
<footer>
    <div class="container-fluid background-footer-profile">
        <div class="col-lg-4 col-sm-4 col-left-footer">
            <div class="row text-center">
                <div class="col-md-4 col-logo-footer"><img src="{{ URL::to('/image/front/logo.png')}}" class="icon-logo-footer-profile"></div>
                <div class="col-md-4 col-txt-footer">
                    <div class="txt-footer-profile">
                        <img src="{{ URL::to('/image/front/logo_fse_profile.png')}}" class="logo-fse-profile">
                        <p>Ce site internet a étéc financé par le Fond Social Européen</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <iframe width="120" height="90" src="https://www.youtube.com/embed/okWP68GHC2Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-8 col-right-footer">
            <div class="row">
                <div class="col-lg-4 col-sm-4">
                    <p class="title-footer">Plate-Forme</p>
                    <p class="title-footer-contain">Accès à des informations premium Etudes, Synthèses, tests produits</p>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <p class="title-footer">Outil De Veille</p>
                    <p class="title-footer-contain">En un clic, soyez informé des nouvelles technologies, informations reglementaires...</p>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <p class="title-footer">Collaboratif</p>
                    <p class="title-footer-contain">Rejoindre, participer, animer des groupes d'échanges sur vos besoins</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid logo-footer">
        <div class="row">
            <div class="col-lg-3 col-sm-3 logo-item"><img src="{{ URL::to('/image/front/logo-metiers-foret-bois.png')}}"></div>
            <div class="col-lg-3 col-sm-3 logo-item"><img src="{{ URL::to('/image/front/fnb.jpeg')}}"></div>
            <div class="col-lg-3 col-sm-3 logo-item"><img src="{{ URL::to('/image/front/cniefeb.jpeg')}}"></div>
            <div class="col-lg-3 col-sm-3 logo-item"><img src="{{ URL::to('/image/front/ffb.png')}}"></div>
        </div>
    </div>
</footer>
{{-- <script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script> --}}

<script src="{{ asset('/assets/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/lib/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/lib/jquery/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/assets/lib/slider/slider.js') }}"></script>

<script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
<!-- <script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script> -->
<!-- <script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script> -->
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