<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-offline')
<!-- /HEADER AND FOOTER -->


@section('scripts-header_content')
	<script type="text/javascript">
		var onloadCallback = function() {
			grecaptcha.render('g-recaptcha', {
				'sitekey' : '6Ld54ywpAAAAAOLWVxqRwZJLNM_B4yJromReFWIG'
			});
		};
	</script>
@endsection

@section('contenido')
	
	<div class="shadowbox" id="login">
	    <div class="wrapper-form">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
	            <div class="formulario">
	                <h2>¡Bienvenido de nuevo!</h2>
	                <form action="{{ route("send.login") }}" class="form" method="POST" name="form_login">
	                	@csrf
	                    <input class="input" type="text" name="email" placeholder="Correo electrónico*" value="{{ old("email") }}">
	                    <input class="input" type="password" name="password" placeholder="Contraseña*">

						<div class="re-captcha-content">
						 	<div id="g-recaptcha"></div>
						</div>

						@foreach ($errors->all() as $error)
				            <p class="error_login"> {{ $error }} </p>
				        @endforeach

                        <a href="{{ route('recover') }}">¿Olvidaste tu contraseña?</a>
	                    <input type="submit" class="button">
                        <p><em>*Campos requeridos</em></p>
	                </form> <!-- /form -->
	                <ul class="flex">
	                    <li>¿Aún no eres miembro?</li>
	                    <li><a href="{{ route("registro.show") }}">Regístrate gratis aquí</a></li>
	                </ul> <!-- /flex -->
	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

@stop

@section('js-content')
	<script type="text/javascript" src="/site/js/app.js"></script>
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
@stop