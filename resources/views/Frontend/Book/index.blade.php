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
                <div class="col-lg-3 col-sm-3">
                    <div id="input_container">
                        <input type="text" id="input" value="<?= app('request')->input('txtSearch'); ?>" class="normanSearch">
                        <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
                        <button id="btnSearch" data-toggle="modal" data-target=".bd-example-modal-lg">Recherche avancée</button>
                        {{--@section('script')--}}
                            {{--<script type="text/javascript">--}}
                                {{--$('input').bind("enterKey",function(e){--}}
                                    {{--let normanSearch = $('.normanSearch').val();--}}
                                    {{--window.location.href = "{{ URL::to('/') . '/book' }}" + "?txtSearch=" + normanSearch;--}}
                                {{--});--}}
                                {{--$('input').keyup(function(e){--}}
                                    {{--if(e.keyCode == 13)--}}
                                    {{--{--}}
                                        {{--$(this).trigger("enterKey");--}}
                                    {{--}--}}
                                {{--});--}}
                                {{--$(document).ready(function () {--}}
                                    {{--$('#input').bind('blur', function () {--}}
                                        {{--if($('#input').val()=='')--}}
                                            {{--$('#input_img').show();--}}
                                    {{--});--}}

                                    {{--$('#input').bind('focus', function () {--}}
                                        {{--$('#input_img').hide();--}}
                                    {{--});--}}
                                {{--});--}}

                                {{--$('.menu-tooltips').click(function(){--}}
                                    {{--let display = $(this).closest(".wrap").find(".content-panel");--}}
                                    {{--let bookID = $(this).closest(".wrap").find(".bookID").val();--}}
                                    {{--let heart = $(this).closest(".wrap").find(".likeIcon");--}}
                                    {{--if(display.css("display") == "none"){--}}
                                        {{--display.css("display","block");--}}
                                        {{--$.ajax({--}}
                                            {{--url: "{{ URL::to('/') }}/check_liked",--}}
                                            {{--cache: false,--}}
                                            {{--type: "GET",--}}
                                            {{--data: {user_id: 1, book_id: bookID},--}}
                                            {{--success: function(result){--}}
                                                {{--result = JSON.parse(result);--}}
                                                {{--if(result.status == 1){--}}
                                                    {{--heart.removeClass("fa-heart-o");--}}
                                                    {{--heart.addClass("fa-heart");--}}
                                                {{--}else{--}}
                                                    {{--heart.addClass("fa-heart-o");--}}
                                                    {{--heart.removeClass("fa-heart");--}}
                                                {{--}--}}
                                            {{--}--}}
                                        {{--});--}}
                                    {{--}else{--}}
                                        {{--display.css("display","none");--}}
                                    {{--}--}}
                                {{--})--}}
                                {{--$('.like-line').click(function(){--}}
                                    {{--let bookID = $(this).closest(".wrap").find(".bookID").val();--}}
                                    {{--let heart = $(this).closest(".wrap").find(".likeIcon");--}}
                                    {{--$.ajax({--}}
                                        {{--url: "{{ URL::to('/') }}/check_liked",--}}
                                        {{--cache: false,--}}
                                        {{--type: "GET",--}}
                                        {{--data: {user_id: 1, book_id: bookID, change: 1},--}}
                                        {{--success: function(result){--}}
                                            {{--result = JSON.parse(result);--}}
                                            {{--if(result.status == 1){--}}
                                                {{--heart.removeClass("fa-heart");--}}
                                                {{--heart.addClass("fa-heart-o");--}}
                                            {{--}else if(result.status == 2) {--}}
                                                {{--heart.removeClass("fa-heart-o");--}}
                                                {{--heart.addClass("fa-heart");--}}
                                            {{--}--}}
                                        {{--}--}}
                                    {{--});--}}
                                {{--})--}}
                            {{--</script>--}}
                        {{--@endsection--}}
                    </div>

                </div>
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="">
                                    <div class="form-group rechercher">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
	                                <span>
	                                    <input type="text" class="form-control input-1" id="rechercher" placeholder="Rechercher sur la plateforme" value="<?= app('request')->input('txtSearch'); ?>">
	                                </span>
                                                <span>
	                                    <input type="text" class="form-control input-2" id="autuer" placeholder="Auteur">
	                                </span>
                                            </div>
                                        </div>
                                        <div class="bibliotheque">
                                            BIBLIOTHEQUE
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <span class="text-label-rechercher">Métier</span>
                                                <div class="form-check">
                                                    <div class="col-lg-2 ">
                                                        <input type="checkbox" class="form-check-input" name="outitl" id="outitl" checked>
                                                        <label class="form-check-label label-non-bold" for="outitl">Outil</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="checkbox" class="form-check-input" id="fer">
                                                        <label class="form-check-label label-non-bold" for="fer">Fer</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <div class="form-check">
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="studes-synthese" id="studes-synthese" checked>
                                                        <label class="form-check-label label-non-bold" for="studes-synthese">Études/Synthese</label>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="produit" id="produit">
                                                        <label class="form-check-label label-non-bold" for="produit">Produit</label>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <input type="checkbox" class="form-check-input" name="reporting" id="reporting">
                                                        <label class="form-check-label label-non-bold" for="reporting">Reporting/Evenements</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <span class="text-label-rechercher">Thématique</span>
                                                <span class="text-sublabel-rechercher">Logiciel</span>
                                                <div class="form-check">
                                                    <div class="col-lg-2 col-sm-2 col-2-overwrite">
                                                        <input type="checkbox" class="form-check-input" name="cao" id="cao">
                                                        <label class="form-check-label label-non-bold" for="cao">CAO/DAO</label>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-2 col-1-overwrite">
                                                        <input type="checkbox" class="form-check-input" name="cfao" id="cfao">
                                                        <label class="form-check-label label-non-bold" for="cfao">CFAO</label>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-2 col-1-overwrite">
                                                        <input type="checkbox" class="form-check-input" name="fao" id="fao">
                                                        <label class="form-check-label label-non-bold" for="fao">FAO</label>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-2">
                                                        <input type="checkbox" class="form-check-input" name="erp" id="erp">
                                                        <label class="form-check-label label-non-bold" for="erp">ERP/CRN</label>
                                                    </div>

                                                    <div class="col-lg-2 col-sm-2 col-3-overwrite">
                                                        <input type="checkbox" class="form-check-input" name="calcul" id="calcul">
                                                        <label class="form-check-label label-non-bold" for="calcul">Calcul strocture</label>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-2 col-3-overwrite">
                                                        <input type="checkbox" class="form-check-input" name="colts" id="colts">
                                                        <label class="form-check-label label-non-bold" for="colts">Colts collaboraie</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <span class="text-sublabel-rechercher">Outil</span>
                                                <div class="form-check">
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="manuel" id="manuel">
                                                        <label class="form-check-label label-non-bold" for="manuel">Manuel</label>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="portatif" id="portatif">
                                                        <label class="form-check-label label-non-bold" for="portatif">Portatif/Stationnaire</label>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <input type="checkbox" class="form-check-input" name="robot" id="robot">
                                                        <label class="form-check-label label-non-bold" for="robot">CN/Robotdetaille/Robot</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <div class="form-check">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <input type="checkbox" class="form-check-input" name="reglementaies" id="reglementaies">
                                                        <label class="form-check-label label-non-bold" for="reglementaies">Règlementaires et normes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <span class="text-sublabel-rechercher">Evolution societale</span>
                                                <div class="form-check">
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="transition-numerique" id="transition-numerique">
                                                        <label class="form-check-label label-non-bold" for="transition-numerique">Transition numérique</label>
                                                    </div>
                                                    <div class="col-lg-9 col-sm-9">
                                                        <input type="checkbox" class="form-check-input" name="transition-environmentale" id="transition-environmentale">
                                                        <label class="form-check-label label-non-bold" for="transition-environmentale">Transition environmentale</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <span class="text-sublabel-rechercher">Materiaux</span>
                                                <div class="form-check">
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="bois" id="bois">
                                                        <label class="form-check-label label-non-bold" for="bois">Bois</label>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="derive" id="derive">
                                                        <label class="form-check-label label-non-bold" for="derive">Derivé</label>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <input type="checkbox" class="form-check-input" name="produit" id="produit">
                                                        <label class="form-check-label label-non-bold" for="produit">Produits</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-sm-12">
                                                <legend class="col-form-label recher-avancee-line"></legend>
                                                <span class="text-sublabel-rechercher">Produit</span>
                                                <div class="form-check">
                                                    <div class="col-lg-3 col-sm-3">
                                                        <input type="checkbox" class="form-check-input" name="quincallerie" id="quincallerie">
                                                        <label class="form-check-label label-non-bold" for="quincallerie">Quincallerie</label>
                                                    </div>
                                                    <div class="col-lg-9 col-sm-9">
                                                        <input type="checkbox" class="form-check-input" name="colletset" id="colletset">
                                                        <label class="form-check-label label-non-bold" for="colletset">Colletset fimition</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <button class="btn btn-oblong btn-primary btn-upload" type="submit"><i class="fa fa-search" aria-hidden="true"></i> RECHECHE</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>
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
                    <div class="head-menu"><span><strong>Étude/Synthese</strong></span> (<?= sizeof($book['data']); ?>)</div>
                    <?php if(sizeof($book['data']) > 0): ?>
                    <?php $i = 1; $j = 1;?>
                    @foreach($book['data'] as $item)
                        <?php if($i == 1 || $i % 7 == 0): ?>
                            <div class="container-fluid group-box" <?= $i ?>>
                        <?php endif; ?>
                            <div class="col-lg-2 col-sm-2">
                                <div class="wrap">
                                    <img src="<?= URL::to('/upload/book/') . "/" . $item['image'] ?>" class="library-thumb">
                                    <div class="menu-tooltips"></div>
                                    <div class="content-panel">
                                        <div class="content-line like-line"><i class="fa fa-heart-o likeIcon" aria-hidden="true"></i> <span>Liker</span></div>
                                        <div class="content-line read-line"><i class="fa fa-bookmark-o readIcon" aria-hidden="true"></i> <span>À lire plus tard</span></div>
                                        <div class="content-line" data-toggle="modal" data-target="#libraryList"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Ajouter dans une liste</span></div>
                                        <div class="content-line"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Créer une liste</span></div>
                                        <div class="content-line"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>Partager</span></div>
                                    </div>
                                    <input type="hidden" class="bookID" value="{{ $item['_id'] }}"/>
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
                    @include('Backend.partials.pagination', ['paginator' => $book])
                    <?php else: ?>
                    <div>not result</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="libraryList" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Library list</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group listWrap">
                        <input type="checkbox" name="itemList"><label>Item 1</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $('input').bind("enterKey",function(e){
            let normanSearch = $('.normanSearch').val();
            window.location.href = "{{ URL::to('/') . '/book' }}" + "?txtSearch=" + normanSearch;
        });
        $('input').keyup(function(e){
            if(e.keyCode == 13)
            {
                $(this).trigger("enterKey");
            }
        });
        $(document).ready(function () {
            $('#input').bind('blur', function () {
                if($('#input').val()=='')
                    $('#input_img').show();
            });

            $('#input').bind('focus', function () {
                $('#input_img').hide();
            });
        });

        $('.menu-tooltips').click(function(){
            let display = $(this).closest(".wrap").find(".content-panel");
            let bookID = $(this).closest(".wrap").find(".bookID").val();
            let heart = $(this).closest(".wrap").find(".likeIcon");
            let read = $(this).closest(".wrap").find(".readIcon");
            if(display.css("display") == "none"){
                display.css("display","block");
                $.ajax({
                    url: "{{ URL::to('/') }}/check_liked",
                    cache: false,
                    type: "GET",
                    data: {user_id: 1, book_id: bookID},
                    success: function(result){
                        result = JSON.parse(result);
                        if(result.status == 1){
                            heart.removeClass("fa-heart-o");
                            heart.addClass("fa-heart");
                        }else{
                            heart.addClass("fa-heart-o");
                            heart.removeClass("fa-heart");
                        }
                    }
                });
                $.ajax({
                    url: "{{ URL::to('/') }}/check_read",
                    cache: false,
                    type: "GET",
                    data: {user_id: 1, object_id: bookID},
                    success: function(result){
                        result = JSON.parse(result);
                        if(result.status == 1){
                            read.removeClass("fa-bookmark-o");
                            read.addClass("fa-bookmark");
                        }else{
                            read.addClass("fa-bookmark-o");
                            read.removeClass("fa-bookmark");
                        }
                    }
                });
            }else{
                display.css("display","none");
            }
        })
        $('.like-line').click(function(){
            let bookID = $(this).closest(".wrap").find(".bookID").val();
            let heart = $(this).closest(".wrap").find(".likeIcon");
            $.ajax({
                url: "{{ URL::to('/') }}/check_liked",
                cache: false,
                type: "GET",
                data: {user_id: 1, book_id: bookID, change: 1},
                success: function(result){
                    result = JSON.parse(result);
                    if(result.status == 1){
                        heart.removeClass("fa-heart");
                        heart.addClass("fa-heart-o");
                    }else if(result.status == 2) {
                        heart.removeClass("fa-heart-o");
                        heart.addClass("fa-heart");
                    }
                }
            });
        })
        $('.read-line').click(function(){
            let bookID = $(this).closest(".wrap").find(".bookID").val();
            let read = $(this).closest(".wrap").find(".readIcon");
            $.ajax({
                url: "{{ URL::to('/') }}/check_read",
                cache: false,
                type: "GET",
                data: {user_id: 1, object_id: bookID, change: 1},
                success: function(result){
                    result = JSON.parse(result);
                    if(result.status == 1){
                        read.removeClass("fa-bookmark");
                        read.addClass("fa-bookmark-o");
                    }else if(result.status == 2) {
                        read.removeClass("fa-bookmark-o");
                        read.addClass("fa-bookmark");
                    }
                }
            });
        })

    </script>
@endsection


