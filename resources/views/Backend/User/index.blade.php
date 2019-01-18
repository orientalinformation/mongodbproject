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
                    <span class="menu-item-label">{{ __('List Users') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
                <button class="btn btn-teal mg-b-20 pd-r-20" data-toggle="modal" data-target="#create_role_modal">
                    <i class="fa fa-plus mg-r-5"></i> {{ __('Add user') }}
                </button>
            </div>
        </div>
        <div class="table-responsive"> 
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-colored thead-primary">
                    <tr>
                        <th>{{ __('No.') }}</th>
                        <th>{{ __('Fullname') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Birthday') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Gender') }}</th>
                        <th>{{ __('Created at') }}</th>
                        <th>{{ __('Updated at') }}</th>
                        <th class="tx-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = 0; ?>
                    @foreach($users as $user)
                        <tr>
                            <th class="tx-right" scope="row"> {{ $index += 1 }}</th>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->role->display_name }}</td>
                            <td>{{ date("Y/m/d", strtotime($user->birthday)) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td> 
                                @if($user->gender == 0)
                                    male
                                @else
                                    female   
                                @endif
                            </td>
                            <td>{{ date("Y/m/d", strtotime($user->created_at)) }}</td>
                            <td>{{ date("Y/m/d", strtotime($user->updated_at)) }}</td>
                            <td class="tx-18 tx-center">                       
                                <a href="javascript:void(0)" data-url="" class="btn btn-primary" id="btn_edit" title="{{ __('Edit') }}">
                                    <i class="fa fa-pencil"  aria-hidden="true"></i>
                                </a>
                                &nbsp;
                                <a href="javascript:void(0)" data-id="{{ $user->id }}" class="btn btn-danger delete"  id="btn-delete" title="{{ __('Delete') }}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="ht-80 d-flex align-items-center justify-content-center">
                {{ $users->links() }}
            </div>            
        </div>
    </div><!-- br-section-wrapper -->

@endsection

@section('script')
    <script src="{{ asset('/js/alert-close.js') }}"></script>
    <script>
              
   </script>        
@endsection    