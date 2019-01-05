@extends('Backend.layout.master')
@section('title')
    {{ __('book.title') }}
@endsection
@section('content-title')
    {{ __('book.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('books.index')}}">Book</a>
            <span class="breadcrumb-item active">Book list</span>
        </nav>

        <div class="barAdd">
            <a href="{{route('books.create')}}"><button class="btn btn-info btnAdd"><i class="fa fa-stack-overflow"></i> Add Book</button></a>
        </div>

        <table class="table table-bordered table-colored table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
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
                    <td>{{ $item['price'] }}</td>
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