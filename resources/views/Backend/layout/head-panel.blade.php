<!-- ########## START: HEAD PANEL ########## -->
<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">`
            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">
                        @if(isset(Auth::user()->fullname))
                             <strong>{{ Auth::user()->fullname }}</strong>
                        @endif
                    </span>
                    <?php
                        if (!empty(Auth::user()->avatar)) {
                            $imagePath = URL::to('/upload/avatar').'/'.Auth::user()->avatar;
                        } else {
                            $imagePath = "http://via.placeholder.com/64x64";
                        }
                    ?>
                    <img src="{{ $imagePath }}" class="wd-32 ht-32 rounded-circle" alt="">
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                    <ul class="list-unstyled user-profile-nav">
                        <li><a data-toggle="modal" data-target="#update_profile"><i class="icon ion-ios-person"></i> {{ __('head-panel.editProfile') }}</a></li>
                        <li><a href=""><i class="icon ion-ios-gear"></i> {{ __('head-panel.setting') }}</a></li>
                        <li><a href=""><i class="icon ion-ios-download"></i> {{ __('head-panel.download') }}</a></li>
                        <li><a href=""><i class="icon ion-ios-star"></i> {{ __('head-panel.favorite') }}</a></li>
                        <li><a href=""><i class="icon ion-ios-folder"></i> {{ __('head-panel.collection') }}</a></li>
                        <li><a href="{{ route('logout') }}"><i class="icon ion-power"></i> {{ __('head-panel.signOut') }}</a></li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
    </div><!-- br-header-right -->
</div><!-- br-header -->
<!-- ########## END: HEAD PANEL ########## -->

{{-- <!-- Update modal -->
<div id="update_profile" class="modal fade">
    <div class="modal-dialog modal-lg modal-dialog-vertical-center" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{ __('Update Profile') }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-25">
                <form id="form_update_profile" action="{{ route('users.updateProfile', Auth::id()) }}" method="POST">
                    {{ method_field("PUT") }}
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label tx-bold">
                                    {{ __('Fullname') }}
                                    <span class="tx-danger">*</span>
                                </label>
                                <input type="text" id="profile_fullname" class="form-control" name="fullname" value="{{ Auth::user()->fullname }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label tx-bold">{{ __('Birthday') }}</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                    <input type="text" name="birthday" class="form-control fc-datepicker" placeholder="YYYY/MM/DD" value="{{ date("Y/m/d", strtotime(Auth::user()->birthday)) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label tx-bold">{{ __('Gender') }}</label>
                                <select class="form-control" name="gender" >
                                    <option value="0" @if (Auth::user()->gender == 0) selected @endif>{{ __('Male') }}</option>
                                    <option value="1" @if (Auth::user()->gender == 1) selected @endif>{{ __('Female') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label tx-bold">{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label tx-bold">
                                    {{ __('Email') }}
                                    <span class="tx-danger">*</span>
                                </label>
                                <input type="text" id="profile_email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label tx-bold">{{ __('Address') }}</label>
                                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                            </div>
                        </div>
                    </div>
                </form>    
            </div>
            <div class="modal-footer">
                <button id="btn_sub_update_profile" type="button" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">
                    {{ __('Update') }}
                </button>
                <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">
                    {{ __('Close') }}
                </button>
            </div>
        </div>
    </div><!-- modal-dialog -->
</div><!-- END Update modal -->  

<!-- Error modal -->
<div id="profile_error_modal" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger tx-semibold mg-b-20" id="profile_error_text_modal"></h4>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- END Error modal --> --}}