<div class="modal fade bd-search-advance-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{ route('frontAjaxSearchAdvance') }}" name="frmSearchbibliotheque" method="POST">
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
                                          <input type="checkbox" name="kind[]" value="product"@php if ($controller == 'ProductController') echo ' checked' @endphp> Produit
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
                                <div class="col-lg-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="kind[]" value="bibliotheque"@php if ($controller == 'BibliothequeController') echo ' checked' @endphp> Bibliotheque
                                        </label>
                                    </div>
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