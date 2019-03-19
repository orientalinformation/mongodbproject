@extends('Frontend.layout.master')

@section('styles')
    <!-- <link href="{{ asset('/assets/lib/bootstrap/bootstrap.css') }}" rel="stylesheet">

    <script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/frontend/web-animations.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/frontend/hammer.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/frontend/muuri.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script> -->
@stop

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row slide">
        <div class="col-12"><img src="{{ URL::to('/image/front/slider.png')}}" class="img-slide"></div>
        <div class="col-12 cover"></div>
        <div class="col-12 title-slide">
            <span>La nouvelle plate-forme des <br/>Compagnons Du Devoir</span>
        </div>
        <div class="col-12 title-slide-small">
            <span>La nouvelle plate-forme des <br/>Compagnons Du Devoir</span>
        </div>
        <div class="col-12 title-slide-foot">
            <span>Votre espace d’échanges collaborative et <br/>professionnelle à votr</span>
        </div>
        <div class="col-12 search_button">
            <div class="box-icon-home"><img src="{{ URL::to('/image/front/home-search-icon.png')}}"></div>
        </div>
        <div class="col-12 edit_button">
            <div class="box-icon-home"><img src="{{ URL::to('/image/front/home-edit-icon.png')}}"></div>
        </div>
    </div>
</div>
<div class="container-fluid container-library">
    <div class="main library">
        <div class="container-fluid">
            <div class="container-fluid-head">
                <div class="row">
                    <div class="col-lg-2 col-sm-2">
                    </div>
                    <div class="col-lg-10 col-sm-10">
                        <span class="title-header-hide">Accueil</span>
                        <span class="title-header-show home">Accueil</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-sm-2">
                    <div class="bg_home_menu"><a href="#"><i class="fa fa-book" aria-hidden="true"></i> Mes Bibliotheques</a></div>
                    <div class="bg_home_menu"><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Mes Causeries</a></div>
                    <div class="bg_home_menu"><a href="#"><i class="fa fa-address-book-o" aria-hidden="true"></i> Mes Sauvegardes</a></div>
                </div>
                <div class="col-lg-10 col-sm-10">
                    <div class="container-fluid">
                        <div class="col-lg-12 col-sm-12 no-padding">
                            <form method="post" action="" >
                                <input type="text" name="discussion" class="form-control wd-250 inputAdSearch">
                                <button class="btnAdSearch">Recherche avancée</button>
                            </form>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="wrapSlider">
                                    <div class="divIcon">
                                        <span>Web</span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div id="homeCarousel1" class="homeCarousel carousel slide" data-ride="carousel" data-interval="false">
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner home-slider">
                                        <div class="item clearfix active">
                                            <div class="image">
                                                <img src="/image/front/9.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 1</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image">
                                                <img src="/image/front/10.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 2</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                      </div>

                                      <!-- Left and right controls -->
                                      <a class="right carousel-control" href="#homeCarousel1" data-slide="next">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="wrapSlider">
                                    <div class="divIcon">
                                        <span>Événement</span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div id="homeCarousel2" class="homeCarousel carousel slide" data-ride="carousel" data-interval="false">
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner home-slider">
                                        <div class="item clearfix active">
                                            <div class="image">
                                                <img src="/image/front/9.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 1</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image">
                                                <img src="/image/front/10.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 2</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                      </div>

                                      <!-- Left and right controls -->
                                      <a class="right carousel-control" href="#homeCarousel2" data-slide="next">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="wrapSlider">
                                    <div class="divIcon">
                                        <span>Étude</span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div id="homeCarousel3" class="homeCarousel carousel slide" data-ride="carousel" data-interval="false">
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner home-slider">
                                        <div class="item clearfix active">
                                            <div class="image">
                                                <img src="/image/front/9.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 1</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image">
                                                <img src="/image/front/10.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 2</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                      </div>

                                      <!-- Left and right controls -->
                                      <a class="right carousel-control" href="#homeCarousel3" data-slide="next">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="wrapSlider">
                                    <div class="divIcon">
                                        <span>Causerie</span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div id="homeCarousel4" class="homeCarousel carousel slide" data-ride="carousel" data-interval="false">
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner home-slider">
                                        <div class="item clearfix active">
                                            <div class="image">
                                                <img src="/image/front/9.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 1</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image">
                                                <img src="/image/front/10.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 2</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                      </div>

                                      <!-- Left and right controls -->
                                      <a class="right carousel-control" href="#homeCarousel4" data-slide="next">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="wrapSlider">
                                    <div class="divIcon">
                                        <span>Produit</span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div id="homeCarousel5" class="homeCarousel carousel slide" data-ride="carousel" data-interval="false">
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner home-slider">
                                        <div class="item clearfix active">
                                            <div class="image">
                                                <img src="/image/front/9.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 1</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image">
                                                <img src="/image/front/10.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 2</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                      </div>

                                      <!-- Left and right controls -->
                                      <a class="right carousel-control" href="#homeCarousel5" data-slide="next">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="wrapSlider">
                                    <div class="divIcon">
                                        <span>Bibliothèque</span>
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <div id="homeCarousel6" class="homeCarousel carousel slide" data-ride="carousel" data-interval="false">
                                      <!-- Wrapper for slides -->
                                      <div class="carousel-inner home-slider">
                                        <div class="item clearfix active">
                                            <div class="image">
                                                <img src="/image/front/9.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 1</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                        <div class="item clearfix">
                                            <div class="image">
                                                <img src="/image/front/10.jpg" alt="">
                                            </div>
                                            <div class="content">
                                                <p class="title">title 2</p>
                                                <p class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                            </div>
                                        </div>
                                      </div>

                                      <!-- Left and right controls -->
                                      <a class="right carousel-control" href="#homeCarousel6" data-slide="next">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                      </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="wrap-space">
                                    <span class="home-space">Mon Espace</span>
                                    <div class="bottom-line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="wrap-image-space">
                                    <img src="/image/front/9.jpg" class="image-space">
                                    <span class="dot-space">...</span>
                                </div>
                                <p class="title-space">Title 1 <span>(80)</span></p>
                                <span class="name-space">Jean-Michel Chauveau</span>
                                <span class="date-space">30/11/2018</span>
                            </div>
                            <div class="col-lg-2">
                                <div class="wrap-image-space">
                                    <img src="/image/front/9.jpg" class="image-space">
                                    <span class="dot-space">...</span>
                                </div>
                                <p class="title-space">Title 1 <span>(80)</span></p>
                                <span class="name-space">Jean-Michel Chauveau</span>
                                <span class="date-space">30/11/2018</span>
                            </div>
                            <div class="col-lg-2">
                                <div class="wrap-image-space">
                                    <img src="/image/front/9.jpg" class="image-space">
                                    <span class="dot-space">...</span>
                                </div>
                                <p class="title-space">Title 1 <span>(80)</span></p>
                                <span class="name-space">Jean-Michel Chauveau</span>
                                <span class="date-space">30/11/2018</span>
                            </div>
                            <div class="col-lg-2">
                                <div class="wrap-image-space">
                                    <img src="/image/front/9.jpg" class="image-space">
                                    <span class="dot-space">...</span>
                                </div>
                                <p class="title-space">Title 1 <span>(80)</span></p>
                                <span class="name-space">Jean-Michel Chauveau</span>
                                <span class="date-space">30/11/2018</span>
                            </div>
                            <div class="col-lg-2">
                                <div class="wrap-image-space">
                                    <img src="/image/front/9.jpg" class="image-space">
                                    <span class="dot-space">...</span>
                                </div>
                                <p class="title-space">Title 1 <span>(80)</span></p>
                                <span class="name-space">Jean-Michel Chauveau</span>
                                <span class="date-space">30/11/2018</span>
                            </div>
                            <div class="col-lg-2">
                                <div class="wrap-image-space">
                                    <img src="/image/front/9.jpg" class="image-space">
                                    <span class="dot-space">...</span>
                                </div>
                                <p class="title-space">Title 1 <span>(80)</span></p>
                                <span class="name-space">Jean-Michel Chauveau</span>
                                <span class="date-space">30/11/2018</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
