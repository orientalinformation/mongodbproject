<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
use App\Repositories\BookDetail\BookDetailRepositoryInterface;
use App\Repositories\ReadAfter\ReadAfterRepositoryInterface;
use App\Repositories\Library\LibraryRepositoryInterface;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;
use App\Repositories\Research\ResearchRepositoryInterface;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Route;
use Auth;


class BookController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var ResearchRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $researchRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */

    public function __construct(CategoryRepositoryInterface $categoryRepository,
                                BookRepositoryInterface $bookRepository,
                                BookDetailRepositoryInterface $bookdetailRepository,
                                ReadAfterRepositoryInterface $readafterRepository,
                                LibraryRepositoryInterface $libraryRepository,
                                LibraryDetailRepositoryInterface $librarydetailRepository,
                                ResearchRepositoryInterface $researchRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->bookRepository = $bookRepository;
        $this->bookdetailRepository = $bookdetailRepository;
        $this->readafterRepository = $readafterRepository;
        $this->libraryRepository = $libraryRepository;
        $this->libraryDetailRepository = $librarydetailRepository;
        $this->researchRepository = $researchRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageName = 'book';
        $q = $request->has('q') ? $request->get('q') : null;
        $limit = Config::get('constants.rowPage');
        $currentPath = Route::getFacadeRoot()->current()->uri();
        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }

        $options = null;
        $options['page'] = $page;
        $options['limit'] = $limit;
        if ($q != null) {
            $options['q'] = $q;
        }

        $sort = 'desc';
        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $options['sort'] = $request->get('sort');
        }

        // url ordering
        $paramPath = '';
        if ($q != null) {
            $paramPath = 'q=' . $q . '&';
        }

        $category = $this->categoryRepository->parentOrderByPath()->toArray();
        if ($request->has('start_year') && $request->has('end_year')) {
            $start_year = $request->get('start_year');
            $end_year = $request->get('end_year');
            $book = $this->bookRepository->getRange($start_year, $end_year, $limit)->toArray();

            $options['start_year'] = $request->get('start_year');
            $options['end_year'] = $request->get('end_year');
            $paramPath .= 'start_year=' . $options['start_year'] . '&end_year=' . $options['end_year'] . '&';
        } else if ($request->has('q')) {
            if($request->has('category')) {
                $categories = explode(',', $request->get('category'));
                $arrCategory = [];
                foreach ($categories as $category) {
                    $listCategories = $this->categoryRepository->getCategoryTreeId($category);
                    foreach ($listCategories as $listCategory) {
                        $arrCategory[] = $listCategory;
                    }
                }

                $arrCategory = array_values(array_unique($arrCategory));
                $options['category_query'] = $request->get('category');
                $options['category'] = $arrCategory;
                $paramPath .= 'category=' . $request->get('category') . '&';
            }

            $indexName = Config::get('constants.elasticsearch.book.index');
            $typeName = Config::get('constants.elasticsearch.book.type');

            $params = Ulities::getElasticParams($indexName, $typeName, $options);
            $client = ClientBuilder::create()->build();
            $response = $client->search($params);

            $book['total'] = $response["hits"]["total"];
            $book['data'] = [];
            if ($response["hits"]["total"] > 0) {
                foreach ($response["hits"]["hits"] as $item) {
                    $book['data'][] = $item['_source'];
                };
            }
        } else if ($request->has('catID')){
            $catID = $request->get('catID');
            $book = $this->bookRepository->getByCatID($catID, $limit)->toArray();
        }else{
//            $book = $this->bookRepository->paginate($limit)->toArray();
            $book = $this->bookRepository->paginateByTitleSort($sort, $limit)->toArray();
        }
        $paginate = Ulities::calculatorPage(null, $page, $book['total'], $limit);

        $urlSort = [];
        $urlSort['latest'] = '/' . $currentPath . '?' . $paramPath . 'sort=desc';
        $urlSort['oldest'] = '/' . $currentPath . '?' . $paramPath . 'sort=asc';
        if($request->has('page')) {
            $urlSort['latest'] .= '&page=' . $request->get('page');
            $urlSort['oldest'] .= '&page=' . $request->get('page');
        }

        // check login
        $user = Auth::user();
        if($user){
            $library = $this->libraryRepository->getAllLibraryByUserID($user->id)->toArray();
        }else{
            $library = [];
        }

        // list category left
        $category = $this->categoryRepository->parentOrderByPath()->toArray();
        // list researches
        $researches = $this->researchRepository->getListItem(5);
        return view('Frontend.Book.index', compact(['category', 'researches', 'book', 'paginate', 'q', 'library', 'urlSort', 'pageName']));
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
     * check status like
     * @param Request $request
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
                            $data['is_like'] = 0;
                            $data['is_public'] = 1;
                            $data['is_delete'] = 0;
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
                                $data['is_like'] = 1;
                                $data['is_public'] = 1;
                                $data['is_delete'] = 0;
                                $this->bookdetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['book_id'] = $book_id;
                            $data['user_id'] = $user_id;
                            $data['share'] = 0;
                            $data['pink'] = 0;
                            $data['is_like'] = 1;
                            $data['is_public'] = 1;
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
     * check status read
     * @param Request $request
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
                            $data['object_id'] = $item['object_id'];
                            $data['user_id'] = $item['user_id'];
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

    /**
     * get library detail by user id
     * @param Request $request
     * @return string
     */
    public function getLibraryDetailbyUserID(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('library_id') && $request->has('object_id')) {
            $library_id = $request->get('library_id');
            $object_id = $request->get('object_id');
            $type = Config::get('constants.objectType.book');
            $libraryDetail = $this->libraryDetailRepository->getLibraryDetail($library_id, $object_id, $type)->toArray();
            $library_data = [];
            if(sizeof($libraryDetail) > 0){
                foreach($libraryDetail as $item){
                    $library_data[] = $item['_id'];
                }
                $result['status'] = 1;
                $result['data'] = $library_data;
            }
        }else{
            $result['status'] = 0;
            $result['data'] = '';
        }
        return json_encode($result);
    }

    /**
     * update library detail
     * @param Request $request
     * @return string
     */
    public function updateLibraryDetail(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('library_id') && $request->has('object_id')) {
            $library_id = $request->get('library_id');
            $object_id = $request->get('object_id');
            $type = Config::get('constants.objectType.book');
            $libraryDetail = $this->libraryDetailRepository->getLibraryDetail($library_id, $object_id, $type)->toArray();
            $libraryDetailExist = $this->libraryDetailRepository->getLibraryDetailExist($library_id, $object_id, $type)->toArray();

            if(sizeof($libraryDetail) <= 0){
                if(sizeof($libraryDetailExist) > 0){
                    foreach($libraryDetailExist as $item){
                        $data = [];
                        $data['library_id'] = $item['library_id'];
                        $data['object_id'] = $item['object_id'];
                        $data['type_name'] = $item['type_name'];
                        $data['share'] = $item['share'];
                        $data['is_delete'] = 0;
                        $this->libraryDetailRepository->update($item['_id'], $data);
                    }
                    $result['status'] = 1;
                }else{
                    $data = [];
                    $data['library_id'] = $library_id;
                    $data['object_id'] = $object_id;
                    $data['type_name'] = $type;
                    $data['share'] = 0;
                    $data['is_delete'] = 0;
                    $this->libraryDetailRepository->create($data);
                    $result['status'] = 2;
                }
            }else{
                foreach($libraryDetail as $item) {
                    $data = [];
                    $data['library_id'] = $item['library_id'];
                    $data['object_id'] = $item['object_id'];
                    $data['type_name'] = $item['type_name'];
                    $data['share'] = $item['share'];
                    $data['is_delete'] = 1;
                    $this->libraryDetailRepository->update($item['_id'], $data);
                }
                $result['status'] = 3;
            }
        }else{
            $result['status'] = 0;
            $result['data'] = '';
        }
        return json_encode($result);
    }

    /**
     * create library
     * @param Request $request
     * @return string
     */
    public function createLibrary(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('name') && $request->has('user_id')) {
            $name = $request->get('name');
            $userId = (int)$request->get('user_id');

            $checkName = $this->libraryRepository->checkName($userId,$name)->toArray();

            if(sizeof($checkName) <= 0){
                $library_data = [];
                $library_data['title'] = $name;
                $library_data['alias'] = Ulities::to_slug($name);
                $library_data['description'] = '';
                $library_data['image'] = '';
                $library_data['url'] = '';
                $library_data['view'] = 0;
                $library_data['price'] = 0;
                $library_data['like'] = 0;
                $library_data['category_id'] = 0;
                $library_data['user_id'] = $userId;
                $library_data['is_delete'] = 0;
                $library_data_result = $this->libraryRepository->create($library_data);

                $result['status'] = 1;
                $result['data'] = $library_data_result;
            }else{
                $result['status'] = 0;
                $result['data'] = 'Name is exist';
            }
        }else{
            $result['status'] = 0;
            $result['data'] = '';
        }
        return json_encode($result);
    }

    /**
     * Check status share
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkShare(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("user_id") && $request->has("book_id")){
            $user_id = $request->get("user_id");
            $book_id = $request->get("book_id");
            $bookDetail = $this->bookdetailRepository->checkShared($user_id, $book_id)->toArray();

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
                            $data['share'] = 0;
                            $data['pink'] = $item['pink'];
                            $data['is_public'] = 1;
                            $data['is_delete'] = 0;
                            $this->bookdetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $bookDetail = $this->bookdetailRepository->checkunShared($user_id, $book_id)->toArray();
                        if(sizeof($bookDetail) > 0){
                            foreach($bookDetail as $item){
                                $data['book_id'] = $item['book_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = 1;
                                $data['pink'] = $item['pink'];
                                $data['is_public'] = 1;
                                $data['is_delete'] = 0;
                                $this->bookdetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['book_id'] = $book_id;
                            $data['user_id'] = $user_id;
                            $data['share'] = 1;
                            $data['pink'] = 0;
                            $data['is_public'] = 1;
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
     * Check pin
     * @param Request $request
     */
    public function checkPin(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("user_id") && $request->has("book_id")){
            $user_id = $request->get("user_id");
            $book_id = $request->get("book_id");
            $bookDetail = $this->bookdetailRepository->checkPin($user_id, $book_id)->toArray();

            if(sizeof($bookDetail) > 0){
                if($bookDetail[0]["pink"] == 1){
                    $result['status'] = 1;
                    $result['data'] = $bookDetail;
                }
            }else{
                $result['status'] = 0;
            }

            if($request->has("change")){
                $change = $request->get("change");
                if($change ==1){
                    if(sizeof($bookDetail) > 0){
                        if($bookDetail[0]["pink"] == 1){
                            $pink = 0;
                            $result['status'] = 0;
                        }else {
                            $pink = 1;
                            $result['status'] = 1;
                        }
                        foreach($bookDetail as $item){
                            $data['book_id'] = $item['book_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = $item['share'];
                            $data['pink'] = $pink;
                            $data['is_public'] = 1;
                            $data['is_delete'] = 0;
                            $this->bookdetailRepository->update($item['_id'], $data);
                        }
                    }else{
                        $bookDetail = $this->bookdetailRepository->checkunPin($user_id, $book_id)->toArray();
                        if(sizeof($bookDetail) > 0){
                            foreach($bookDetail as $item){
                                $data['book_id'] = $item['book_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = 0;
                                $data['pink'] = 1;
                                $data['is_public'] = 1;
                                $data['is_delete'] = 0;
                                $this->bookdetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['book_id'] = $book_id;
                            $data['user_id'] = $user_id;
                            $data['share'] = 0;
                            $data['pink'] = 1;
                            $data['is_public'] = 1;
                            $data['is_delete'] = 0;
                            $data = $this->bookdetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 1;
                    }
                }
            }
        }
        $result = json_encode($result);
        print_r($result);die;
    }

    /**
     * library checked list
     * @param Request $request
     */
    public function libraryCheckedList(Request $request){
        $result['status'] = 0;
        $result['data'] = "";

        $user = Auth::user();
        $userId = 0;
        if($user){
            $userId = $user->id;
        }

        if($userId > 0){
            $library_data = [];
            $library = $this->libraryRepository->getAllLibraryByUserID($userId)->toArray();
            foreach($library as $item){
                $item_data = [];

                $library_id = $item['_id'];
                $item_data['checked'] = 0;
                if($request->has('object_id')){
                    $object_id = $request->get("object_id");
                    $type = Config::get('constants.objectType.book');
                    $library_detail = $this->libraryDetailRepository->getLibraryDetail($library_id, $object_id, $type)->toArray();

                    if(sizeof($library_detail) > 0){
                        $item_data['checked'] = 1;
                    }
                }

                $item_data['title'] = $item['title'];
                $item_data['id'] = $item['_id'];
                $library_data[] = $item_data;
            }
            $result['status'] = 1;
            $result['data'] = $library_data;
        }else{
            $result['status'] = 1;
            $result['data'] = 'not login';
        }

        $result = json_encode($result);
        print_r($result);die;
    }
}
