<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Research\ResearchRepositoryInterface;
use Illuminate\Support\Facades\Route;


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
    	$input = $this->request->all();
		$keyword = (isset($input['keyword'])) ? $input['keyword'] : null;
		$page = (isset($input['page'])) ? $input['page'] : 1;
		$currentPath = Route::getFacadeRoot()->current()->uri();
		// url ordering
		$urlSort = [];
		$urlSort['latest'] = '/' . $currentPath . '?sort=desc';
		$urlSort['oldest'] = '/' . $currentPath . '?sort=asc';
		if ($keyword != null) {
			$urlSort['latest'] = '/' . $currentPath . '?keyword=' . $keyword . '&sort=desc';
			$urlSort['oldest'] = '/' . $currentPath . '?keyword=' . $keyword . '&sort=asc';  
		}

		$options = null;
		if (isset($input['sort'])) {
			$options['sort'] = $input['sort'];
		}

		$products = $this->productRepository->searchByKeyword($keyword, $page, $options);
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

		// list category left
		$category = $this->categoryRepository->parentOrderByPath()->toArray();
		// list researches
		$researches = $this->researchRepository->getListItem(5);

		return view('Frontend.Product.index', compact('keyword', 'products', 'category', 'researches', 'productItems', 'urlSort'));
    }
}
