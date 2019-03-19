<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Route;
// use App\Repositories\Research\ResearchRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;

class BibliothequeController extends Controller
{
    /**
     * @var BibliothequeRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bibliothequetRepository;

	/**
     * Instantiate product controller.
     *
     * @param Request $request
     * @param BibliothequeRepositoryInterface $bibliothequeRepository
     * @return void
     */
    public function __construct(
        Request $request,
        BibliothequeRepositoryInterface $bibliothequeRepository,
		CategoryRepositoryInterface $categoryRepository
    ) {
        $this->request = $request;
        $this->bibliothequeRepository = $bibliothequeRepository;
        $this->categoryRepository = $categoryRepository;
        // $this->researchRepository = $researchRepository;
    }

    /** 
     * Display Bibliottheque
     * @return View
     */
    public function index()
    {
        $q           = $this->request->has('q') ? $this->request->get('q') : null;
		$page        = $this->request->has('page') ? $this->request->get('page') : 1;
		$currentPath = Route::getFacadeRoot()->current()->uri();

		$options     = null;
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

		$bibliotheques     = $this->bibliothequeRepository->searchByKeyword($q, $page, $options);
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

		$rowPage = Config::get('constants.rowPageBibliotheque');
		$paginate = Ulities::calculatorPage($q, $page, $bibliotheques['total'], $rowPage);
        $result = $this->bibliothequeRepository->paginate($rowPage)->toArray();

		// list category left
        $category = $this->categoryRepository->parentOrderByPath()->toArray();

		// list researches
		// $researches = $this->researchRepository->getListItem(5);

		return view(
			'Frontend.Bibliotheque.index',
			compact('bibliotheques', 'category', 'researches', 'bibliothequeItems', 'urlSort', 'result', 'paginate', 'q')
		);
    }
}
