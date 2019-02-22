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
                <span class="breadcrumb-item active">Book create</span>
            </nav>
        </div>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="post" action="{{route('books.store')}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    <div id="errorMsg">{{$error}}</div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control select2 type" name="type" data-placeholder="Choose type" tabindex="-1" aria-hidden="true">
                            <option label="Choose type"></option>
                            <option value="POST" selected>Post</option>
                            <option value="DOCUMENT">Document</option>
                            <option value="VIDEO">Video</option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control select2" name="catID" data-placeholder="Choose category" tabindex="-1" aria-hidden="true" onchange="getChildCat(this)">
                            <option label="Choose category"></option>
                            @foreach($category_list as $item)
                                <option value="{{ $item['_id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group catIDSub1">
                    </div><!-- form-group -->
                    <div class="form-group catIDSub2">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Title: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="title" value="" placeholder="Enter title" onblur="aliasCovert(this)" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Alias:</label>
                        <input class="form-control" type="text" name="alias" value="" placeholder="Enter alias" id="alias">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Author:</label>
                        <input class="form-control" type="text" name="author" value="" placeholder="Enter author">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Price:</label>
                        <input class="form-control" type="text" name="price" value="" placeholder="Enter price">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Short Description:</label>
                        <textarea rows="2" class="form-control" placeholder="Enter short description" name="shortDescription"></textarea>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Description:</label>
                        <div id="summernote"></div>
                    </div><!-- form-group -->
                    <div class="form-group youtube">
                        <label>Youtube URL:</label>
                        <input class="form-control" type="text" name="youtube" value="" placeholder="Enter youtube URL" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Image:</label>
                        <div class="row">
                            <div class="form-group">
                                <input type="file" class="form-control" id="image" name="logo">
                                <img id="blah" src="#" alt="your image" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="ckbox">
                            <input type="checkbox" name="share">
                            <span>Shared</span>
                        </label>
                    </div>
                    <div class="form-group">
                        <label class="ckbox">
                            <input type="checkbox" name="status">
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
        $('#blah').hide();

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
            $('#blah').show();
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
                    let html = '<select class="form-control select2" name="catID" data-placeholder="Choose category" onchange="getChildCat_2(this)">';
                        html += '<option label="Choose sub category"></option>';
                    if(data['data'].length > 0){
                        data['data'].map(function (item) {
                            html += '<option value="' + item._id + '">' + item.name + '</option>';
                        })
                            html += '</select>';
                        $('.catIDSub1').show();
                        $('.catIDSub1').html(html);
                    }else{
                        $('.catIDSub1').hide();
                        $('.catIDSub2').hide();
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
                    let html = '<select class="form-control select2 catIDSub2" name="catID" data-placeholder="Choose category"';
                        html += '<option label="Choose sub category"></option>';
                    if(data['data'].length > 0){
                        data['data'].map(function (item) {
                            html += '<option value="' + item._id + '">' + item.name + '</option>';
                        })
                        html += '</select';
                        $('.catIDSub2').show();
                        $('.catIDSub2').html(html);
                    }else{
                        $('.catIDSub2').hide();
                    }
                }else{
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