<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Research\ResearchRepositoryInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Model\Research;
use App\Rules\ValidateUniqueResearch;
use Lang;
use Auth;


class ResearchController extends Controller
{
	/**
     * @var ResearchRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $ResearchRepository;

	/**
     * Instantiate Research controller.
     *
     * @param Request $request
     * @param ResearchRepositoryInterface $ResearchRepository
     * @return void
     */
    public function __construct(Request $request, ResearchRepositoryInterface $researchRepository)
    {
        $this->request = $request;
        $this->researchRepository = $researchRepository;
    }

    /**
     * Save key searching value
     * @return string
     */
	public function saveKeyword()
	{
		 if ($this->request->ajax()) {
		 	$request = $this->request->all();

			$validator = Validator::make($request, [
	            'name' => ['bail', 'required', 'max:100', new ValidateUniqueResearch],
			    'keyword' => 'required',
	        ]);

			if ($validator->fails()) {
			    return response()->json(['errors'=>$validator->errors()->all()]);
			}
			
			$result = $this->researchRepository->saveKeySearchingValue($request);
			if ($result) {
				return response()->json([
					'code' => '200',
					'message' => Lang::get('message.msg_create_successfully')
				]);
			}
        }
	}

	/**
     * Delete Item Research
     * @return bolean
     */
	public function destroy()
	{
		if ($this->request->ajax()) {

            $request = $this->request->all();
            $id = $request['id'];
            $count = Research::where('_id', $id)->where('user_id', Auth::user()->id)->count();
            if ($count > 0) {
            	return Research::destroy($id);
            }
        }
	}
}
