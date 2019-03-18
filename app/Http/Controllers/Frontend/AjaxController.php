<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
	/**
     * Instantiate Ajax controller.
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
	            'q' => 'required',
			    'kind' => 'required',
	        ]);

	        if ($validator->fails()) {
			    return response()->json(['errors'=>$validator->errors()->all()]);
			}

			$kinds = $this->request->get('kind');
			
	        if (count($kinds) > 1) {
	        	$url = '/web?q=' . $this->request->get('q');
	        	if ($this->request->has('category')) {
	        		$url .= '&category=' . implode(',', $this->request->get('category'));
	        	}

	        	$response = [
	        		'code' => 200,
	        		'url' => $url
	        	];
	        } else {
	        	$url = '/' . $kinds[0] . '?q=' . $this->request->get('q');
	        	if ($this->request->has('category')) {
	        		$url .= '&category=' . implode(',', $this->request->get('category'));
	        	}
	        	
	        	$response = [
	        		'code' => 200,
	        		'url' => $url
	        	];
	        }

	        return response()->json($response);
    	}
    }
}
