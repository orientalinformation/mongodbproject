<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Envato\Ulities;
use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Rss\RssRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Rules\CheckRssRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\CheckAdmin;

class RssController extends Controller
{
    /**
     * @var RssRepositoryInterface|BaseRepositoryInterface
     */
    protected $rss;

    /**
     * @var UserRepositoryInterface|BaseRepositoryInterface
     */
    protected $user;

    /**
     * RssController constructor.
     * @param RssRepositoryInterface $rssRepository
     */
    public function __construct(
        RssRepositoryInterface $rssRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->rss = $rssRepository;

        $this->user = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'rssIndex';

        $q = !is_null($request->get('q'))? $request->get('q'): null;

        $page = $request->get('page');

        $rowPage = Config::get('constants.rowPage');

        if (!isset($page)) {
            $page = 1;
        }

        $users = $this->user->findByColumn('is_admin', '=', 1);

        $userIds = $users->pluck('id')->toArray();

        $userNames = $users->pluck('username', 'id')->toArray();

        $data = $this->rss->mongoPaginate('user_id', $userIds, $rowPage)->toArray();

        for($i = 0 ; $i < count($data['data']); $i++) {
            $data['data'][$i]['username'] = $userNames[$data['data'][$i]['user_id']];
        }

        $paginate = Ulities::calculatorPage($q, $page, $data['total'], $rowPage);

        return view('Backend.Rss.index', compact(['currentPage', 'data', 'q', 'paginate']));
    }

    /**
     * Show rss list of user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rssUserIndex(Request $request)
    {
        $currentPage = 'rssUserIndex';

        $q = !is_null($request->get('q'))? $request->get('q'): null;

        $page = $request->get('page');

        $rowPage = Config::get('constants.rowPage');

        if (!isset($page)) {
            $page = 1;
        }

        $users = $this->user->findByColumn('is_admin', '=', 0);

        $userIds = $users->pluck('id')->toArray();

        $userNames = $users->pluck('username', 'id')->toArray();

        $data = $this->rss->mongoPaginate('user_id', $userIds, $rowPage)->toArray();

        for($i = 0 ; $i < count($data['data']); $i++) {
            $data['data'][$i]['username'] = $userNames[$data['data'][$i]['user_id']];
        }

        $paginate = Ulities::calculatorPage($q, $page, $data['total'], $rowPage);

        return view('Backend.Rss.user-index', compact(['currentPage', 'data', 'q', 'paginate']));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Rss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regex = '/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/';

        $rules = [
            'url'   => [
                'sometimes',
                'required',
                'regex:'. $regex,
                new CheckRssRule()
            ]

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(compact(['errors']) , 422);
        }

        $input  = $request->only(['url', 'description']);

        $input['userId'] = Auth::user()->id;

        $response= $this->rss->create($input);

        if ($response) {
            $request->session()->flash('success', __('message.msg_create_successfully'));

            $status = 'ok';

            return response()->json(compact(['status']), 200);
        }

        $status = 'error';

        return response()->json(compact(['status']), 500);

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
        $rss = $this->rss->find($id);

        return view('Backend.Rss.edit', compact(['rss']));
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
        $regex = '/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/';

        $rules = [
            'url'   => [
                'sometimes',
                'required',
                'regex:'. $regex,
                new CheckRssRule()
            ]

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(compact(['errors']) , 422);
        }

        $input  = $request->only(['url', 'description']);

        $response = $this->rss->update($id, $input);

        if($response) {
            $request->session()->flash('success', __('message.msg_edit_successfully'));

            $status = 'ok';

            return  response()->json(compact(['status']), 200);
        }

        $status = 'error';

        return response()->json(compact(['status']), 500);

    }

    /**
     * Show message delete
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function delete(Request $request, $id)
    {
        $rss = $this->rss->find($id);

        if(is_null($rss)) {
            $errors = __('message.msg_error_delete');

            return response()->json(compact(['error']), 422);
        }

        return view('Backend.Rss.delete', compact(['rss']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rss = $this->rss->find($id);

        if(is_null($rss)) {
            $errors = __('message.msg_error_delete');

            return response()->json(compact(['error']), 422);
        }

        $response = $this->rss->delete($id);
        if($response) {
            $request->session()->flash('success', __('msg_delete_successfully'));

            $status = 'ok';

            return  response()->json(compact(['status']), 200);
        }

        $status = 'error';

        return response()->json(compact(['status']), 500);
    }
}
