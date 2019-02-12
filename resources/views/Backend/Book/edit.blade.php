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
                <span class="breadcrumb-item active">Book edit</span>
            </nav>
        </div>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="post" enctype="multipart/form-data" action="{{Request::url() . '?id=' . $book['_id']}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    <div id="errorMsg">{{$error}}</div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control select2 type" name="type" data-placeholder="Choose type" tabindex="-1" aria-hidden="true">
                            <option label="Choose type"></option>
                            <option value="POST" {{ ($book['type']=='POST')?'selected':'' }}>Post</option>
                            <option value="DOCUMENT" {{ ($book['type']=='DOCUMENT')?'selected':'' }}>Document</option>
                            <option value="VIDEO" {{ ($book['type']=='VIDEO')?'selected':'' }}>Video</option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control select2 type" name="catID" data-placeholder="Choose category" tabindex="-1" aria-hidden="true" onchange="getChildCat(this)">
                            <option label="Choose category"></option>
                            @foreach($category_list as $item)
                                <option value="{{ $item['_id'] }}" {{ ($item['_id']==$book['catID'])?'selected':'' }}>{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <select class="form-control select2 type catIDSub1" name="catID" data-placeholder="Choose category" tabindex="-1" aria-hidden="true" onchange="getChildCat_2(this)" disabled>
                            <option label="Choose sub category"></option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <select class="form-control select2 type catIDSub2" name="catID" data-placeholder="Choose category" tabindex="-1" aria-hidden="true" disabled>
                            <option label="Choose sub category"></option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Title: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="title" value="{{$book['title']}}" placeholder="Enter title" onblur="aliasCovert(this)" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Alias:</label>
                        <input class="form-control" type="text" name="alias" value="{{$book['alias']}}" placeholder="Enter alias" id="alias">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Author:</label>
                        <input class="form-control" type="text" name="author" value="{{$book['author']}}" placeholder="Enter author">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Price:</label>
                        <input class="form-control" type="text" name="price" value="{{$book['price']}}" placeholder="Enter price">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Short Description:</label>
                        <textarea rows="2" class="form-control" placeholder="Enter short description" name="shortDescription">{{$book['shortDescription']}}</textarea>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea rows="2" class="form-control" id="summernote" name="description">{{$book['description']}}</textarea>
                    </div><!-- form-group -->
                    <div class="form-group youtube">
                        <label>Youtube URL: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="youtube" value="" placeholder="Enter youtube URL">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>File:</label>
                        <?php
                            $filePath = URL::to('/') . '/upload/book/file/' . $book['file'];
                            if (EnvatoUlities::is_url_exist($filePath)) {
                                echo '<a href="' . $filePath . '"><i class="fa fa-download"></i></a>';
                            }
                        ?>
                        <div class="row">
                            <div class="form-group">
                                <input type="file" class="form-control" id="file" name="file" data-file="{{$book['file']}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Image:</label>
                        <div class="row">
                            <div class="form-group">
                                <?php
                                    $imagePath = URL::to('/') . '/upload/book/' . $book['image'];
                                    if (!@getimagesize($imagePath)) {
                                        $imagePath = "https://via.placeholder.com/140x100";
                                    }
                                ?>
                                <input type="file" class="form-control" id="image" name="image">
                                <img id="blah" src="{{$imagePath}}" alt="book thumb" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="ckbox">
                            <?php
                            $checkShare = "";
                            if($book['share'] == 1){
                                $checkShare = 'checked';
                            }
                            ?>
                            <input type="checkbox" name="share" {{$checkShare}}>
                            <span>Shared</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="ckbox">
                            <?php
                                $checkBook = "";
                                if($book['status'] == 1){
                                    $checkBook = 'checked';
                                }
                            ?>
                            <input type="checkbox" name="status" {{$checkBook}}>
                            <span>Published</span>
                        </label>
                    </div>
                    <input type="hidden" id="submitType" name="submitType">
                    <button type="submit" class="btn btn-info">Save</button>
                    <button type="button" class="btn btn-warning" id="btnDraft">Draft</button>
                    <button type="button" class="btn btn-light active" onclick="window.location= '{{route('books.index')}}'">Canel</button>
                </form>
            </div>
        </div>
    </div><!-- row -->

@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        // Summernote editor
        $('#summernote').summernote({
            height: 150,
            tooltip: false
        })

        //hide image thumb

        // hide youtube URL input
        $('.youtube').hide();
        $('.catIDSub1').hide();
        $('.catIDSub2').hide();
        // event change of type selector
        $(document).ready(function(){
            $('.type').change(function(){
                let type = $(this).val();
                if(type == 'VIDEO'){
                    $('.youtube').show();
                    $('.youtube input').attr("required", "required");
                }else{
                    $('.youtube').hide();
                    $('.youtube input').removeAttr("required");
                }
            });
        });

        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });
    });

    function aliasCovert(tag) {
        let aliasTxt = $(tag).val();
        aliasTxt = aliasTxt.replace(/^[ ]+|[ ]+$/g,'')
        $('#alias').val(aliasTxt.replace(/\s/g, "-"));
    }

    function getChildCat(tag) {
        let catID = $(tag).val();
        $.ajax({
            url:"<?= URL::to('/'); ?>/admin/books/getChildCat",
            type: 'POST',
            cache: false,
            data: {catID: catID},
            success: function (result) {
                let data = JSON.parse(result);
                if(data['status']==1){
                    $('.catIDSub1').removeAttr('disabled');
                    let html = '<option label="Choose sub category"></option>';
                    data['data'].map(function (item) {
                        html += '<option value="' + item._id + '">' + item.name + '</option>';
                    })
                    if(data['data'].length > 0){
                        $('.catIDSub1').show();
                        $('.catIDSub1').html(html);
                    }
                }else{
                    $('.catIDSub1').hide();
                    $('.catIDSub2').hide();
                }
            }

        });
    }

    function getChildCat_2(tag) {
        let catID = $(tag).val();
        $.ajax({
            url:"<?= URL::to('/'); ?>/admin/books/getChildCat",
            type: 'POST',
            cache: false,
            data: {catID: catID},
            success: function (result) {
                let data = JSON.parse(result);
                if(data['status']==1){
                    $('.catIDSub2').removeAttr('disabled');
                    let html = '<option label="Choose sub category"></option>';
                    data['data'].map(function (item) {
                        html += '<option value="' + item._id + '">' + item.name + '</option>';
                    })
                    if(data['data'].length > 0){
                        $('.catIDSub2').show();
                        $('.catIDSub2').html(html);
                    }
                }else{
                    $('.catIDSub1').hide();
                    $('.catIDSub2').hide();
                }
            }

        });
    }

    $('#btnDraft').click(function () {
        $('#submitType').val('DRAFT');
        $('form#book-form').submit();
    })
</script>
@endsection