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
                    @include('Frontend.layout.leftmenu', ['category'])
                </div>
                <div class="col-lg-9 col-sm-9">
                    <div class="head-menu"><span><strong>Étude/Synthese</strong></span> (<?= sizeof($book); ?>)</div>
                    <?php $i = 1; $j = 1;?>
                    @foreach($book['data'] as $item)
                        <?php if($i == 1 || $i % 7 == 0): ?>
                            <div class="container-fluid group-box" <?= $i ?>>
                        <?php endif; ?>
                            <div class="col-lg-2 col-sm-2">
                                <div class="wrap">
                                    <img src="<?= URL::to('/upload/book/') . "/" . $item['image'] ?>" class="library-thumb">
                                    <div class="menu-tooltips"></div>
                                </div>
                                <div class="thumb-title">
                                    <span class="title"><strong>{{ $item['title'] }}</strong></span>
                                    <img src="{{ URL::to('/image/front/cdd-icon.png') }}" class="cdd-icon">
                                </div>
                                <div class="">
                                    {{ EnvatoUlities::limit(strip_tags($item['description']), 20) }}
                                </div>
                                <div class="">
                                    {{ EnvatoUlities::number_format_short($item['view']) }} vues . {{ EnvatoUlities::time_elapsed_string($item['created_at']) }}
                                </div>
                            </div>
                        <?php if($j == 6): ?>
                            </div>
                        <?php $j = 0; ?>
                        <?php endif; ?>
                        <?php $i++; $j++ ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection