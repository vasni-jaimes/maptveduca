<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-offline')
<!-- /HEADER AND FOOTER -->

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@stop


@section('contenido')

	<div class="shadowbox" id="registro">
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

	                <h2>Regístrate gratis y explora un poco</h2>
	                <form action="{{ route("registro") }}" class="form" method="POST" name="form_registro">
	                	@csrf
	                    <div>
	                        <input class="input" type="text" name="nombre" placeholder="Nombre(s)*" value="{{ old("nombre") }}">
	                        <input class="input" type="text" name="apaterno" placeholder="Apellido Paterno*" value="{{ old("apaterno") }}">
	                    </div>
	                    <div>
	                        <input class="input" type="text" name="amaterno" placeholder="Apellido materno*" value="{{ old("amaterno") }}">
	                        <input class="input datepicker" type="text" name="fecha_nacimiento" data-date-format="yyyy-mm-dd" placeholder="Fecha de nacimiento" value="{{ old("fecha_nacimiento") }}">
	                    </div>
	                    <input class="input" type="text" name="email" placeholder="Correo electrónico*" value="{{ old("email") }}">
	                    <div>
	                        <input class="input" type="password" name="password" placeholder="Contraseña*">
	                        <input class="input" type="password" name="password_confirmation" placeholder="Repetir contraseña">
	                    </div>
	                    <input type="submit" class="button">
                        <p><em>*Campos requeridos</em></p>
	                </form> <!-- /form -->
	                <ul class="flex">
	                    <li>¿Ya eres miembro?</li>
	                    <li><a href="{{ route("login") }}">Inicia sesión aquí</a></li>
	                </ul> <!-- /flex -->
	                <div class="row-terminos">
	                    <p>Al registrarte estás aceptando lo estipulado en nuestros</p>
	                    <ul>
	                        <li><a href="#">Términos y Condiciones de Uso</a> y <a href="#">Aviso de privacidad</a></li>
	                    </ul> <!-- /flex -->
	                </div> <!-- /row-terminos -->
	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->
	</div> <!-- /shadowbox -->

@stop


@section('js-content')
	<!-- Data picker -->
   	<script src="/admini/js/plugins/datapicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
		
		var mem = $('.datepicker').datepicker({
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

	</script>
	<script type="text/javascript" src="/site/js/app.js"></script>
@stop