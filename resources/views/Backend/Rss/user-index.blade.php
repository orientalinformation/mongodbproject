@extends('Backend.layout.master')

@section('title')
    {{ __('rss.userRssHeader') }}
@endsection

@section('content-title')
    {{ __('rss.userRssHeader') }}
@endsection

@section('content')
    <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('rss.user')}}">{{ __('common.home') }}</a>
            <span class="breadcrumb-item active">{{ __('rss.rssUserTitle') }}</span>
        </nav>
    </div>
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-md-6 tx-left">
                <h1 class="tx-gray-800 tx-bold mg-b-10">
                    <i class="icon ion-ios-list-outline" aria-hidden="true"></i>
                    <span class="menu-item-label">{{ __('rss.userRssHeader') }}</span>
                </h1>
            </div>

        </div>

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
