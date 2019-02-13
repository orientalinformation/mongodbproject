<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\BaseRepositoryInterface;
use App\Repositories\Pin\PinRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Pin;

class PinController extends Controller
{
    /**
     * @var PinRepositoryInterface|BaseRepositoryInterface
     */
    protected $pinRepository;

    /**
     * PinController constructor.
     * @param PinRepositoryInterface $pinRepository
     */
    public function __construct(PinRepositoryInterface $pinRepository)
    {
        $this->pinRepository = $pinRepository;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $itemID = $request->get('itemID');
        $userID = (int)$request->get('userID');
        $type = $request->get('type');
        $result = $this->pinRepository->findByMultiWhere($itemID, $userID, $type)->toArray();
        if(sizeof($result) > 0){
            $this->pinRepository->delete($result[0]['_id']);
            return 1;
        }else{
            $data = [];
            $data['itemID'] = $itemID;
            $data['userID'] = $userID;
            $data['type'] = $type;
            $this->pinRepository->create($data);
            return 0;
        }
    }

    static function checkPinExist($itemID, $userID, $type) {
        $result = Pin::findByMultiWhere($itemID, $userID, $type)->toArray();
        if(sizeof($result)>0){
            return 1;
        }
        return 0;
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
