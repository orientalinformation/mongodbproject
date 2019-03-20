<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Route;
use App\Repositories\Research\ResearchRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;
use App\Repositories\Library\LibraryRepositoryInterface;

class BibliothequeController extends Controller
{
    /**
     * @var BibliothequeRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bibliothequetRepository;

	/**
     * @var CategoryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var ResearchRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
	protected $researchRepository;
	
	/**
     * @var LibraryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
	protected $libraryRepository;
	
	/**
     * Instantiate Bibliotheque controller.
     *
     * @param Request $request
	 * @param CategoryRepositoryInterface $categoryRepository
	 * @param ResearchRepositoryInterface $researchRepository
	 * @param LibraryRepositoryInterface $libraryRepository
     * @param BibliothequeRepositoryInterface $bibliothequeRepository
     * @return void
     */
    public function __construct(
        Request $request,
        BibliothequeRepositoryInterface $bibliothequeRepository,
		CategoryRepositoryInterface $categoryRepository,
		ResearchRepositoryInterface $researchRepository,
		LibraryRepositoryInterface $libraryRepository
    ) {
        $this->request = $request;
        $this->bibliothequeRepository = $bibliothequeRepository;
        $this->categoryRepository = $categoryRepository;
		$this->researchRepository = $researchRepository;
		$this->libraryRepository = $libraryRepository;
    }

    /** 
     * Display Bibliottheque
     * @return View
     */
    public function index()
    {
        $q                   = $this->request->has('q') ? $this->request->get('q') : null;
		$page                = $this->request->has('page') ? $this->request->get('page') : 1;
		$currentPath         = Route::getFacadeRoot()->current()->uri();
		$limit               = Config::get('constants.rowPage');
		$options             = null;
		$options['page']     = $page;
		$options['limit']    = $limit;
		if ($q != null) {
			$options['q'] = $q;
		}
		if ($this->request->has('sort')) {
			$options['sort'] = $this->request->get('sort');
		}

		// url ordering
		$paramPath = '';
		if ($q != null) {
			$paramPath = 'q=' . $q . '&';
		}

		if($this->request->has('start_year') && $this->request->has('end_year')) {
			$options['start_year'] = $this->request->get('start_year');
			$options['end_year'] = $this->request->get('end_year');
			$paramPath .= 'start_year=' . $options['start_year'] . '&end_year=' . $options['end_year'] . '&';
		}

		if($this->request->has('category')) {
			$categories = explode(',', $this->request->get('category'));
			$arrCategory = [];
			foreach ($categories as $category) {
				$listCategories = $this->categoryRepository->getCategoryTreeId($category);
				foreach ($listCategories as $listCategory) {
					$arrCategory[] = $listCategory;
				}
			}

			$arrCategory = array_values(array_unique($arrCategory));
			$options['category'] = $arrCategory;
			$paramPath .= 'category=' . $this->request->get('category') . '&';
		}

		$urlSort           = [];
		$urlSort['latest'] = '/' . $currentPath . '?' . $paramPath . 'sort=desc';
		$urlSort['oldest'] = '/' . $currentPath . '?' . $paramPath . 'sort=asc';
		$indexName         = Config::get('constants.elasticsearch.bibliotheque.index');
		$typeName          = Config::get('constants.elasticsearch.bibliotheque.type');

		$params            = Ulities::getElasticParams($indexName, $typeName, $options);
		
		$client            = ClientBuilder::create()->build();
		$response          = $client->search($params);
		
		$bibliotheques = [];
		if (!empty($response)) {
            $bibliotheques['total'] = $response['hits']['total'];
            $bibliotheques['hits']  = $response['hits']['hits'];
		}
		
		$bibliothequeItems = [];
		if(!empty($bibliotheques['hits'])) { 
			if (count($bibliotheques['hits']) > 6) {
				$itemTotal = ceil(count($bibliotheques['hits'])/6);
				$from      = 0;
				$to        = 6;
				for($i = 0; $i < $itemTotal; $i++){
					$bibliothequeItems[] = array_slice($bibliotheques['hits'], $from, $to);
					$from += 6;
				}
		    } else {
		    	$bibliothequeItems[] = $bibliotheques['hits'];
		    }
		}

		$paginate = Ulities::calculatorPage($q, $page, $bibliotheques['total'], $limit);
        $result   = $this->bibliothequeRepository->paginate($limit)->toArray();

		// list category left
        $category = $this->categoryRepository->parentOrderByPath()->toArray();

		// list researches
		$researches = $this->researchRepository->getListItem(5)->toArray();
		$library    = $this->libraryRepository->getAllLibraryByUserID("1")->toArray();

		return view(
			'Frontend.Bibliotheque.index',
			compact('bibliotheques', 'category', 'researches', 'bibliothequeItems', 'urlSort', 'result', 'paginate', 'q', 'library')
		);
    }
}
