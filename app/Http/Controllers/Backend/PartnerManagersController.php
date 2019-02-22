<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PartnerManager\PartnerManagerRepositoryInterface;
use Validator;
use App\Http\Middleware\CheckAdmin;

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
        $this->middleware(CheckAdmin::class);
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
        $currentPage = 'partner';
        $dataType = 'add';

        return view('Backend.Partner.edit-add', compact(['currentPage', 'dataType']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'address' => 'required|string',
            'web' => 'required|string',
        ];

        $messages = [      
            'name.required'      => __('The name field is required.'),  
            'address.required'      => __('The address field is required.'),  
            'web.required'      => __('The web field is required.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        // create
        $result = $this->partnerRepository->create($request->all());

        if ($result) {
            return redirect()->route("partners.index")->with("success",__('Successfully Added New.'));
        }

        return back()->withErrors(__('Create Failed.'))->withInput();        
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
        $currentPage = 'partner';
        $dataType = 'edit';

        // check id
        if (empty($id) || (int)$id < 0) {
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }
        // get partner by id
        $partner = $this->partnerRepository->find($id);

        return view('Backend.Partner.edit-add', compact(['currentPage', 'dataType', 'partner']));
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
        // check id
        if (empty($id) || (int)$id < 0) {
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }

        $rules = [
            'name' => 'required|string',
            'address' => 'required|string',
            'web' => 'required|string',
        ];

        $messages = [      
            'name.required'      => __('The name field is required.'),  
            'address.required'      => __('The address field is required.'),  
            'web.required'      => __('The web field is required.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }

        // update
        $result = $this->partnerRepository->update($id, $request->all());

        if ($result) {
            return redirect()->route("partners.index")->with("success",__('Successfully Updated.'));
        }

        return back()->withErrors(__('Update Failed.'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // check id
        if (empty($id) || (int)$id < 0) {
            return back()->withErrors(__('Invalid Role ID supplied.'))->withInput();
        }

        //delete
        $result = $this->partnerRepository->delete($id);

        if ($result) {
            return redirect()->route("partners.index")->with("success",__('Successfully Deleted.'));
        }
        return back()->withErrors(__('Sorry it appears there was a problem deleting this.'))->withInput();        
    }
}
