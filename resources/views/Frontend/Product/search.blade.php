@extends('Frontend.layout.master')

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')

@include('Frontend.layout.header')
<div class="container-fluid container-library">
    <div class="main library">
        <div class="container-fluid">
            <div class="col-lg-3 col-sm-3">
                <div id="input_container">
                	<form method="Get" action="{{ route('frontProductSearch') }}">
	                    <input type="text" name="keyword" id="input" value="{{ app('request')->input('keyword') }}">
	                    <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
	                    <button id="btnSearch">Recherche avancée</button>
					</form>
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
                        <img src="/image/front/video-checked.png" class="library-video-icon">
                        <img src="/image/front/video-remove.png" class="library-video-icon">
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
            <div class="col-lg-9 col-sm-9">
                <div class="head-menu"><span><strong>@lang('product.title')</strong></span>({{ $products['total'] }})</div>
                @if (!empty($productItems))
                @foreach($productItems as $key => $productItem)
                <div class="container-fluid group-box">
                    @foreach ($productItem as $key => $product)
                    <div class="col-lg-2 col-sm-2">
                        <img src="{{ $product['_source']['image'] }}" class="library-thumb">
                        <div class="menu-tooltips"></div>
                        <div class="thumb-title">
                            <span class="title"><strong>{{ $product['_source']['title'] }}</strong></span>
                            <img src="/image/front/cdd-icon.png" class="cdd-icon">
                        </div>
                        <div class="">
                            {!! str_limit($product['_source']['description'], $limit = 30, $end = '...') !!}
                        </div>
                        <div class="">
                            {{ $product['_source']['view'] }} @lang('product.views') . ily a 5 ans
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                @else 
                <div class="alert alert-warning">@lang('common.noResult')</div>
                @endif
            </div>
        </div>
    </div>
</div>