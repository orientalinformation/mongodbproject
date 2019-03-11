<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.ico">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title','Accueil')</title>

    <!-- vendor css -->
    <link href="{{ asset('/assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <!--Dynamic StyleSheets added from a view would be pasted here-->
    @yield('styles')

    <!-- Plugins -->

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/front-style.css') }}">


    <!-- Stylesheets -->


</head>