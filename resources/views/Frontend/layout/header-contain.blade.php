<header class="header-fixed">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="logo">
                    <a href="/">
                        <img src="{{ URL::to('/image/front/logo.png')}}" class="img-logo">
                    </a>
                    <span class="logo-title">Compagnons Du Devoir</span>
                </div>
            </div>

            @if(Auth::check() || (isset($pageName) && ($pageName == 'home' or $pageName == 'book')))
                <div class="col-lg-4">
                    <div class="pull-right">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Condition d’accès</button>
                            <ul class="dropdown-menu">
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Nos offres</button>
                            <ul class="dropdown-menu">
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            @if(!isset(Auth::user()->fullname))
                                <a href="{{ route('frontLogin') }}" class="btnConnect">CONNEXION</a>
                            @else
                                <span class="name-avatar-home dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->fullname }}</span>
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
                                    <li><a href="{{ route('frontLogout') }}">LOGOUT</a></li>
                                </ul>
                                <?php
                                if (!empty(Auth::user()->avatar)) {

                                    $url = parse_url(Auth::user()->avatar);
                                    if (isset($url['scheme']) && ($url['scheme'] == 'https' || $url['scheme'] == 'http')) {
                                        $imagePath = Auth::user()->avatar;
                                    } else {
                                        $imagePath = URL::to('/upload/avatar').'/'.Auth::user()->avatar;
                                    }

                                } else {
                                    $imagePath = URL::to('/image/front/avatar-home.png');
                                }
                                ?>
                                <img src="{{ asset(Auth::user()->avatar) }}" width="50px" height="50px" class="avatar-home">
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>