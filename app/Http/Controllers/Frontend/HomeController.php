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
use App\Repositories\Library\LibraryRepositoryInterface;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;

use App\Repositories\User\UserRepositoryInterface;
//use App\Repositories\Bibliotheque\BibliothequeRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Elasticsearch\ClientBuilder;
use App\Helpers\Envato\Ulities;
use Auth;

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
     * @var ProductDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $productdetailRepository;

    /**
     * @var BookRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bookRepository;

    /**
     * @var BibliothequeRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
//    protected $bibliothequetRepository;

    /**
     * @var LibraryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $libraryRepository;

    /**
     * @var LibraryDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $librarydetailRepository;

    /**
     * Instantiate product controller.
     *
     * @param Request $request
     * @param UserRepositoryInterface $userRepository
     * @param WebRepositoryInterface $webRepository
     * @param ProductRepositoryInterface $productRepository
     * @param ProductDetailRepositoryInterface $productdetailRepository
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
//                                BibliothequeRepositoryInterface $bibliothequetRepository,
                                LibraryRepositoryInterface $libraryRepository,
                                LibraryDetailRepositoryInterface $librarydetailRepository)
    {
        $this->webRepository = $webRepository;
        $this->webdetailRepository = $webdetailRepository;
        $this->bookRepository = $bookRepository;
        $this->bookdetailRepository = $bookdetailRepository;
        $this->productRepository = $productRepository;
        $this->productdetailRepository = $productdetailRepository;
        $this->request = $request;
        $this->userRepository = $userRepository;
//        $this->bibliothequetRepository = $bibliothequetRepository;
        $this->libraryRepository = $libraryRepository;
        $this->librarydetailRepository = $librarydetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            //get list id admin
            $userAdmins = $this->userRepository->getlistAdmins();
            $listAdminIds = [];
            if (count($userAdmins) > 0) {
                foreach ($userAdmins as $userAdmin) {
                    array_push($listAdminIds, $userAdmin->id);
                }
            }

            $webs = [];
            $books = [];
            $products = [];
            $bibliothequets = [];
            $limit = Config::get('constants.itemSearchHome');
            $page = $this->request->has('page') ? $this->request->get('page') : 1;
            $options = null;
            $options['page'] = $page;
            $options['limit'] = $limit;
            $client = ClientBuilder::create()->build();
            if (!empty($listAdminIds)) {
                $options['user'] = $listAdminIds;
                // get web data
                $indexName = Config::get('constants.elasticsearch.web.index');
                $typeName = Config::get('constants.elasticsearch.web.type');
                $param = [
                    'index' => $indexName
                ];
                if ($client->indices()->exists($param)) {
                    $params = Ulities::getElasticParams($indexName, $typeName, $options);
                    $response = $client->search($params);
                    $webs = $response['hits']['hits'];
                }
                
                // get book data
                $indexName = Config::get('constants.elasticsearch.book.index');
                $typeName = Config::get('constants.elasticsearch.book.type');
                $param = [
                    'index' => $indexName
                ];
                if ($client->indices()->exists($param)) {
                    $params = Ulities::getElasticParams($indexName, $typeName, $options);
                    $response = $client->search($params);
                    $books = $response['hits']['hits'];
                }
                
                // get product data
                $indexName = Config::get('constants.elasticsearch.product.index');
                $typeName = Config::get('constants.elasticsearch.product.type');
                $param = [
                    'index' => $indexName
                ];
                if ($client->indices()->exists($param)) {
                    $params = Ulities::getElasticParams($indexName, $typeName, $options);
                    $response = $client->search($params);
                    $products = $response['hits']['hits'];
                }

                // get product data
                $indexName = Config::get('constants.elasticsearch.bibliotheque.index');
                $typeName = Config::get('constants.elasticsearch.bibliotheque.type');
                $param = [
                    'index' => $indexName
                ];
                if ($client->indices()->exists($param)) {
                    $params = Ulities::getElasticParams($indexName, $typeName, $options);
                    $response =  $client->search($params);
                    $bibliothequets = $response['hits']['hits'];
                }
            }
            
            $pageName = 'home';
            return view('Frontend.Home.index', compact(['pageName', 'webs', 'books', 'products', 'bibliothequets']));
        } else {
            return redirect()->action('Frontend\HomeController@index_login');
        }
    }

    public function index_login()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userId = $user->id;
            $perPage = 3;
            $web = $this->webRepository->getAllPublicByUserID($userId, $perPage)->toArray();
            $book = $this->bookdetailRepository->getAllPublicByUserID($userId, $perPage)->toArray();
            $product = $this->productdetailRepository->getAllPublicByUserID($userId, $perPage)->toArray();
            $library = $this->librarydetailRepository->getAllPublicByUserID($userId, $perPage)->toArray();
            return view('Frontend.Home.index_login', compact(['web','book','product','library']));
        }else {
            return redirect()->action('Frontend\AuthController@login');
        }

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
