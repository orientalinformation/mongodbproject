<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Web\WebRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;

class HomeController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $userRepository;

    /**
     * @var WebRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $webRepository;

    /**
     * @var ProductRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var BookRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bookRepository;

    /**
     * @var BibliothequeRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bibliothequetRepository;

    /**
     * Instantiate product controller.
     *
     * @param Request $request
     * @param UserRepositoryInterface $userRepository
     * @param WebRepositoryInterface $webRepository
     * @param ProductRepositoryInterface $productRepository
     * @param BookRepositoryInterface $bookRepository
     * @param BibliothequeRepositoryInterface $bibliothequetRepository
     * @return void
     */
    public function __construct(
        Request $request, 
        UserRepositoryInterface $userRepository, 
        ProductRepositoryInterface $productRepository, 
        WebRepositoryInterface $webRepository, 
        BookRepositoryInterface $bookRepository, 
        BibliothequeRepositoryInterface $bibliothequetRepository)
    {
        $this->request = $request;
        $this->userRepository = $userRepository;
        $this->webRepository = $webRepository;
        $this->productRepository = $productRepository;
        $this->bookRepository = $bookRepository;
        $this->bibliothequetRepository = $bibliothequetRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get list id admin
        $userAdmins = $this->userRepository->getlistAdmins();
        $listAdminIds = [];
        if (count($userAdmins) > 0) {
            foreach ($userAdmins as $userAdmin) {
                array_push($listAdminIds, $userAdmin->id);
            }
        }

        // get web data
        $pageName = 'home';
        return view('Frontend.Home.index', compact(['pageName']));
    }

    public function index_login()
    {
        return view('Frontend.Home.index_login');
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
