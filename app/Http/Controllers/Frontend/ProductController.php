<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Research\ResearchRepositoryInterface;
use App\Repositories\ReadAfter\ReadAfterRepositoryInterface;
use App\Repositories\Library\LibraryRepositoryInterface;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;
use Illuminate\Support\Facades\Route;
use App\Helpers\Envato\Ulities;
use Illuminate\Support\Facades\Config;
use Elasticsearch\ClientBuilder;
use Auth;


class ProductController extends Controller
{
	/**
     * @var ProductRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var CategoryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var ResearchRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $researchRepository;

    /**
     * @var ProductDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $productdetailRepository;

    /**
     * @var ReadAfterRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $readafterRepository;

    /**
     * @var LibraryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $libraryRepository;

    /**
     * @var LibraryDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $librarydetailRepository;


	/**
     * Instantiate product controller.
     *
     * @param Request $request
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ResearchRepositoryInterface $researchRepository
     * @param ProductDetailRepositoryInterface $productdetailRepository
     * @param ReadAfterRepositoryInterface $readafterRepository
     * @param LibraryRepositoryInterface $libraryRepository
     * @param LibraryDetailRepositoryInterface $librarydetailRepository
     * @return void
     */
    public function __construct(
        Request $request, 
        ProductRepositoryInterface $productRepository, 
        ProductDetailRepositoryInterface $productdetailRepository, 
        CategoryRepositoryInterface $categoryRepository, 
        ResearchRepositoryInterface $researchRepository, 
        ReadAfterRepositoryInterface $readafterRepository, 
        LibraryRepositoryInterface $libraryRepository, 
        LibraryDetailRepositoryInterface $librarydetailRepository)
    {
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->researchRepository = $researchRepository;
        $this->readafterRepository = $readafterRepository;
        $this->libraryRepository = $libraryRepository;
        $this->libraryDetailRepository = $librarydetailRepository;
        $this->productdetailRepository = $productdetailRepository;
    }

	/**
	 * Display list product with keyword filter
	 *
	 * @return View
	 */
    public function index()
    {
		$q = $this->request->has('q') ? $this->request->get('q') : null;
		$page = $this->request->has('page') ? $this->request->get('page') : 1;
		$limit = Config::get('constants.rowPage');
		$currentPath = Route::getFacadeRoot()->current()->uri();

		$options = null;
		$options['page'] = $page;
		$options['limit'] = $limit;
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
            $options['category_query'] = $this->request->get('category');
			$options['category'] = $arrCategory;
			$paramPath .= 'category=' . $this->request->get('category') . '&';
		}

		$urlSort = [];
		$urlSort['latest'] = '/' . $currentPath . '?' . $paramPath . 'sort=desc';
		$urlSort['oldest'] = '/' . $currentPath . '?' . $paramPath . 'sort=asc';
        if($this->request->has('page')) {
            $urlSort['latest'] .= '&page=' . $this->request->get('page');
            $urlSort['oldest'] .= '&page=' . $this->request->get('page');
        }

		$indexName = Config::get('constants.elasticsearch.product.index');
		$typeName = Config::get('constants.elasticsearch.product.type');

		$params = Ulities::getElasticParams($indexName, $typeName, $options);
		$client = ClientBuilder::create()->build();
        $response = $client->search($params);

        $products = [];
        if (!empty($response)) {
            $products['total'] = $response['hits']['total'];
            $products['hits'] = $response['hits']['hits'];
        }

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

		$paginate = Ulities::calculatorPage($q, $page, $products['total'], $limit, $options);
		$result = $this->productRepository->paginate($limit)->toArray();
		// list category left
		$category = $this->categoryRepository->parentOrderByPath()->toArray();
		// list researches
		$researches = $this->researchRepository->getListItem(5);
        $library = $this->libraryRepository->getAllLibraryByUserID(Auth::user()->id)->toArray();
		return view('Frontend.Product.index', compact('products', 'category', 'researches', 'productItems', 'urlSort', 'result', 'paginate', 'q', 'library'));
    }

}
