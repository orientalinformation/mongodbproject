@extends('Backend.layout.master')
@section('title')
    {{ __('library.title') }}
@endsection
@section('content-title')
    {{ __('library.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('libraries.index')}}">Library</a>
                <span class="breadcrumb-item active">Library create</span>
            </nav>
        </div>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="POST" action="{{Request::url() . '?id=' . $library['_id']}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" name="id" value="{{ $library['_id'] }}">
                    <div class="form-group">
                        <label>Name: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="{{ $library['name'] }}" placeholder="Enter name" onblur="aliasCovert(this)" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Alias:</label>
                        <input class="form-control" type="text" name="alias" value="{{$library['alias']}}" placeholder="Enter alias" id="alias">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="ckbox">
                            <?php
                            $checkShare = "";
                            if($library['share'] == 1){
                                $checkShare = 'checked';
                            }
                            ?>
                            <input type="checkbox" name="share" {{$checkShare}}>
                            <span>Shared</span>
                        </label>
                    </div>
                    <input type="hidden" name="view" value="{{ $library['view'] }}">
                    <button type="submit" class="btn btn-info" formmethod="post">Save</button>
                    <button type="button" class="btn btn-light active" onclick="window.location= '{{route('libraries.index')}}'">Canel</button>
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