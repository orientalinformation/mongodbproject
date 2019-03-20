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

class HomeController extends Controller
{
    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $cateogryRepository
     */
    public function __construct(WebRepositoryInterface $webRepository,
                                WebDetailRepositoryInterface $webdetailRepository,
                                BookRepositoryInterface $bookRepository,
                                BookDetailRepositoryInterface $bookdetailRepository,
                                ProductRepositoryInterface $productRepository,
                                ProductDetailRepositoryInterface $productdetailRepository)
    {
        $this->webRepository = $webRepository;
        $this->webdetailRepository = $webdetailRepository;
        $this->bookRepository = $bookRepository;
        $this->bookdetailRepository = $bookdetailRepository;
        $this->productRepository = $productRepository;
        $this->productdetailRepository = $productdetailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Frontend.Home.index');
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
