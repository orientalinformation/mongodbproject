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
                	<form method="Get" action="{{ route('frontProduct') }}">
	                    <input type="text" name="keyword" id="input" value="{{ app('request')->input('keyword') }}">
	                    <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
	                    <button type="button" id="btnSearch" data-toggle="modal" data-target=".bd-search-advance-modal-lg">Recherche avancée</button>
					</form>
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
                <div class="btn-research pull-right">
                    <a href="#" class="btn btn-warning text-uppercase" data-toggle="modal" data-target=".bd-save-keyword-modal-md"><i class="fa fa-level-down" aria-hidden="true"></i> @lang('common.saveSearch')</a>
                </div>
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
                            {{ EnvatoUlities::number_format_short($product['_source']['view']) }} vues . {{ EnvatoUlities::time_elapsed_string($product['_source']['created_at']) }}
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
<div class="modal fade bd-search-advance-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="">
                    <div class="form-group rechercher">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <span>
                                    <input type="text" class="form-control input-1" id="rechercher" placeholder="Rechercher sur la plateforme" >
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
                                        <input type="checkbox" class="form-check-input" name="produit" id="produit" checked>
                                        <label class="form-check-label label-non-bold" for="produit">Produit</label>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <input type="checkbox" class="form-check-input" name="reporting" id="reporting" checked>
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
@endsection