@extends('Backend.layout.master')

@section('content-title')

@endsection

@section('content')
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('List Roles') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
                <button class="btn btn-teal mg-b-20 pd-r-20" data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-plus mg-r-5"></i> {{ __('Add role') }}
                </button>
            </div>
        </div>
        <div class="table-responsive"> 
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-colored thead-primary">
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th class="tx-center">6</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="tx-right" scope="row">1</th>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td class="tx-18 tx-center">
                            6

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div><!-- br-section-wrapper -->
@endsection