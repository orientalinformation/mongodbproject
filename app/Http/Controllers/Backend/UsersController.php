<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
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
        $rowPage = Config::get('constants.rowPage');

        // get all data
        $users = $this->userRepository->listUsersByRole($rowPage);

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
        
        // check username and email exists       
        $data = $request->all();
        
        if ($this->userRepository->checkExistsByKey('username', trim($data['username']))) {
            return back()->withErrors(__('The username already exists.'))->withInput();  
        }
        
        if ($this->userRepository->checkExistsByKey('email', trim($data['email']))) {
            return back()->withErrors(__('The email already exists.'))->withInput();  
        }        

        // check role
        $role = $this->roleRepository->find($data['role_id']);

        if (!$role) {
            return back()->withErrors(__('Role does not exist.'))->withInput();
        }

        if ($role->name == 'super.admin' || $role->name == 'admin') {
            $data["is_admin"] = 1;
        } else {
            $data["is_admin"] = 0;
        }

        // Hash password
        $data["gender"] = 0;
        $data["birthday"] = date("Y-m-d");
        $data["password"] = Hash::make($data["password"]);

        if ($request->hasFile('avatar')) {
            $ext = ['jpg','jpeg','gif','png','bmp'];
            $avatarPath = Config::get('constants.avatarPath');
            $path = Ulities::uploadFile($request->avatar, $avatarPath, $ext);
            $data['avatar'] = $path;
        }

        // create
        $result = $this->userRepository->create($data);

        if ($result) {
            return redirect()->route("users.index")->with("success",__('Successfully Added New.'));
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

        // check id
        if (empty($id) || (int)$id < 0) {
            return back()->withErrors(__('Invalid ID supplied.'))->withInput();
        }

        // get user by id
        $user = $this->userRepository->getUserByKey("id", $id);

        if (!$user) {
            return back()->withErrors(__('User does not exist.'))->withInput();
        }

        // get all role
        $roles = $this->roleRepository->all();

        return view('Backend.User.edit-add', compact(['currentPage', 'dataType', 'roles', 'user']));
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

        // get user by id
        $user = $this->userRepository->getUserByKey("id", $id);

        if (!$user) {
            return back()->withErrors(__('User does not exist.'))->withInput();
        }        

        $rules = [
            'username' => 'string|min:6|max:255',
            'role_id' => 'required|integer|min:1',
            'fullname' => 'required|string|max:100',
            'email' => 'required|email|max:255',
        ];

        $messages = [
            'username.max'      => __('Username must be greater than 100 characters.'),
            'username.min'      => __('The username must be at least 6 characters.'),
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
        
        // check password
        $data = $request->all();
        unset($data['username']);

        if (!empty($data['password'])) {

            if (strlen(trim($data['password'])) < 6) {
                return back()->withErrors(__('The password must be at least 6 characters.'))->withInput();  
            }
            
            if (!Hash::check($data['password'], $user->password)) {
                // Hash password
                $data["password"] = Hash::make($data["password"]);
            }
        } else {
            unset($data['password']);
        }


        if ($request->hasFile('avatar')) {
            $ext = ['jpg','jpeg','gif','png','bmp'];
            $avatarPath = Config::get('constants.avatarPath');
            $path = Ulities::uploadFile($request->avatar, $avatarPath, $ext);

            if($path['status'] == 1){
                $data['avatar']  = $path['data'];
            }
        }

        // update
        $result = $this->userRepository->update($id, $data);

        if ($result) {
            return redirect()->route("users.index")->with("success",__('Successfully Updated.'));
        }

        return back()->withErrors(__('Update Failed.'))->withInput();  
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
