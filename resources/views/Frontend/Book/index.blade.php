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
                        <button id="btnSearch" data-toggle="modal" data-target=".bd-search-advance-modal-lg">Recherche avancée</button>
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
                    <div class="btn-research pull-right">
                        <a href="#" class="btn btn-warning text-uppercase" data-toggle="modal" data-target=".bd-save-keyword-modal-md"><i class="fa fa-level-down" aria-hidden="true"></i> @lang('common.saveSearch')</a>
                    </div>
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
                                        <div class="content-line list-line" data-toggle="modal" data-target="#libraryList"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Ajouter dans une liste</span></div>
                                        <div class="content-line create-line" data-toggle="modal" data-target="#libraryCreate"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Créer une liste</span></div>
                                        <div class="content-line share-line"><i class="fa fa-share-alt shareIcon" aria-hidden="true"></i> <span>Partager</span></div>
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
                <div class="modal-body" id="body-libraryList">
                    @foreach($library as $item)
                    <div class="input-group listWrap">
                        <input type="checkbox" name="itemList" class="itemList" attr-data="{{ $item['_id'] }}"><label>{{ $item['name'] }}</label>
                    </div>
                    @endforeach
                    <input type="hidden" id="bookID-modal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="libraryCreate" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create list</h4>
                </div>
                <div class="modal-body">
                    <label>Name:</label>
                    <div class="alert alert-success alertCreatelist"></div>
                    <input type="text" class="form-control" placeholder="Name" id="nameLibrary">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btnCreateLibrary">Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade bd-save-keyword-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">@lang('common.saveSearch')</h4>
                </div>
                <div class="modal-body">
                    <form name="frmSaveKeyword" action="{{ route('frontResearchSave') }}">
                        <div class="form-group rechercher">
                            <div class="input-group">
                                <input type="text" name="research_name" class="form-control">
                                <span class="input-group-btn">
                                <buttonn id="btn-save-keyword" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-ok" aria-hidden="true">
                                </span> @lang('common.btnSave')!</button>
                            </span>
                            </div>
                        </div>
                    </form>
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
            let share = $(this).closest(".wrap").find(".shareIcon");
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
                $.ajax({
                    url: "{{ URL::to('/') }}/check_share",
                    cache: false,
                    type: "GET",
                    data: {user_id: 1, book_id: bookID},
                    success: function(result){
                        result = JSON.parse(result);
                        if(result.status == 1){
                            share.css('color','blue')
                        }else{
                            share.css('color','black')
                        }
                    }
                });
            }else{
                display.css("display","none");
            }
        })
        $(document).mouseup(function (e) {
            var popup = $(".content-panel");
            if (!$('.menu-tooltips').is(e.target) && !popup.is(e.target) && popup.has(e.target).length == 0) {
                popup.hide(500);
            }
        });
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
                    console.log(result);
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
        $('.list-line').click(function(){
            let bookID = $(this).closest(".wrap").find(".bookID").val();
            let itemList = $('.itemList');
            $("#libraryList").find("#bookID-modal").val(bookID);
            // itemList.parent().remove();
            itemList.map(function(){
                let library_id = $(this).attr('attr-data');
                let library_item = $(this);
                $.ajax({
                    url: "{{ URL::to('/') }}/check_list",
                    cache: false,
                    type: "GET",
                    data: {library_id: library_id, object_id: bookID},
                    success: function(result){
                        result = JSON.parse(result);
                        console.log(result);
                        if(result.status == 1){
                            // itemList.parent().append('<input type="checkbok">');
                            library_item.attr('checked','checked');
                        }
                    }
                });
            })
        })
        $('.itemList').click(function(){
            let bookID = $(this).closest(".modal-body").find("#bookID-modal").val();
            let library_id = $(this).attr('attr-data');
            $.ajax({
                url: "{{ URL::to('/') }}/update_list",
                cache: false,
                type: "GET",
                data: {library_id: library_id, object_id: bookID},
                success: function(result){
                    result = JSON.parse(result);
                }
            });
        })
        $('.create-line').click(function(){
            $('input').val('');
            $('.alertCreatelist').hide();
            $('.btnCreateLibrary').click(function(){
                let name = $('#nameLibrary').val();

                $.ajax({
                    url: "{{ URL::to('/') }}/create_list",
                    cache: false,
                    type: "GET",
                    data: {user_id: "1", name: name},
                    success: function(result){
                        result = JSON.parse(result);
                        if(result.status == 1){
                            $('.alertCreatelist').text("create success");
                            $('.alertCreatelist').show();
                        }else{
                            $('.alertCreatelist').text(result.data);
                            $('.alertCreatelist').show();
                        }
                    }
                });
            })
        })
        $('.share-line').click(function(){
            let bookID = $(this).closest(".wrap").find(".bookID").val();
            let share = $(this).closest(".wrap").find(".shareIcon");
            $.ajax({
                url: "{{ URL::to('/') }}/check_share",
                cache: false,
                type: "GET",
                data: {user_id: 1, book_id: bookID, change: 1},
                success: function(result){
                    result = JSON.parse(result);
                    if(result.status == 1){
                        share.css('color','black');
                    }else if(result.status == 2) {
                        share.css('color','blue');
                    }
                }
            });
        })
    </script>
@endsection

@include('Frontend.layout.modal-searchadvance')

