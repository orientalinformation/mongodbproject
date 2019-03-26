<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Helpers\Envato\Ulities;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Route;
use App\Repositories\Research\ResearchRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Library\LibraryRepositoryInterface;
use App\Repositories\LibraryDetail\LibraryDetailRepositoryInterface;

class LibraryController extends Controller
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
     * @var LibraryRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
	protected $libraryRepository;
    
    /**
     * @var LibraryDetailRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $libraryDetailRepository;
	
	/**
     * Instantiate Bibliotheque controller.
     *
     * @param Request $request
	 * @param CategoryRepositoryInterface $categoryRepository
	 * @param ResearchRepositoryInterface $researchRepository
	 * @param LibraryRepositoryInterface $libraryRepository
	 * @param LibraryDetailRepositoryInterface $libraryDetailRepository
     * @return void
     */
    public function __construct(
        Request $request,
		CategoryRepositoryInterface $categoryRepository,
		ResearchRepositoryInterface $researchRepository,
		LibraryRepositoryInterface $libraryRepository,
        LibraryDetailRepositoryInterface $libraryDetailRepository
    ) {
        $this->request = $request;
        $this->categoryRepository = $categoryRepository;
		$this->researchRepository = $researchRepository;
		$this->libraryRepository = $libraryRepository;
        $this->libraryDetailRepository = $libraryDetailRepository;
    }

    /** 
     * Display Bibliottheque
     * @return View
     */
    public function index()
    {
        $q                   = $this->request->has('q') ? $this->request->get('q') : null;
		$page                = $this->request->has('page') ? $this->request->get('page') : 1;
		$currentPath         = Route::getFacadeRoot()->current()->uri();
		$limit               = Config::get('constants.rowPage');
		$options             = null;
		$options['page']     = $page;
        $options['limit']    = $limit;
        
		if ($q != null) {
			$options['q'] = $q;
		}
		if ($this->request->has('sort')) {
			$options['sort'] = $this->request->get('sort');
		}

		// url ordering
		$paramPath = '';
		if ($q != null) {
			$paramPath = 'q=' . $q . '&';
		}

		if($this->request->has('start_year') && $this->request->has('end_year')) {
			$options['start_year'] = $this->request->get('start_year');
			$options['end_year']   = $this->request->get('end_year');
			$paramPath .= 'start_year=' . $options['start_year'] . '&end_year=' . $options['end_year'] . '&';
		}

		if($this->request->has('category')) {
			$categories  = explode(',', $this->request->get('category'));
			$arrCategory = [];
			foreach ($categories as $category) {
				$listCategories = $this->categoryRepository->getCategoryTreeId($category);
				foreach ($listCategories as $listCategory) {
					$arrCategory[] = $listCategory;
				}
			}

			$arrCategory = array_values(array_unique($arrCategory));
			$options['category'] = $arrCategory;
			$paramPath .= 'category=' . $this->request->get('category') . '&';
		}

		$urlSort           = [];
		$urlSort['latest'] = '/' . $currentPath . '?' . $paramPath . 'sort=desc';
		$urlSort['oldest'] = '/' . $currentPath . '?' . $paramPath . 'sort=asc';
		$indexName         = Config::get('constants.elasticsearch.library.index');
		$typeName          = Config::get('constants.elasticsearch.library.type');

		$params            = Ulities::getElasticParams($indexName, $typeName, $options);

		$client            = ClientBuilder::create()->build();
		$response          = $client->search($params);
		$bibliotheques     = [];
		if (!empty($response)) {
            $bibliotheques['total'] = $response['hits']['total'];
            $bibliotheques['hits']  = $response['hits']['hits'];
		}
		
		$bibliothequeItems = [];
		if(!empty($bibliotheques['hits'])) { 
			if (count($bibliotheques['hits']) > 6) {
				$itemTotal = ceil(count($bibliotheques['hits'])/6);
				$from      = 0;
				$to        = 6;
				for($i = 0; $i < $itemTotal; $i++) {
					$bibliothequeItems[] = array_slice($bibliotheques['hits'], $from, $to);
					$from += 6;
				}
		    } else {
		    	$bibliothequeItems[] = $bibliotheques['hits'];
		    }
		}

		$paginate = Ulities::calculatorPage($q, $page, $bibliotheques['total'], $limit);
        $result   = $this->libraryRepository->paginate($limit)->toArray();

		// list category left
        $category = $this->categoryRepository->parentOrderByPath()->toArray();

		// list researches
		$researches = $this->researchRepository->getListItem(5)->toArray();
		$library    = $this->libraryRepository->getAllLibraryByUserID(1)->toArray();

		return view(
			'Frontend.Bibliotheque.index',
			compact('bibliotheques', 'category', 'researches', 'bibliothequeItems', 'urlSort', 'result', 'paginate', 'q', 'library')
		);
	}
	
	/**
     * Check status like
     *
     * @return string
     */
    public function checkLiked(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("user_id") && $request->has("library_id")) {
            $userId = $request->get("user_id");
            $libraryId = $request->get("library_id");
            $libraryDetail = $this->libraryDetailRepository->checkLiked($userId, $libraryId)->toArray();

            if(sizeof($libraryDetail) > 0) {
                $result['status'] = 1;
                $result['data'] = $libraryDetail;
            } else {
                $result['status'] = 0;
            }

            if($request->has("change")) {
                $change = $request->get("change");
                if($change ==1){
                    if(sizeof($libraryDetail) > 0){
                        foreach($libraryDetail as $item) {
                            $data['library_id'] = $item['library_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = $item['share'];
                            $data['pink'] = $item['pink'];
                            $data['is_like'] = 0;
                            $data['is_public'] = 1;
                            $data['is_delete'] = 0;
                            $this->libraryDetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    }else{
                        $libraryDetail = $this->libraryDetailRepository->checkunLiked($userId, $libraryId)->toArray();
                        
                        if(sizeof($libraryDetail) > 0){
                            foreach($libraryDetail as $item){
                                $data['library_id'] = $item['library_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = $item['share'];
                                $data['pink'] = $item['pink'];
                                $data['is_like'] = 1;
                                $data['is_public'] = 1;
                                $data['is_delete'] = 0;
                                $this->libraryDetailRepository->update($item['_id'], $data);
                            }
                        }else{
                            $data['library_id'] = $libraryId;
                            $data['user_id'] = $userId;
                            $data['share'] = 0;
                            $data['pink'] = 0;
                            $data['is_like'] = 1;
                            $data['is_public'] = 1;
                            $data['is_delete'] = 0;
                            $data = $this->libraryDetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }
        $result = json_encode($result);
        return response()->json($result);
    }

    /**
     * Check status read
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkRead(Request $request)
    {
        $result['status'] = 0;
        $result['data']   = "";
        if($request->has("library_id")) {
            $userId        = Auth::user()->id;
            $objectId      = $request->get("library_id");
            $type          = Config::get('constants.objectType.library');
            $libraryDetail = $this->readafterRepository->checkRead($userId, $objectId, $type)->toArray();

            if(sizeof($libraryDetail) > 0) {
                $result['status'] = 1;
                $result['data']   = $libraryDetail;
            } else {
                $result['status'] = 0;
            }

            if($request->has("change")) {
                $change = $request->get("change");
                if($change == 1) {
                    if(sizeof($libraryDetail) > 0) {
                        foreach($libraryDetail as $item) {
                            $data['user_id']   = $item['user_id'];
                            $data['object_id'] = $item['object_id'];
                            $data['type_name'] = $type;
                            $data['is_delete'] = 1;
                            $this->readafterRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    } else {
                        $libraryDetail = $this->readafterRepository->checkunRead($userId, $objectId, $type)->toArray();
                        if(sizeof($libraryDetail) > 0) {
                            foreach($libraryDetail as $item) {
                                $data['user_id']   = $item['user_id'];
                                $data['object_id'] = $item['object_id'];
                                $data['type_name'] = $type;
                                $data['is_delete'] = 0;
                                $this->readafterRepository->update($item['_id'], $data);
                            }
                        } else {
                            $data['user_id']   = $userId;
                            $data['object_id'] = $objectId;
                            $data['type_name'] = $type;
                            $data['is_delete'] = 0;
                            $data              = $this->readafterRepository->create($data);
                            $result['data']    = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }
        $result = json_encode($result);

        return response()->json($result);
    }

    /**
     * Get library detail with user id
     *
     * @return string
     */
    public function getLibraryDetailbyUserID(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('library_id') && $request->has('object_id')) {
            $libraryId     = $request->get('library_id');
            $objectId      = $request->get('object_id');
            $type          = Config::get('constants.objectType.library');
            $libraryDetail = $this->libraryDetailRepository->getLibraryDetail($libraryId, $objectId, $type)->toArray();
            $libraryData   = [];

            if(sizeof($libraryDetail) > 0) {
                foreach($libraryDetail as $item) {
                    $libraryData[] = $item['_id'];
                }
                $result['status'] = 1;
                $result['data']   = $libraryData;
            }
        } else {
            $result['status'] = 0;
            $result['data']   = '';
        }
        
        return response()->json($result);
    }

    /**
     * Update library detail
     *
     * @return string
     */
    public function updateLibraryDetail(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('library_id') && $request->has('object_id')) {
            $libraryId = $request->get('library_id');
            $objectId = $request->get('object_id');
            $type = Config::get('constants.objectType.library');
            $libraryDetail = $this->libraryDetailRepository->getLibraryDetail($libraryId, $objectId, $type)->toArray();
            $libraryDetailExist = $this->libraryDetailRepository->getLibraryDetailExist($libraryId, $objectId, $type)->toArray();

            if(sizeof($libraryDetail) <= 0) {
                if(sizeof($libraryDetailExist) > 0) {
                    foreach($libraryDetailExist as $item) {
                        $data = [];
                        $data['library_id'] = $item['library_id'];
                        $data['object_id'] = $item['object_id'];
                        $data['type_name'] = $item['type_name'];
                        $data['share'] = $item['share'];
                        $data['is_delete'] = 0;
                        $this->libraryDetailRepository->update($item['_id'], $data);
                    }
                    $result['status'] = 1;
                } else {
                    $data = [];
                    $data['library_id'] = $libraryId;
                    $data['object_id'] = $objectId;
                    $data['type_name'] = $type;
                    $data['share'] = 0;
                    $data['is_delete'] = 0;
                    $this->libraryDetailRepository->create($data);
                    $result['data'] = $data;
                    $result['status'] = 2;
                }
            } else {
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
        } else {
            $result['status'] = 0;
            $result['data'] = '';
        }
        
        return response()->json($result);
    }

    /**
     * Create a library
     *
     * @return string
     */
    public function createLibrary(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";

        if($request->has('name')) {
            $name = $request->get('name');
            $userId = Auth::user()->id;

            $checkName = $this->libraryRepository->checkName($userId,$name)->toArray();

            if(sizeof($checkName) <= 0) {
                $data = [];
                $data['name'] = $name;
                $data['alias'] = Ulities::to_slug($name);
                $data['share'] = 0;
                $data['user_id'] = $userId;
                $data['view'] = 0;
                $data['is_delete'] = 0;
                $data_result = $this->libraryRepository->create($data);

                $result['status'] = 1;
                $result['data'] = $data_result;
            } else {
                $result['status'] = 0;
                $result['data'] = 'Name is exist';
            }
        } else {
            $result['status'] = 0;
            $result['data'] = '';
        }
        
        return response()->json($result);
    }

        /**
     * Check share status
     *
     * @return string
     */
    public function checkShare(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("object_id")) {
            $userId = Auth::user()->id;
            $objectId = $request->get("object_id");
            $libraryDetail = $this->libraryDetailRepository->checkShared($userId, $objectId)->toArray();

            if(sizeof($libraryDetail) > 0) {
                $result['status'] = 1;
                $result['data'] = $libraryDetail;
            }else {
                $result['status'] = 0;
            }

            if($request->has("change")) {
                $change = $request->get("change");
                if($change == 1) {
                    if(sizeof($libraryDetail) > 0) {
                        foreach($libraryDetail as $item) {
                            $data['library_id'] = $item['library_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = 0;
                            $data['pink'] = $item['pink'];
                            $data['is_public'] = $item['is_public'];
                            $data['is_delete'] = $item['is_delete'];
                            $this->libraryDetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    } else {
                        $libraryDetail = $this->libraryDetailRepository->checkunShare($userId, $objectId)->toArray();
                        if(sizeof($libraryDetail) > 0){
                            foreach($libraryDetail as $item){
                                $data['library_id'] = $item['library_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['share'] = 1;
                                $data['pink'] = $item['pink'];
                                $data['is_public'] = $item['is_public'];
                                $data['is_delete'] = $item['is_delete'];
                                $this->libraryDetailRepository->update($item['_id'], $data);
                            }
                        } else {
                            $data['library_id'] = $objectId;
                            $data['user_id'] = $userId;
                            $data['share'] = 1;
                            $data['pink'] = 0;
                            $data['is_public'] = 0;
                            $data['is_delete'] = 0;
                            $data = $this->libraryDetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }

        return response()->json($result);
    }

    /**
     * Check pin
     * @param Request $request
     */
    public function checkPin(Request $request)
    {
        $result['status'] = 0;
        $result['data'] = "";
        if($request->has("object_id")) {
            $userId = Auth::user()->id;
            $objectId = $request->get("object_id");
            $libraryDetail = $this->libraryDetailRepository->checkPin($userId, $objectId)->toArray();

            if(sizeof($libraryDetail) > 0) {
                $result['status'] = 1;
                $result['data'] = $libraryDetail;
            }else {
                $result['status'] = 0;
            }

            if($request->has("change")) {
                $change = $request->get("change");
                if($change == 1) {
                    if(sizeof($libraryDetail) > 0) {
                        foreach($libraryDetail as $item) {
                            $data['library_id'] = $item['library_id'];
                            $data['user_id'] = $item['user_id'];
                            $data['share'] = $item['share'];
                            $data['pink'] = 0;
                            $data['is_public'] = $item['is_public'];
                            $data['is_delete'] = $item['is_delete'];
                            $this->libraryDetailRepository->update($item['_id'], $data);
                        }
                        $result['status'] = 1;
                    } else {
                        $libraryDetail = $this->libraryDetailRepository->checkunPin($userId, $objectId)->toArray();
                        if(sizeof($libraryDetail) > 0){
                            foreach($libraryDetail as $item){
                                $data['library_id'] = $item['library_id'];
                                $data['user_id'] = $item['user_id'];
                                $data['pink'] = 1;
                                $data['share'] = $item['share'];
                                $data['is_public'] = $item['is_public'];
                                $data['is_delete'] = $item['is_delete'];
                                $this->libraryDetailRepository->update($item['_id'], $data);
                            }
                        } else {
                            $data['library_id'] = $objectId;
                            $data['user_id'] = $userId;
                            $data['share'] = 0;
                            $data['pink'] = 1;
                            $data['is_public'] = 0;
                            $data['is_delete'] = 0;
                            $data = $this->libraryDetailRepository->create($data);
                            $result['data'] = $data;
                        }
                        $result['status'] = 2;
                    }
                }
            }
        }

        return response()->json($result);
    }
}
