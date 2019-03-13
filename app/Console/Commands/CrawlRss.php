<?php

namespace App\Console\Commands;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Rss\RssRepositoryInterface;
use App\Repositories\Web\WebRepositoryInterface;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class CrawlRss extends Command
{

    /**
     * @var RssRepositoryInterface|BaseRepositoryInterface
     */
    private $rss;

    /**
     * @var WebRepositoryInterface|BaseRepositoryInterface
     */
    private $web;

    /**
     * @var ClientBuilder
     */
    private $client;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:crawlRss';

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
        RssRepositoryInterface $rssRepository,
        WebRepositoryInterface $webRepository
    )
    {
        parent::__construct();

        $this->rss = $rssRepository;

        $this->web = $webRepository;

        $this->client = ClientBuilder::create()->build();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->getDataFromRss();
    }

    /**
     * Get content from RSS
     */
    private function getDataFromRss()
    {
        $rssList = $this->rss->all();
        Log::info('======================================================================================');
        Log::info('Starting get data from Rss...');
        Log::info('======================================================================================');
        foreach ($rssList as $rss) {
            $url = $rss->url;
            Log::info('Link Rss: '. $url);
            $data = $this->getInformationRss($url);
            $this->pushData($data);
        }
        Log::info('======================================================================================');
        Log::info('Finished get data from Rss.');
        Log::info('======================================================================================');
    }

    /**
     * Get information from RSS
     * @param $url
     * @return array
     */
    private function getInformationRss($url)
    {
        $rss = new \DOMDocument();
        $rss->load($url);

        $feed = array();
        foreach ($rss->getElementsByTagName('item') as $node) {

            $title = $node->getElementsByTagName('title')->length > 0 ? $node->getElementsByTagName('title')->item(0)->nodeValue : '';
            $description = $node->getElementsByTagName('description')->length > 0 ? $node->getElementsByTagName('description')->item(0)->nodeValue : '';
            $enclosure = $node->getElementsByTagName('enclosure')->length > 0 ? $node->getElementsByTagName('enclosure')->item(0)->getAttribute('url') : '';
            $link = $node->getElementsByTagName('link')->length > 0 ? $node->getElementsByTagName('link')->item(0)->nodeValue : '';
            $pubDate = $node->getElementsByTagName('pubDate')->length > 0 ? $node->getElementsByTagName('pubDate')->item(0)->nodeValue : '';

            $item = [
                'title'         => $title,
                'description'   => $description,
                'enclosure'     => $enclosure,
                'link'          => $link,
                'pub_date'      => !empty($pubDate) ? date('Y-m-d H:m:s', strtotime($pubDate)) : $pubDate,
                'view'          => 0,
                'like'          => 0,
                'is_delete'     => 0
            ];

            $feed[] = $item;

        }

        return $feed;
    }

    /**
     * Push data into mongodb and elasticSearch
     * @param $data
     */
    private function pushData($data)
    {
        foreach ($data as $item) {
            $web = $this->web->findFirst('link', $item['link']);
            if (empty($web)) {
                $result = $this->web->create($item);

                $document = [
                    'body'  => [
                        'title'         => $item['title'],
                        'description'   => $item['description'],
                        'enclosure'     => $item['enclosure'],
                        'link'          => $item['link'],
                        'pub_date'      => $item['pub_date'],
                        'view'          => $item['view'],
                        'like'          => $item['like']
                    ],
                    'index' => Config::get('constants.elasticsearch.web.index'),
                    'type'  => Config::get('constants.elasticsearch.web.type'),
                    'id'    => $result->_id
                ];

                $this->client->index($document);

            } else {
                $result = $this->web->update($web['id'], $item);

                $document = [
                    'body'  => [
                        'doc'   => [
                            'title'         =>  $item['title'],
                            'description'   =>  $item['description'],
                            'enclosure'     =>  $item['enclosure'],
                            'link'          =>  $item['link'],
                            'pub_date'      =>  $item['pub_date'],
                        ]
                    ],
                    'index' =>  Config::get('constants.elasticsearch.web.index'),
                    'type'  =>  Config::get('constants.elasticsearch.web.type'),
                    'id'    =>  $web['id']
                ];

                $this->client->update($document);

            }
        }


    }

}
