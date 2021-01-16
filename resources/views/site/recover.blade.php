<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-offline')
<!-- /HEADER AND FOOTER -->

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@stop


@section('contenido')

	<div class="shadowbox" id="registro">
	    <div class="wrapper-form wrapper-recover">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
	            <div class="formulario">
	                <h2>Recupera tu contraseña</h2>
                    <p>Ingresa tu correo electrónico y recibe un enlace para recuperar tu contraseña.</p>
	                <form action="{{ route("registro") }}" class="form" method="POST" name="form_registro">
	                    <input class="input" type="text" name="email" placeholder="Correo electrónico*" value="{{ old("email") }}">
	                    <input type="submit" class="button">
                        <p><em>*Campos requeridos</em></p>
	                </form> <!-- /form -->
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