<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Research\ResearchRepositoryInterface;
use Illuminate\Support\Facades\Route;
use App\Helpers\Envato\Ulities;
use Illuminate\Support\Facades\Config;


class ProductController extends Controller
{
	/**
     * @var ProductRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $productRepository;

	/**
     * Instantiate product controller.
     *
     * @param Request $request
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ResearchRepositoryInterface $researchRepository
     * @return void
     */
    public function __construct(Request $request, ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, ResearchRepositoryInterface $researchRepository)
    {
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->researchRepository = $researchRepository;
    }

	/**
	 *
	 * Display list product with keyword filter
	 *
	 * @return view
	 */
    public function index()
    {
		$q = $this->request->has('q') ? $this->request->get('q') : null;
		$page = $this->request->has('page') ? $this->request->get('page') : 1;
		$currentPath = Route::getFacadeRoot()->current()->uri();

		$options = null;
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
			$options['category'] = $this->request->get('category');
			$paramPath .= 'category=' . $options['category'] . '&';
		}

		$urlSort = [];
		$urlSort['latest'] = '/' . $currentPath . '?' . $paramPath . 'sort=desc';
		$urlSort['oldest'] = '/' . $currentPath . '?' . $paramPath . 'sort=asc';

		$products = $this->productRepository->searchByKeyword($q, $page, $options);
		$productItems = [];
		if(!empty($products['hits'])){ 
			if (count($products['hits']) > 6) {
				$itemTotal = ceil(count($products['hits'])/6);
				$from = 0;
				$to = 6;
				for($i = 0; $i < $itemTotal; $i++){
					$productItems[] = array_slice($products['hits'], $from, $to);
					$from += 6;
				}
		    } else {
		    	$productItems[] = $products['hits'];
		    }
		}

		$rowPage = Config::get('constants.rowPageProduct');
		$paginate = Ulities::calculatorPage($q, $page, $products['total'], $rowPage);
		$result = $this->productRepository->paginate($rowPage)->toArray();
		// list category left
		$category = $this->categoryRepository->parentOrderByPath()->toArray();
		// list researches
		$researches = $this->researchRepository->getListItem(5);

		return view('Frontend.Product.index', compact('products', 'category', 'researches', 'productItems', 'urlSort', 'result', 'paginate', 'q'));
    }
}
