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
                    <input type="checkbox" name="itemList" class="itemList" attr-data="{{ $item['_id'] }}" data-type="{{ $type }}"><label>{{ $item['title'] }}</label>
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

<?php
    $userId = 0;
    if (!empty(Auth::user())){
        $userId = Auth::user()->id;
    }
?>
<script>
    function aliasCovert(tag) {
        let aliasTxt = $(tag).val();
        aliasTxt = aliasTxt.replace(/^[ ]+|[ ]+$/g,'')
        $('#libraryAlias').val(aliasTxt.replace(/\s/g, "-"));
    }
</script>
<div class="modal fade" id="libraryCreate" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create list</h4>
            </div>
            <div class="modal-body">
                <form id="data" method="post" enctype="multipart/form-data">
                    <div class="alert alert-success alert-success-library"></div>
                    <div class="alert alert-danger alert-danger-library"></div>
                    <div class="form-group">
                        <label>Title (*):</label>
                        <input class="form-control" type="text" name="title" id="libraryTitle" value="" placeholder="Enter title" onblur="aliasCovert(this)" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Alias (*):</label>
                        <input class="form-control" type="text" name="alias" id="libraryAlias" value="" placeholder="Enter alias" required>
                    </div><!-- form-group -->
                    <?php $category_list = EnvatoCategory::getAllOrderByPath(); ?>
                    <div class="form-group">
                        <label>Category (*):</label>
                        <select class="form-control select2" id="catId" name="category_id" data-placeholder="Choose category" tabindex="-1" aria-hidden="true" required>
                            <option label="Choose category"></option>
                            @foreach($category_list as $item)
                                <option value="{{ $item['id'] }}" data-path="{{ $item['path'] }}">
                                    <?php
                                    $path = explode("/",$item['path']);
                                    $path_html = "";
                                    foreach($path as $path_item){
                                        echo '<i style="color: #a5a5a5;font-weight: bold;margin-right: 5px; font-style: normal;">|—</i>';
                                    }
                                    echo $item['name'];
                                    ?>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price:</label>
                        <input class="form-control" type="text" name="price" id="libraryPrice" value="" placeholder="Enter price">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea rows="2" class="form-control" name="description" id="libraryDescription"></textarea>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Image:</label>
                        <div class="container-fluid">
                            <input type="file" class="form-control" id="libraryImage" name="image">
                            <img id="libraryThumb" src="#" alt="your image" />
                            <style>
                                #libraryThumb {
                                    max-width: 80%;
                                    margin-top: 10px;
                                }
                            </style>
                        </div>
                    </div>
                    <input type="hidden" value="{{ $userId }}" id="userId" name="user_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btnCreateLibrary">Create</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

@section('script-tooltip')
<script>
    $(document).ready(function(){
        //hide image thumb
        $('#libraryThumb').hide();
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#libraryThumb').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#libraryImage").change(function () {
            readURL(this);
            $('#libraryThumb').show();
        });
        $('.btnCreateLibrary').click(function () {
            let userId = $('#userId').val();
            let title = $('#libraryTitle').val();
            let alias = $('#libraryAlias').val();
            let image = $('#libraryImage').val();
            let catId = $('#catId').val();
            let error = "";

            if(title == ""){
                error = "title not valid";
            }else if(alias == ""){
                error = "alias not valid";
            }else if(catId == ""){
                error = "category not valid";
            }

            if(error != ""){
                $('.alert-danger-library').show();
                $('.alert-danger-library').text(error);
            }else {
                // Get form
                var form = $('#data')[0];

                // Create an FormData object
                var data = new FormData(form);

                $.ajax({
                    enctype: 'multipart/form-data',
                    url: "<?= URL::to('/'); ?>/ajax/createLibrary",
                    type: 'POST',
                    cache: false,
                    // data: {user_id: userId, title: title, alias: alias, image: image, category_id: catId},
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (result) {
                        if (result['status'] == 1) {
                            $('.alert-success-library').show();
                            $('.alert-success-library').text("create success");
                            $(".modal .close").click();
                            $(".modal .close").click()
                        } else {
                            $('.alert-danger-library').show();
                            $('.alert-danger-library').text(result['data']);
                        }
                    }
                });
            }
        })
        $("#btnSearch").click(function () {
            let value = $('.normanSearch').val();
            $('#rechercher').val(value);
        })
    })
</script>
@endsection