<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Envato\ObjectService;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;

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
        ProductDetailRepositoryInterface $productdetailRepository
    )
    {
        $this->request = $request;
        $this->objectService = $objectService;
        $this->productRepository = $productRepository;
        $this->productdetailRepository = $productdetailRepository;
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
			    return response()->json(['errors'=>$validator->errors()->all()]);
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
			switch ($type) {
				case 'product':
					$object = $this->objectService->getDataObjectDetail($id, $type, $this->productdetailRepository);
					break;
			}

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
				'data' => ''
			];
			$id = $this->request->get('id');
			$type = $this->request->get('type');
			$element = $this->request->get('element');
			$result = false;
			switch ($type) {
				case 'product':
					$result = $this->objectService->setDataObjectDetail($id, $type, $element, $this->productRepository, $this->productdetailRepository);
					break;
			}

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
