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
        <meta property="og:title" content="Bracket">
        <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

        <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
        <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="600">

        <!-- Meta -->
        <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
        <meta name="author" content="ThemePixels">

        <title>Reset Password</title>

        <!-- vendor css -->
        <link href="{{ asset('/assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">

        <!-- Bracket CSS -->
        <link rel="stylesheet" href="{{ asset('/assets/css/bracket.css') }}">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <div class="card">
                        <div class="card-header bg-success text-dark">{{ __('login.forgotPassword') }}</div>
                        <div class="card-body">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/password/reset') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">{{ __('login.email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <p style="color:red">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <p style="color:red">
                                                {{ $errors->first('password') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                    <label for="password_confirmation" class="col-md-4 control-label">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>

                                        @if ($errors->has('password_confirmation'))
                                            <p style="color:red">
                                                {{ $errors->first('password_confirmation') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <a href="{{ route('login') }}" class="btn btn-danger">
                                            Back Login
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('/assets/lib/jquery/jquery.js') }}"></script>
        <script src="{{ asset('/assets/lib/popper.js/popper.js') }}"></script>
        <script src="{{ asset('/assets/lib/bootstrap/bootstrap.js') }}"></script>
    </body>
</html>