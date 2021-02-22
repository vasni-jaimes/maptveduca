<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-offline')
<!-- /HEADER AND FOOTER -->

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/bootstrap.min.css" rel="stylesheet">
@stop


@section('contenido')

	<div class="shadowbox" id="registro">
	    <div class="wrapper-form wrapper-recover">
	        <div>
	            <img class="logo" src="/site/img/logo.png">

	            @if (session()->has('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('status') }}
                    </div>
                @endif

	            <div class="formulario">
	                <h2>Recupera tu contraseña</h2>
                    <p>Ingresa tu correo electrónico y recibe un enlace para recuperar tu contraseña.</p>
	                <form action="{{ route('password.email') }}" class="form" method="POST">
	                	@csrf
	                    <input class="input" type="text" name="email" placeholder="Correo electrónico*" value="{{ old("email") }}">

	                    @error('email')
                            <p class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </p>
                        @enderror

	                    <input type="submit" class="button">
                        <p><em>*Campos requeridos</em></p>
	                </form> <!-- /form -->
	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

@stop


@section('js-content')
	<script type="text/javascript" src="/site/js/app.js"></script>
@stop