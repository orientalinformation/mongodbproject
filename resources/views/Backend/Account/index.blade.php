@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        @include('Backend.partials.alerts')
        <div class="row">
            <div class="col-md-12 tx-center">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <span class="menu-item-label">{{ __('left-panel.accountManagement') }}</span>
                </h1>
            </div>
        </div>
        <div class="table-responsive"> 
            <form action="{{ route('accounts.store') }}" method="POST">
                {{ method_field("POST") }}
                {{ csrf_field() }}            
                <table class="table table-bordered table-striped">
                    <thead class="thead-colored thead-primary">
                        <tr>
                            <th class="tx-center wd-35p">{{ __('account.mainFeatures') }}</th>
                            <th class="tx-center">{{ __('account.optionAccess') }}</th>
                            <th class="tx-center">{{ __('account.optionPremium') }}</th>
                            <th class="tx-center">{{ __('account.optionClub') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $percents = ['10', '20', '30', '40', '50', '60', '70', '80', '90', '100'];  
                            $rss = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];  
                            $libraries = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];  
                            $customizing = ['0', '1', '2', '3', '4', '5'];  
                            $disussions = ['0', '1', '2', '3', '4', '5'];
                        ?>
                        <tr>
                            <td class="tx-center">{{ __('account.accessDocuments') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_access_documents">
                                    @foreach ($percents as $percent)
                                        <option @if($access->access_documents == $percent) selected @endif value="{{ $percent }}">
                                            {{ $percent }}%
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_access_documents">
                                    @foreach ($percents as $percent)
                                        <option @if($premium->access_documents == $percent) selected @endif value="{{ $percent }}"> 
                                            {{ $percent }}%
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_access_documents">
                                    @foreach ($percents as $percent)
                                        <option @if($club->access_documents == $percent) selected @endif value="{{ $percent }}"> 
                                            {{ $percent }}%
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.customizableCuration') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_customizable_curation" value="0">
                                    <input type="checkbox" @if($access->customizable_curation == 1) checked @endif name="access_customizable_curation">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_customizable_curation" value="0">
                                    <input type="checkbox" @if($premium->customizable_curation == 1) checked @endif name="premium_customizable_curation">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_customizable_curation" value="0">
                                    <input type="checkbox" @if($club->customizable_curation == 1) checked @endif name="club_customizable_curation">
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.numberRSS') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_number_rss">
                                    @foreach ($rss as $value)
                                        <option @if($access->number_rss == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_number_rss">
                                    @foreach ($rss as $value)
                                        <option @if($premium->number_rss == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_number_rss">
                                    @foreach ($rss as $value)
                                        <option @if($club->number_rss == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.customizingEnvironment') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_customizing_environment">
                                    @foreach ($customizing as $value)
                                        <option @if($access->customizing_environment == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }} {{ __('account.canvas') }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_customizing_environment">
                                    @foreach ($customizing as $value)
                                        <option @if($premium->customizing_environment == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }} {{ __('account.canvas') }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_customizing_environment">
                                    @foreach ($customizing as $value)
                                        <option @if($club->customizing_environment == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }} {{ __('account.canvas') }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.numberLibraries') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_number_libraries">
                                    @foreach ($libraries as $value)
                                        <option @if($access->number_libraries == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_number_libraries">
                                    @foreach ($libraries as $value)
                                        <option @if($premium->number_libraries == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_number_libraries">
                                    @foreach ($libraries as $value)
                                        <option @if($club->number_libraries == $value) selected @endif value="{{ $value }}"> 
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.followDiscussionGroups') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_follow_discussion_groups" value="0">    
                                    <input type="checkbox" @if($access->follow_discussion_groups == 1) checked @endif name="access_follow_discussion_groups">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_follow_discussion_groups" value="0">
                                    <input type="checkbox" @if($premium->follow_discussion_groups == 1) checked @endif name="premium_follow_discussion_groups">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_follow_discussion_groups" value="0">
                                    <input type="checkbox" @if($club->follow_discussion_groups == 1) checked @endif name="club_follow_discussion_groups">
                                    <span></span>
                                </label>
                            </td>
                        </tr> 
                        <tr>
                            <td class="tx-center">{{ __('account.participationDisussions') }}</td>
                            <td class="">
                                <?php 
                                    $accessParDis = json_decode($access->participation_disussions);
                                ?>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_par_dis_public" value="0">
                                    <input type="checkbox" @if($accessParDis[0] == 1) checked @endif name="access_par_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_par_dis_private" value="0">
                                    <input type="checkbox" @if($accessParDis[1] == 1) checked @endif name="access_par_dis_private">
                                    <span>{{ __('account.private') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_par_dis_confidential" value="0">
                                    <input type="checkbox" @if($accessParDis[2] == 1) checked @endif name="access_par_dis_confidential">
                                    <span>{{ __('account.confidential') }}</span>
                                </label>
                                <br/>
                            </td>
                            <td class="">
                                <?php 
                                    $premiumParDis = json_decode($premium->participation_disussions);
                                ?>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_par_dis_public" value="0">
                                    <input type="checkbox" @if($premiumParDis[0] == 1) checked @endif name="premium_par_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_par_dis_private" value="0">
                                    <input type="checkbox" @if($premiumParDis[1] == 1) checked @endif name="premium_par_dis_private">
                                    <span>{{ __('account.private') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_par_dis_confidential" value="0">
                                    <input type="checkbox" @if($premiumParDis[2] == 1) checked @endif name="premium_par_dis_confidential">
                                    <span>{{ __('account.confidential') }}</span>
                                </label>
                                <br/>                            
                            </td>
                            <td class="">
                                <?php 
                                    $clubParDis = json_decode($club->participation_disussions);
                                ?>                                
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_par_dis_public" value="0">
                                    <input type="checkbox" @if($clubParDis[0] == 1) checked @endif name="club_par_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_par_dis_private" value="0">
                                    <input type="checkbox" @if($clubParDis[1] == 1) checked @endif name="club_par_dis_private">
                                    <span>{{ __('account.private') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_par_dis_confidential" value="0">
                                    <input type="checkbox" @if($clubParDis[2] == 1) checked @endif name="club_par_dis_confidential">
                                    <span>{{ __('account.confidential') }}</span>
                                </label>
                                <br/>                            
                            </td>
                        </tr>
                        <tr>
                            <?php 
                                $accessCreateDis = json_decode($access->creating_disussion);
                            ?>
                            <td class="tx-center">{{ __('account.creatingDisussion') }}</td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_create_dis_public" value="0">
                                    <input type="checkbox" @if($accessCreateDis[0] == 1) checked @endif name="access_create_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="access_create_dis_private">
                                            @foreach ($disussions as $disussion)
                                                <option @if($accessCreateDis[1] == $disussion) selected @endif value="{{ $disussion }}"> 
                                                    {{ $disussion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.private') }}
                                    </label>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="access_create_dis_confidential">
                                            @foreach ($disussions as $disussion)
                                                <option @if($accessCreateDis[2] == $disussion) selected @endif value="{{ $disussion }}"> 
                                                    {{ $disussion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.confidential') }}
                                    </label>
                                </div>                            
                            </td>
                            <?php 
                                $premiumCreateDis = json_decode($premium->creating_disussion);
                            ?>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_create_dis_public" value="0">
                                    <input type="checkbox" @if($premiumCreateDis[0] == 1) checked @endif name="premium_create_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="premium_create_dis_private">
                                            @foreach ($disussions as $disussion)
                                                <option @if($premiumCreateDis[1] == $disussion) selected @endif value="{{ $disussion }}"> 
                                                    {{ $disussion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.private') }}
                                    </label>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="premium_create_dis_confidential">
                                            @foreach ($disussions as $disussion)
                                                <option @if($premiumCreateDis[2] == $disussion) selected @endif value="{{ $disussion }}"> 
                                                    {{ $disussion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.confidential') }}
                                    </label>
                                </div>                            
                            </td>
                            <?php 
                                $clubCreateDis = json_decode($club->creating_disussion);
                            ?>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_create_dis_public" value="0">
                                    <input type="checkbox" @if($clubCreateDis[0] == 1) checked @endif name="club_create_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="club_create_dis_private">
                                            @foreach ($disussions as $disussion)
                                                <option @if($clubCreateDis[1] == $disussion) selected @endif value="{{ $disussion }}"> 
                                                    {{ $disussion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.private') }}
                                    </label>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="club_create_dis_confidential">
                                            @foreach ($disussions as $disussion)
                                                <option @if($clubCreateDis[2] == $disussion) selected @endif value="{{ $disussion }}"> 
                                                    {{ $disussion }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.confidential') }}
                                    </label>
                                </div>                            
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.publicity') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_publicity" value="0">
                                    <input type="checkbox" @if($access->publicity == 1) checked @endif name="access_publicity">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_publicity" value="0">
                                    <input type="checkbox" @if($premium->publicity == 1) checked @endif name="premium_publicity">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_publicity" value="0">
                                    <input type="checkbox" @if($club->publicity == 1) checked @endif name="club_publicity">
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.associationApplications') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="access_association_applications" value="0">
                                    <input type="checkbox" @if($access->association_applications == 1) checked @endif name="access_association_applications">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="premium_association_applications" value="0">
                                    <input type="checkbox" @if($premium->association_applications == 1) checked @endif name="premium_association_applications">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="hidden" name="club_association_applications" value="0">
                                    <input type="checkbox" @if($club->association_applications == 1) checked @endif name="club_association_applications">
                                    <span></span>
                                </label>
                            </td>
                        </tr>                                                                                            
                    </tbody>
                </table>     
                <input type="hidden" name="access_id" value="{{ $access->id }}" >
                <input type="hidden" name="premium_id" value="{{ $premium->id }}" >
                <input type="hidden" name="club_id" value="{{ $club->id }}" >
                <div class="row">
                    <div class="col-md-12 tx-center pd-t-50">
                        <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25">{{ __('Update') }}</button>
                    </div>
                </div>                
            </form>        
        </div>        
    </div><!-- br-section-wrapper -->

@endsection

@section('script')
    <script>
              
   </script>        
@endsection    