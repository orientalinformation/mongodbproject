@extends('Backend.layout.master')

@section('title')
    {{ __('rss.header') }}
@endsection

@section('content-title')
    {{ __('rss.header') }}
@endsection

@section('content')
    <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('rss.index')}}">{{ __('common.home') }}</a>
            <span class="breadcrumb-item active">{{ __('rss.rssAdminTitle') }}</span>
        </nav>
    </div>
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
                    <i class="fa fa-plus mg-r-5"></i>{{ __('rss.btnCreateRss') }}
                </a>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong class="d-block d-sm-inline-block-force">{{ __('common.welldone') }}!</strong> {{ session('success') }}
            </div><!-- alert -->
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="thead-colored thead-primary">
                    <tr>
                        <th class="tx-center">{{ __('common.no') }}</th>
                        <th class="tx-center">{{ __('rss.linkRss') }}</th>
                        <th class="tx-center">{{ __('common.description') }}</th>
                        <th class="tx-center">{{ __('rss.userName') }}</th>
                        <th class="tx-center">{{ __('common.createDate') }}</th>
                        <th class="tx-center">{{ __('common.updateDate') }}</th>
                        <th class="tx-center">{{ __('common.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data['data'] as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item['rss'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['username'] }}</td>
                        <td>{{ $item['created_at'] }}</td>
                        <td>{{ $item['updated_at'] }}</td>
                        <td class="tx-center">
                            <a class="btn btn-primary" data-target="#form-popup" data-toggle="model" form-name="#edit-rss" data-url="{{ route('rss.edit', $item['_id']) }}" href="javascript:;"><i class="fa fa-pencil"></i></a>

                            <a class="btn btn-danger" data-target="#form-popup" data-toggle="model" form-name="#delete-rss" data-url="{{ route('rss.delete', $item['_id']) }}" href="javascript:;"><i class="fa fa-trash"></i></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="ht-80 d-flex align-items-center justify-content-center">
                @include('Backend.partials.pagination')
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('[form-name="#add-rss"][data-target="#form-popup"]').click(function (e) {
                e.preventDefault();
                $('#form-popup .modal-content').load('{{ route('rss.create') }}', function (result) {
                    $('#form-popup').modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                });
            });
            
            $('[form-name="#edit-rss"][data-target="#form-popup"]').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('data-url');
                $('#form-popup .modal-content').load(url, function (result) {
                    $('#form-popup').modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                });
            });

            $('[form-name="#delete-rss"][data-target="#form-popup"]').click(function (e) {
                e.preventDefault();
                var url = $(this).attr('data-url');
                $('#form-popup .modal-content').load(url, function (result) {
                    $('#form-popup').modal({
                        backdrop: 'static',
                        keyboard: true,
                        show: true
                    });
                });
            });

            setTimeout(function() {
                $(".alert").alert('close');
            }, 5000);
        });

    </script>
@endsection