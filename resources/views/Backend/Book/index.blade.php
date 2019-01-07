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
                        <form method="POST" action="{{route('categories.update',$item['_id'])}}" class="delete-form" data-parsley-validate>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div><button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i></button></div>
                        </form>
                        <form method="POST" action="{{route('categories.destroy',$item['_id'])}}" class="delete-form" data-parsley-validate>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div><button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button></div>
                        </form>
                    </td>
                </tr>
                    <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        @include('Backend.pagination.default', ['paginator' => $result])
    </div><!-- row -->

@endsection