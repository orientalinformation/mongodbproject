@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        @include('Backend.partials.alerts')
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="icon ion-person-stalker" aria-hidden="true"></i>
                    <span class="menu-item-label">
                        @if ($dataType == 'add') 
                            {{ __('user.create') }}
                        @else 
                            {{ __('user.update') }}
                        @endif
                    </span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
            </div>
        </div>
        <div class="form-layout form-layout-5">
        <!-- form start -->
            <form role="form" class="form-edit-add" method="POST" enctype="multipart/form-data" 
                action="@if($dataType == 'edit'){{ route('users.update', 1) }}@else{{ route('users.store') }}@endif"> 

                <!-- PUT Method if we are editing -->
                @if ($dataType == 'edit')
                    {{ method_field("PUT") }}
                @endif
                {{ csrf_field() }}

                <div class="row">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.username') }} : <span class="tx-danger">*</span>
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="text" 
                            class="form-control" 
                            name="username" 
                            value="@if(isset($user)) {{ $user->username }}@endif"
                            @if($dataType == 'edit') disabled @else required @endif>
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.password') }} : <span class="tx-danger">*</span> 
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="password" 
                            class="form-control" 
                            name="password"
                            value="" 
                            @if($dataType == 'add') required @endif>
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.role') }} : <span class="tx-danger">*</span> 
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <select class="form-control select2-show-search" name="role_id" required>
                            @foreach($roles as $role)
                                <option  @if(isset($user) && $user->role_id == $role->id) selected @endif value="{{ $role->id }}">
                                    {{ $role->display_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.fullname') }} : <span class="tx-danger">*</span> 
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="text" 
                            class="form-control" 
                            name="fullname"
                            value="@if(isset($user)) {{ $user->fullname }}@endif" 
                            required>
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.email') }} : <span class="tx-danger">*</span> 
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="email" 
                            class="form-control" 
                            name="email" 
                            value="@if(isset($user)) {{ $user->email }}@endif"
                            required>
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.phone') }} :
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="text" 
                            class="form-control" 
                            name="phone"
                            value="@if(isset($user)) {{ $user->email }}@endif">
                    </div>
                </div><!-- row -->        
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('user.avatar') }} :
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="file" class="form-control" name="avatar">
                    </div>
                </div><!-- row -->                                         
                <div class="row mg-t-30">
                    <div class="col-sm-8 mg-l-auto">
                        <div class="form-layout-footer">
                                <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25">
                                    @if ($dataType == 'add') 
                                        {{ __('user.btnCreate') }}
                                    @else 
                                        {{ __('user.btnUpdate') }}
                                    @endif
                                </button>
                            </div><!-- form-layout-footer -->
                    </div><!-- col-8 -->
                </div>
            </form>    
        </div>
    </div><!-- br-section-wrapper -->

@endsection

@section('script')
    <script>

   </script>        
@endsection    