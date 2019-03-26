@extends('Frontend.layout.master')

{{--@section('styles')--}}

    {{--<script src="{{ asset('/assets/lib/jquery/jquery-ui.min.js') }}"></script>--}}
    {{--<script src="{{ asset('/assets/lib/slider/slider.js') }}"></script>--}}
{{--@stop--}}

@section('title')
    {{ __('book.title') }}
@endsection

@section('content')
    <div class="container-fluid container-library">
        <div class="main library">
            <div class="container-fluid">
                <div class="col-lg-3 col-sm-3">
                    <div id="input_container">
                        <input type="text" id="input" value="<?= app('request')->input('q'); ?>" class="normanSearch">
                        <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
                        <button id="btnSearch" data-toggle="modal" data-target=".bd-search-advance-modal-lg">Recherche avancée</button>
                    </div>

                </div>

                <div class="col-lg-9 col-sm-9">
                    <ul class="horizontal-menu-library pull-left">
                        <li> <a href="#">Toutes</a></li>
                        <li> <a href="#">Web</a></li>
                        <li class="active"> <a href="#">Étude/Synthese</a></li>
                        <li> <a href="#">Produit</a></li>
                        <li> <a href="#">Preporting/Evenement</a></li>
                        <li> <a href="#">Librairie Compagnons</a></li>
                    </ul>
                    <?php if(isset($_GET["q"])): ?>
                    <div class="btn-research pull-right">
                        <a href="#" class="btn btn-warning text-uppercase" data-toggle="modal" data-target=".bd-save-keyword-modal-md"><i class="fa fa-level-down" aria-hidden="true"></i> @lang('common.saveSearch')</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="container-fluid">
                <div class="col-lg-3 col-sm-3">
                    <!-- Left menu -->
                    @include('Frontend.layout.leftmenu', ['category'])
                </div>
                <div class="col-lg-9 col-sm-9">
                    <div class="row">
                        <div class="col-md-9 hidden-xs hidden-sm"></div>
                        <div class="col-md-3 box-trier">
                            <select class="selectpicker" title="@lang('common.sort')" onchange="window.open(this.value,'_self');">
                                <option value="{{ $urlSort['latest'] }}"
                                        @if (app('request')->input('sort') == 'desc')
                                        selected
                                        @endif>@lang('common.latest')</option>
                                <option value="{{ $urlSort['oldest'] }}"
                                        @if (app('request')->input('sort') == 'asc')
                                        selected
                                        @endif
                                >@lang('common.oldest')</option>
                            </select>
                        </div>
                    </div>
                    <div class="head-menu"><span><strong>Étude/Synthese</strong></span> (<?= sizeof($book['data']); ?>)</div>
                    <?php if(sizeof($book['data']) > 0): ?>
                    <?php $i = 1;?>
                    @foreach($book['data'] as $item)
                        <?php if($i == 1): ?>
                            <div class="container-fluid group-box" <?= $i ?>>
                        <?php endif; ?>
                            <div class="col-lg-2 col-sm-2 <?= $i ?>">
                                <div class="wrap">
                                    <img src="<?= URL::to('/upload/book/') . "/" . $item['image'] ?>" class="library-thumb">
                                    <?php if (!empty(Auth::user())): ?>
                                    <?php
                                        if(!isset($_GET["q"])){
                                            $itemId =  $item['_id'];
                                        }else{
                                            $itemId =  $item['id'];
                                        }
                                    ?>
                                    <div class="box-toolips" data-type="book" data-id="{{ $itemId }}">
                                        <div class="menu-tooltips"></div>
                                        {{--<div class="content-panel">--}}
                                            {{--<div class="content-line like-line"><i class="fa fa-heart-o likeIcon" aria-hidden="true"></i> <span>Liker</span></div>--}}
                                            {{--<div class="content-line read-line"><i class="fa fa-bookmark-o readIcon" aria-hidden="true"></i> <span>À lire plus tard</span></div>--}}
                                            {{--<div class="content-line list-line" data-toggle="modal" data-target="#libraryList"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Ajouter dans une liste</span></div>--}}
                                            {{--<div class="content-line create-line" data-toggle="modal" data-target="#libraryCreate"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Créer une liste</span></div>--}}
                                            {{--<div class="content-line pin-line"><i class="fa fa-thumb-tack pinIcon" aria-hidden="true"></i> <span>Pin</span></div>--}}
                                            {{--<div class="content-line share-line"><i class="fa fa-share-alt shareIcon" aria-hidden="true"></i> <span>Partager</span></div>--}}
                                        {{--</div>--}}
                                        <div class="content-panel">
                                            <div class="content-line like-line object-tooltip" data-element="like"><i class="fa fa-heart-o likeIcon" aria-hidden="true"></i> <span>Liker</span></div>
                                            <div class="content-line read-line object-tooltip" data-element="read"><i class="fa fa-bookmark-o readIcon" aria-hidden="true"></i> <span>À lire plus tard</span></div>
                                            <div class="content-line list-line" data-toggle="modal" data-target="#libraryList"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Ajouter dans une liste</span></div>
                                            <div class="content-line create-line" data-toggle="modal" data-target="#libraryCreate"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Créer une liste</span></div>
                                            <div class="content-line share-line object-tooltip" data-element="share"><i class="fa fa-share-alt shareIcon" aria-hidden="true"></i> <span>Partager</span></div>
                                            <div class="content-line pink-line object-tooltip" data-element="pink"><i class="fa fa fa-thumb-tack pinkIcon" aria-hidden="true"></i> <span>Pink</span></div>
                                        </div>
                                    </div>
                                    <input type="hidden" class="bookID" value="{{ $itemId }}"/>
                                    <?php endif; ?>
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
                        <?php if($i == 6): ?>
                            </div>
                        <?php $i = 0; ?>
                        <?php endif; ?>
                        <?php $i++; ?>
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
                        <input type="checkbox" name="itemList" class="itemList" attr-data="{{ $item['_id'] }}"><label>{{ $item['title'] }}</label>
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
    <?php $userID = 0; ?>
    <?php if (!empty(Auth::user())): ?>
    <?php $userID = Auth::user()->id; ?>
    <?php endif; ?>
    <script type="text/javascript">
        $('input').bind("enterKey",function(e){
            let normanSearch = $('.normanSearch').val();
            window.location.href = "{{ URL::to('/') . '/book' }}" + "?q=" + normanSearch;
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


    </script>
    @include('Frontend.layout.modal-searchadvance')
    @include('Frontend.layout.modal-tooltip', ['library'])
@endsection

