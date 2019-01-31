<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo">
    <a href="{{route('dashboard.index')}}">
        <img src="{{ URL::to('/image/logo-compagnons.png')}}" class="wd-150">
    </a>
</div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">{{ __('left-panel.navigation') }}</label>
    <div class="br-sideleft-menu">
        <a href="#" class="br-menu-link @if ($currentPage == 'dashboard' || $currentPage == 'partner') active show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-contact-outline tx-24"></i>
                <span class="menu-item-label">Administratif</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item">
                <a href="{{route('dashboard.index')}}" class="nav-link @if ($currentPage == 'dashboard') active @endif">
                    {{ __('left-panel.dashboard') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('partners.index')}}" class="nav-link @if ($currentPage == 'partner') active @endif">
                    {{ __('left-panel.partnerManagement') }}
                </a>
            </li>
        </ul>

        <a href="#" class="br-menu-link @if ($currentPage == 'user' || $currentPage == 'role' || $currentPage == 'permission' || $currentPage == 'account') active show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-people-outline tx-24"></i>
                <span class="menu-item-label">Management des utilisateurs</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link @if ($currentPage == 'user') active @endif">
                    {{ __('left-panel.users') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('accounts.index') }}" class="nav-link @if ($currentPage == 'account') active @endif">
                    {{ __('left-panel.accountManagement') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link @if ($currentPage == 'role') active @endif">
                    {{ __('left-panel.roles') }}
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('permissions.index') }}" class="nav-link @if ($currentPage == 'permission') active @endif">
                    {{ __('left-panel.permissions') }}
                </a>
            </li>
        </ul>

        <a href="{{ route('categories.index') }}" class="br-menu-link @if ($currentPage == 'categoryIndex') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
                <span class="menu-item-label">{{ __('left-panel.category') }}</span>
            </div><!-- menu-item -->
        </a>

        <a href="#" class="br-menu-link @if ($currentPage == 'libraryIndex' || $currentPage == 'bookIndex' || $currentPage == 'eventIndex' || $currentPage == 'productIndex' || $currentPage == 'draftIndex') show-sub @endif"">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                <span class="menu-item-label">Management des base de données</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('libraries.index') }}" class="nav-link @if ($currentPage == 'libraryIndex') active @endif">Biblithèque personnelle</a></li>
            <li class="nav-item">
                <a href="{{ route('books.index') }}" class="nav-link @if ($currentPage == 'bookIndex') active @endif">{{ __('left-panel.book') }}</a>
                <ul style="list-style-type: none">
                    <li><a href="{{ route('drafts.index') }}" class="nav-link @if ($currentPage == 'draftIndex') active @endif">Brouillons</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link @if ($currentPage == 'productIndex') active @endif">Produit</a></li>
            <li class="nav-item"><a href="{{ route('events.index') }}" class="nav-link @if ($currentPage == 'eventIndex') active @endif">Evénement</a></li>
        </ul>

        <a href="#" class="br-menu-link @if ($currentPage == 'discussionIndex') show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Management des causeries</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('discussions.index') }}" class="nav-link @if ($currentPage == 'discussionIndex') active @endif">Gestion des causeries</a></li>
        </ul>

        <a href="#" class="br-menu-link @if ($currentPage == 'rssIndex' || $currentPage == 'rssUserIndex') active show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-flame-outline tx-20"></i>
                <span class="menu-item-label">{{ __('rss.rssMenu') }}</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
            <li class="nav-item"><a href="{{ route('rss.index') }}" class="nav-link @if ($currentPage == 'rssIndex') active @endif">{{ __('rss.rssAdminMenu') }}</a></li>
            <li class="nav-item"><a href="{{ route('rss.user') }}" class="nav-link @if ($currentPage == 'rssUserIndex') active @endif">{{ __('rss.rssUserMenu') }}</a></li>
        </ul>

        <a href="" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-archive tx-20"></i>
                <span class="menu-item-label">Management QCM</span>
            </div><!-- menu-item -->
        </a>

        <a href="" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                <span class="menu-item-label">Management pages web</span>
            </div><!-- menu-item -->
        </a>

        <a href="{{ route('libraries.index') }}" class="br-menu-link @if ($currentPage == 'libraryIndex') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-albums-outline tx-22"></i>
                <span class="menu-item-label">{{ __('left-panel.library') }}</span>
            </div><!-- menu-item -->
        </a>


    </div><!-- br-sideleft-menu -->

    <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->