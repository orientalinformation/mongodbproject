<?php

namespace App\Console\Commands;

use App\Model\PostElastic;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\Source\SourceRepositoryInterface;
use App\Repositories\Topic\TopicRepositoryInterface;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CrawlWeb extends Command
{
    /**
     * @var PostRepositoryInterface|BaseRepositoryInterface
     */
    private $post;

    /**
     * @var TopicRepositoryInterface|BaseRepositoryInterface
     */
    private $topic;

    /**
     * @var SourceRepositoryInterface|BaseRepositoryInterface
     */
    private $source;

    /**
     * @var ClientBuilder
     */
    private $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:crawlWeb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        TopicRepositoryInterface $topicRepository,
        SourceRepositoryInterface $sourceRepository
    )
    {
        parent::__construct();

        $this->post     = $postRepository;

        $this->topic    = $topicRepository;

        $this->source   =$sourceRepository;

        $this->client   = ClientBuilder::create()->build();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getTechnologies();

    }

    /**
     * get data technologies of scoop.it page
     */
    private function getTechnologies()
    {
        $dataTopics = $this->topic->all();
        $dataSources = $this->source->getTechnology();
        $write = 0;

        foreach ($dataSources as $source) {
            $dataPost = [];
            Log::info("Starting to get data from '$source->url'");
            foreach ($dataTopics as $topic) {
                $topicName = str_replace(' ', '+', $topic->name);
                $url = $source->url . $topicName;
                $pages = $this->getPageTopic($url);
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i > 100) {
                        break;
                    }
                    $url = $source->url . $topicName . "&type=post&page=$i&limit=24";
                    $dataPost[$topicName][] = $this->getTopicContent($url, $topic->id);
                }
            }
            if (count($dataPost) > 0) {
                if (!$write) {
                    $this->deleteDataMongoAndElasticSearch();
                }
                $this->insertMongoToElasticSearch($dataPost);
                $write = 1;
            }
            Log::info("Finished to get data from '$source->url'");
        }

        if($write) {
            Log::info('Finished to get and insert data into post table and elasticSearch.');
        } else {
            Log::info('Do not insert data into post table and elasticSearch.');
        }

    }

    /**
     * get page of topic
     * @param $url
     * @return int
     */
    private function getPageTopic($url)
    {
        $cURL = curl_init($url);
        curl_setopt($cURL, CURLOPT_USERAGENT, "Mozilla/5.0");
        curl_setopt($cURL, CURLOPT_HTTPHEADER, ['Content-type: text/html','charset=UTF-8']);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

        //Gán nội dung trả về vào một biến
        $content = curl_exec($cURL);

        curl_close($cURL);

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$doc->loadHTML($content);

        $xpath = new \DOMXPath($doc);

        $ul = $xpath->query('//ul[contains(@class, "navtab-menu")]');
        $li = $ul[0]->getElementsByTagName("li");
        $aTag = $li[0]->getElementsByTagName("a");

        $records = (int) filter_var($aTag[0]->nodeValue, FILTER_SANITIZE_NUMBER_INT);
        $pageNum = 0;

        if ($records > 0) {
            $pageNum = (int)($records/24);
            $pageNum += ($records % 24) > 0 ? 1 : 0;
        }

        return $pageNum;

    }

    /**
     * Get topic content
     * @param $url
     * @param $topicId
     * @return array
     */
    private function getTopicContent($url, $topicId)
    {

        $cURL = curl_init($url);
        curl_setopt($cURL, CURLOPT_USERAGENT, "Mozilla/5.0");
        curl_setopt($cURL, CURLOPT_HTTPHEADER, ['Content-type: text/html', 'charset=UTF-8']);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($cURL);

        curl_close($cURL);

        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        @$doc->loadHTML($content);

        $xpath = new \DOMXPath($doc);

        //Get content items of scoop.it
        $postOnePostTwoBrick = $xpath->query('//div[@class="post onePost twocbrick    "]');
        $avatar = "";
        $avatarUrl = "";
        $resultName = "";
        $resultUrl = "";
        $authorName = "";
        $authorUrl = "";
        $data = [];
        foreach ($postOnePostTwoBrick as $onePostBlock) {
            $children = $onePostBlock->ownerDocument->saveXML($onePostBlock);

            $dom = new \DOMDocument();
            $dom->loadHTML($children);

            $xpath = new \DOMXPath($dom);

            //Get Header Start
            $tableElement = $xpath->query('//table[contains(@class, "post-history posthistory")]');
            $dataElement = [];
            foreach ($tableElement as $element) {
                $tdElements = $element->getElementsByTagName("td");
                foreach ($tdElements as $tdElement) {
                    $aElements = $tdElement->getElementsByTagName("a");
                    if (count($aElements) == 1) {
                        $imgIcon = $aElements[0]->getElementsByTagName("img");
                        if (!is_null($imgIcon)) {
                            $avatar = $imgIcon[0]->getAttribute("src");
                            $avatarUrl = $aElements[0]->getAttribute("href");
                        }
                    } else if (count($aElements) == 2) {
                        $resultName  = $aElements[0]->nodeValue;
                        $resultUrl   = $aElements[0]->getAttribute("href");
                        $authorName = $aElements[1]->nodeValue;
                        $authorUrl  = $aElements[1]->getAttribute("href");
                    }
                }

                $dataElement['avatar']      = $avatar;
                $dataElement['avatarUrl']   = $avatarUrl;
                $dataElement['resultName']   = $resultName;
                $dataElement['resultUrl']    = !empty($resultUrl) && !strpos('http', $resultUrl) ? 'https://www.scoop.it' . $resultUrl : $resultUrl;
                $dataElement['authorName']  = $authorName;
                $dataElement['authorUrl']   = $authorUrl;

            }
            //Get Header End

            //Get Content Start
            $title = "";
            $titleUrl = "";
            $postMetaName = "";
            $postImage = "";
            $postMetaUrl = "";
            $postMetaDateTime = "";
            $postMetaDateTimeUrl = "";


            $divPostView = $xpath->query('//div[contains(@class, "post-title tCustomization tCustomization_post_title editable-container tooltip-on-mouse")]');
            $aElement = $divPostView[0]->getElementsByTagName("a");
            if (!is_null($aElement[0])) {
                $title = utf8_decode(trim($aElement[0]->nodeValue));
                $titleUrl = $aElement[0]->getAttribute("href");
            }

            $divImage = $xpath->query('//div[contains(@class, "thisistherealimage")]');
            if (count($divImage) > 0) {
                $imgElement = $divImage[0]->getElementsByTagName("img");
                if (count($imgElement) > 0) {
                    $postImage = $imgElement[0]->getAttribute("src");
                }
            }

            $divPostMeta = $xpath->query('//div[contains(@class, "post-metas tCustomization_post_metas")]');
            $aElement = $divPostMeta[0]->getElementsByTagName("a");
            if (!is_null($aElement[0])) {
                $postMetaName = trim($aElement[0]->nodeValue);
                $postMetaUrl = $aElement[0]->getAttribute("href");
            }
            if (!is_null($aElement[1])) {
                $postMetaDateTime = trim($aElement[1]->nodeValue);
                $postMetaDateTimeUrl = $aElement[1]->getAttribute("href");
            }


            $divPostDescription = $xpath->query('//div[contains(@class, "tCustomization tCustomization_post_description")]');
            $nodeValue = trim($divPostDescription[0]->nodeValue);
            $description = utf8_decode(substr($nodeValue,0,strpos($nodeValue, "...") > 0 ? strpos($nodeValue, "...") + 3 : strlen($nodeValue)));

            $dataElement['title']               = $title;
            $dataElement['titleUrl']            = $titleUrl;
            $dataElement['image']               = $postImage;
            $dataElement['postMetaName']        = $postMetaName;
            $dataElement['postMetaUrl']         = $postMetaUrl;
            $dataElement['postMetaDateTime']    = $postMetaDateTime;
            $dataElement['postMetaDateTimeUrl'] = !empty($postMetaDateTimeUrl) && !strpos('http', $postMetaDateTimeUrl) ? 'https://www.scoop.it' . $postMetaDateTimeUrl : $postMetaDateTimeUrl;
            $dataElement['description']         = $description;
            $dataElement['topicId']             = $topicId;

            //Get Content End

            $data[] = $dataElement;

        }

        return $data;

    }

    /**
     * Insert data into mongoDB and ElasticSearch
     * @param $dataPosts
     */
    private function insertMongoToElasticSearch($dataPosts)
    {
        foreach ($dataPosts as $dataPost) {
            foreach ($dataPost as $items) {
                foreach ($items as $data) {
                    $item = $this->post->create($data);

                    $post = new PostElastic();

                    $document = [
                        'body' => [
                            'avatar'                => $item->avatar,
                            'avatarUrl'             => $item->avatarUrl,
                            'resultName'            => $item->resultName,
                            'resultUrl'             => $item->resultUrl,
                            'authorName'            => $item->authorName,
                            'authorUrl'             => $item->authorUrl,
                            'title'                 => $item->title,
                            'titleUrl'              => $item->titleUrl,
                            'image'                 => $item->image,
                            'postMetaName'          => $item->postMetaName,
                            'postMetaUrl'           => $item->postMetaUrl,
                            'postMetaDateTime'      => $item->postMetaDateTime,
                            'postMetaDateTimeUrl'   => $item->postMetaDateTimeUrl,
                            'description'           => $item->description,
                            'topicId'               => $item->topicId
                        ],
                        'index' => $post->getIndexName(),
                        'type'  => $post->getTypeName(),
                        'id'    => $item->_id,
                    ];

                    $this->client->index($document);
                }
            }
        }
    }

    /**
     * Delete data from mongoDB and ElasticSearch
     */
    private function deleteDataMongoAndElasticSearch()
    {
        //Delete all document
        $result = DB::connection('mongodb')->collection('post')->delete();
        if ($result) {
            //Delete all data of Post table in elasticSearch
            $post = new PostElastic();
            $params['index'] = $post->getIndexName();
            $this->client->indices()->delete($params);
        }

    }

    

}
