<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Elasticsearch\ClientBuilder;
use App\Model\BookElastic;
use App\Helpers\Envato\Ulities;
use Illuminate\Support\Facades\Config;
use Validator;
use App\Image;
use Auth;
use App\Http\Middleware\CheckAdmin;

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
        $this->middleware(CheckAdmin::class);        
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'bookIndex';
        $userID = Auth::id();
        $rowPage = Config::get('constants.rowPage');
        //Searching value
        $q = null;

        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }
        $result = $this->bookRepository->paginate($rowPage)->toArray();

        $paginate = Ulities::calculatorPage(null, $page, $result['total'], $rowPage);

        return view('Backend.Book.index', compact(['currentPage', 'result', 'userID', 'paginate', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $currentPage = 'bookIndex';
        $category_list = $this->cateogryRepository->allOrderByPath()->toArray();
        $error = "";
        return view('Backend.Book.create', compact(['currentPage', 'category_list', 'error']));
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
            $submitType = $request->get('submitType');
            $data['type'] = $request->get('type');
            $data['price'] = $request->get('price');
            $data['title'] = $request->get('title');
            $data['alias'] = $request->get('alias');
            $data['author'] = $request->get('author');
            $data['description'] = $request->get('description');
            $data['cat_id'] = $request->get('cat_id');
            $data['view'] = 0;
            $image = "";
            if ($request->hasFile('image')) {
                $fileImage = $request->image;
                $bookPath = Config::get('constants.bookPath');
                $ext = ['jpg','jpeg','gif','png','bmp'];
                $path = Ulities::uploadFile($fileImage, $bookPath, $ext);
                $data['image'] = $path['data'];
                $image = $path['data'];
            }
            $file = "";
            if ($request->hasFile('file')) {
                $file = $request->file;
                $bookFilePath = Config::get('constants.bookFilePath');
                $ext = ['doc','pdf','xlsx'];
                $pathFile = Ulities::uploadFile($file, $bookFilePath, $ext);
                $data['file'] = $pathFile;
                $file = $pathFile;
            }
            if ($request->has('status')) {
                $status = 1;
            } else {
                $status = 0;
            }
            $data['status'] = $status;

            if($submitType=='DRAFT'){
                $data['status'] = 'DRAFT';
            }

            if ($request->has('share')) {
                $share = 1;
            } else {
                $share = 0;
            }
            $data['share'] = $share;
            $error = "";
            if($request->get('title') == ""){
                $error = "Title is not valid";
            }

            if($error == "") {
                $result = $this->bookRepository->create($data);
                $id = $result->_id;

                if ($id != '') {
                    $book = new BookElastic();
                    $dataElastic = [
                        'body' => [
                            'type' => $request->get('type'),
                            'price' => $request->get('price'),
                            'title' => $request->get('title'),
                            'alias' => $request->get('alias'),
                            'description' => $request->get('description'),
                            'cat_id' => $request->get('cat_id'),
                            'image' => $image,
                            'file' => $file,
                            'status' => $data['status'],
                            'share' => $share,
                            'view' => 0,
                            'updated_at' => $result->updated_at->format('Y-m-d h'),
                            'created_at' => $result->created_at->format('Y-m-d h')
                        ],
                        'index' => Config::get('constants.elasticsearch.book.index'),
                        'type' => Config::get('constants.elasticsearch.book.type'),
                        'id' => $id,
                    ];

                    $client = ClientBuilder::create()->build();
                    $response = $client->index($dataElastic);
                }
                return redirect()->to('admin/books');
            }

            $currentPage = 'bookIndex';
            $category_list = $this->cateogryRepository->allOrderByPath()->toArray();
            return view('Backend.Book.create', compact(['currentPage', 'category_list', 'error']));
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
            $error = "";
            $id = $request->get('id');
            $category_list = $this->cateogryRepository->all()->toArray();
            $book = $this->bookRepository->find($id)->toArray();
            dd($book);
            if ($request->method() == 'POST') {
                $submitType = $request->get('submitType');
                $data['type'] = $request->get('type');
                $data['price'] = $request->get('price');
                $data['title'] = $request->get('title');
                $data['alias'] = $request->get('alias');
                $data['author'] = $request->get('author');
                $data['description'] = $request->get('description');
                $data['cat_id'] = $request->get('cat_id');
                $data['view'] = $book['view'];
                $image = "";
                if($request->hasFile('image')) {
                    $fileImage = $request->image;
                    $bookPath = Config::get('constants.bookPath');
                    $ext = ['jpg','jpeg','gif','png','bmp'];
                    $path = Ulities::uploadFile($fileImage, $bookPath, $ext);
                    if($path['status'] == 1){
                        $data['image'] = $path['data'];
                        $image = $path['data'];
                        //delete old file image
                        $oldImage = $bookPath . $book['image'];
                        @unlink($oldImage);
                    }
                    else{
                        $error = $path['data'];
                    }
                }
                $file = "";
                if($request->hasFile('file')) {
                    $file = $request->file;
                    $bookFilePath = Config::get('constants.bookFilePath');
                    $ext = ['doc','pdf','xlsx'];
                    $path = Ulities::uploadFile($file, $bookFilePath, $ext);
                    if($path['status'] == 1){
                        $data['file'] = $path['data'];
                        $file = $path['data'];
                        //delete old file
                        $oldFile = $bookFilePath . $book['file'];
                        @unlink($oldFile);
                    }
                    else{
                        $error = $path['data'];
                    }
                }
                if($request->has('status')) {
                    $status = 1;
                }else{
                    $status = 0;
                }
                $data['status'] = $status;
                if($submitType=='DRAFT'){
                    $data['status'] = 'DRAFT';
                }

                if($request->has('share')) {
                    $share = 1;
                }else{
                    $share = 0;
                }
                $data['share'] = $share;

                if($error == "") {
                    $result = $this->bookRepository->update($id, $data);
                }else{
                    return view('Backend.Book.edit', compact(['currentPage', 'book', 'category_list', 'error']));
                }

//                $id = $result->_id;

                if($id != '') {
                    $bookElastic = new BookElastic();
                    $dataElastic = [
                        'body' => [
                            'type' => $request->get('type'),
                            'price' => $request->get('price'),
                            'title' => $request->get('title'),
                            'alias' => $request->get('alias'),
                            'description' => $request->get('description'),
                            'cat_id' => $request->get('cat_id'),
                            'image' => $image,
                            'file' => $file,
                            'status' => $data['status'],
                            'share' => $share,
                            'view' => $book['view']
                        ],
                        'index' => $bookElastic->getIndexName(),
                        'type'  => $bookElastic->getTypeName(),
                        'id' => $id,
                    ];
                    $client = ClientBuilder::create()->build();
                    $response = $client->index($dataElastic);
                }
                return redirect()->to('admin/books');
            }else{
                return view('Backend.Book.edit', compact(['currentPage', 'book', 'category_list', 'error']));
            }
        }
        dd('a');
    }

    public function updateStatus(Request $request)
    {
        if($request->has('bookID')) {
            $id = $request->get('bookID');
            $status = $request->get('status');
            $book = $this->bookRepository->checkStatus($id, $status)->toArray();
            if(sizeof($book)) {
                if ($book[0]["status"] == 1) {
                    $status = 0;
                    $data['status'] = 0;
                    $this->bookRepository->update($id, $data);
                    return 1;
                } else {
                    $status = 1;
                    $data['status'] = 1;
                    $this->bookRepository->update($id, $data);
                    return 0;
                }

                $bookElastic = new BookElastic();
                $dataElastic = [
                    'body' => [
                        'type' => $book["type"],
                        'price' => $book["price"],
                        'title' => $book["title"],
                        'alias' => $book["alias"],
                        'description' => $book["description"],
                        'cat_id' => $book["cat_id"],
                        'image' => $book["image"],
                        'file' => $book["file"],
                        'status' => $status,
                        'share' => $book["share"],
                        'view' => $book["view"]
                    ],
                    'index' => $bookElastic->getIndexName(),
                    'type'  => $bookElastic->getTypeName(),
                    'id' => $book[0]["_id"],
                ];
                $client = ClientBuilder::create()->build();
                $response = $client->index($dataElastic);
            }
        }
    }

    public function getChildCat(Request $request){
        if($request->has('catID')) {
            $catID = $request->get('catID');
            $result = $this->cateogryRepository->getChildCat($catID)->toArray();
            $data = [];
            $data['status'] = 1;
            $data['data'] = $result;
        }else{
            $data['status'] = 0;
            $data['data'] = '';
        }
        return json_encode($data);
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

    /**
     * delete book
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request){
        if($request->has('id')) {
            $id = $request->get('id');
            $this->bookRepository->delete($id);

            $book = new BookElastic();
            $params = [
                'index' => $book->getIndexName(),
                'type'  => $book->getTypeName(),
                'body' => [
                    'query' => [
                        'match' => [
                            '_id' => $id
                        ]
                    ]
                ]
            ];
            $client = ClientBuilder::create()->build();
            $response = $client->search($params);
            $items = $response['hits']['hits'];

            if(sizeof($items) > 0) {
                $params = [
                    'index' => $book->getIndexName(),
                    'type'  => $book->getTypeName(),
                    'id' => $id
                ];
                $client->delete($params);
            }

            return redirect()->to('admin/books');
        }
    }
}
