@extends('Backend.layout.master')

@section('content-title')
    {{ __('dashboard.book') }}
@endsection

@section('content')
    <div class="row row-sm" style="margin-bottom: 10px;">
        <form method="get" action="{{ route('search.index') }}" id="search">
            <div class="input-group">
                <input class="form-control" style="width: 454px;" placeholder="Please input value search" type="text" name="q" id="q" value="{{$q}}">
                <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div>
        </form>
    </div>
    <div class="row row-sm">
        <table class="table table-bordered table-colored table-dark">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['hits']['hits'] as $item)
            <tr>
                <td>{{ $item['_source']['title'] }}</td>
                <td>{{ $item['_source']['description']  }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div><!-- row -->

    @include('Backend.partials.pagination')

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('#q').keypress(function(e){
                if(e.which == 13){//Enter key pressed
                    $('search').submit();
                }
            });
        });
    </script>
@endsection