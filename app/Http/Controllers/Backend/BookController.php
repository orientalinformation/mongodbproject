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
        $limitPage = 5;
        $rowPage = 5;
        $result = $this->bookRepository->paginateWithoutSort($rowPage)->toArray();
        $result['limitPage'] = $limitPage;
        return view('Backend.Book.index', compact(['currentPage', 'result', 'userID']));
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
            $data['type'] = $request->get('type');
            $data['price'] = $request->get('price');
            $data['title'] = $request->get('title');
            $data['alias'] = $request->get('alias');
            $data['author'] = $request->get('author');
            $data['shortDescription'] = $request->get('shortDescription');
            $data['description'] = $request->get('description');
            $data['catID'] = $request->get('catID');
            $image = "";
            if ($request->hasFile('image')) {
                $fileImage = $request->image;
                $bookPath = Config::get('constants.bookPath');
                $path = Ulities::uploadFile($fileImage, $bookPath);
                $data['image'] = $path;
                $image = $path;
            }
            $file = "";
            if ($request->hasFile('file')) {
                $file = $request->file;
                $bookFilePath = Config::get('constants.bookFilePath');
                $pathFile = Ulities::uploadFile($file, $bookFilePath);
                $data['file'] = $pathFile;
                $file = $pathFile;
            }
            if ($request->has('status')) {
                $status = 1;
            } else {
                $status = 0;
            }
            $data['status'] = $status;

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
                            'shortDescription' => $request->get('shortDescription'),
                            'description' => $request->get('description'),
                            'catID' => $request->get('catID'),
                            'image' => $image,
                            'file' => $file,
                            'status' => $status,
                            'share' => $share
                        ],
                        'index' => $book->getIndexName(),
                        'type' => $book->getTypeName(),
                        'id' => $id,
                    ];
                    $client = ClientBuilder::create()->build();
                    $response = $client->index($dataElastic);
                }
                return redirect()->to('admin/books');
            }

            $currentPage = 'bookIndex';
            $category_list = $this->cateogryRepository->all()->toArray();
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
            if ($request->method() == 'POST') {
                $data['type'] = $request->get('type');
                $data['price'] = $request->get('price');
                $data['title'] = $request->get('title');
                $data['alias'] = $request->get('alias');
                $data['author'] = $request->get('author');
                $data['shortDescription'] = $request->get('shortDescription');
                $data['description'] = $request->get('description');
                $data['catID'] = $request->get('catID');
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
                    $book = new BookElastic();
                    $dataElastic = [
                        'body' => [
                            'type' => $request->get('type'),
                            'price' => $request->get('price'),
                            'title' => $request->get('title'),
                            'alias' => $request->get('alias'),
                            'shortDescription' => $request->get('shortDescription'),
                            'description' => $request->get('description'),
                            'catID' => $request->get('catID'),
                            'image' => $image,
                            'file' => $file,
                            'status' => $status,
                            'share' => $share
                        ],
                        'index' => $book->getIndexName(),
                        'type'  => $book->getTypeName(),
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

                $book = new BookElastic();
                $dataElastic = [
                    'body' => [
                        'type' => $book[0]["type"],
                        'price' => $book[0]["price"],
                        'title' => $book[0]["title"],
                        'alias' => $book[0]["alias"],
                        'shortDescription' => $book[0]["shortDescription"],
                        'description' => $book[0]["description"],
                        'catID' => $book[0]["catID"],
                        'image' => $book[0]["image"],
                        'file' => $book[0]["file"],
                        'status' => $status,
                        'share' => $book[0]["share"]
                    ],
                    'index' => $book->getIndexName(),
                    'type'  => $book->getTypeName(),
                    'id' => $book[0]["_id"],
                ];
                $client = ClientBuilder::create()->build();
                $response = $client->index($dataElastic);
            }
        }
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
