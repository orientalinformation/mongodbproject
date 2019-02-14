<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="no-js css-menubar">
@include('Frontend.layout.head')
<body>

    @yield('content')
<!-- End Page -->
<!-- Footer -->
@include('Frontend.layout.footer')
<!-- Script on Page -->
@section('script')

@show
<!-- End Script on Page -->

</body>
</html>