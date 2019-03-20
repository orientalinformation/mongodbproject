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
                <ul class="horizontal-menu-library">
                    <li> <a href="#">Toutes</a></li>
                    <li> <a href="#">Web</a></li>
                    <li> <a href="#">Étude/Synthese</a></li>
                    <li> <a href="#">Produit</a></li>
                    <li> <a href="#">Preporting/Evenement</a></li>
                    <li class="active"> <a href="#">Librairie Compagnons</a></li>
                </ul>
                <div class="btn-research pull-right">
                    <a href="#" class="btn btn-warning text-uppercase" data-toggle="modal" data-target=".bd-save-keyword-modal-md"><i class="fa fa-level-down" aria-hidden="true"></i> @lang('common.saveSearch')</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Left menu -->
            <div class="col-lg-3 col-sm-3">
                @include('Frontend.Bibliotheque.partials.leftmenu', ['category'])
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
                                <div class="menu-tooltips"></div>
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
                    <div class="text-center">@include('Backend.partials.pagination', ['paginator' => $result])</div>
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
@include('Frontend.Bibliotheque.partials.modal-searchadvance')
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

<script src="{{ asset('/assets/js/front-bibliotheque.js') }}"></script>
<script type="text/javascript">
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
@endsection