@extends('Frontend.layout.master')

@section('styles')
    <link href="{{ asset('/assets/lib/bootstrap/bootstrap.css') }}" rel="stylesheet">

    <script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('/assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/frontend/web-animations.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/frontend/hammer.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/frontend/muuri.min.js') }}"></script>
    <script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script>
@stop

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')
<div class="container-fluid container-home">
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
    <div class="main home">
        <div class="row">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-9">
                <div class="headTitle-home-1">Tableau de bord</div>
                <div class="headTitle-home-2">Tableau de bord</div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <ul class="profile-menu-left menu-home">
                    <li><a href="">BIBLIOTHEQUE</a></li>
                    <li><a href="">Social <span>NETWORK</span></a></li>
                    <li><a href="">Annuaire</a></li>
                </ul>
            </div>
            <div class="col-lg-9">
                <div class="grid grid-1">
                    <div class="item piece_2">
                        <div class="item-content" style="background: url(/image/front/piece_1.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Bibliothéque -</strong> Title</p>
                    </div>
                    <div class="item piece_4">
                        <div class="item-content" style="background: url(/image/front/piece_2.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Web -</strong> Title</p>
                    </div>
                    <div class="item piece_1">
                        <div class="item-content" style="background: url(/image/front/piece_3.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Bibliothéque -</strong> Title</p>
                    </div>
                    <div class="item piece_2">
                        <div class="item-content" style="background: url(/image/front/piece_4.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Forum -</strong> Title</p>
                    </div>
                    <div class="item piece_3">
                        <div class="item-content" style="background: url(/image/front/piece_5.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Envenement -</strong> Title</p>
                    </div>
                    <div class="item piece_4">
                        <div class="item-content" style="background: url(/image/front/piece_6.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Veille -</strong> Title</p>
                    </div>
                    <div class="item piece_1">
                        <div class="item-content" style="background: url(/image/front/piece_7.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Bibliothéque -</strong> Title</p>
                    </div>
                    <div class="item piece_3">
                        <div class="item-content" style="background: url(/image/front/piece_8.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Produit -</strong> Title</p>
                    </div>
                    <div class="item piece_2">
                        <div class="item-content" style="background: url(/image/front/piece_9.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Forum -</strong> Title</p>
                    </div>
                    <div class="item piece_2">
                        <div class="item-content" style="background: url(/image/front/piece_10.png) no-repeat; background-size: cover;"></div>
                        <div class="point-more">...</div>
                        <p class="title"><strong>Web -</strong> Title</p>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
		var grid1 = new Muuri('.grid-1', {
		    dragEnabled: true,
		    dragContainer: document.body,
		    dragSort: function () {
		        return [grid1]
		    }
		});
    </script>
@endsection