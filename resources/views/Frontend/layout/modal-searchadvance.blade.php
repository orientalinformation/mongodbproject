<div class="modal fade bd-search-advance-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <form action="">
                    <div class="rechercher">
                        <div class="form-group">
                            <span>
                                <input type="text" class="form-control input-1" id="rechercher" placeholder="Rechercher sur la plateforme" >
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
                                          <input type="checkbox" name="article"> Études/Synthese
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="article" checked> Produit
                                        </label>
                                      </div>
                                </div>
                                <div class="col-lg-3 col-sm-3">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" name="article"> Reporting/Evenements
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    	@if(sizeof($category) > 0)
                    	<div class="list-category-advance">
                    		@foreach($category as $key => $item)
	                    		<?php $subCat = EnvatoCategory::getSubCategory($item['_id']); ?>
		                        <div class="form-group">
		                        	<legend class="col-form-label recher-avancee-line"></legend>
		                            <span class="text-label-rechercher text-label-rechercher-parent">Filière</span>
									<div class="checkbox">
		                                <label>
		                                  <input type="checkbox" name="category"> {{ $item['name'] }}
		                                </label>
		                            </div>
		                        </div>
		                        @if(sizeof($subCat) > 0)
			                        <div class="form-group">
			                            <span class="text-label-rechercher">Thématique</span>
			                        </div>
			                        @foreach($subCat as $keySub => $subItem)
				                        <?php $subCatChilds = EnvatoCategory::getSubCategory($subItem['_id']); ?>
			                        	<div class="form-group">
			                        		@if ($keySub > 0)
			                        		<legend class="col-form-label recher-avancee-line"></legend>
				                        	@endif
				                        	<div class="checkbox">
				                                <label>
				                                  <input type="checkbox" name="cate"> {{ $subItem['name'] }}
				                                </label>
				                            </div>
				                            <div class="box-sub-cat-child">
				                            	@foreach ($subCatChilds as $subCatChild)
				                            	<div class="box-sub-cat-child-item">
				                            		<div class="checkbox">
						                                <label>
						                                  <input type="checkbox" name="cate"> {{ $subCatChild['name'] }}
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
                                  <input type="checkbox" name="category"> Produit
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
                            <button class="btn btn-oblong btn-primary btn-upload" type="submit"><i class="fa fa-search" aria-hidden="true"></i> RECHECHE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>