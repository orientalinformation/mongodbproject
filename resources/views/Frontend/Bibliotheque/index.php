
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.ico">

    <title>Librairie Compagnons</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script src='js/jquery.min.js'></script>
    <script src='js/bootstrap.min.js'></script>
  </head>

  <body>
     
    <header class="header-fixed">
    	<div class="container-fluid">
	      <div class="row">
	        <div class="col-lg-8 col-sm-8">
	          <div class="logo">
	            <img src="image/logo.png" class="img-logo">
	            <span class="logo-title">Compagnons Du Devoir</span>
	          </div>
	        </div>
	        <div class="col-lg-4 col-sm-8">
	        	<div class="pull-right">
					<div class="dropdown">
						<span class="name-avatar-home dropdown-toggle" data-toggle="dropdown">Frédéric BOUTON</span>
						<ul class="dropdown-menu">
					      <li><a href="#">MON PROFIL</a></li>
					      <li><a href="#">MA VEILLE</a></li>
					      <li>
					      	<a href="#">MES OUTILS</a>
					      	<ul class="sub-menu-home">
					      		<li>Calendrier des événements</li>
					      		<li>Lien de stockage</li>
					      	</ul>
					      </li>
					      <li><a href="#">MES NOTIFICATIONS</a></li>
					      <li><a href="#">MES ARTICLES</a></li>
					      <li><a href="#">MES ENQUETES</a></li>
					      <li><a href="#">MES PARAMÉTRES</a></li>
					    </ul>
						<img src="image/avatar-home.png" class="avatar-home">
					</div>
				</div>
	        </div>
	      </div>
	    </div>
    </header>
    <div class="container-fluid container-library">
  		<div class="main library">
	  		<div class="container-fluid">
	  			<div class="col-lg-3">
	  				<div id="input_container">
					    <input type="text" id="input" value>
					    <i class="fa fa-search" aria-hidden="true" id="input_img"></i>
					    <button id="btnSearch" data-toggle="modal" data-target=".bd-example-modal-lg">Recherche avancée</button>
					    <!-- <input type="button" value="Recherche avancée" id="btnSearch"> -->
					</div>
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
	  			</div>
	  		</div>
	  		<div class="container-fluid">
	  			<div class="col-lg-3">
	  				<ul class="profile-menu-left menu-home menu-library">
	  					<li class="accordion-toggle"><a href="#colMenu1" data-toggle="collapse"><i class="fa fa-desktop" aria-hidden="true"></i> Métier</a></li>
	  					<div id="colMenu1" class="panel-collapse collapse in">
		  					<ul class="sub-menu-library">
	  							<li>Bois</li>
	  						</ul>
	  					</div>
	  					<li><a class="accordion-toggle" href="#colMenu2" data-toggle="collapse">Thématique</a></li>
	  					<div id="colMenu2" class="panel-collapse collapse in">
		  					<ul class="sub-menu-library">
	  							<li>Logiciel</li>
	  							<li>Outil</li>
	  							<li>Règlementaires et normes</li>
	  							<li>Transition</li>
	  							<li>Matériaux</li>
	  							<li>Produit</li>
	  						</ul>
	  					</div>
	  					<li><a class="accordion-toggle collapsed" href="#colMenu3" data-toggle="collapse">Année</a></li>
	  					<div id="colMenu3" class="panel-collapse collapse">
		  					<ul class="sub-menu-library">
	  							<li>Logiciel</li>
	  							<li>Outil</li>
	  							<li>Règlementaires et normes</li>
	  							<li>Transition</li>
	  							<li>Matériaux</li>
	  							<li>Produit</li>
	  						</ul>
	  					</div>
	  					<li>
	  						<img src="image/video-checked.png" class="library-video-icon">
	  						<img src="image/video-remove.png" class="library-video-icon">
	  					</li>
	  					<li><a class="accordion-toggle" href="#colMenu4" data-toggle="collapse">Mes bibliothèques</a></li>
	  					<div id="colMenu4" class="panel-collapse collapse in">
		  					<ul class="sub-menu-library">
	  							<li>À lire plus tard 
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Biblio 1
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Biblio 2
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Biblio 3
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Biblio 4
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  						</ul>
	  						<div class="link-menu"><a href="#">voir plus</a></div>
	  					</div>
	  					<li><a class="accordion-toggle" href="#colMenu5" data-toggle="collapse">Bibliothèques publiques</a></li>
	  					<div id="colMenu5" class="panel-collapse collapse in">
		  					<ul class="sub-menu-library">
	  							<li>Nom de la bibio par rene
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Nom de la bibio2 par @rene
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Nom de la bibio par Pierre badin
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Nom de la bibio par rene
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  							<li>Nom de la bibio par rene
	  								<span class="pin-icon"><i class="fa fa-thumb-tack" aria-hidden="true"></i> <i class="fa fa-share" aria-hidden="true"></i></span>
	  							</li>
	  						</ul>
	  						<div class="link-menu"><a href="#">voir plus</a></div>
	  					</div>
	  				</ul>
	  			</div>
	  			<div class="col-lg-9">
	  				<div class="head-menu"><span>Librairie Compagnons</span> (314)</div>
					<div class="container group-box">
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-4.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-3.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-2.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-1.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
					</div>
					<div class="container group-box">
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-4.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-3.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-2.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-1.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
					</div>
					<div class="container group-box">
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-4.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-3.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-2.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-1.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
					</div>
					<div class="container group-box">
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-5.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-4.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-3.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-2.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
								<img src="image/cdd-icon.png" class="cdd-icon">
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
						<div class="col-lg-2">
							<div class="wrap">
								<img src="image/library-thumb-1.png" class="library-thumb">
								<div class="menu-tooltips"></div>
							</div>
							<div class="thumb-title">
								<span class="title">Title</span>
							</div>
							<div class="thumb-author">
								Tim Snyder
							</div>
							<div class="thumb-price">
								28 €
							</div>
						</div>
					</div>
	  			</div>
	  		</div>
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
	                                    <input type="text" class="form-control input-1" id="rechercher" placeholder="Rechercher sur la plateforme" >
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
  	<footer>
  		<div class="container-fluid background-footer-profile">
  			<div class="row">
	  			<div class="col-lg-4 col-sm-4 col-left-footer">
	  				<div class="row text-center">
	  					<div class="col-md-4 col-logo-footer"><img src="image/logo.png" class="icon-logo-footer-profile"></div>
	  					<div class="col-md-4 col-txt-footer">
	  						<div class="txt-footer-profile">
		  						<img src="image/logo_fse_profile.png" class="logo-fse-profile">
		  						<p>Ce site internet a étéc financé par le Fond Social Européen</p>
	  						</div>
	  					</div>
	  					<div class="col-md-4">
	  						<iframe width="120" height="90" src="https://www.youtube.com/embed/okWP68GHC2Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	  					</div>
	  				</div>
	  			</div>
	  			<div class="col-lg-8 col-sm-8 col-right-footer">
	  				<div class="row">
	  					<div class="col-lg-4 col-sm-4">
	  						<p class="title-footer">Plate-Forme</p>
	  						<p class="title-footer-contain">Accès à des informations premium Etudes, Synthèses, tests produits</p>
	  					</div>
	  					<div class="col-lg-4 col-sm-4">
	  						<p class="title-footer">Outil De Veille</p>
	  						<p class="title-footer-contain">En un clic, soyez informé des nouvelles technologies, informations reglementaires...</p>
	  					</div>
	  					<div class="col-lg-4 col-sm-4">
	  						<p class="title-footer">Collaboratif</p>
	  						<p class="title-footer-contain">Rejoindre, participer, animer des groupes d'échanges sur vos besoins</p>
	  					</div>
	  				</div>
		  		</div>
		  	</div>
  		</div>
  		<div class="container-fluid logo-footer">
  			<div class="row">
	  			<div class="col-lg-3 col-sm-3 logo-item"><img src="image/logo-metiers-foret-bois.png"></div>
	  			<div class="col-lg-3 col-sm-3 logo-item"><img src="image/fnb.jpeg"></div>
	  			<div class="col-lg-3 col-sm-3 logo-item"><img src="image/cniefeb.jpeg"></div>
	  			<div class="col-lg-3 col-sm-3 logo-item"><img src="image/ffb.png"></div>
	  		</div>
  		</div>
  	</footer>
  </body>
</html>
