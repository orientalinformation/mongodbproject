<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Book\BookRepositoryInterface;
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
    public function __construct(CategoryRepositoryInterface $cateogryRepository, BookRepositoryInterface $bookRepository)
    {
        $this->cateogryRepository = $cateogryRepository;
        $this->bookRepository = $bookRepository;
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
}
