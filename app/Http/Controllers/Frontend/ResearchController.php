<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Research\ResearchRepositoryInterface;
use Illuminate\Support\Facades\Route;


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
    public function __construct(Request $request, ResearchRepositoryInterface $ResearchRepository)
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
            $this->request->validate([
			    'name' => 'bail|required|unique:researches|max:100',
			    'keyword' => 'required',
			    'user_id' => 'required',
			]);

			$request = $this->request->all();
        }
	}
}
