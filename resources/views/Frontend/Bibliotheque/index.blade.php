@extends('Frontend.layout.master')

{{--@section('styles')--}}

    {{--<script src="{{ asset('/assets/lib/jquery/jquery-ui.min.js') }}"></script>--}}
    {{--<script src="{{ asset('/assets/lib/slider/slider.js') }}"></script>--}}
{{--@stop--}}

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')
<div class="container-fluid container-library">
    <div class="main library">
        <div class="container-fluid">
            <div class="col-lg-3">
                <div id="input_container">
                  <input type="text" id="input" value>
                  <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
                  <button id="btnSearch" data-toggle="modal" data-target=".bd-example-modal-lg">Recherche avancée</button>
                  <!-- <input type="button" value="Recherche avancée" id="btnSearch"> -->
              </div>
              <script type="text/javascript">
                  $(document).ready(function () {
                      $('#input').bind('blur', function () {
                          if($('#input').val()=='')
                              $('#input_img').show();
                      });

                      $('#input').bind('focus', function () {
                          $('#input_img').hide();
                      });
                  });
              </script>
            </div>
            <div class="col-lg-9">
                <ul class="horizontal-menu-library">
                  <li> <a href="#">Toutes</a></li>
                  <li> <a href="#">Web</a></li>
                  <li> <a href="#">Étude/Synthese</a></li>
                  <li> <a href="#">Produit</a></li>
                  <li> <a href="#">Preporting/Evenement</a></li>
                  <li class="active"> <a href="#">Librairie Compagnons</a></li>
              </ul>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-lg-3">
                <ul class="profile-menu-left menu-home menu-library">
                    <li class="accordion-toggle"><a href="#colMenu1" data-toggle="collapse"><i class="fa fa-desktop" aria-hidden="true"></i> Métier</a></li>
                    <div id="colMenu1" class="panel-collapse collapse in">
                        <ul class="sub-menu-library">
                            <li>Bois</li>
                        </ul>
                    </div>
                    <li><a class="accordion-toggle" href="#colMenu2" data-toggle="collapse">Thématique</a></li>
                    <div id="colMenu2" class="panel-collapse collapse in">
                        <ul class="sub-menu-library">
                            <li>Logiciel</li>
                            <li>Outil</li>
                            <li>Règlementaires et normes</li>
                            <li>Transition</li>
                            <li>Matériaux</li>
                            <li>Produit</li>
                        </ul>
                    </div>
                    <li><a class="accordion-toggle collapsed" href="#colMenu3" data-toggle="collapse">Année</a></li>
                    <div id="colMenu3" class="panel-collapse collapse">
                        <ul class="sub-menu-library">
                            <li>Logiciel</li>
                            <li>Outil</li>
                            <li>Règlementaires et normes</li>
                            <li>Transition</li>
                            <li>Matériaux</li>
                            <li>Produit</li>
                        </ul>
                    </div>
                    <li>
                        <img src="image/video-checked.png" class="library-video-icon">
                        <img src="image/video-remove.png" class="library-video-icon">
                    </li>
                    <li><a class="accordion-toggle" href="#colMenu4" data-toggle="collapse">Mes bibliothèques</a></li>
                    <div id="colMenu4" class="panel-collapse collapse in">
                        <ul class="sub-menu-library">
                            <li>À lire plus tard 
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Biblio 1
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Biblio 2
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Biblio 3
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Biblio 4
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                        </ul>
                        <div class="link-menu"><a href="#">voir plus</a></div>
                    </div>
                    <li><a class="accordion-toggle" href="#colMenu5" data-toggle="collapse">Bibliothèques publiques</a></li>
                    <div id="colMenu5" class="panel-collapse collapse in">
                        <ul class="sub-menu-library">
                            <li>Nom de la bibio par rene
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Nom de la bibio2 par @rene
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Nom de la bibio par Pierre badin
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Nom de la bibio par rene
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                            <li>Nom de la bibio par rene
                                <span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
                            </li>
                        </ul>
                        <div class="link-menu"><a href="#">voir plus</a></div>
                    </div>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="head-menu"><span>Librairie Compagnons</span> (314)</div>
              <div class="container group-box">
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-4.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-3.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-2.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-1.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
              </div>
              <div class="container group-box">
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-4.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-3.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-2.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-1.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
              </div>
              <div class="container group-box">
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-4.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-3.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-2.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-1.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
              </div>
              <div class="container group-box">
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-5.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-4.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-3.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-2.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                          <img src="image/cdd-icon.png" class="cdd-icon">
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
                  <div class="col-lg-2">
                      <div class="wrap">
                          <img src="image/library-thumb-1.png" class="library-thumb">
                          <div class="menu-tooltips"></div>
                      </div>
                      <div class="thumb-title">
                          <span class="title">Title</span>
                      </div>
                      <div class="thumb-author">
                          Tim Snyder
                      </div>
                      <div class="thumb-price">
                          28 €
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection