<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href="{{route('dashboard.index')}}"><span>[</span>{{ __('left-panel.logoName') }}<span>]</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">{{ __('left-panel.navigation') }}</label>
    <div class="br-sideleft-menu">
        <a href="{{route('dashboard.index')}}" class="br-menu-link @if ($currentPage == 'dashboard') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">{{ __('left-panel.dashboard') }}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

        <a href="{{route('books.index')}}" class="br-menu-link @if ($currentPage == 'bookIndex') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">{{ __('left-panel.book') }}</span>
            </div><!-- menu-item -->
        </a><!-- br-menu-link -->

    </div><!-- br-sideleft-menu -->

    <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">{{ __('left-panel.information') }}</label>

    <div class="info-list">
        <div class="d-flex align-items-center justify-content-between pd-x-15">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">{{ __('left-panel.memoryUsage') }}</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div><!-- d-flex -->

    </div><!-- info-lst -->

    <br>
</div><!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->