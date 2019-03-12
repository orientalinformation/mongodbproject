<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
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
     * @param CategoryRepositoryInterface $cateogryRepository
     * @return void
     */
    public function __construct(Request $request, ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $cateogryRepository)
    {
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->cateogryRepository = $cateogryRepository;
    }

	/**
	 *
	 * Display list product with keyword filter
	 *
	 * @return view
	 */
    public function search()
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

		$category = $this->cateogryRepository->parentOrderByPath()->toArray();

		return view('Frontend.Product.search', compact('keyword', 'products', 'category', 'productItems', 'urlSort'));
    }
}
