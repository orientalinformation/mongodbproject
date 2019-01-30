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
                            $customizing = ['1', '2', '3', '4', '5'];  
                            $disussions = ['1', '2', '3', '4', '5'];
                        ?>
                        <tr>
                            <td class="tx-center">{{ __('account.accessDocuments') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_access_documents">
                                    @foreach ($percents as $percent)
                                        <option value="{{ $percent }}"> {{ $percent }}%</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_access_documents">
                                    @foreach ($percents as $percent)
                                        <option value="{{ $percent }}"> {{ $percent }}%</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_access_documents">
                                    @foreach ($percents as $percent)
                                        <option value="{{ $percent }}"> {{ $percent }}%</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.customizableCuration') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_customizable_curation">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_customizable_curation">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_customizable_curation">
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.numberRSS') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_number_rss">
                                    @foreach ($rss as $value)
                                        <option value="{{ $value }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_number_rss">
                                    @foreach ($rss as $value)
                                        <option value="{{ $value }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_number_rss">
                                    @foreach ($rss as $value)
                                        <option value="{{ $value }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.customizingEnvironment') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_customizing_environment">
                                    @foreach ($customizing as $value)
                                        <option value="{{ $value }}"> {{ $value }} canvas</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_customizing_environment">
                                    @foreach ($customizing as $value)
                                        <option value="{{ $value }}"> {{ $value }} canvas</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_customizing_environment">
                                    @foreach ($customizing as $value)
                                        <option value="{{ $value }}"> {{ $value }} canvas</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.numberLibraries') }}</td>
                            <td class="tx-center">
                                <select class="form-control" name="access_number_libraries">
                                    @foreach ($libraries as $value)
                                        <option value="{{ $value }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="premium_number_libraries">
                                    @foreach ($libraries as $value)
                                        <option value="{{ $value }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="tx-center">
                                <select class="form-control" name="club_number_libraries">
                                    @foreach ($libraries as $value)
                                        <option value="{{ $value }}"> {{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.followDiscussionGroups') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_follow_discussion_groups">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_follow_discussion_groups">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_follow_discussion_groups">
                                    <span></span>
                                </label>
                            </td>
                        </tr> 
                        <tr>
                            <td class="tx-center">{{ __('account.participationDisussions') }}</td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_par_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_par_dis_private">
                                    <span>{{ __('account.private') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_par_dis_confidential">
                                    <span>{{ __('account.confidential') }}</span>
                                </label>
                                <br/>
                            </td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_par_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_par_dis_private">
                                    <span>{{ __('account.private') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_par_dis_confidential">
                                    <span>{{ __('account.confidential') }}</span>
                                </label>
                                <br/>                            
                            </td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_par_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_par_dis_private">
                                    <span>{{ __('account.private') }}</span>
                                </label>
                                <br/>
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_par_dis_confidential">
                                    <span>{{ __('account.confidential') }}</span>
                                </label>
                                <br/>                            
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.creatingDisussion') }}</td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_create_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="access_create_dis_private">
                                            @foreach ($disussions as $disussion)
                                                <option value="{{ $disussion }}"> {{ $disussion }}</option>
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
                                                <option value="{{ $disussion }}"> {{ $disussion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.confidential') }}
                                    </label>
                                </div>                            
                            </td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_create_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="premium_create_dis_private">
                                            @foreach ($disussions as $disussion)
                                                <option value="{{ $disussion }}"> {{ $disussion }}</option>
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
                                                <option value="{{ $disussion }}"> {{ $disussion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-4 form-control-label"  style="line-height: 30px" >
                                        {{ __('account.confidential') }}
                                    </label>
                                </div>                            
                            </td>
                            <td class="">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_create_dis_public">
                                    <span>{{ __('account.public') }}</span>
                                </label>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select class="form-control" name="club_create_dis_private">
                                            @foreach ($disussions as $disussion)
                                                <option value="{{ $disussion }}"> {{ $disussion }}</option>
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
                                                <option value="{{ $disussion }}"> {{ $disussion }}</option>
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
                                    <input type="checkbox" name="access_publicity">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_publicity">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_publicity">
                                    <span></span>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="tx-center">{{ __('account.associationApplications') }}</td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="access_association_applications">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="premium_association_applications">
                                    <span></span>
                                </label>
                            </td>
                            <td class="tx-center">
                                <label class="ckbox ckbox-inline">
                                    <input type="checkbox" name="club_association_applications">
                                    <span></span>
                                </label>
                            </td>
                        </tr>                                                                                            
                    </tbody>
                </table>     

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