<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Envato\ObjectService;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;
use App\Repositories\Library\LibraryRepositoryInterface;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookDetail\BookDetailRepositoryInterface;
use App\Helpers\Envato\Ulities;
use Illuminate\Support\Facades\Config;
use Elasticsearch\ClientBuilder;

class AjaxController extends Controller
{
	/**
     * @var ObjectService|\App\Helpers\Envato\ObjectService
     */
    protected $objectService;

    /**
     * @var ProductRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var ProductDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
	protected $productdetailRepository;
	
	/**
     * @var LibraryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $libraryRepository;

    /**
     * @var LibraryDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $libraryDetailRepository;

    /**
     * @var BookRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bookRepository;

    /**
     * @var BookDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bookdetailRepository;

	/**
     * Instantiate Ajax controller.
     *
     * @param Request $request
     * @param ObjectService $objectService
     * @return void
     */
    public function __construct(
    	Request $request, 
    	ObjectService $objectService, 
    	ProductRepositoryInterface $productRepository, 
        ProductDetailRepositoryInterface $productdetailRepository,
        BookRepositoryInterface $bookRepository,
		BookDetailRepositoryInterface $bookdetailRepository,
		LibraryDetailRepositoryInterface $libraryDetailRepository,
		LibraryRepositoryInterface $libraryRepository
    )
    {
        $this->request = $request;
        $this->objectService = $objectService;
        $this->productRepository = $productRepository;
        $this->productdetailRepository = $productdetailRepository;
        $this->bookdetailRepository = $bookdetailRepository;
		$this->bookRepository = $bookRepository;
		$this->libraryRepository = $libraryRepository;
		$this->libraryDetailRepository = $libraryDetailRepository;
    }
	/**
	 * Popup search advance
	 *
	 * @return string
	 */
    public function searchAdvance()
    {
    	if ($this->request->ajax()) {
    		$request = $this->request->all();
    		$validator = Validator::make($request, [
			    'kind' => 'required',
	        ]);

	        if ($validator->fails()) {
			    $errors = $validator->errors()->all();
			    return response()->json(compact(['errors']), 422);
			}

			$kinds = $this->request->get('kind');
			
	        if (count($kinds) > 1) {
	        	$url = '/home';
	        	if (($this->request->has('q') && $this->request->get('q') != null) || $this->request->has('catID')) {
	        		$url .= '?';
	        	}
	        	
	        	if ($this->request->has('q')) {
        			$url .= 'q=' . $this->request->get('q');
	        	}
	        	
	        	if ($this->request->has('catID')) {
                    if ($this->request->has('q') && $this->request->get('q') != null) {
                        $url .= '&';
                    }
                    
	        		$url .= '&catID=' . implode(',', $this->request->get('catID'));
	        	}

	        	$response = [
	        		'code' => 200,
	        		'url' => $url
	        	];
	        } else {
	        	$url = '/' . $kinds[0];
	        	if (($this->request->has('q') && $this->request->get('q') != null) || $this->request->has('catID')) {
	        		$url .= '?';
	        	}

	        	if ($this->request->has('q') && $this->request->get('q') != null) {
	        		$url .=  'q=' . $this->request->get('q');
	        	}

	        	if ($this->request->has('catID')) {
                    if ($this->request->has('q') && $this->request->get('q') != null) {
                        $url .= '&';
                    }

	        		$url .= 'catID=' . implode(',', $this->request->get('catID'));
	        	}
	        	
	        	$response = [
	        		'code' => 200,
	        		'url' => $url
	        	];
	        }

	        return response()->json($response);
    	}
    }

    /**
     * Get object data
     *
     * @return string
     */
    public function getObjectDataDetail()
	{
		if ($this->request->ajax()) {
			$id = $this->request->get('id');
			$type = $this->request->get('type');
			$idFieldName = null;
			$detailRepositoryName = null;
			switch ($type) {
				case 'product':
					$idFieldName = 'product_id';
					$detailRepositoryName = $this->productdetailRepository;
					break;

                case 'book':
                    $idFieldName = 'book_id';
					$detailRepositoryName = $this->bookdetailRepository;
                    break;

                case 'library':
                    $idFieldName = 'library_id';
					$detailRepositoryName = $this->libraryDetailRepository;
                    break;
			}

			$object = $this->objectService->getDataObjectDetail($id, $idFieldName, $type, $detailRepositoryName);

			return response()->json($object);
		}
	}

	/**
     * set object data
     *
     * @return string
     */
	public function setObjectDataDetail()
	{
		if ($this->request->ajax()) {
			$response = [
				'status' => 0,
				'data' => false
			];
			$id = $this->request->get('id');
			$type = $this->request->get('type');
			$element = $this->request->get('element');
			$result = false;
			$idFieldName = null;
			$repositoryName = null;
			$detailRepositoryName = null;
			switch ($type) {
				case 'product':
					$idFieldName = 'product_id';
					$repositoryName = $this->productRepository;
					$detailRepositoryName = $this->productdetailRepository;
					break;
				
				case 'book':
					$idFieldName = 'book_id';
					$repositoryName = $this->bookRepository;
					$detailRepositoryName = $this->bookdetailRepository;
					break;

				case 'library':
					$idFieldName = 'library_id';
					$repositoryName = $this->libraryRepository;
					$detailRepositoryName = $this->libraryDetailRepository;
			}

			$result = $this->objectService->setDataObjectDetail($id, $idFieldName, $type, $element, $repositoryName, $detailRepositoryName);
			if ($result) {
				$response = [
					'status' => 1,
					'data' => $result
				];
			}

			return response()->json($response);
		}
	}

	public function createLibrary(Request $request){
        $response = [
            'status' => 0,
            'data' => false
        ];
        $error = "";
        if ($request->isMethod('post')){
            if(!$request->has('title') || $request->get('title')==''){
                $error = "title is invalid";
            }else if(!$request->has('alias') || $request->get('alias')==''){
                $error = "alias is invalid";
            }

            if(!empty($error)){
                $response = [
                    'status' => 0,
                    'data' => $error
                ];
            }else{
                $userId = $request->get('user_id');
                $title = $request->get('title');
                $alias = $request->get('alias');
                $price = $request->get('price');
                $description = $request->get('description');
                $categoryId = $request->get('category_id');

                $data = [];
                $data['title'] = $title;
                $data['description'] = $description;
                $data['image'] = "";

                if($request->has('image')) {
                    $fileImage = $request->image;
                    $libraryPath = Config::get('constants.libraryPath');
                    $ext = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
                    $path = Ulities::uploadFile($fileImage, $libraryPath, $ext);
                    $data['image'] = $path['data'];
                }

                $data['user_id'] = (int)$userId;
                $data['category_id'] = $categoryId;
                $data['alias'] = $alias;
                $data['share'] = 0;
                $data['price'] = $price;
                $data['like'] = 0;
                $data['view'] = 0;
                $data['is_public'] = 1;
                $data['is_delete'] = 0;
                $data['is_video'] = 0;
                $data['is_image'] = 0;
                $data['is_sound'] = 0;

                $result = $this->libraryRepository->create($data);

                $id = $result->_id;
                if ($id != '') {
                    $dataElastic = [
                        'body' => $data,
                        'index' => Config::get('constants.elasticsearch.library.index'),
                        'type' => Config::get('constants.elasticsearch.library.type'),
                        'id' => $id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $response = $client->index($dataElastic);
                }

                $response = [
                    'status' => 1,
                    'data' => $result
                ];
            }
        }
        return response()->json($response);
    }

}
