<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Web\WebRepositoryInterface;
use App\Repositories\WebDetail\WebDetailRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookDetail\BookDetailRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductDetail\ProductDetailRepositoryInterface;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;
use Illuminate\Support\Facades\Config;

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

    public function __construct(WebRepositoryInterface $webRepository,
                                WebDetailRepositoryInterface $webdetailRepository,
                                BookRepositoryInterface $bookRepository,
                                BookDetailRepositoryInterface $bookdetailRepository,
                                ProductRepositoryInterface $productRepository,
                                ProductDetailRepositoryInterface $productdetailRepository,
                                Request $request,
                                UserRepositoryInterface $userRepository,
                                BibliothequeRepositoryInterface $bibliothequetRepository)
    {
        $this->webRepository = $webRepository;
        $this->webdetailRepository = $webdetailRepository;
        $this->bookRepository = $bookRepository;
        $this->bookdetailRepository = $bookdetailRepository;
        $this->productRepository = $productRepository;
        $this->productdetailRepository = $productdetailRepository;
        $this->request = $request;
        $this->userRepository = $userRepository;
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

        $webs = null;
        $books = null;
        $products = null;
        $bibliothequets = null;
        $limit = Config::get('constants.itemSearchHome');
        if (!empty($listAdminIds)) {
            // get web data
            $webs = $this->webRepository->getItemsByadmin($limit);

            // get book data
            $books = $this->bookRepository->getItemsByadmin($listAdminIds, $limit);
            
            // get product data
            $products = $this->productRepository->getItemsByadmin($listAdminIds, $limit);

            // get product data
            $bibliothequets = $this->bibliothequetRepository->getItemsByadmin($listAdminIds, $limit);
        }
        
        $pageName = 'home';
        return view('Frontend.Home.index', compact(['pageName', 'webs', 'books', 'products', 'bibliothequets']));
    }

    public function index_login()
    {
        $web = $this->webdetailRepository->getAllPublic(3)->toArray();
        $book = $this->bookdetailRepository->getAllPublic(3)->toArray();
        $product = $this->productdetailRepository->getAllPublic(3)->toArray();
        return view('Frontend.Home.index_login', compact(['web','book','product']));
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
