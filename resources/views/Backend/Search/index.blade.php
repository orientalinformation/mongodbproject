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

    <div class="dataTables_paginate paging_simple_numbers" id="datatable1_paginate">
        <?php
        $flag = false;
        $limitPage = 6;
        $leftLimitPage =3;
        $rightLimitPage = $paginate['pageNum'] - 2;
        if ($paginate['page'] >= $leftLimitPage && $paginate['page'] <= $limitPage) {
            $leftLimitPage = $paginate['page'] + 1;
        }
        if (($paginate['pageNum'] - $paginate['page']) <= $limitPage) {
            $rightLimitPage = $paginate['page'] - 1;
        } elseif (($paginate['pageNum'] - $paginate['page']) > $limitPage && $paginate['page'] > $limitPage) {
            $flag = true;
        }
        ?>

        @if (!is_null($paginate['prev']))
        <a href="{{ $paginate['prev'] }}" class="paginate_button previous" aria-controls="datatable1" data-dt-idx="0" tabindex="0" id="datatable1_previous">Previous</a>
        @endif
        <span>

            @for( $i = 1; $i <= $leftLimitPage; $i++)
                <a href="{{ ($paginate['page']) == $i ? '#' : ($paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . $i) }}" class="paginate_button " > {{ $i }}</a>
            @endfor
            @if($flag)
                ...
                    <a href="{{ $paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . ($paginate['page'] - 1) }}" class="paginate_button " > {{ $paginate['page'] - 1 }}</a>
                    <a href="#" class="paginate_button " > {{ $paginate['page']}}</a>
                    <a href="{{ $paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . ($paginate['page'] + 1) }}" class="paginate_button " > {{ $paginate['page'] + 1 }}</a>
                @endif
                ...
            @for( $i = $rightLimitPage; $i <= $paginate['pageNum']; $i++)
                    <a href="{{ ($paginate['page']) == $i ? '#' : ($paginate['url'] . ($q ? '?q=' . $q : '') . (is_null($q) ? '?page=' : '&page=') . $i) }}" class="paginate_button " > {{ $i }}</a>
            @endfor
        </span>
            @if(!is_null($paginate['next']))
                <a href="{{ $paginate['next'] }}" class="paginate_button next" aria-controls="datatable1" data-dt-idx="7" tabindex="0" id="datatable1_next">Next</a>
            @endif
    </div>

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