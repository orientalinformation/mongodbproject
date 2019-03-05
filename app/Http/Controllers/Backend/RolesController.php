<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\PermissionRole\PermissionRoleRepositoryInterface;
use Validator;
use App\Http\Middleware\CheckAdmin;

class RolesController extends Controller
{
    /**
     * @var RoleRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $roleRepository;

    /**
     * @var PermissionRoleRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $permsRoleRepository;

    /**
     * RolesController constructor.
     * @param RoleRepositoryInterface $roleRepository
     * @param PermissionRoleRepositoryInterface $permsRoleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRoleRepositoryInterface $permsRoleRepository)
    {
        $this->middleware(CheckAdmin::class);
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
        $this->permsRoleRepository = $permsRoleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = 'role';
        $limit = 10;
  
        // get all data
        $roles = $this->roleRepository->paginate($limit);

        return view('Backend.Role.index', compact(['currentPage', 'roles']));
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
            'name' => 'required|string',
            'display_name' => 'required|string',
        ];

        $messages = [
            'name.required' => __('The name field is required.'),
            'display_name.required' => __('The display name field is required.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }    

        // create
        $result = $this->roleRepository->create($request->all());

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
            return response()->json(['type' => 'error' ,'messages' => __('Invalid Role ID supplied.')], 200); 
        }

        // get data
        $result = $this->roleRepository->find($id);
        
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
            'name' => 'required|string',
            'display_name' => 'required|string',
        ];

        $messages = [
            'name.required' => __('The name field is required.'),
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
        $result = $this->roleRepository->update($id, $request->all());

        if ($result) {
            return redirect()->route("roles.index")->with("success",__('Successfully Updated.'));
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
        $result = $this->roleRepository->delete($id);

        if ($result) {
            return redirect()->route("roles.index")->with("success",__('Successfully Deleted.'));
        }
        return back()->withErrors(__('Sorry it appears there was a problem deleting this.'))->withInput();
    }

    /**
     * view choose permission
     *
     * @param [type] $roleId
     * @return void
     */
    public function viewChoosePermission($roleId)
    {
        $currentPage = 'role';

        // check id
        if (empty($roleId) || (int)$roleId < 0) {
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }

        //active permission of role
        $results = $this->permsRoleRepository->getPermissionsByRoleId($roleId);

        return view('Backend.Role.choosePermission', compact(['currentPage', 'roleId', 'results']));        
    }

    /**
     * update permission for role
     *
     * @param Request $request
     * @param [type] $roleId
     * @return void
     */
    public function assignRole(Request $request, $roleId)
    {
        // check id
        if (empty($roleId) || (int)$roleId < 0) {
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }

        // check role exist
        $role = $this->roleRepository->find($roleId);

        if (!$role) {
            return back()->withErrors(__('Role does not exist.'))->withInput();
        }

        //update permission of role
        $result = $this->permsRoleRepository->assignPermissionForRole($request->get('permissions'), $roleId);

        if ($result) {
            return redirect()->route("roles.index")->with("success",__('Successfully Updated.'));
        }   
        
        return back()->withErrors(__('Sorry it appears there was a problem updating this.'))->withInput();
    }
}
