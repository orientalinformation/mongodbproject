@extends('Backend.layout.master')

@section('title')
    {{ __('source.title') }}
@endsection

@section('content-title')
    {{ __('source.title') }}
@endsection

@section('content')
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="icon ion-ios-list-outline" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('rss.header') }}</span>
                </h1>
            </div>
            <div class="col-md-6 tx-right">
                <a class="btn btn-teal mg-b-20 pd-r-20" data-target="#form-popup" data-toggle="model" form-name="#add-rss" href="javascript:;">
                    <i class="fa fa-plus mg-r-5"></i>{{ __('rss.addRss') }}
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-colored thead-primary">
                    <tr>
                        <th>{{ __('common.name') }}</th>
                        <th>{{ __('rss.rss') }}</th>
                        <th>{{ __('common.description') }}</th>
                        <th>{{ __('rss.userName') }}</th>
                        <th class="tx-center">{{ __('common.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->rss }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->userName }}</td>
                        <td class="tx-center">
                            <a class="btn btn-primary" data-target="#form-popup" data-toggle="model" form-name="#edit-rss" data-url=""><i class="fa fa-pencil"></i></a>
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" onclick=""><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('[form-name="#add-rss"][data-target="#form-popup"]').click(function (e) {
                e.preventDefault();
                $('#form-popup .modal-content').load('{{ route('rss.create') }}', function (result) {
                    $('#form-popup').modal({show:true});
                });

            });
        });

    </script>
@endsection