@php $type = ''; @endphp
@if ($controller == 'ProductController')
  @php $type = 'product'; @endphp
@elseif($controller == 'BookController')
  @php $type = 'book'; @endphp
@endif
<div class="modal fade" id="libraryList" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Library list</h4>
            </div>
            <div class="modal-body" id="body-libraryList">
                @foreach($library as $item)
                <div class="input-group listWrap">
                    <input type="checkbox" name="itemList" class="itemList" attr-data="{{ $item['_id'] }}" data-type="{{ $type }}"><label>{{ $item['name'] }}</label>
                </div>
                @endforeach
                <input type="hidden" id="bookID-modal">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="libraryCreate" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create list</h4>
            </div>
            <div class="modal-body">
                <label>Name:</label>
                <!-- <div class="alert alert-success alertCreatelist"></div> -->
                <input type="text" class="form-control" placeholder="Name" id="nameLibrary">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btnCreateLibrary">Create</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>