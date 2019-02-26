@extends('Frontend.layout.master')

@section('title', __('Registre'))

@section('css')
<link href="{{ asset('/assets/lib/gentleSelect/jquery-gentleSelect.css') }}" rel="stylesheet">
@stop

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
    <div class="row">
        <div class="col-lg-12 title-background-forgot">
            <span>S'Enregistrer</span>
        </div>
        <div class="col-lg-12 title-background-small">
            <span>S'Enregistrer</span>
        </div>
        <div class="container register-form">
            <form action="{{ route('register') }}" id="register" method="POST">
                {{ method_field("POST") }}
                {{ csrf_field() }}
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show alert-close" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="input-table-register">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row col-register-left">
                                <div class="col-lg-12">
                                    <label class="form-control-label label-civ">Civilité <strong class="require">*</strong></label>
                                    <div class="switch-field">
                                        <input type="radio" id="switch_left" name="civility" value="0" checked/>
                                        <label for="switch_left">M.</label>
                                        <input type="radio" id="switch_right" name="civility" value="1" />
                                        <label for="switch_right">Mme</label>
                                    </div>
                                    @if ($errors->has('civility'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('civility') }}
                                        </div>
                                    @endif    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Nom <strong class="require">*</strong></label>
                                        <input type="text" name="first_name" placeholder="Nom" class="form-control inputField {{ $errors->has('first_name') ? ' is-invalid' : '' }}" required>
                                    </div>    
                                    @if ($errors->has('first_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('first_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Prénom <strong class="require">*</strong></label>
                                        <input type="text" name="last_name" placeholder="Prénom" class="form-control inputField {{ $errors->has('last_name') ? ' is-invalid' : '' }}" required>
                                    </div>    
                                    @if ($errors->has('last_name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('last_name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Adresse</label>
                                        <input type="text" name="address" placeholder="Adresse" class="form-control inputField">
                                    </div>    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Code Postal</label>
                                        <input type="text" name="postal_code" placeholder="Code Postal" class="form-control inputField">
                                    </div>    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Pays</label>
                                        <input type="text" name="country" placeholder="Pays" class="form-control inputField">
                                    </div>    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Addresse e-mail <strong class="require">*</strong></label>
                                        <input type="text" name="email" placeholder="Addresse e-mail" class="form-control inputField {{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                    </div>    
                                    @if ($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Confirmer votre adresse e-mail <strong class="require">*</strong></label>
                                        <input type="text" name="email_confirmation" placeholder="Confirmer votre adresse e-mail" class="form-control inputField {{ $errors->has('email_confirmation') ? ' is-invalid' : '' }}" required>
                                    </div>    
                                    @if ($errors->has('email_confirmation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email_confirmation') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Mot de passe <strong class="require">*</strong></label>
                                        <input type="password" name="password" placeholder="Mot de passe" class="form-control inputField {{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                    </div>    
                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="no-margin">Confirmez le mot de passe <strong class="require">*</strong></label>
                                        <input type="password" name="password_confirmation" placeholder="Mot de passe" class="form-control inputField {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" required>
                                    </div>    
                                    @if ($errors->has('password_confirmation'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('password_confirmation') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <label class="form-control-label label-fil">Filière <strong class="require">*</strong></label>
                                    <div class="switch-field">
                                        <input type="radio" id="switch_2_left" name="career" value="0" checked/>
                                        <label for="switch_2_left">Bois</label>
                                        <input type="radio" id="switch_2_right" name="career" value="1" />
                                        <label for="switch_2_right">Pierre</label>
                                    </div>
                                </div>    
                                @if ($errors->has('career'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('career') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12" style="margin: 10px 0;">
                                <div class="input-group">
                                    <span class="headLine">Intéressé par les métiers:</span>
                                    <div class="switch-field">
                                        <input type="radio" id="switch_3_1" name="interested" value="0" />
                                        <label for="switch_3_1">Menuisier</label>
                                        <input type="radio" id="switch_3_2" name="interested" value="1" />
                                        <label for="switch_3_2">Agenceur</label>
                                        <input type="radio" id="switch_3_3" name="interested" value="2" />
                                        <label for="switch_3_3">Charpentier</label>
                                        <input type="radio" id="switch_3_4" name="interested" value="3" />
                                        <label for="switch_3_4">Constructeur Bois</label>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-lg-12" style="margin: 10px 0;">
                                <div class="input-group">
                                    <label style="display: inline-block; width: 220px">Membre de l'association des Compagnons du Deviort du Tour de France <strong class="require">*</strong></label>
                                    <div class="switch-field">
                                        <input type="radio" id="switch_4_1" name="association" value="0" checked/>
                                        <label for="switch_4_1">Oui</label>
                                        <input type="radio" id="switch_4_2" name="association" value="1" />
                                        <label for="switch_4_2">Non</label>
                                    </div>
                                </div>    
                                @if ($errors->has('association'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('association') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12" style="margin: 10px 0;">
                                <div class="input-group">
                                    <label style="display: inline-block;">Statut <strong class="require">*</strong></label>
                                    <div class="switch-field">
                                        <input type="radio" id="switch_5_1" name="status" value="0" checked/>
                                        <label for="switch_5_1" style="width: 200px;">Professionnel du secteur</label>
                                        <input type="radio" id="switch_5_2" name="status" value="1" />
                                        <label for="switch_5_2">Passionné(e)</label>
                                    </div>
                                </div>    
                                @if ($errors->has('association'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('association') }}
                                    </div>
                                @endif
                            </div>    
                            <div class="col-lg-12" style="margin: 10px 0;">    
                                <div class="input-group">
                                    <label class="form-control-label" style="display: inline-block;">Type <strong class="require">*</strong></label>
                                    <div id="groupType">
                                        <select id='typeList' multiple="multiple" name="type[]" style="width: 100%" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}">
                                            <option value="1">Chef d'entreprise</option>
                                            <option value="2">Salarie</option>
                                            <option value="3">Charge d'affaire</option>
                                            <option value="4">Conductuer de travaux</option>
                                            <option value="5">Ouvrier qualifie</option>
                                            <option value="6">Bureau d'etude</option>
                                            <option value="7">Apprenti</option>
                                            <option value="8">Chef d'atelier</option>
                                            <option value="9">Chef de chantier</option>
                                            <option value="10">Metreur</option>
                                            <option value="11">Chef d'equipe</option>
                                            <option value="12">Vernisseur</option>
                                            <option value="13">Technico-Commercial</option>
                                            <option value="14">Operateur machine numerique</option>
                                        </select>
                                    </div>
                                </div>    
                                @if ($errors->has('type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('type') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row groupAgree">
                        <div class="col-lg-12">
                            <div class="wrap_agree">
                                <input type="checkbox" name="agree" id="chkAgree" class="chkAgree"> 
                                <span>En cliquant sur le bouton "s'enregistrer" vous acceptez les conditions générales d'utilisation de Compagnons Du Devior</span>
                            </div>
                        </div>   
                    </div>
                    <button type="button" class="btnLogin">S'EnRegistrer</button>
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('/assets/lib/gentleSelect/jquery-gentleSelect.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#typeList').gentleSelect({ 
                title: "Choisir",
                prompt: "Choisir",
                columns: 2,
                itemWidth: 150,
                openEffect: "fade",
                openSpeed: "slow",
                // maxDisplay: 3,
                hideOnMouseOut: true
            });
        });

        $(document).on('click', '.btnLogin', function () {
            
            if ($('#chkAgree').is(":checked")) {
                $('#register').submit();
            } else {
                alert("Vous acceptez les conditions d'utilisation des Compagnons Du Devoir");
            }
        });
    </script>
@endsection