@extends('Frontend.layout.master')

@section('styles')
    <link href="{{ asset('/assets/lib/bootstrap/bootstrap.css') }}" rel="stylesheet">
@stop

@section('title')
    {{ __ ('register.title') }}
@endsection

@section('css')
<link href="{{ asset('/assets/lib/gentleSelect/jquery-gentleSelect.css') }}" rel="stylesheet">
<style>
.registerAvatar{
    position: absolute;
    top: -160px;
    left: 160px;
    border: 2px solid #b9babb;
    /* padding: 20px 10px 0; */
}
.register-avt {
    position: absolute;
    top: -212px;
    left: 1px;
    border: 2px solid #b9babb;
    max-width: 121px;
    max-height: 141px;
    /* padding: 20px 10px 0; */
}
.registerAvatar img{
    width: 100px;
}
.register-avt .cropit-image-input {
    float: none;
}
.register-avt .cropit-image-zoom-input {
    float: none;
    width: unset;
}
.registerAvatar input{
    display: none;
}
.cropit-preview {
  /* You can specify preview size in CSS */
  width: 120px;
  height: 140px;
}
</style>
@stop

@section('content')
@php
    // user signup with social account
    $provider = $data['provider'] ?? '';
    $provider_id = $data['provider_id'] ?? '';
    $nom = $data['name'] ?? '';
    $email = $data['email'] ?? '';
    $avatar_social = $data['avatar_social'] ?? '';
    $fullname = $data['fullname'] ?? '';
    $role_id = $data['role_id'] ?? '';
    $account_id = $data['account_id'] ?? '';
    $username = $data['username'] ?? '';
    $gender   = $data['gender'] ?? '';
    $is_admin = $data['is_admin'] ?? '';
    $first_name = $data['first_name'] ?? '';
    $last_name = $data['last_name'] ?? '';
    
    // data of redirect when login with social
    if(isset($input) && array_key_exists('career', $input)) {
        if($input['career'] == '0') {
            $career = 0;
        }
        if($input['career'] == '1') {
            $career = 1;
        }
    } else { $career = null; }

    if(isset($input) && array_key_exists('civility', $input)) {
        if($input['civility'] == '0') {
            $civility = 0;
        }
        if($input['civility'] == '1') {
            $civility = 1;
        }
    } else { $civility = null; }

    if(isset($input) && array_key_exists('interested', $input)) {
        $interested = $input['interested'] == '0' ? 0 : '';
        $interested = $input['interested'] == '1' ? 1 : '';
        $interested = $input['interested'] == '2' ? 2 : '';
        $interested = $input['interested'] == '3' ? 3 : '';
    } else { $interested = null; }
    // 
    if(isset($input) && array_key_exists('association', $input)) {
        $association = $input['association'] == '0' ? 0 : '';
        $association = $input['association'] == '1' ? 1 : '';
    } else { $association = null; }
    //
    if(isset($input) && array_key_exists('status', $input)) {
        $status = $input['status'] == '0' ? 0 : '';
        $status = $input['status'] == '1' ? 1 : '';
    } else { $status = null; }
    if(isset($input) && array_key_exists('type', $input)) {
        $listType = $input['type'];
    } else { $listType = []; }
    if(isset($input) && array_key_exists('provider', $input)) {
        $provider = $input['provider'];
    }
    // provider_id
    if(isset($input) && array_key_exists('provider_id', $input)) {
        $provider_id = $input['provider_id'];
    }
    if(isset($input) && array_key_exists('nom', $input)) {
        $nom = $input['nom'];
    }
    if(isset($input) && array_key_exists('nom', $input)) {
        $nom = $input['nom'];
    }
    if(isset($input) && array_key_exists('avatar_social', $input)) {
        $avatar_social = $input['avatar_social'];
    }
    
    if(isset($input) && array_key_exists('fullname', $input)) {
        $fullname = $input['fullname'];
    }
    if(isset($input) && array_key_exists('role_id', $input)) {
        $role_id = $input['role_id'];
    }
    if(isset($input) && array_key_exists('account_id', $input)) {
        $account_id = $input['account_id'];
    }
    if(isset($input) && array_key_exists('username', $input)) {
        $username = $input['username'];
    }
    if(isset($input) && array_key_exists('gender', $input)) {
        $gender = $input['gender'];
    }
    if(isset($input) && array_key_exists('is_admin', $input)) {
        $is_admin = $input['is_admin'];
    }
@endphp
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
        {{-- <div class="col-lg-12">
            <div class="registerAvatar">
                <img src="{{asset('image/front/default-avatar.jpg')}}" class="imgAvatar" id="img_avatar">
                <input type="file" name="avatar" class="uploadAvatar" form="register" onchange="loadFile(event)">
            </div>
        </div> --}}
        
        <div class="container register-form">
            <form action="{{ route('register') }}" id="register" method="POST">
                {{ method_field("POST") }}
                {{ csrf_field() }}
                <div class="col-lg-12">
                    <div id="image-cropper" class="register-avt">
                        <div class="cropit-preview"></div>

                        <span class="icon icon-image small-image"></span>
                        <input type="range" class="cropit-image-zoom-input" />

                        <input type="file" class="cropit-image-input" name="original_image" accept="image/*" />
                        
                    </div>
                    @if ($errors->has('original_image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('original_image') }}
                        </div>
                    @endif
                </div>
                
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
                                        <input type="radio" id="switch_left" name="civility" value="0" @if (old('civility') == '0') checked @elseif($civility === 0) checked @endif />
                                        <label for="switch_left">M.</label>
                                        <input type="radio" id="switch_right" name="civility" value="1" @if (old('civility') == '1') checked @elseif($civility === 1) checked @endif />
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
                                        <input type="text"
                                            name="first_name"
                                            placeholder="Nom"
                                            class="form-control inputField {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                            value="@if($first_name) {{$first_name}} @elseif(isset($input)) {{$input['first_name']}} @else {{ old('first_name') }} @endif"
                                            required>
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
                                        <input
                                            type="text"
                                            name="last_name"
                                            placeholder="Prénom"
                                            class="form-control inputField {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                            value="@if($last_name) {{$last_name}} @elseif(isset($input)) {{$input['last_name']}} @else {{ old('last_name') }} @endif"
                                            required>
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
                                        <input type="text" 
                                                name="address"
                                                placeholder="Adresse"
                                                class="form-control inputField"
                                                value="@if(isset($input)) {{$input['address']}} @else {{ old('address') }}@endif">
                                    </div>    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Code Postal</label>
                                        <input
                                            type="text"
                                            name="postal_code"
                                            placeholder="Code Postal"
                                            class="form-control inputField"
                                            value="@if(isset($input)) {{$input['postal_code']}} @else {{ old('postal_code') }}@endif">
                                    </div>    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Pays</label>
                                        <input
                                            type="text"
                                            name="country"
                                            placeholder="Pays"
                                            class="form-control inputField"
                                            value="@if(isset($input)) {{$input['country']}} @else{{ old('country') }}@endif">
                                    </div>    
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <label class="form-control-label">Addresse e-mail <strong class="require">*</strong></label>
                                        <input
                                            type="text"
                                            name="email"
                                            placeholder="Addresse e-mail"
                                            class="form-control inputField {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            value="@if($email) {{$email}} @elseif(isset($input)) {{$input['email']}} @else {{ old('email') }} @endif"
                                            required>
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
                                        <input
                                            type="text"
                                            name="email_confirmation"
                                            placeholder="Confirmer votre adresse e-mail"
                                            class="form-control inputField {{ $errors->has('email_confirmation') ? ' is-invalid' : '' }}"
                                            value="@if($email) {{$email}} @elseif(isset($input)) {{$input['email_confirmation']}} @else {{ old('email_confirmation') }} @endif"
                                            required>
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
                                        <input type="radio"
                                            class="career"
                                            id="switch_2_left"
                                            name="career"
                                            value="0"
                                            @if(!is_null($career) && $career == 0) checked @endif />
                                        <label for="switch_2_left">Bois</label>
                                        <input type="radio"
                                            class="career"
                                            id="switch_2_right"
                                            name="career"
                                            value="1" @if(!is_null($career) && $career == 1) checked @endif />
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
                                <div class="input-group" style="display: none" id="interested_group" >
                                    <span class="headLine">Intéressé par les métiers:</span>
                                    <div class="switch-field">
                                        <input type="radio"
                                            id="switch_3_1"
                                            name="interested"
                                            value="0"
                                            @if (old('interested') == '0') checked @elseif(!is_null($interested) && $interested == 0) checked @endif />
                                        <label for="switch_3_1">Menuisier</label>
                                        <input type="radio"
                                            id="switch_3_2"
                                            name="interested"
                                            value="1"
                                            @if (old('interested') == '1') checked @elseif(!is_null($interested) && $interested == 1) checked @endif />
                                        <label for="switch_3_2">Agenceur</label>
                                        <input type="radio"
                                            id="switch_3_3"
                                            name="interested"
                                            value="2"
                                            @if (old('interested') == '2') checked @elseif(!is_null($interested) && $interested == 2) checked @endif />
                                        <label for="switch_3_3">Charpentier</label>
                                        <input type="radio"
                                            id="switch_3_4"
                                            name="interested"
                                            value="3" @if (old('interested') == '3') checked @elseif(!is_null($interested) && $interested == 3) checked @endif />
                                        <label for="switch_3_4">Constructeur Bois</label>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-lg-12" style="margin: 10px 0;">
                                <div class="input-group">
                                    <label style="display: inline-block; width: 220px">Membre de l'association des Compagnons du Deviort du Tour de France <strong class="require">*</strong></label>
                                    <div class="switch-field">
                                        <input type="radio"
                                            id="switch_4_1"
                                            name="association"
                                            value="0"
                                            @if (old('association') == '0') checked @elseif(!is_null($association) && $association == 0) checked @endif />
                                        <label for="switch_4_1">Oui</label>
                                        <input type="radio"
                                            id="switch_4_2"
                                            name="association"
                                            value="1" @if (old('association') == '1') checked @elseif(!is_null($association) && $association == 1) checked @endif />
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
                                        <input type="radio"
                                            id="switch_5_1"
                                            name="status"
                                            value="0"
                                            @if (old('status') == '0') checked @elseif(!is_null($status) && $status == 0) checked @endif />
                                        <label for="switch_5_1" style="width: 200px;">Professionnel du secteur</label>
                                        <input type="radio"
                                            id="switch_5_2"
                                            name="status"
                                            value="1" @if (old('status') == '1') checked @elseif(!is_null($status) && $status == 1) checked @endif />
                                        <label for="switch_5_2">Passionné(e)</label>
                                    </div>
                                </div>    
                                @if ($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>    
                            <div class="col-lg-12" style="margin: 10px 0;">    
                                <div class="input-group">
                                    <label class="form-control-label" style="display: inline-block;">Type <strong class="require">*</strong></label>
                                    <div id="groupType">
                                        <select id='typeList' multiple="multiple" name="type[]" style="width: 100%" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}">
                                            <option value="1" @foreach($listType as $type) @if($type == '1') selected @endif @endforeach>Chef d'entreprise</option>
                                            <option value="2" @foreach($listType as $type) @if($type == '2') selected @endif @endforeach>Salarie</option>
                                            <option value="3" @foreach($listType as $type) @if($type == '3') selected @endif @endforeach>Charge d'affaire</option>
                                            <option value="4" @foreach($listType as $type) @if($type == '4') selected @endif @endforeach>Conductuer de travaux</option>
                                            <option value="5" @foreach($listType as $type) @if($type == '5') selected @endif @endforeach>Ouvrier qualifie</option>
                                            <option value="6" @foreach($listType as $type) @if($type == '6') selected @endif @endforeach>Bureau d'etude</option>
                                            <option value="7" @foreach($listType as $type) @if($type == '7') selected @endif @endforeach>Apprenti</option>
                                            <option value="8" @foreach($listType as $type) @if($type == '8') selected @endif @endforeach>Chef d'atelier</option>
                                            <option value="9" @foreach($listType as $type) @if($type == '9') selected @endif @endforeach>Chef de chantier</option>
                                            <option value="10" @foreach($listType as $type) @if($type == '10') selected @endif @endforeach>Metreur</option>
                                            <option value="11" @foreach($listType as $type) @if($type == '11') selected @endif @endforeach>Chef d'equipe</option>
                                            <option value="12" @foreach($listType as $type) @if($type == '12') selected @endif @endforeach>Vernisseur</option>
                                            <option value="13" @foreach($listType as $type) @if($type == '13') selected @endif @endforeach>Technico-Commercial</option>
                                            <option value="14" @foreach($listType as $type) @if($type == '14') selected @endif @endforeach>Operateur machine numerique</option>
                                        </select>
                                    </div>
                                </div>    
                                @if ($errors->has('type'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('type') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12" style="margin: 10px 0;">
                                <div class="input-group">
                                    <div class="g-recaptcha" data-sitekey={!!env('RECAPTCHA_SITE_KEY')!!}></div>
                                </div>
                                <div id="html_element"></div>
                                @if ($errors->has('g-recaptcha-response'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('g-recaptcha-response') }}
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
                    <input type="hidden" name="provider" value="{{$provider}}">
                    <input type="hidden" name="provider_id" value="{{$provider_id}}">
                    <input type="hidden" name="nom" value="{{$nom}}">
                    <input type="hidden" name="avatar_social" value="{{$avatar_social}}" id="avatar_social">
                    <input type="hidden" name="fullname" value="{{$fullname}}">
                    <input type="hidden" name="role_id" value="{{$role_id}}">
                    <input type="hidden" name="account_id" value="{{$account_id}}">
                    <input type="hidden" name="username" value="{{$username}}">
                    <input type="hidden" name="gender" value="{{$gender}}">
                    <input type="hidden" name="is_admin" value="{{$is_admin}}">
                    <input type="hidden" name="image_data" class="hidden-image-data" />
                    <input type="hidden" name="image_name" class="hidden-image-name" />
                    
                    
                    <button type="button" class="btnLogin g-recaptcha"  data-callback="onSubmit">S'EnRegistrer</button>
                </div>
            </form>    
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('/assets/lib/gentleSelect/jquery-gentleSelect.js') }}"></script>
    <script src="{{ asset('/js/plugins/jquery.cropit.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl={{ app()->getLocale() }}' async defer>
    </script>
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

            if($('#switch_2_left').is(':checked')) {
                $('#interested_group').show();
            }
            let imageSrc = $('#avatar_social').val();
            
            $('#image-cropper').cropit({
                'minZoom': 2,
                'allowDragNDrop': false,
                'smallImage': 'allow',
                imageState: {src: imageSrc}
            });

        });

        $(document).on('click', '.btnLogin', function () {

            if ($('#chkAgree').is(":checked")) {
                $('#register').submit();
            } else {
                alert("Vous acceptez les conditions d'utilisation des Compagnons Du Devoir");
            }
            
        });

        $(document).on('click', '.career', function () {

            if ($(this).val() == 0) {
                $('#interested_group').show();
            } else {
                $('#interested_group').hide();
            }
        });
        
        $('form#register').submit(function() {
            // Move cropped image data to hidden input
            let imageData = $('#image-cropper').cropit('export');
            $('.hidden-image-data').val(imageData);
            
            // Prevent the form from actually submitting
            return true;
        });
        function onSubmit(token) {
            document.getElementById("register").submit();
        }
        const SITE_KEY = '{{ env('RECAPTCHA_SITE_KEY') }}';
        var onloadCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey' : SITE_KEY
            });
        };
    </script>
@endsection