<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Discussion\DiscussionRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;
use App\Model\DiscussionElastic;
use Auth;

class DiscussionController extends Controller
{
    /**
     * @var DiscussionRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $discussionRepository;

    /**
     * DiscussionController constructor.
     * @param DiscussionRepositoryInterface $discussionRepository
     */
    public function __construct(DiscussionRepositoryInterface $discussionRepository)
    {
        $this->discussionRepository = $discussionRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'discussionIndex';
        $limitPage = 5;
        $rowPage = Config::get('constants.rowPage');
        //Searching value
        $q = null;
        $page = $request->get('page');
        if (is_null($page)) {
            $page = 1;
        }
        $result = $this->discussionRepository->paginate($rowPage)->toArray();
        $paginate = Ulities::calculatorPage(null, $page, $result['total'], $rowPage);
        return view('Backend.Discussion.index', compact(['currentPage', 'result', 'paginate', 'q']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentPage = 'discussionIndex';
        return view('Backend.Discussion.create', compact(['currentPage']));
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
            $data['title'] = $request->get('title');
            $data['type'] = $request->get('type');
            $data['start'] = $request->get('start');
            $data['end'] = $request->get('end');
            $data['moderator'] = $userID;
            $result = $this->discussionRepository->create($data);
            $id = $result->_id;

            if($id != '') {
                $discussion = new DiscussionElastic();
                $dataElastic = [
                    'body' => [
                        'title' => $request->get('title'),
                        'type' => $request->get('type'),
                        'start' => $request->get('start'),
                        'end' => $data['end'],
                        'moderator' => $userID
                    ],
                    'index' => $discussion->getIndexName(),
                    'type'  => $discussion->getTypeName(),
                    'id' => $id,
                ];
                $client = ClientBuilder::create()->build();
                $response = $client->index($dataElastic);
            }

            return redirect('admin/discussions')->with('success', 'Disccussion saved!');
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
        $currentPage = 'discussionIndex';
        $userID = Auth::id();
        if($request->has('id')) {
            $id = $request->get('id');
            $discussion = $this->discussionRepository->find($id)->toArray();
            if ($request->method() == 'POST') {
                $data['title'] = $request->get('title');
                $data['type'] = $request->get('type');
                $data['start'] = $request->get('start');
                $data['end'] = $request->get('end');
                $data['moderator'] = $userID;
                $this->discussionRepository->update($id, $data);

                $discussion = new DiscussionElastic();
                $dataElastic = [
                    'body' => [
                        'title' => $request->get('title'),
                        'type' => $request->get('type'),
                        'start' => $request->get('start'),
                        'end' => $data['end'],
                        'moderator' => $userID
                    ],
                    'index' => $discussion->getIndexName(),
                    'type'  => $discussion->getTypeName(),
                    'id' => $id,
                ];
                $client = ClientBuilder::create()->build();
                $response = $client->index($dataElastic);

                return redirect()->to('admin/discussions');
            }else{
                return view('Backend.Discussion.edit', compact(['currentPage', 'discussion']));
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
}
