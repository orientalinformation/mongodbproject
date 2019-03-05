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
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <label>Saisissez votre addresse e-mail</label>
                    <input type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <p class="forgot-form-foot" style="color:red">{{ $errors->first('email') }}</p>
                    @endif 
                    <button class="btnLogin">Valider</button>
                </div>
            </form>    
        </div>
    </div>
 
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Notification</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <p>
                        Vous avez oublié votre mot the passe ?
                        Vous venez de demander le renouvellement de votre mot de passe.
                        Nous venons de vous envoyer à l’instant un email avec un lien à suivre.
                        Nous vous invitons donc à vérifier votre boîte de réception (et éventuellement vos emails non désirés ou spam)… puis à revenir nous voir grâce au lien.
                        A tout de suite…
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        var name = '{{ session('status') }}';

        if (name) {
            $('#myModal').modal('show');
        }

    </script>
@endsection