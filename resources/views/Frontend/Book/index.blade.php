@extends('Frontend.layout.master')

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')
    <!-- Header -->
    @include('Frontend.layout.header-contain')
    <div class="container-fluid container-library">
        <div class="main library">
            <div class="container-fluid">
                <div class="col-lg-3 col-sm-3">
                    <div id="input_container">
                        <input type="text" id="input" value="">
                        <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
                        <button id="btnSearch">Recherche avancée</button>

                    </div>

                </div>
                <div class="col-lg-9 col-sm-9">
                    <ul class="horizontal-menu-library">
                        <li> <a href="#">Toutes</a></li>
                        <li> <a href="#">Web</a></li>
                        <li class="active"> <a href="#">Étude/Synthese</a></li>
                        <li> <a href="#">Produit</a></li>
                        <li> <a href="#">Preporting/Evenement</a></li>
                        <li> <a href="#">Librairie Compagnons</a></li>
                    </ul>
                </div>
            </div>
            <div class="container-fluid">
                <div class="col-lg-3 col-sm-3">
                    <!-- Left menu -->
                    @include('Frontend.layout.leftmenu')
                </div>
                <div class="col-lg-9 col-sm-9">
                    <div class="head-menu"><span><strong>Étude/Synthese</strong></span>(1124)</div>
                    <div class="container-fluid group-box">
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_1.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/library-thumb-1.png" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_3.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_4.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid group-box">
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_1.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/library-thumb-1.png" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_3.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_4.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid group-box">
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_1.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/library-thumb-1.png" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_3.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_4.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid group-box">
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_1.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/library-thumb-1.png" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_2.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_3.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <img src="image/Bibliotheque_Web_4.jpg" class="library-thumb">
                            <div class="menu-tooltips"></div>
                            <div class="thumb-title">
                                <span class="title"><strong>Title</strong></span>
                                <img src="image/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                DFM-Engineering
                            </div>
                            <div class="">
                                2M vues . ily a 5 ans
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection