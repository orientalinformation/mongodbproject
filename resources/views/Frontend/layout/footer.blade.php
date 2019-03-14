<script src="{{ asset('/assets/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/lib/slider/slider.js') }}"></script>

<!-- Plugins -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>