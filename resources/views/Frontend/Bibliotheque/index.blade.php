@extends('Frontend.layout.master')

@section('title')
    {{ __('home.frontEnd.title') }}
@endsection

@section('content')
<div class="container-fluid container-library">
    <div class="main library">
        <div class="container-fluid">
            <div class="col-lg-3">
                <div id="input_container">
                    <form method="Get" action="{{ route('frontBibliotheque') }}">
                        <input type="text" name="q" id="input" value="{{ app('request')->input('q') }}">
                        <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
                        <button type="button" id="btnSearch" data-toggle="modal" data-target=".bd-search-advance-modal-lg">Recherche avancée</button>
                        <!-- <input type="button" value="Recherche avancée" id="btnSearch"> -->
                    </form>
              </div>
              
            </div>
            <div class="col-lg-9">
                @include('Frontend.layout.pagemenu')
            </div>
        </div>
        <div class="container-fluid">
            <!-- Left menu -->
            <div class="col-lg-3 col-sm-3">
                {{-- @include('Frontend.Bibliotheque.partials.leftmenu', ['category']) --}}
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
                <div class="head-menu"><span>@lang('bibliotheques.title') Compagnons</span> ({{$bibliotheques['total']}})</div>
                @if (!empty($bibliothequeItems))
                    @foreach($bibliothequeItems as $key => $productItem)
                    <div class="container group-box">
                        @foreach ($productItem as $key => $product)
                        <div class="col-lg-2 col-sm-2">
                            <div class="wrap">
                                <img src="{{ $product['_source']['image'] }}" class="library-thumb">
                                <div class="box-toolips" data-type="library" data-id="{{ $product['_id'] }}">
                                    <div class="menu-tooltips"></div>
                                    <div class="content-panel">
                                        <div class="content-line like-line object-tooltip" data-element="like"><i class="fa fa-heart-o likeIcon" aria-hidden="true"></i> <span>Liker</span></div>
                                        <div class="content-line read-line object-tooltip" data-element="read"><i class="fa fa-bookmark-o readIcon" aria-hidden="true"></i> <span>À lire plus tard</span></div>
                                        <div class="content-line share-line object-tooltip" data-element="share"><i class="fa fa-share-alt shareIcon" aria-hidden="true"></i> <span>Partager</span></div>
                                        <div class="content-line pink-line object-tooltip" data-element="pink"><i class="fa fa fa-thumb-tack pinkIcon" aria-hidden="true"></i> <span>Pink</span></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="thumb-title">
                                <span class="title">{{ $product['_source']['title'] }}</span>
                                <img src="/image/front/cdd-icon.png" class="cdd-icon">
                            </div>
                            <div class="thumb-author">
                                Tim Snyder
                            </div>
                            <div class="thumb-price">
                                    {{ $product['_source']['price'] }} €
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    {{-- <div class="text-center">@include('Frontend.Bibliotheque.partials.pagination', ['paginator' => $result])</div> --}}
                    <div class="text-center">@include('Frontend.partials.pagination', ['paginator' => $result])</div>
                @else 
                <div class="alert alert-warning">@lang('common.noResult')</div>
                @endif
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
                                <button id="btn_save_search_keyword" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-ok" aria-hidden="true">
                                </span> @lang('common.btnSave')!</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @include('Frontend.Bibliotheque.partials.modal-searchadvance') --}}
@include('Frontend.layout.modal-searchadvance')
@include('Frontend.Bibliotheque.partials.modal-tooltip', ['library'])
@endsection

@section('script')
<script>
if(!!window.jQuery) {
    // jQuery is loaded
} else {
    // load jQuery first
    var script = document.createElement('script');
    script.type = "text/javascript";
    script.src = "/assets/lib/jquery/jquery.min.js";
    document.getElementsByTagName('head')[0].appendChild(script);
}
</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#input').bind('blur', function () {
            if($('#input').val()=='')
                $('#input_img').show();
        });

        $('#input').bind('focus', function () {
            $('#input_img').hide();
        });

        $('.bd-search-advance-modal-lg').on('show.bs.modal', function(e) {
            var queryParam = $("input[name='q']").val();

            //populate the textbox
            $(e.currentTarget).find('#rechercher').val(queryParam);
        });
    });
    
</script>

@endsection