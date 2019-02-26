@extends('Frontend.layout.master')

@section('title', __('Mot De Passe Oublié'))

@section('content')
<header class="header-login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-sm-6">
                <div class="logo">
                    <a href="/">
                        <img src="{{ URL::to('/image/front/logo.png')}}" class="img-logo">
                    </a>
                    <span class="logo-title">Compagnons Du Devoir</span>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row slide">
        <div class="bg-login"></div>
        <div class="col-lg-12 title-background-forgot">
            <span>Mot De Passe Oublié</span>
        </div>
        <div class="col-lg-12 title-background-small-forgot">
            <span>Mot De Passe Oublié</span>
        </div>
        <div class="col-lg-12 forgot-form">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('frontResetPassword') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-table">
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
                    <label>Saisissez votre addresse e-mail</label>
                    <input type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="email" required>
                    @if ($errors->has('email'))
                        <p class="forgot-form-foot" style="color:red">{{ $errors->first('email') }}</p>
                    @endif 

                    <label>Nouveau mot de passe</label>
                    <input type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Nouveau mot de passe" required>
                    @if ($errors->has('password'))
                        <p class="forgot-form-foot" style="color:red">{{ $errors->first('email') }}</p>
                    @endif 

                    <label>Confirmation mot de passe</label>
                    <input type="password" class="{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirmation mot de passe" required>
                    @if ($errors->has('password_confirmation'))
                        <p class="forgot-form-foot" style="color:red">{{ $errors->first('email') }}</p>
                    @endif 

                    <button type="submit" class="btnLogin">Envoyer</button>
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection