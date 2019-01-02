<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js css-menubar">
@include('Backend.layout.head')
<body class="dashboard">

@include('Backend.layout.left-panel')
@include('Backend.layout.head-panel')

<div class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">@yield('content-title')</h4>
    </div>
    <div class="br-pagebody mg-t-5 pd-x-30">
        @yield('content', '')
    </div>
    @include('Backend.layout.footer-panel')

</div>

<!-- End Page -->
<!-- Footer -->
@include('Backend.layout.footer')
<!-- Script on Page -->
@section('script')

@show
<!-- End Script on Page -->

</body>
</html>