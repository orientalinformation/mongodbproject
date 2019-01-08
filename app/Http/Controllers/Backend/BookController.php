<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Validator;
use App\Image;

class BookController extends Controller
{

    /**
     * @var BookRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $bookRepository;
    protected $cateogryRepository;

    /**
     * BookController constructor.
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository, CategoryRepositoryInterface $cateogryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->cateogryRepository = $cateogryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $currentPage = 'bookIndex';
        $limitPage = 5;
        $rowPage = 5;
        $result = $this->bookRepository->paginateWithoutSort($rowPage)->toArray();
        $result['limitPage'] = $limitPage;
        return view('Backend.Book.index', compact(['currentPage', 'result']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $currentPage = 'bookIndex';
        $category_list = $this->cateogryRepository->all()->toArray();
        return view('Backend.Book.create', compact(['currentPage', 'category_list']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->method() == 'POST') {
            $data['type'] = $request->get('type');
            $data['price'] = $request->get('price');
            $data['title'] = $request->get('title');
            $data['shortDescription'] = $request->get('shortDescription');
            $data['description'] = $request->get('description');
            $data['catID'] = $request->get('catID');
            $data['image'] = $request->get('image');
            if($request->has('status')) {
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            $this->bookRepository->create($data);
            return redirect()->to('books');
        }
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
    public function update(Request $request)
    {
        $currentPage = 'bookIndex';
        if($request->has('id')) {
            $id = $request->get('id');
            $category_list = $this->cateogryRepository->all()->toArray();
            $book = $this->bookRepository->find($id)->toArray();
            if ($request->method() == 'POST') {
                $data['type'] = $request->get('type');
                $data['price'] = $request->get('price');
                $data['title'] = $request->get('title');
                $data['shortDescription'] = $request->get('shortDescription');
                $data['description'] = $request->get('description');
                $data['catID'] = $request->get('catID');
                $data['image'] = $request->get('image');
                if($request->has('status')) {
                    $data['status'] = 1;
                }else{
                    $data['status'] = 0;
                }
                $this->bookRepository->update($id, $data);
                return redirect()->to('books');
            }else{
                return view('Backend.Book.edit', compact(['currentPage', 'book', 'category_list']));
            }
        }
        dd('a');
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

    public function delete(Request $request){
        if($request->has('id')) {
            $id = $request->get('id');
            $this->bookRepository->delete($id);
            return redirect()->to('books');
        }
    }
}
