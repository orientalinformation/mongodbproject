<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js css-menubar">
@include('Frontend.layout.head')
<body class="dashboard">

@include('Frontend.layout.sitebar')
@include('Frontend.layout.site-menubar')

<div class="page animsition">
    <div class="page-scroll scrollbar-outer">
        <div class="page-content">
            <div class="container-fluid">
                @yield('content', '')
            </div>
        </div>
    </div>
</div>
<!-- End Page -->
<!-- Footer -->
@include('Frontend.layout.footer')
<!-- Script on Page -->
@section('script')

@show
<!-- End Script on Page -->

</body>



</html>