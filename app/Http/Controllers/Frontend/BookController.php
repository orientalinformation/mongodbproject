<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookDetail\BookDetailRepositoryInterface;
use App\Repositories\ReadAfter\ReadAfterRepositoryInterface;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;


class BookController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $cateogryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $cateogryRepository
     */
    public function __construct(CategoryRepositoryInterface $cateogryRepository, BookRepositoryInterface $bookRepository, BookDetailRepositoryInterface $bookdetailRepository, ReadAfterRepositoryInterface $readafterRepository)
    {
        $this->cateogryRepository = $cateogryRepository;
        $this->bookRepository = $bookRepository;
        $this->bookdetailRepository = $bookdetailRepository;
        $this->readafterRepository = $readafterRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rowPage = Config::get('constants.rowPageBook');
        //Searching value
        $q = null;

        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }
        $category = $this->cateogryRepository->parentOrderByPath()->toArray();
        if($request->has('start_year') && $request->has('end_year')) {
            $start_year = $request->get('start_year');
            $end_year = $request->get('end_year');
            $book = $this->bookRepository->getRange($start_year, $end_year, $rowPage)->toArray();
        }else if($request->has('txtSearch')){
            $client = ClientBuilder::create()->build();
            $searchValue = $request->get('txtSearch');
            $matchAll = [
                'match_all' => new \stdClass()
            ];

            $matchPrefix = [
                'match_phrase_prefix'   => [
                    'title' => $searchValue
                ]
            ];
            $param = [
                'index' => Config::get('constants.elasticsearch.book.index'),
                'type'  => Config::get('constants.elasticsearch.book.type'),
                'body'  => [
                    'from'  => ($page - 1) * $rowPage,
                    'size'  => $rowPage,
                    'query' => is_null($searchValue) ? $matchAll : $matchPrefix

                ]
            ];

            $response = $client->search($param);
            $book['total'] = $response["hits"]["total"];
            $book['data'] = [];
            if($response["hits"]["total"] > 0) {
                foreach ($response["hits"]["hits"] as $item) {
                    $book['data'][] = $item['_source'];
                };
            }
        }else{
            $book = $this->bookRepository->paginate($rowPage)->toArray();
        }
        $paginate = Ulities::calculatorPage(null, $page, $book['total'], $rowPage);
        return view('Frontend.Book.index', compact(['category', 'book', 'paginate', 'q']));
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

    /**
     * Check status like
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkLiked(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("user_id") && $request->has("book_id")){
            $user_id = $request->get("user_id");
            $book_id = $request->get("book_id");
            $bookDetail = $this->bookdetailRepository->checkLiked($user_id, $book_id)->toArray();

            if(sizeof($bookDetail) > 0){
                $result['status'] = 1;
                $result['data'] = $bookDetail;
            }else{
                $result['status'] = 0;
            }

            if($request->has("change")){
                $change = $request->get("change");
                if($change ==1){
                    if(sizeof($bookDetail) > 0){
                        foreach($bookDetail as $item){
                            $data['book_id'] = $item['book_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = $item['share'];
                            $data['pink'] = $item['pink'];
                            $data['is_public'] = $item['is_public'];
                            $data['is_delete'] = 1;
                            $this->bookdetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $bookDetail = $this->bookdetailRepository->checkunLiked($user_id, $book_id)->toArray();
                        if(sizeof($bookDetail) > 0){
                            foreach($bookDetail as $item){
                                $data['book_id'] = $item['book_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = $item['share'];
                                $data['pink'] = $item['pink'];
                                $data['is_public'] = $item['is_public'];
                                $data['is_delete'] = 0;
                                $this->bookdetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['book_id'] = $book_id;
                            $data['user_id'] = $user_id;
                            $data['share'] = 0;
                            $data['pink'] = 0;
                            $data['is_public'] = 0;
                            $data['is_delete'] = 0;
                            $data = $this->bookdetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }
        $result = json_encode($result);
        print_r($result);die;
    }

    /**
     * Check status read
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkRead(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("user_id") && $request->has("object_id")){
            $user_id = $request->get("user_id");
            $object_id = $request->get("object_id");
            $type = Config::get('constants.objectType.book');
            $bookDetail = $this->readafterRepository->checkRead($user_id, $object_id, $type)->toArray();

            if(sizeof($bookDetail) > 0){
                $result['status'] = 1;
                $result['data'] = $bookDetail;
            }else{
                $result['status'] = 0;
            }

            if($request->has("change")){
                $change = $request->get("change");
                if($change ==1){
                    if(sizeof($bookDetail) > 0){
                        foreach($bookDetail as $item){
                            $data['user_id'] = $item['user_id'];
                            $data['object_id'] = $item['object_id'];
                            $data['type_name'] = $type;
                            $data['is_delete'] = 1;
                            $this->readafterRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $bookDetail = $this->readafterRepository->checkunRead($user_id, $object_id, $type)->toArray();
                        if(sizeof($bookDetail) > 0){
                            foreach($bookDetail as $item){
                                $data['user_id'] = $item['user_id'];
                                $data['object_id'] = $item['object_id'];
                                $data['type_name'] = $type;
                                $data['is_delete'] = 0;
                                $this->readafterRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['user_id'] = $user_id;
                            $data['object_id'] = $object_id;
                            $data['type_name'] = $type;
                            $data['is_delete'] = 0;
                            $data = $this->readafterRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }
        $result = json_encode($result);
        print_r($result);die;
    }
}
