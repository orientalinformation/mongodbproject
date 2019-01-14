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
                <form method="POST" action="{{Request::url() . '?id=' . $category['_id']}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <input type="hidden" name="id" value="{{ $category['_id'] }}">
                    <div class="form-group">
                        <label>Parent</label>
                        <select class="form-control select2 select2-hidden-accessible type" name="parentID" data-placeholder="Choose category" tabindex="-1" aria-hidden="true">
                            <option label="Choose category"></option>
                            @foreach($category_list as $item)
                                <option value="{{ $item['_id'] }}">{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Name: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="{{ $category['name'] }}" placeholder="Enter name" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="2" class="form-control" placeholder="Enter description" name="description">{{ $category['description'] }}</textarea>
                    </div><!-- form-group -->
                    <button type="submit" class="btn btn-info" formmethod="post">Save</button>
                    <button type="button" class="btn btn-light active" onclick="window.location= '{{route('categories.index')}}'">Canel</button>
                </form>
            </div>
        </div>
    </div><!-- row -->

@endsection