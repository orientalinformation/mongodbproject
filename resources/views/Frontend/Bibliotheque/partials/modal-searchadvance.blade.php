<div class="modal fade bd-search-advance-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="" name="frmSearchAdvance" method="POST">
                	{{ csrf_field() }}
                    <div class="rechercher">
                        <div class="form-group">
                            <span>
                                <input type="text" name="q" value="{{ app('request')->input('q') }}" class="form-control input-1" id="rechercher" placeholder="Rechercher sur la plateforme" >
                            </span>
                        </div>
                        <div class="bibliotheque text-warning`">
                            BIBLIOTHEQUE
                        </div>
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <span class="text-label-rechercher">Métier</span>
                            <div class="form-check row">
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="outitl" id="outitl" checked="">
                                    <label class="form-check-label label-non-bold" for="outitl">Outil</label>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" id="fer">
                                    <label class="form-check-label label-non-bold" for="fer">Fer</label>
                                </div>

                            </div>
                            
                        </div>
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <div class="form-check row">
                                <div class="col-lg-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="kind[]" value="book"> Études/Synthese
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="kind[]" value="product"> Produit
                                        </label>
                                      </div>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="kind[]" value="report"> Reporting/Evenements
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <span class="text-label-rechercher">Thématique</span>
                            <span class="text-sublabel-rechercher">Logiciel</span>
                            <div class="form-check row">
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="cao" id="cao">
                                    <label class="form-check-label label-non-bold" for="cao">CAO/DAO</label>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="cfao" id="cfao">
                                    <label class="form-check-label label-non-bold" for="cfao">CFAO</label>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="fao" id="fao">
                                    <label class="form-check-label label-non-bold" for="fao">FAO</label>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="erp" id="erp">
                                    <label class="form-check-label label-non-bold" for="erp">ERP/CRN</label>
                                </div>

                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="calcul" id="calcul">
                                    <label class="form-check-label label-non-bold" for="calcul">Calcul strocture</label>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <input type="checkbox" class="form-check-input" name="colts" id="colts">
                                    <label class="form-check-label label-non-bold" for="colts">Colts collaboraie</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <span class="text-sublabel-rechercher">Outil</span>
                            <div class="form-check row">
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
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <div class="form-check row">
                                <div class="col-lg-12 col-sm-12">
                                    <input type="checkbox" class="form-check-input" name="reglementaies" id="reglementaies">
                                    <label class="form-check-label label-non-bold" for="reglementaies">Règlementaires et normes</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <span class="text-sublabel-rechercher">Evolution societale</span>
                            <div class="form-check row">
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
                        <div class="form-group">
                            <legend class="col-form-label recher-avancee-line"></legend>
                            <span class="text-sublabel-rechercher">Materiaux</span>
                            <div class="form-check row">
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
                    	@if(sizeof($category) > 0)
                    	<div class="list-category-advance">
                    		@foreach($category as $key => $item)
	                    		@php $subCat = EnvatoCategory::getSubCategory($item['_id']); @endphp
		                        <div class="form-group">
		                        	<legend class="col-form-label recher-avancee-line"></legend>
		                            <span class="text-label-rechercher text-label-rechercher-parent">Filière</span>
									<div class="checkbox checkbox-category-first">
		                                <label>
		                                  <input type="checkbox" name="category[]" value="{{ $item['_id'] }}" class="input-category-one"> {{ $item['name'] }}
		                                </label>
		                            </div>
		                        </div>
		                        @if(sizeof($subCat) > 0)
			                        <div class="form-group">
			                            <span class="text-label-rechercher">Thématique</span>
			                        </div>
			                        @foreach($subCat as $keySub => $subItem)
				                        @php $subCatChilds = EnvatoCategory::getSubCategory($subItem['_id']); @endphp
			                        	<div class="form-group">
			                        		@if ($keySub > 0)
			                        		<legend class="col-form-label recher-avancee-line"></legend>
				                        	@endif
				                        	<div class="checkbox">
				                                <label>
				                                  <input type="checkbox" name="category[]" value="{{ $subItem['_id'] }}" data-id="{{ $subItem['_id'] }}" id="input-category-two-{{ $subItem['_id'] }}" class="input-category-two"> {{ $subItem['name'] }}
				                                </label>
				                            </div>
				                            <div class="box-sub-cat-child">
				                            	@foreach ($subCatChilds as $subCatChild)
				                            	<div class="box-sub-cat-child-item">
				                            		<div class="checkbox">
						                                <label>
						                                  <input type="checkbox" name="category[]" value="{{ $subCatChild['_id'] }}" data-parent="{{ $subItem['_id'] }}" class="input-category-three input-category-three-{{ $subItem['_id'] }}"> {{ $subCatChild['name'] }}
						                                </label>
						                            </div>
				                            	</div>
				                            	@endforeach
				                            </div>
			                            </div>
		                            @endforeach
		                        @endif
	                        @endforeach
	                    </div>
                        @endif
                        <div class="form-group">
                        	<legend class="col-form-label recher-avancee-line"></legend>
							<div class="checkbox">
                                <label>
                                  <input type="checkbox" name="category[]"> Produit
                                </label>
                            </div>
                            <div class="box-sub-cat-child">
                            	<div class="box-sub-cat-child-item">
                            		<div class="checkbox">
		                                <label>
		                                  <input type="checkbox" name="cate"> Quincallerie
		                                </label>
		                            </div>
                            	</div>
                            	<div class="box-sub-cat-child-item">
                            		<div class="checkbox">
		                                <label>
		                                  <input type="checkbox" name="cate"> Colletset
		                                </label>
		                            </div>
                            	</div>
                            </div>
                        </div>
                        <div class="box-btn-search-advance">
                            <button class="btn btn-oblong btn-primary btn-upload" id="btn_search_advance" type="button"><i class="fa fa-search" aria-hidden="true"></i> RECHECHE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>