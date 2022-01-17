roust<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')


    <div class="shadowbox" id="registro">

	    <div class="wrapper-form wrapper-checkout">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
                
    	            <div class="formulario membresia-basica">

    	                <h2>Suscriopcion para membresia basica.</h2>
                        <p> Suscribete desde este link y se te otorgara un descuento de 1 semestre completo,<br> solo puede ser para tu usuario a si que no compartas este link. </p>
                        <p><small>¿Tienes preguntas? <a href="mailto:maptveduca.info@gmail.com">Escríbenos</a> y te atenderemos lo antes posible.</small></p>
                        <br>

                        <form action="{{ route('paago-membresia', 'membresia-basica') }}" class="form-checkout" method="GET">
                            @csrf
                            <input type="hidden" name="promocion" value="1" />
	                        <button style="cursor: pointer;">
	                            <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
	                        </button><br><br>
	                    </form>

    	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->

	</div> <!-- /shadowbox -->

@stop