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
                            {{ __('partner.create') }}
                        @else 
                            {{ __('partner.update') }}
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
                action="@if($dataType == 'edit'){{ route('partners.update', $partner->id) }}@else{{ route('partners.store') }}@endif"> 

                <!-- PUT Method if we are editing -->
                @if ($dataType == 'edit')
                    {{ method_field("PUT") }}
                @endif
                {{ csrf_field() }}
                <div class="row">
                    <label class="col-sm-4 form-control-label">
                        {{ __('partner.name') }} : <span class="tx-danger">*</span>
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="text" 
                            class="form-control" 
                            name="name" 
                            value="@if(isset($partner)) {{ $partner->name }}@endif"
                            required>
                    </div>
                </div><!-- row -->

                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('partner.address') }} : <span class="tx-danger">*</span>
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="text" 
                            class="form-control" 
                            name="address" 
                            value="@if(isset($partner)) {{ $partner->address }}@endif"
                            required>
                    </div>
                </div><!-- row -->  
                
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">
                        {{ __('partner.webPage') }} : <span class="tx-danger">*</span>
                    </label>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <input type="text" 
                            class="form-control" 
                            name="web" 
                            value="@if(isset($partner)) {{ $partner->web }}@endif"
                            required>
                    </div>
                </div><!-- row -->                

                <div class="row mg-t-30">
                    <div class="col-sm-8 mg-l-auto">
                        <div class="form-layout-footer">
                                <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25">
                                    @if ($dataType == 'add') 
                                        {{ __('partner.btnCreate') }}
                                    @else 
                                        {{ __('partner.btnUpdate') }}
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