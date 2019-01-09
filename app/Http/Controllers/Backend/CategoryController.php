<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $cateogryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $cateogryRepository
     */
    public function __construct(CategoryRepositoryInterface $cateogryRepository)
    {
        $this->cateogryRepository = $cateogryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentPage = 'categoryIndex';
        $limitPage = 5;
        $rowPage = 5;
        $result = $this->cateogryRepository->paginateWithoutSort($rowPage)->toArray();
        $result['limitPage'] = $limitPage;
        return view('Backend.Category.index', compact(['currentPage', 'result']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentPage = 'categoryIndex';
        $category_list = $this->cateogryRepository->all()->toArray();
        return view('Backend.Category.create', compact(['currentPage', 'category_list']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['parentID'] = $request->get('parentID');
        $data['name'] = $request->get('name');
        $data['description'] = $request->get('description');
        $this->cateogryRepository->create($data);
        return redirect()->to('categories');
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
        if($request->has('id')) {
            $id = $request->get('id');
            $category_list = $this->cateogryRepository->all()->toArray();
            $category = $this->cateogryRepository->find($id)->toArray();
            if ($request->method() == 'POST') {
                $data['parentID'] = $request->get('parentID');
                $data['name'] = $request->get('name');
                $data['description'] = $request->get('description');
                $this->cateogryRepository->update($id, $data);
                return redirect()->to('categories');
            }else{
                return view('Backend.Category.edit', compact(['currentPage', 'category', 'category_list']));
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
        $this->cateogryRepository->delete($id);
        return redirect()->to('categories');
        return redirect()->route('catagories')->with(['succsess' => 'Delete successfully.']);
    }

    public function delete(Request $request){
        if($request->has('id')) {
            $id = $request->get('id');
            $this->cateogryRepository->delete($id);
            return redirect()->to('categories');
        }
    }
}
