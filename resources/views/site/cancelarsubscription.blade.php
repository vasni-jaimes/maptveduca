<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')


    <div class="shadowbox" id="registro">

	    <div class="wrapper-form wrapper-checkout">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
                
    	            <div class="formulario membresia-basica">

    	                <h2>¡Se Cancelo con exito!</h2>
                        <p>Se cancelo tu Membresia con exíto, esperamos que vuelvas pronto.</p>
                        <p><small>¿Tienes preguntas? <a href="{{ route('faqs') }}">Escríbenos</a> y te atenderemos lo antes posible.</small></p>
                        <a class="btn-amarillo" href="{{ route('micuenta.index') }}">Ir a mi Tablero Personal</a>

    	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->

	</div> <!-- /shadowbox -->

@stop