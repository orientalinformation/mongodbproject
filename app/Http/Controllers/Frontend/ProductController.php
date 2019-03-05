<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;

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
     * @return void
     */
    public function __construct(Request $request, ProductRepositoryInterface $productRepository)
    {
        $this->request = $request;
        $this->productRepository = $productRepository;
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
		$products = $this->productRepository->searchByKeyword($keyword, $page);
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

		return view('Frontend.Product.search', compact('keyword', 'products', 'productItems'));
    }


}
