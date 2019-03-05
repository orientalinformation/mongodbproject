<header class="header-fixed">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-sm-8">
                <div class="logo">
                    <img src="{{ URL::to('/image/front/logo.png')}}" class="img-logo">
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
                        <img src="{{ URL::to('/image/front/avatar-home.png')}}" class="avatar-home">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>