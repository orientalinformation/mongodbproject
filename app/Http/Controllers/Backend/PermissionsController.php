<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Validator;

class PermissionsController extends Controller
{
    /**
     * @var PermissionRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $permRepository;

    /**
     * BookController constructor.
     * @param PermissionRepositoryInterface $permRepository
     */
    public function __construct(PermissionRepositoryInterface $permRepository)
    {
        $this->middleware('auth');
        $this->permRepository = $permRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = 'permission';
        $limit = 10;

        // get all data
        $permissions = $this->permRepository->paginate($limit);

        return view('Backend.Permission.index', compact(['currentPage', 'permissions']));
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
        $rules = [
            'key' => 'required|string',
            'display_name' => 'required|string',
        ];

        $messages = [
            'key.required' => __('The key field is required.'),
            'display_name.required' => __('The display name field is required.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }    

        // create
        $result = $this->permRepository->create($request->all());

        if ($result) {
            return redirect()->back()->with("success",__('Successfully Added New.'));
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
        // check id
        if (empty($id) || (int)$id < 0) {
            return response()->json(['type' => 'error' ,'messages' => __('Invalid Permission ID supplied.')], 200); 
        }

        // get data
        $result = $this->permRepository->find($id);
        
        if ($result) {
            return response()->json(['type' => 'success' ,'data' => $result], 200);
        }
        
        return response()->json(['type' => 'error' ,'messages' => __('Data not found.')], 200);
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
        $rules = [
            'key' => 'required|string',
            'display_name' => 'required|string',
        ];

        $messages = [
            'key.required' => __('The key field is required.'),
            'display_name.required' => __('The display name field is required.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }    

        // check id
        if (empty($id) || (int)$id < 0) {
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }

        // update
        $result = $this->permRepository->update($id, $request->all());

        if ($result) {
            return redirect()->route("permissions.index")->with("success",__('Successfully Updated.'));
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
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }

        //delete
        $result = $this->permRepository->delete($id);

        if ($result) {
            return redirect()->route("permissions.index")->with("success",__('Successfully Deleted.'));
        }
        return back()->withErrors(__('Sorry it appears there was a problem deleting this.'))->withInput();
    }
}
