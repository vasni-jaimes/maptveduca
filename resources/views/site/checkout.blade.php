<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <div class="shadowbox" id="registro">
	    <div class="wrapper-form wrapper-checkout">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
	            <div class="formulario">

	                <h2>Te damos la bienvenida a la familia MAPtv Educa.</h2>
                    
	                <form action="" class="form-checkout" method="POST" name="">
	                	
                        <input type="submit" class="button" value="Enviar">
	                    
	                </form> <!-- /form -->
                    
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