<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('rss.editRss') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ Form::model($rss, ['route'=>['rss.update', $rss->_id], 'class' => 'form-horizontal submit-form', 'method' => 'patch', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="form-group row">
        <label for="url" class="col-md-2 col-sm-2 col-form-label">{{ __('rss.linkRss') }}</label>
        <div class="col-md-10 col-sm-10">
            {{ Form::text('url', null, array_merge(['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'url'], [])) }}
            <span class="error url"></span>
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

            var link = $('#url').val();

            if (link.trim() == "") {
                $('.url').text('{{ __('message.msg_rssRequired') }}');
                return false;
            }
            else {
                var rssReg = new RegExp('(https?:\\/\\/(?:www\\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\\.[^\\s]{2,}|www\\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\\.[^\\s]{2,}|https?:\\/\\/(?:www\\.|(?!www))[a-zA-Z0-9]+\\.[^\\s]{2,}|www\\.[a-zA-Z0-9]+\\.[^\\s]{2,})');

                if (!rssReg.test(link)) {
                    $('.url').text('{{ __('message.msg_rssInvalid') }}');
                    return false;
                }
            }
            return true;
        });
    });
</script>