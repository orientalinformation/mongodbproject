@extends('Backend.layout.master')
@section('title')
    {{ __('category.title') }}
@endsection
@section('content-title')
    {{ __('category.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('categories.index')}}">Category</a>
                <span class="breadcrumb-item active">Category create</span>
            </nav>
        </div>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="post" action="{{route('libraries.store')}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Name: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="name" placeholder="Enter name" onblur="aliasCovert(this)" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Alias:</label>
                        <input class="form-control" type="text" name="alias" value="" placeholder="Enter alias" id="alias">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="ckbox">
                            <input type="checkbox" name="share">
                            <span>Shared</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-info" formmethod="post">Save</button>
                    <button type="cancel" class="btn btn-light active" onclick="window.location= '{{route('categories.index')}}'">Canel</button>
                </form>
            </div>
        </div>
    </div><!-- row -->

@endsection

@section('script')
    <script type="text/javascript">
        function aliasCovert(tag) {
            let aliasTxt = $(tag).val();
            aliasTxt = aliasTxt.replace(/^[ ]+|[ ]+$/g,'')
            $('#alias').val(aliasTxt.replace(/\s/g, "-"));
        }
    </script>
@endsection