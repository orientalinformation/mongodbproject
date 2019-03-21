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
			$options['category'] = $arrCategory;
			$paramPath .= 'category=' . $this->request->get('category') . '&';
		}

		$urlSort = [];
		$urlSort['latest'] = '/' . $currentPath . '?' . $paramPath . 'sort=desc';
		$urlSort['oldest'] = '/' . $currentPath . '?' . $paramPath . 'sort=asc';
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

		$paginate = Ulities::calculatorPage($q, $page, $products['total'], $limit);
		$result = $this->productRepository->paginate($limit)->toArray();
		// list category left
		$category = $this->categoryRepository->parentOrderByPath()->toArray();
		// list researches
		$researches = $this->researchRepository->getListItem(5);
        $library = $this->libraryRepository->getAllLibraryByUserID(Auth::user()->id)->toArray();
		return view('Frontend.Product.index', compact('products', 'category', 'researches', 'productItems', 'urlSort', 'result', 'paginate', 'q', 'library'));
    }

    /**
     * Check status like
     *
     * @return string
     */
    public function checkLiked(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("object_id")){
            $userId = Auth::user()->id;
            $objectId = $request->get("object_id");
            $productDetail = $this->productdetailRepository->checkLiked($userId, $objectId)->toArray();

            if(sizeof($productDetail) > 0){
                $result['status'] = 1;
                $result['data'] = $productDetail;
            }else{
                $result['status'] = 0;
            }

            if($request->has("change")){
                $change = $request->get("change");
                if($change == 1){
                    if(sizeof($productDetail) > 0){
                        foreach($productDetail as $item){
                            $data['product_id'] = $item['product_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = $item['share'];
                            $data['pink'] = $item['pink'];
                            $data['is_public'] = $item['is_public'];
                            $data['is_delete'] = 1;
                            $this->productdetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $productDetail = $this->productdetailRepository->checkunLiked($userId, $objectId)->toArray();
                        if(sizeof($productDetail) > 0){
                            foreach($productDetail as $item){
                                $data['product_id'] = $item['product_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = $item['share'];
                                $data['pink'] = $item['pink'];
                                $data['is_public'] = $item['is_public'];
                                $data['is_delete'] = 0;
                                $this->productdetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['product_id'] = $objectId;
                            $data['user_id'] = $userId;
                            $data['share'] = 0;
                            $data['pink'] = 0;
                            $data['is_public'] = 0;
                            $data['is_delete'] = 0;
                            $data = $this->productdetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }

        return response()->json($result);
    }

    /**
     * Check status read
     *
     * @return string
     */
    public function checkRead(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("object_id")){
            $userId = Auth::user()->id;
            $objectId = $request->get("object_id");
            $type = Config::get('constants.objectType.book');
            $productDetail = $this->readafterRepository->checkRead($userId, $objectId, $type)->toArray();

            if(sizeof($productDetail) > 0){
                $result['status'] = 1;
                $result['data'] = $productDetail;
            }else{
                $result['status'] = 0;
            }

            if($request->has("change")){
                $change = $request->get("change");
                if($change ==1){
                    if(sizeof($productDetail) > 0){
                        foreach($productDetail as $item){
                            $data['user_id'] = $item['user_id'];
                            $data['object_id'] = $item['object_id'];
                            $data['type_name'] = $type;
                            $data['is_delete'] = 1;
                            $this->readafterRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $productDetail = $this->readafterRepository->checkunRead($userId, $objectId, $type)->toArray();
                        if(sizeof($productDetail) > 0){
                            foreach($productDetail as $item){
                                $data['user_id'] = $item['user_id'];
                                $data['object_id'] = $item['object_id'];
                                $data['type_name'] = $type;
                                $data['is_delete'] = 0;
                                $this->readafterRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['user_id'] = $userId;
                            $data['object_id'] = $objectId;
                            $data['type_name'] = $type;
                            $data['is_delete'] = 0;
                            $data = $this->readafterRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }
        
        return response()->json($result);
    }

    /**
     * Get library detail with user id
     *
     * @return string
     */
    public function getLibraryDetailbyUserID(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('library_id') && $request->has('object_id')) {
            $library_id = $request->get('library_id');
            $objectId = $request->get('object_id');
            $type = Config::get('constants.objectType.book');
            $libraryDetail = $this->libraryDetailRepository->getLibraryDetail($library_id, $objectId, $type)->toArray();
            $library_data = [];
            if(sizeof($libraryDetail) > 0){
                foreach($libraryDetail as $item){
                    $library_data[] = $item['_id'];
                }
                $result['status'] = 1;
                $result['data'] = $library_data;
            }
        }else{
            $result['status'] = 0;
            $result['data'] = '';
        }
        
        return response()->json($result);
    }

    /**
     * Update library detail
     *
     * @return string
     */
    public function updateLibraryDetail(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('library_id') && $request->has('object_id')) {
            $library_id = $request->get('library_id');
            $objectId = $request->get('object_id');
            $type = Config::get('constants.objectType.product');
            $libraryDetail = $this->libraryDetailRepository->getLibraryDetail($library_id, $objectId, $type)->toArray();
            $libraryDetailExist = $this->libraryDetailRepository->getLibraryDetailExist($library_id, $objectId, $type)->toArray();

            if(sizeof($libraryDetail) <= 0){
                if(sizeof($libraryDetailExist) > 0){
                    foreach($libraryDetailExist as $item){
                        $data = [];
                        $data['library_id'] = $item['library_id'];
                        $data['object_id'] = $item['object_id'];
                        $data['type_name'] = $item['type_name'];
                        $data['share'] = $item['share'];
                        $data['is_delete'] = 0;
                        $this->libraryDetailRepository->update($item['_id'], $data);
                    }
                    $result['status'] = 1;
                }else{
                    $data = [];
                    $data['library_id'] = $library_id;
                    $data['object_id'] = $objectId;
                    $data['type_name'] = $type;
                    $data['share'] = 0;
                    $data['is_delete'] = 0;
                    $this->libraryDetailRepository->create($data);
                    $result['status'] = 2;
                }
            }else{
                foreach($libraryDetail as $item) {
                    $data = [];
                    $data['library_id'] = $item['library_id'];
                    $data['object_id'] = $item['object_id'];
                    $data['type_name'] = $item['type_name'];
                    $data['share'] = $item['share'];
                    $data['is_delete'] = 1;
                    $this->libraryDetailRepository->update($item['_id'], $data);
                }
                $result['status'] = 3;
            }
        }else{
            $result['status'] = 0;
            $result['data'] = '';
        }
        
        return response()->json($result);
    }

    /**
     * Create a library
     *
     * @return string
     */
    public function createLibrary(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('name')) {
            $name = $request->get('name');
            $userId = Auth::user()->id;

            $checkName = $this->libraryRepository->checkName($userId,$name)->toArray();

            if(sizeof($checkName) <= 0){
                $data = [];
                $data['name'] = $name;
                $data['alias'] = Ulities::to_slug($name);
                $data['share'] = 0;
                $data['user_id'] = $userId;
                $data['view'] = 0;
                $data['is_delete'] = 0;
                $data_result = $this->libraryRepository->create($data);

                $result['status'] = 1;
                $result['data'] = $data_result;
            }else{
                $result['status'] = 0;
                $result['data'] = 'Name is exist';
            }
        }else{
            $result['status'] = 0;
            $result['data'] = '';
        }
        
        return response()->json($result);
    }

    /**
     * Check share status
     *
     * @return string
     */
    public function checkShare(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("object_id")){
            $userId = Auth::user()->id;
            $objectId = $request->get("object_id");
            $productDetail = $this->productdetailRepository->checkShared($userId, $objectId)->toArray();

            if(sizeof($productDetail) > 0){
                $result['status'] = 1;
                $result['data'] = $productDetail;
            }else{
                $result['status'] = 0;
            }

            if($request->has("change")){
                $change = $request->get("change");
                if($change ==1){
                    if(sizeof($productDetail) > 0){
                        foreach($productDetail as $item){
                            $data['product_id'] = $item['product_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = 0;
                            $data['pink'] = $item['pink'];
                            $data['is_public'] = $item['is_public'];
                            $data['is_delete'] = $item['is_delete'];
                            $this->productdetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $productDetail = $this->productdetailRepository->checkunLiked($userId, $objectId)->toArray();
                        if(sizeof($productDetail) > 0){
                            foreach($productDetail as $item){
                                $data['product_id'] = $item['product_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = 1;
                                $data['pink'] = $item['pink'];
                                $data['is_public'] = $item['is_public'];
                                $data['is_delete'] = $item['is_delete'];
                                $this->productdetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['product_id'] = $objectId;
                            $data['user_id'] = $userId;
                            $data['share'] = 1;
                            $data['pink'] = 0;
                            $data['is_public'] = 0;
                            $data['is_delete'] = 0;
                            $data = $this->productdetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }

        return response()->json($result);
    }
}
