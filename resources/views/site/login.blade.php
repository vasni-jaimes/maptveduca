<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-offline')
<!-- /HEADER AND FOOTER -->



@section('contenido')
	
	<div class="shadowbox" id="login">
	    <div class="wrapper-form">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
	            <div class="formulario">

	            	@if ($errors->any())
					    <div class="alert alert-danger" style="background:red">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif


	                <h2>¡Bienvenido de nuevo!</h2>
	                <form action="{{ route("send.login") }}" class="form" method="POST" name="form_login">
	                	@csrf
	                    <input class="input" type="text" name="email" placeholder="Correo electrónico" value="{{ old("email") }}">
	                    <input class="input" type="password" name="password" placeholder="Contraseña">
	                    <input type="submit" class="button">
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
@stop