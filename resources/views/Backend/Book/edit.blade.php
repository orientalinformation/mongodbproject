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
            <span class="breadcrumb-item active">Book edit</span>
        </nav>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="post" enctype="multipart/form-data" action="{{Request::url() . '?id=' . $book['_id']}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control select2 select2-hidden-accessible type" name="type" data-placeholder="Choose type" tabindex="-1" aria-hidden="true">
                            <option label="Choose type"></option>
                            <option value="POST" {{ ($book['type']=='POST')?'selected':'' }}>Post</option>
                            <option value="DOCUMENT" {{ ($book['type']=='DOCUMENT')?'selected':'' }}>Document</option>
                            <option value="VIDEO" {{ ($book['type']=='VIDEO')?'selected':'' }}>Video</option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control select2 select2-hidden-accessible type" name="catID" data-placeholder="Choose category" tabindex="-1" aria-hidden="true">
                            <option label="Choose category"></option>
                            @foreach($category_list as $item)
                                <option value="{{ $item['_id'] }}" {{ ($item['_id']==$book['catID'])?'selected':'' }}>{{ $item['name'] }}</option>
                            @endforeach
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
                        <label>Youtube URL:</label>
                        <input class="form-control" type="text" name="youtube" value="" placeholder="Enter youtube URL">
                    </div><!-- form-group -->
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
                                $check = "";
                                if($book['status'] == 1){
                                    $check = 'checked';
                                }
                            ?>
                            <input type="checkbox" name="status" {{$check}}>
                            <span>Publish</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-info">Save</button>
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
        // event change of type selector
        $(document).ready(function(){
            $('.type').change(function(){
                let type = $(this).val();
                if(type == 'VIDEO'){
                    $('.youtube').show();
                }else{
                    $('.youtube').hide();
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
</script>
@endsection