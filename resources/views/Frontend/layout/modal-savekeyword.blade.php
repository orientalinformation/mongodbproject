<div class="modal fade bd-save-keyword-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@lang('common.saveSearch')</h4>
            </div>
            <div class="modal-body">
                <form name="frmSaveKeyword" action="{{ route('frontResearchSave') }}">
                    <div class="form-group rechercher">
                        <div class="input-group">
                            <input type="text" name="research_name" class="form-control">
                            <span class="input-group-btn">
                                <button id="btn-save-keyword" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-ok" aria-hidden="true">
                                </span> @lang('common.btnSave')!</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>