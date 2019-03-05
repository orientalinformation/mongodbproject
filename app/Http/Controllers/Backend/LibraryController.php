<?php

namespace App\Http\Controllers\Backend;

use App\Model\LibraryElastic;
use App\Repositories\Library\LibraryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;
use App\Helpers\Envato\Ulities;
use Illuminate\Support\Facades\Config;
use Auth;
use App\Http\Middleware\CheckAdmin;

class LibraryController extends Controller
{
    /**
     * @var LibraryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $libraryRepository;

    /**
     * LibraryController constructor.
     * @param LibraryRepositoryInterface $libraryRepository
     */
    public function __construct(LibraryRepositoryInterface $libraryRepository)
    {
        $this->libraryRepository = $libraryRepository;
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'libraryIndex';
        $limitPage = 5;
        $rowPage = Config::get('constants.rowPage');
        //Searching value
        $q = null;
        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }
        $userID = Auth::id();
        $result = $this->libraryRepository->getLibraryByUserID(Auth::id(), $limitPage)->toArray();
        $paginate = Ulities::calculatorPage(null, $page, $result['total'], $rowPage);
        return view('Backend.Library.index', compact(['currentPage', 'result', 'userID', 'paginate', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentPage = 'libraryIndex';
        return view('Backend.Library.create', compact(['currentPage']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = Auth::id();
        if ($request->method() == 'POST') {
            $data['name'] = $request->get('name');
            $data['alias'] = $request->get('alias');
            if ($request->has('share')) {
                $share = 1;
            } else {
                $share = 0;
            }
            $data['share'] = $share;
            $data['userID'] = $userID;
            $data['view'] = 0;
            $result = $this->libraryRepository->create($data);
            $id = $result->_id;

            if($id != '') {
                $library = new LibraryElastic();
                $dataElastic = [
                    'body' => [
                        'name' => $request->get('name'),
                        'alias' => $request->get('alias'),
                        'share' => $share,
                        'userID' => $userID,
                        'view' => $request->get('view'),
                    ],
                    'index' => $library->getIndexName(),
                    'type'  => $library->getTypeName(),
                    'id' => $id,
                ];
                $client = ClientBuilder::create()->build();
                $response = $client->index($dataElastic);
            }

            return redirect()->to('admin/libraries');
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
        $currentPage = 'categoryIndex';
        $userID = Auth::id();
        if($request->has('id')) {
            $id = $request->get('id');
            $library = $this->libraryRepository->find($id)->toArray();
            if ($request->method() == 'POST') {
                $data['name'] = $request->get('name');
                $data['alias'] = $request->get('alias');
                if($request->has('share')) {
                    $share = 1;
                }else{
                    $share = 0;
                }
                $data['share'] = $share;
                $data['userID'] = $userID;
                $data['view'] = $request->get('view');
                $this->libraryRepository->update($id, $data);

                $library = new LibraryElastic();
                $dataElastic = [
                    'body' => [
                        'name' => $request->get('name'),
                        'alias' => $request->get('alias'),
                        'share' => $share,
                        'userID' => $userID,
                        'view' => $request->get('view')
                    ],
                    'index' => $library->getIndexName(),
                    'type'  => $library->getTypeName(),
                    'id' => $id,
                ];
                $client = ClientBuilder::create()->build();
                $response = $client->index($dataElastic);

                return redirect()->to('admin/libraries');
            }else{
                return view('Backend.Library.edit', compact(['currentPage', 'library']));
            }
        }
        dd('a');
    }

    public function updateShare(Request $request)
    {
        $userID = Auth::id();
        if($request->has('libraryID')) {
            $id = $request->get('libraryID');
            $share = $request->get('share');
            $library = $this->libraryRepository->checkShare($id, $share)->toArray();
            if(sizeof($library)) {
                if ($library[0]["share"] == 1) {
                    $share = 0;
                    $data['share'] = 0;
                    $this->libraryRepository->update($id, $data);
                    return 1;
                } else {
                    $share = 1;
                    $data['share'] = 1;
                    $this->libraryRepository->update($id, $data);
                    return 0;
                }

                $library = new LibraryElastic();
                $dataElastic = [
                    'body' => [
                        'name' => $library[0]["name"],
                        'alias' => $library[0]["alias"],
                        'share' => $share,
                        'userID' => $userID,
                        'view' => $library[0]["view"]
                    ],
                    'index' => $book->getIndexName(),
                    'type'  => $book->getTypeName(),
                    'id' => $library[0]["_id"],
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
        $this->libraryRepository->delete($id);
        return redirect()->to('admin/libraries');
    }

    public function delete(Request $request){
        if($request->has('id')) {
            $id = $request->get('id');
            $this->libraryRepository->delete($id);

            $library = new LibraryElastic();
            $params = [
                'index' => $library->getIndexName(),
                'type'  => $library->getTypeName(),
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
                    'index' => $library->getIndexName(),
                    'type'  => $library->getTypeName(),
                    'id' => $id
                ];
                $client->delete($params);
            }

            return redirect()->to('admin/libraries');
        }
    }
}
