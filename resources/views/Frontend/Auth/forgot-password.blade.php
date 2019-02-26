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
            <form class="form-horizontal" role="form" method="POST" action="{{ route('frontSendMail') }}">
                {{ csrf_field() }}
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
                    <p class="forgot-form-foot">
                        <a href="#"><span class="caret"></span> <span>Mot de passe oublié</span></a>
                    </p>
                    <button class="btnLogin">Valider</button>
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection