@extends('Backend.layout.master')
@section('title')
    {{ __('product.title') }}
@endsection
@section('content-title')
    {{ __('product.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('products.index')}}">{{ __('product.home') }}</a>
                <span class="breadcrumb-item">{{ __('product.database management') }}</span>
                <span class="breadcrumb-item active">{{ __('product.title') }}</span>
            </nav>
        </div>

        <div class="barAdd">
            <a href="{{route('events.create')}}"><button class="btn btn-info btnAdd"><i class="fa fa-stack-overflow"></i> {{ __('event.create a event') }}</button></a>
        </div>

        <table class="table table-bordered table-colored table-dark">
            <thead class="thead-colored thead-primary">
            <tr>
                <th>{{ __('product.id') }}</th>
                <th>{{ __('product.title_menu') }}</th>
                <th>{{ __('product.company') }}</th>
                <th>{{ __('product.occupation') }}</th>
                <th>{{ __('product.uploaded date') }}</th>
                <th>{{ __('product.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($result['data'] as $item)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $item['name'] }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $item['created_at'] }}</td>
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
                    <h3>Delete Event</h3>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this event?</p>
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
            window.location = 'products/delete?id=' + id;
        });
    </script>
@endsection