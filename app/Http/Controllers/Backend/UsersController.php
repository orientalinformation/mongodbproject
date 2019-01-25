<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Validator;

class UsersController extends Controller
{
    /**
     * @var RoleRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $roleRepository;

    /**
     * @var UserRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $userRepository;

    /**
     * BookController constructor.
     * @param RoleRepositoryInterface $roleRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository, UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = 'user';
  
        // get all data
        $users = $this->userRepository->listUsersByRole();

        return view('Backend.User.index', compact(['currentPage', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentPage = 'user';
        $dataType = 'add';

        // get all role
        $roles = $this->roleRepository->all();

        return view('Backend.User.edit-add', compact(['currentPage', 'dataType', 'roles']));
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
            'username' => 'required|string|min:6|max:255',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer|min:1',
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|max:255',
        ];

        $messages = [
            'username.required' => __('The username field is required.'),
            'username.max'      => __('Username must be greater than 100 characters.'),
            'username.min'      => __('The username must be at least 6 characters.'),        
            'password.required' => __('The password field is required.'),
            'password.min'      => __('The password must be at least 6 characters.'),
            'role_id.required'      => __('The role id field is required.'),
            'role_id.min'      => __('The role id must be at least 1.'),
            'fullname.required'      => __('The fullname field is required.'),
            'fullname.max'      => __('Fullname must be greater than 100 characters.'),
            'email.required'      => __('The email field is required.'),
            'email.email'      => __('Please enter your email.'),
            'email.max'      => __('Email must be greater than 100 characters.'),      
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator->messages())->withInput();
        }    
        
        // check username exists       
        $data = $request->all();
        
        if ($this->userRepository->checkExistsByKey('username', trim($data['username']))) {
            return back()->withErrors(__('The username already exists.'))->withInput();  
        }

        // check role
        $role = $this->roleRepository->find($data['role_id']);

        if (!$role) {
            return back()->withErrors(__('Role does not exist.'))->withInput();
        }

        

        // create
        $result = $this->userRepository->create($request->all());

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
        $currentPage = 'user';
        $dataType = 'edit';

        // get all role
        $roles = $this->roleRepository->all();

        return view('Backend.User.edit-add', compact(['currentPage', 'dataType', 'roles']));
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $rules = [
            'fullname' => 'required|string',
            'email' => 'required|email|string',
        ];

        $messages = [
            'fullname.required' => __('The fullname field is required.'),
            'email.required' => __('The email field is required.'),
            'email.email' => __('Email is invalid.'),
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            $messages = $validator->messages();
            
            if (count($messages->all()) > 0) {
                return response()->json(['type' => 'error' ,'messages' => $messages->all()[0]], 200); 
            }
        }

        // update
        $result = $this->userRepository->update($id, $request->all());

        if ($result) {
            return response()->json(['type' => 'success' ,'data' => $result], 200);
        }
        
        return response()->json(['type' => 'error' ,'messages' => __('Data not found.')], 200);        
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
