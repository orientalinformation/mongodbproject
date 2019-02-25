<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AccountManager\AccountManagerRepositoryInterface;
use App\Http\Middleware\CheckAdmin;

class AccountManagersController extends Controller
{
    /**
     * @var AccountManagerRepositoryInterface|\App\Repositories\BaseRepositoryInterface
     */
    protected $accountRepository;

    /**
     * AccountManagersController constructor.
     * @param AccountManagerRepositoryInterface $accountRepository
     */
    public function __construct(AccountManagerRepositoryInterface $accountRepository)
    {
        $this->middleware(CheckAdmin::class);
        $this->middleware('auth');
        $this->accountRepository = $accountRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = 'account';

        // get data
        $access = $this->accountRepository->getAccountByKey('name', 'Access');
        $premium = $this->accountRepository->getAccountByKey('name', 'Premium');
        $club = $this->accountRepository->getAccountByKey('name', 'Club');

        return view('Backend.Account.index', compact(['currentPage', 'access', 'premium', 'club']));
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
        // get data    
        $data = $request->all();

        $accessId = $data['access_id']; 
        $premiumId = $data['premium_id']; 
        $clubId = $data['club_id']; 

        // set data for access and save
        $accessParDis = [];
        array_push($accessParDis, ($data['access_par_dis_public'] == 'on') ? 1 : 0);
        array_push($accessParDis, ($data['access_par_dis_private'] == 'on') ? 1 : 0);
        array_push($accessParDis, ($data['access_par_dis_confidential'] == 'on') ? 1 : 0);

        $accessCreateDis = [];
        array_push($accessCreateDis, ($data['access_create_dis_public'] == 'on') ? 1 : 0);
        array_push($accessCreateDis, $data['access_create_dis_private']);
        array_push($accessCreateDis, $data['access_create_dis_confidential']);

        $accessData = [
            "access_documents" => $data['access_access_documents'],
            "customizable_curation" => ($data['access_customizable_curation'] == 'on') ? 1 : 0,
            "number_rss" => $data['access_number_rss'],
            "customizing_environment" => $data['access_customizing_environment'],
            "number_libraries" => $data['access_number_libraries'],
            "follow_discussion_groups" => ($data['access_follow_discussion_groups'] == 'on') ? 1 : 0,
            "participation_disussions" => json_encode($accessParDis),
            "creating_disussion" => json_encode($accessCreateDis),
            "publicity" => ($data['access_publicity'] == 'on') ? 1 : 0,
            "association_applications" => ($data['access_association_applications'] == 'on') ? 1 : 0,            
        ];

        $access = $this->accountRepository->update($accessId, $accessData);

        // set data for premium and save
        $premiumParDis = [];
        array_push($premiumParDis, ($data['premium_par_dis_public'] == 'on') ? 1 : 0);
        array_push($premiumParDis, ($data['premium_par_dis_private'] == 'on') ? 1 : 0 );
        array_push($premiumParDis, ($data['premium_par_dis_confidential'] == 'on') ? 1 : 0 );

        $premiumCreateDis = [];
        array_push($premiumCreateDis, ($data['premium_create_dis_public'] == 'on') ? 1 : 0);
        array_push($premiumCreateDis, $data['premium_create_dis_private']);
        array_push($premiumCreateDis, $data['premium_create_dis_confidential']);

        $premiumData = [
            "access_documents" => $data['premium_access_documents'],
            "customizable_curation" => ($data['premium_customizable_curation'] == 'on') ? 1 : 0,
            "number_rss" => $data['premium_number_rss'],
            "customizing_environment" => $data['premium_customizing_environment'],
            "number_libraries" => $data['premium_number_libraries'],
            "follow_discussion_groups" => ($data['premium_follow_discussion_groups'] == 'on') ? 1 : 0,
            "participation_disussions" => json_encode($premiumParDis),
            "creating_disussion" => json_encode($premiumCreateDis),
            "publicity" => ($data['premium_publicity'] == 'on') ? 1 : 0,
            "association_applications" => ($data['premium_association_applications'] == 'on') ? 1 : 0,            
        ];

        $premium = $this->accountRepository->update($premiumId, $premiumData);        

        // set data for club and save
        $clubParDis = [];
        array_push($clubParDis, ($data['club_par_dis_public'] == 'on') ? 1 : 0);
        array_push($clubParDis, ($data['club_par_dis_private'] == 'on') ? 1 : 0);
        array_push($clubParDis, ($data['club_par_dis_confidential'] == 'on') ? 1 : 0);

        $clubCreateDis = [];
        array_push($clubCreateDis, ($data['club_create_dis_public'] == 'on') ? 1 : 0);
        array_push($clubCreateDis, $data['club_create_dis_private']);
        array_push($clubCreateDis, $data['club_create_dis_confidential']);

        $clubData = [
            "access_documents" => $data['club_access_documents'],
            "customizable_curation" => ($data['club_customizable_curation'] == 'on') ? 1 : 0,
            "number_rss" => $data['club_number_rss'],
            "customizing_environment" => $data['club_customizing_environment'],
            "number_libraries" => $data['club_number_libraries'],
            "follow_discussion_groups" => ($data['club_follow_discussion_groups'] == 'on') ? 1 : 0,
            "participation_disussions" => json_encode($clubParDis),
            "creating_disussion" => json_encode($clubCreateDis),
            "publicity" => ($data['club_publicity'] == 'on') ? 1 : 0,
            "association_applications" => ($data['club_association_applications'] == 'on') ? 1 : 0,            
        ];

        $club = $this->accountRepository->update($clubId, $clubData);         

        return redirect()->route("accounts.index")->with("success",__('Successfully Deleted.'));
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
