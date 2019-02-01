<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Twitter -->
        <meta name="twitter:site" content="@themepixels">
        <meta name="twitter:creator" content="@themepixels">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Bracket">
        <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
        <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

        <!-- Facebook -->
        <meta property="og:url" content="http://themepixels.me/bracket">
        <meta property="og:title" content="{{ __('left-panel.logoName') }}">
        <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

        <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
        <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="600">

        <!-- Meta -->
        <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
        <meta name="author" content="ThemePixels">

        <title>Bracket Responsive Bootstrap 4 Admin Template</title>

        <!-- vendor css -->
        <link href="{{ asset('/assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">

        <!-- Bracket CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/css/bracket.css') }}">
    </head>

    <body>
        <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
            <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
                <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">
                    <img src="{{ URL::to('/image/logo-compagnons.png')}}" class="">
                </div>
                <div class="tx-center mg-b-60"></div>

                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" required class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="{{ __('login.username') }}">
                        @if ($errors->has('username'))
                            <p style="color:red">{{ $errors->first('username') }}</p>
                        @endif    
                    </div><!-- form-group -->

                    <div class="form-group">
                        <input type="password" required name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('login.password') }}">
                        @if ($errors->has('password'))
                            <p style="color:red">{{ $errors->first('password') }}</p>
                        @endif
                        <a href="{{ route('passwordForgot') }}" class="tx-info tx-12 d-block mg-t-10">{{ __('login.forgotPassword') }}</a>
                    </div><!-- form-group -->

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-info btn-block">{{ __('login.signIn') }}</button>
                </form>    
<!--                 <div class="mg-t-60 tx-center">
                    Not yet a member? <a href="" class="tx-info">Sign Up</a>
                </div> -->
            </div><!-- login-wrapper -->
        </div><!-- d-flex -->

        <script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
        <script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
        <script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script>

    </body>
</html>