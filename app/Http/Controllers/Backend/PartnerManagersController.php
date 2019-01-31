<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PartnerManager\PartnerManagerRepositoryInterface;

class PartnerManagersController extends Controller
{
    /**
     * @var PartnerManagerRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $partnerRepository;

    /**
     * PartnerManagersController constructor.
     * @param PartnerManagerRepositoryInterface $partnerRepository
     */
    public function __construct(PartnerManagerRepositoryInterface $partnerRepository)
    {
        $this->middleware('auth');
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = 'partner';
        $limit = 20;

        // get all data
        $partners = $this->partnerRepository->paginate($limit);

        return view('Backend.Partner.index', compact(['currentPage', 'partners']));
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
