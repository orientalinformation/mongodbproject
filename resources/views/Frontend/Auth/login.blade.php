@extends('Frontend.layout.master')

@section('title')
    {{ __('login.frontEnd.title') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row slide">
        <div class="bg-login"></div>
        <div class="col-lg-12 title-background-login">
            <span>Connectez Vous</span>
        </div>
        <div class="col-lg-12 title-background-small-login">
            <span>Connectez Vous</span>
        </div>
        <div class="col-lg-12 login-form">
            <form action="{{ route('frontPostLogin') }}" method="POST">
                {{ csrf_field() }}
                <div class="input-table">
                    <div class="input-table-group">
                        <label>Courriel</label>
                        <input type="text" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" placeholder="courriel ou pseudo">
                        @if ($errors->has('username'))
                            <p style="color:red">{{ $errors->first('username') }}</p>
                        @endif 
                        <label>Mot de passe</label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="mot de pass">
                        @if ($errors->has('password'))
                            <p style="color:red">{{ $errors->first('password') }}</p>
                        @endif 
                        <p class="login-form-foot">
                            <a href="{{ route('frontPasswordForgot') }}"><span class="caret"></span> <span>Mot de passe oublié</span></a>
                            <a href="{{ route('register') }}" class="float-right"><span class="caret"></span> <span>Créer un compte</span></a>
                        </p>
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <button class="btnLogin">Me Connecter</button>
                    </div>
                    <div style="text-align: center;">
                        <p class="txt-login-with">Connectez-vous plus repidement</p>
                        <a href="{{ url('auth/facebook') }}" class="btnFacebook"><i class="fa fa-facebook"></i> facebook</a>
                        <a href="{{ url('auth/google') }}" class="btnGoogle"><i class="fa fa-google-plus"></i> google+</a>
                        <a href="{{ url('auth/linkedin') }}" class="btnLinked"><i class="fa fa-linkedin-square"></i> Linked In</a>
                        <a href="{{ url('auth/live') }}" class="btnMicrosoft"><i class="fa fa-windows"></i> Microsoft</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection