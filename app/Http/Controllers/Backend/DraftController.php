<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\Discussion\DiscussionRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;

class DraftController extends Controller
{
    /**
     * @var DiscussionRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $discussionRepository;

    /**
     * DiscussionController constructor.
     * @param DiscussionRepositoryInterface $discussionRepository
     */
    public function __construct(DiscussionRepositoryInterface $discussionRepository)
    {
        $this->discussionRepository = $discussionRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'draftIndex';
        $limitPage = 5;
        $rowPage = Config::get('constants.rowPage');
        //Searching value
        $q = null;
        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }
        $result = $this->discussionRepository->paginate($rowPage)->toArray();
        $paginate = Ulities::calculatorPage(null, $page, $result['total'], $rowPage);
        return view('Backend.Draft.index', compact(['currentPage', 'result', 'paginate', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
