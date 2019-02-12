<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('rss.editRss') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ Form::model($rss, ['route'=>['rss.update', $rss->_id], 'class' => 'form-horizontal submit-form', 'method' => 'patch', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="form-group row">
        <label for="rss" class="col-md-2 col-sm-2 col-form-label">{{ __('rss.rss') }}</label>
        <div class="col-md-10 col-sm-10">
            {{ Form::text('rss', null, array_merge(['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'rss'], [])) }}
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
    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('common.btnCancel') }}</button>
    <button type="submit" id="save" class="btn btn-primary">{{ __('common.btnSave') }}</button>
</div>
{{ Form::close() }}

<script type="text/javascript">
    submit_from_data();

    $(function () {
        $('#save').click(function (e) {
            $('.error').text('');

            var rss = $('#rss').val();

            if (rss.trim() == "") {
                $('.rss').text('{{ __('rss.msg_rssRequired') }}');
                return false;
            } else {
                var rssReg = new RegExp('^(https?:\\/\\/)?([\\da-z\\.-]+)\\.([a-z\\.]{2,6})([\\/\\w \\.-]*)*\\/?(\\.rss)$');

                if (!rssReg.test(rss)) {
                    $('.rss').text('{{ __('rss.msg_rssInvalid') }} (ex: https://test.net/test.rss)');
                    return false;
                }
            }
            return true;
        });
    });
</script>