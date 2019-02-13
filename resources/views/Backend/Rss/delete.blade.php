<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">{{ __('rss.deleteRss') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{ Form::model($rss, ['route'=>['rss.destroy', $rss->_id], 'class' => 'form-horizontal submit-form', 'method' => 'delete', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <p>{{ __('message.msg_question_delete') }}</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="submit" id="save" class="btn btn-primary">Save</button>
</div>
{{ Form::close() }}

<script type="text/javascript">
    submit_from_data();
</script>