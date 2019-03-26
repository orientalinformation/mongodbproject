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
        BookDetailRepositoryInterface $bookdetailRepository
    )
    {
        $this->request = $request;
        $this->objectService = $objectService;
        $this->productRepository = $productRepository;
        $this->productdetailRepository = $productdetailRepository;
        $this->bookdetailRepository = $bookdetailRepository;
        $this->bookRepository = $bookRepository;
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
        			$url .= 'q=' . $this->request->get('q') . '&';
	        	}
	        	
	        	if ($this->request->has('catID')) {
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
	        		$url .=  'q=' . $this->request->get('q') . '&';
	        	}

	        	if ($this->request->has('catID')) {
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

}
