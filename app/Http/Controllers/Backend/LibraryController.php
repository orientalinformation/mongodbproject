<?php

namespace App\Http\Controllers\Backend;

use App\Model\LibraryElastic;
use App\Repositories\Library\LibraryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = 'libraryIndex';
        $limitPage = 5;
        $rowPage = 5;
        $userID = Auth::id();
        $result = $this->libraryRepository->getLibraryByUserID(Auth::id(), $limitPage)->toArray();
        $result['limitPage'] = $limitPage;
        return view('Backend.Library.index', compact(['currentPage', 'result', 'userID']));
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

    public function updateShare(Request $request)
    {
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
                        'status' => $share,
                        'userID' => $library[0]["userID"]
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
        //
    }
}
