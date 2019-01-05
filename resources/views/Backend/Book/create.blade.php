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
            <span class="breadcrumb-item active">Book create</span>
        </nav>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="post" action="" id="book-form" data-parsley-validate>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control select2 select2-hidden-accessible type" name="type" data-placeholder="Choose country" tabindex="-1" aria-hidden="true">
                            <option label="Choose type"></option>
                            <option value="POST" selected>Post</option>
                            <option value="DOCUMENT">Document</option>
                            <option value="VIDEO">Video</option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Title: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="title" value="" placeholder="Enter title" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea rows="2" class="form-control" placeholder="Enter short description" name="short_description"></textarea>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Description</label>
                        <div id="summernote"></div>
                    </div><!-- form-group -->
                    <div class="form-group youtube">
                        <label>Youtube URL:</label>
                        <input class="form-control" type="text" name="youtube" value="" placeholder="Enter youtube URL">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Image:</label>
                        <div class="row">
                            <div class="form-group">
                                <input type="file" class="form-control" id="logo" name="logo">
                                <img id="blah" src="#" alt="your image" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Save</button>
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

        $("#logo").change(function () {
            readURL(this);
            jQuery.ajax({
                url:"{{url('/')}}/books/create",

                data:new FormData($("#book-form")[0]),
                method:"POST",
                processData: false,
                contentType: false,
                success:function(data){
                    console.log(data);
                },
                error:function(error){
                    console.log(error);
                }
            });
        });
    });

</script>
@endsection