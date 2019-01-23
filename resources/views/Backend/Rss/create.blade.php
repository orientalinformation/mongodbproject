<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('rss.titleAdd') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ Form::open(['route'=>['rss.store'], 'class' => 'form-horizontal submit-form', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
        <div class="form-group row">
            <label for="name" class="col-md-2 col-sm-2 col-form-label">{{ __('common.name') }}</label>
            <div class="col-md-10 col-sm-10">
                {{ Form::text('name', null, array_merge(['class' => 'form-control', 'autocomplete' => 'off'], [])) }}
                <span class="error name"></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="rss" class="col-md-2 col-sm-2 col-form-label">{{ __('rss.rss') }}</label>
            <div class="col-md-10 col-sm-10">
                {{ Form::text('rss', null, array_merge(['class' => 'form-control', 'autocomplete' => 'off'], [])) }}
                <span class="error rss"></span>
            </div>
        </div>
    <div class="form-group row">
        <label for="description" class="col-md-2 col-sm-2 col-form-label">{{ __('common.description') }}</label>
        <div class="col-md-10 col-sm-10">
            {{ Form::textarea('description', null, array_merge(['class' => 'form-control', 'rows' => 7, 'autocomplete' => 'off'], [])) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
{{ Form::close() }}

<script type="text/javascript">
    submit_from_data();
</script>