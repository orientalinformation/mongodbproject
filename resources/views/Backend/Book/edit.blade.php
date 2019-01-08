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
                <form method="post" action="{{Request::url() . '?id=' . $book['_id']}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control select2 select2-hidden-accessible type" name="type" data-placeholder="Choose type" tabindex="-1" aria-hidden="true">
                            <option label="Choose type"></option>
                            <option value="POST" selected>Post</option>
                            <option value="DOCUMENT">Document</option>
                            <option value="VIDEO">Video</option>
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
                        <input class="form-control" type="text" name="title" value="{{$book['title']}}" placeholder="Enter title" required>
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
                        <div id="summernote">{{$book['description']}}</div>
                    </div><!-- form-group -->
                    <div class="form-group youtube">
                        <label>Youtube URL:</label>
                        <input class="form-control" type="text" name="youtube" value="" placeholder="Enter youtube URL">
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
                    <button type="cancel" class="btn btn-light active" onclick="window.location= '{{route('books.index')}}'">Canel</button>
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
            $('#blah').show();
        });
    });

</script>
@endsection