@extends('Backend.layout.master')
@section('title')
    {{ __('library.title') }}
@endsection
@section('content-title')
    {{ __('library.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('libraries.index')}}">{{ __('library.home') }}</a>
                <span class="breadcrumb-item">{{ __('library.database management') }}</span>
                <span class="breadcrumb-item active">{{ __('library.personal library') }}</span>
            </nav>
        </div>

        <div class="barAdd">
            <a href="{{route('libraries.create')}}"><button class="btn btn-info btnAdd"><i class="fa fa-stack-overflow"></i> Add Library</button></a>
        </div>

        <table class="table table-bordered table-colored table-dark">
            <thead class="thead-colored thead-primary">
            <tr>
                <th>ID</th>
                <th>{{ __('library.title_menu') }}</th>
                <th>{{ __('library.author') }}</th>
                <th>{{ __('library.date') }}</th>
                <th>{{ __('library.number of views') }}</th>
                <th>Share</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($result['data'] as $item)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $item['name'] }}</td>
                    <td></td>
                    <td>{{ $item['created_at'] }}</td>
                    <td>{{ $item['view'] }}</td>
                    <td><span onclick="share('{{$item['_id']}}', this)" data-share="{{$item['share']}}">
                        <?php
                            if($item['share']==1){
                                echo '<i class="icon ion-share active"></i>';
                            }else{
                                echo '<i class="icon ion-share"></i>';
                            }
                            ?></span>
                    </td>
                    <td>
                        <div>
                            <a href="libraries/update?id={{ $item['_id'] }}"><button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
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
            window.location = 'libraries/delete?id=' + id;
        });

        function share(libraryID, tag){
            let share = $(tag).attr('data-share');
            $.ajax({
                url: "libraries/updateShare",
                cache: false,
                type: "POST",
                data: {libraryID: libraryID, share: share},
                success: function(result){
                    if(result==1){
                        console.log(result);
                        $(tag).attr('data-share',0)
                        $(tag).html('<i class="icon ion-share"></i>');
                    }else{
                        console.log(result);
                        $(tag).attr('data-share',1)
                        $(tag).html('<i class="icon ion-share active"></i>');
                    }
                }
            });
        }
    </script>
@endsection