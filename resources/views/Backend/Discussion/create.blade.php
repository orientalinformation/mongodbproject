@extends('Backend.layout.master')
@section('title')
    {{ __('discussion.title') }}
@endsection
@section('content-title')
    {{ __('discussion.title') }}
@endsection

@section('content')

    <div class="row row-sm">
        <div class="br-pageheader pd-y-15 pd-l-20" style="width: 100%;">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="{{route('discussions.index')}}">{{ __('discussion.home') }}</a>
                <span class="breadcrumb-item active">{{ __('discussion.create a document') }}</span>
            </nav>
        </div>
        <div class="main-form br-section-wrapper">
            <div class="form-layout form-layout-1">
                <form method="post" action="{{route('discussions.store')}}" id="book-form" data-parsley-validate>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>{{ __('discussion.title_menu') }}: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="title" placeholder="{{ __('discussion.enterTitle') }}" required>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>{{ __('discussion.type') }}</label>
                        <select class="form-control select2 type" name="type" data-placeholder="Choose type" tabindex="-1" aria-hidden="true">
                            <option label="Choose type"></option>
                            <option value="PUBLIC">Publique</option>
                            <option value="PRIVATE">Privée</option>
                            <option value="CONFIDENTIAL">Confidentielle</option>
                        </select>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Début</label>
                        <input id="start" class="form-control" name="start" placeholder="{{ __('discussion.enterStartDate') }}"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Fin</label>
                        <input id="end" class="form-control" name="end" placeholder="{{ __('discussion.enterEndDate') }}"/>
                    </div><!-- form-group -->
                    <button type="submit" class="btn btn-info" formmethod="post">Save</button>
                    <button type="cancel" class="btn btn-light active" onclick="window.location= '{{route('discussions.index')}}'">Canel</button>
                </form>
            </div>
        </div>
    </div><!-- row -->

@endsection

@section('script')
    <script>
        $('#start').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#end').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection