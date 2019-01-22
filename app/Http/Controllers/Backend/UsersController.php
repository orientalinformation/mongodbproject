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
        $limit = 10;
  
        // get all data
        $users = $this->userRepository->listUsersByRole($limit);

        return view('Backend.User.index', compact(['currentPage', 'users']));
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
