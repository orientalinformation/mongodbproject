<?php

namespace App\Http\Controllers\Backend;

use App\Model\PostElastic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'bookIndex';

        $searchValue = !is_null($request->get('q'))? $request->get('q'): null;

        $page = $request->get('page');
        $rowPage = 24;

        if (!isset($page)) {
            $page = 1;
        }

        $url = url()->current();

        $post = new PostElastic();
        $client = ClientBuilder::create()->build();

        $matchAll = [
            'match_all' => new \stdClass()
        ];

        $matchPrefix = [
            'match_phrase_prefix'   => [
                'title' => $searchValue
            ]
        ];

        $param = [
            'index' => $post->getIndexName(),
            'type'  => $post->getTypeName(),
            'body'  => [
                'from'  => ($page - 1) * $rowPage,
                'size'  => $rowPage,
                'query' => is_null($searchValue) ? $matchAll : $matchPrefix

            ]
        ];

        $data = $client->search($param);
        $rowNum = $data['hits']['total'];
        $pageNum = 0;

        if (count($data) > 0) {
            $pageNum = (int)($rowNum/$rowPage);
            $pageNum += ($rowNum % $rowPage) > 0 ? 1 : 0;
        }

        $prev = $page > 1 ? $url . ($searchValue ? '?q=' . $searchValue : '') . (is_null($searchValue) ? '?page=':'&page=' ) . ($page - 1): null;
        $next = $page < $pageNum ? $url . ($searchValue ? '?q=' . $searchValue : '') . (is_null($searchValue) ? '?page=':'&page=' ) . ($page + 1): null;
        $paginate = [
            'page'          => $page,
            'pageNum'       => $pageNum,
            'prev'          => $prev,
            'next'          => $next,
            'url'           => $url
        ];

        $q = $searchValue;

        return view('Backend.Search.index' , compact(['currentPage', 'data', 'q', 'paginate']));
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
