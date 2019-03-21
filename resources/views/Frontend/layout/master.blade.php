<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js css-menubar">
    @include('Frontend.layout.head')
    <body>
        @yield('css')

        <!-- Header -->
        @include('Frontend.layout.header-contain')

        @yield('content','')
    <!-- End Page -->
    <!-- Footer -->

    {{-- @include('Frontend.layout.footer-panel') --}}

    @include('Frontend.layout.footer')
    <!-- Script on Page -->

    <!-- This script only use left menu-->
    @section('script-left-menu')
    @show

    @section('script')

    @show
    <!-- End Script on Page -->

    </body>
</html>