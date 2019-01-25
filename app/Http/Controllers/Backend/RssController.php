<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Rss\RssRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function index()
    {
        $currentPage = 'rssIndex';
        $data = $this->rss->all()->toArray();

        $users = $this->user->findByColumn('is_admin', '=', 1)->pluck('id', 'id');

        dd($users);

        return view('Backend.Rss.index', compact(['currentPage', 'data']));
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?(\.rss)$/';
        $validator = Validator::make($request->all(), [
            'rss'   =>  'sometimes|required|regex:'.$regex
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(compact(['errors']) , 422);
        }

        $input  = $request->only(['rss', 'description']);

        $input['userId'] = Auth::user()->id;

//        $this->rss->create($input);

        $request->session()->flash('success', __('common.Addsuccess'));

        $message = __('common.Addsuccess');

        return response()->json(compact(['message']), 200);



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
