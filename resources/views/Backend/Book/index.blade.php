@extends('Backend.layout.master')
@section('title')
    {{ __('dashboard.book') }}
@endsection
@section('content-title')
    {{ __('dashboard.book') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="barAdd">
            <button class="btn btn-light btnAdd"><i class="fa fa-stack-overflow"></i> Add Book</button>
        </div>

        <table class="table table-bordered table-colored table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($result['data'] as $item)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $item['title'] }}</td>
                    <td></td>
                    <td>
                        <a href="#" class="btn btn-primary btn-icon">
                            <div><i class="fa fa-pencil"></i></div>
                        </a>
                        <a href="#" class="btn btn-danger btn-icon">
                            <div><i class="fa fa-trash"></i></div>
                        </a>
                    </td>
                </tr>
                    <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        @include('Backend.pagination.default', ['paginator' => $result])
    </div><!-- row -->

@endsection