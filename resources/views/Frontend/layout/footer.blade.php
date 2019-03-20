<script src="{{ asset('/assets/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/lib/slider/slider.js') }}"></script>

<script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/assets/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('/assets/lib/frontend/web-animations.min.js') }}"></script>
<script src="{{ asset('/assets/lib/frontend/hammer.min.js') }}"></script>
<script src="{{ asset('/assets/lib/frontend/muuri.min.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/lib/slider/slider.js') }}"></script>
<script src="{{ asset('/assets/js/front-product.js') }}"></script>

<!-- Plugins -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Set version Bootstrap default with Bootstrap select
    $.fn.selectpicker.Constructor.BootstrapVersion = '3';
    $('.selectpicker').selectpicker();
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
</script>