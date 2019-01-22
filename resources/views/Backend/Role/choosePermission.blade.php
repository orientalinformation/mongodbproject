@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        @include('Backend.partials.alerts')
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('Choose Permissions') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
            </div>
        </div>
        <form id="form_update" action="{{ route('roles.assignRole', $roleId) }}" method="POST">
            {{ method_field("POST") }}
            {{ csrf_field() }}
            <div class="row">
                @foreach($results as $perms)
                    <div class="col-md-3">
                        <label class="ckbox">
                            <input type="checkbox" name="permissions[]" {{ $perms['active'] }} value="{{ $perms['id'] }}" >
                            <span>{{ $perms['display_name'] }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12 tx-center pd-t-50">
                    <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25" id="btn_check_all" >{{ __('Check All') }}</button>
                    <button type="submit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25">{{ __('Update') }}</button>
                </div>
            </div>
        </form>
    </div><!-- br-section-wrapper -->

@endsection

@section('script')
    <script>
        $(document).on('click', '#btn_check_all', function() {
            $(this).parent().parent().parent().find('input:checkbox').attr('checked', true);
        });
   </script>        
@endsection    