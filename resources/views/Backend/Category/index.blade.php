@extends('Backend.layout.master')
@section('title')
    {{ __('category.title') }}
@endsection
@section('content-title')
    {{ __('category.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('categories.index')}}">{{ __('category.home') }}</a>
                <span class="breadcrumb-item active">{{ __('category.business management') }}</span>
            </nav>
        </div>

        <div class="barAdd">
            <a href="{{route('categories.create')}}"><button class="btn btn-info btnAdd"><i class="fa fa-stack-overflow"></i> {{ __('category.create a document') }}</button></a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('success') }} 
            </div><!-- alert -->
        @endif

        <table class="table table-bordered table-colored table-dark">
            <thead class="thead-colored thead-primary">
            <tr>
                <th>ID</th>
                <th>{{ __('category.job') }}</th>
                <th>{{ __('category.short description') }}</th>
                <th>{{ __('category.created') }}</th>
                <th>{{ __('category.modified') }}</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($result['data'] as $item)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>
                    <?php
                        $path = explode("/",$item['path']);
                        $path_html = "";
                        foreach($path as $path_item){
                            echo '<i style="color: #a5a5a5;font-weight: bold;margin-right: 5px; font-style: normal;">|—</i>';
                        }
                        echo $item['name'];
                    ?>
                    </td>
                    <td>{{ $item['description'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                    <td>{{ $item['updated_at'] }}</td>
                    <td>
                        <div>
                            <a href="categories/update?id={{ $item['_id'] }}"><button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" onclick="jQuery('#hid_Id').val('<?= $item['_id'] ?>');"><i class="fa fa-trash"></i></button>
                        </div>
                        {{--<form method="POST" action="{{route('categories.destroy',$item['_id'])}}" class="delete-form" data-parsley-validate>--}}
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        {{--</form>--}}
                    </td>
                </tr>
                <?php $i++ ?>
            @endforeach
            </tbody>
        </table>
        @include('Backend.partials.pagination', ['paginator' => $result])
    </div><!-- row -->

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Delete Category</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <input type="hidden" value="" id="hid_Id" />
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        jQuery(".btn-ok").click(function () {
            var id = jQuery("#hid_Id").val();
            if (id <= 0 || id == "") {
                return false;
            }
            window.location = 'categories/delete?id=' + id;
        });
    </script>
@endsection