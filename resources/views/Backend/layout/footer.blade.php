<script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('/assets//lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('/assets/lib/moment/moment.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery-switchbutton/jquery.switchButton.js') }}"></script>
<script src="{{ asset('/assets/lib/peity/jquery.peity.js') }}"></script>
<script src="{{ asset('/assets/lib/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('/assets/lib/medium-editor/medium-editor.js') }}"></script>
<script src="{{ asset('/js/plugins/bootstrap-alert.js') }}"></script>
<!-- Plugins -->

<script src="{{ asset('/js/alert-close.js') }}"></script>
<script src="{{ asset('/assets/js/bracket.js') }}"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>