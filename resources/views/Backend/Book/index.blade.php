@extends('Backend.layout.master')
@section('title')
    {{ __('book.title') }}
@endsection
@section('content-title')
    {{ __('book.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('books.index')}}">Book</a>
                <span class="breadcrumb-item active">Book list</span>
            </nav>

            <div class="barAdd">
                <a href="{{route('books.create')}}"><button class="btn btn-info btnAdd"><i class="fa fa-stack-overflow"></i> Add Book</button></a>
            </div>
        </div>

        <table class="table table-bordered table-colored table-dark bookTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @if(sizeof($result['data']) > 0)
                    @foreach($result['data'] as $item)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['author'] }}</td>
                        <td>
                            <?php
                                $imagePath = URL::to('/') . '/upload/book/' . $item['image'];
                                if (@getimagesize($imagePath)) {
                                    echo '<img src="' . $imagePath . '" class="bookThumb">';
                                }else{
                                    echo '<img src="https://via.placeholder.com/140x100">';
                                }
                            ?>
                        </td>
                        <td>{{ $item['price'] }}</td>
                        <td>{{ $item['type'] }}</td>
                        <td><span onclick="status('{{ $item['_id'] }}', this)" data-status="{{$item['status']}}">
                            <?php
                                if($item['status'] == 1){
                                    echo '<i class="fa fa-eye"></i>';
                                }else{
                                    echo '<i class="fa fa-eye-slash"></i>';
                                }
                            ?>
                            </span>
                        </td>
                        <td>{{ date("d/m/Y", strtotime($item['created_at'])) }}</td>
                        <td>
                            <div>
                                <a href="books/update?id={{ $item['_id'] }}"><button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a>
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete" onclick="jQuery('#hid_Id').val('<?= $item['_id'] ?>');"><i class="fa fa-trash"></i></button>
                                <?php
                                    if(EnvatoBook::checkPinExist($item['_id'],1,'BOOK') == 1){
                                        $btnPin = 'btn-light disabled';
                                    }else{
                                        $btnPin = 'btn-warning';
                                    }
                                ?>
                                <button type="submit" class="btn {{$btnPin}}" onclick="pin('{{ $item['_id'] }}',1, this);"><i class="icon ion-pin"></i></button>
                                <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-{{$i}}"><i class="icon ion-clipboard"></i></button>

                                <!-- LARGE MODAL -->
                                <div id="modal-{{$i}}" class="modal fade">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content tx-size-sm">
                                            <div class="modal-header pd-x-20">
                                                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{ $item['title'] }}</h6>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body pd-20">
                                                {{ $item['description'] }}
                                            </div><!-- modal-body -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div><!-- modal-dialog -->
                                </div><!-- modal -->

                            </div>
                        </td>
                    </tr>
                        <?php $i++ ?>
                    @endforeach
                @endif
            </tbody>
        </table>
        @include('Backend.partials.paginate', ['paginator' => $result])
    </div><!-- row -->

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Delete Book</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this book?</p>
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
            window.location = 'books/delete?id=' + id;
        });

        function pin(itemID, userID, tag){
            $.ajax({
                url: "pins/create",
                cache: false,
                type: "POST",
                data: {itemID: itemID, userID: userID, type: 'BOOK'},
                success: function(result){
                    if(result==1){
                        $(tag).attr('class','btn btn-warning');
                    }else{
                        $(tag).attr('class','btn btn-light disabled');
                    }
                }
            });
        }

        function status(bookID, tag){
            let status = $(tag).attr('data-status');
//            alert(status);
            $.ajax({
                url: "books/updateStatus",
                cache: false,
                type: "POST",
                data: {bookID: bookID, status: status},
                success: function(result){
                    if(result==1){
                        console.log(result);
                        $(tag).attr('data-status',0)
                        $(tag).html('<i class="fa fa-eye-slash"></i>');
                    }else{
                        console.log(result);
                        $(tag).attr('data-status',1)
                        $(tag).html('<i class="fa fa-eye"></i>');
                    }
                }
            });
        }

        var modalBody = $('.modal-body');
        modalBody.map(function(){
            let html = $(this).html();
                html = $('<textarea />').html(html).text();
            $(this).html(html);
        })
    </script>
@endsection