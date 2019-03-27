@extends('Frontend.layout.master')

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')

<div class="container-fluid container-library">
    <div class="main library">
        <div class="container-fluid">
            <div class="col-lg-3 col-sm-3">
                <div id="input_container">
                	<form method="get" action="{{ route('frontProduct') }}" name="frmSearchNormal">
	                    <input type="text" name="q" id="input" value="{{ app('request')->input('q') }}">
	                    <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
	                    <button type="button" id="btnSearch" data-toggle="modal" data-target=".bd-search-advance-modal-lg">Recherche avancée</button>
					</form>
                </div>

            </div>
            <div class="col-lg-9 col-sm-9">
                @include('Frontend.layout.pagemenu')
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-lg-3 col-sm-3">
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
                <div class="head-menu"><span><strong>@lang('product.title')</strong></span>({{ $products['total'] }})</div>
                @if (!empty($productItems))
                @foreach($productItems as $key => $productItem)
                <div class="container-fluid group-box">
                    @foreach ($productItem as $key => $product)
                    <div class="col-lg-2 col-sm-2">
                        <div class="wrap">
                            <img src="{{ $product['_source']['image'] }}" class="library-thumb">
                            <div class="box-toolips" data-type="product" data-id="{{ $product['_id'] }}">
                                <div class="menu-tooltips"></div>
                                <div class="content-panel">
                                    <div class="content-line like-line object-tooltip" data-element="like"><i class="fa fa-heart-o likeIcon" aria-hidden="true"></i> <span>Liker</span></div>
                                    <div class="content-line read-line object-tooltip" data-element="read"><i class="fa fa-bookmark-o readIcon" aria-hidden="true"></i> <span>À lire plus tard</span></div>
                                    <div class="content-line list-line" data-toggle="modal" data-target="#libraryList"><i class="fa fa-list-ul" aria-hidden="true"></i> <span>Ajouter dans une liste</span></div>
                                    <div class="content-line create-line" data-toggle="modal" data-target="#libraryCreate"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Créer une liste</span></div>
                                    <div class="content-line share-line object-tooltip" data-element="share"><i class="fa fa-share-alt shareIcon" aria-hidden="true"></i> <span>Partager</span></div>
                                    <div class="content-line pink-line object-tooltip" data-element="pink"><i class="fa fa fa-thumb-tack pinkIcon" aria-hidden="true"></i> <span>Pink</span></div>
                                </div>
                            </div>
                            <div class="thumb-title">
                                <span class="title"><strong>{{ $product['_source']['title'] }}</strong></span>
                                <img src="/image/front/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="">
                                {{ EnvatoUlities::limit(strip_tags($product['_source']['description']), 20) }}
                            </div>
                            <div class="">
                                {{ EnvatoUlities::number_format_short($product['_source']['view']) }} vues . {{ EnvatoUlities::time_elapsed_string($product['_source']['created_at']) }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div class="text-center">@include('Frontend.partials.pagination', ['paginator' => $result])</div>
                @else 
                <div class="alert alert-warning">@lang('common.noResult')</div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('Frontend.layout.modal-savekeyword')
@include('Frontend.layout.modal-searchadvance')
@include('Frontend.layout.modal-tooltip', ['library'])
@endsection