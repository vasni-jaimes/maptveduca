<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')


    <div class="shadowbox" id="registro">

	    <div class="wrapper-form wrapper-checkout">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
                
    	            <div class="formulario membresia-basica">

    	            	@if (auth()->user()->promocion == 1)
    	            		<h2>Lo sentimos :( !</h2>
    	            		<p> Hola {{ auth()->user()->nombre }}, ya cuentas con esta promoción, ya no es posible volver adquirirla, <br> si tienes algun problema o no tuviste tu promocion, contactanos</p>
    	            		<br>
    	            		<p><small>¿Tienes preguntas? <a href="mailto:maptveduca.info@gmail.com">Escríbenos</a> y te atenderemos lo antes posible.</small>
    	            	@else

	    	                <h2>Suscripción para membresía básica.</h2>
	                        <p> Este es un link exclusivo para la comunidad de Colegio MAP. </p><br>
	                        <p>Suscríbete desde este enlace y obtendrás un periodo gratuito equivalente a la duración del semestre Enero-Junio 2022.<br>Esta promoción es exclusiva para alumnos previamente inscritos a Colegio MAP, por lo que te pedimos que no compartas este link a nadie más</p><br>

	                        <p><small>¿Tienes preguntas? Escríbenos. <a href="mailto:maptveduca.info@gmail.com">Escríbenos</a> y te atenderemos lo antes posible.</small></p>
	                        <br>

	                        <form action="{{ route('paago-membresia', 'membresia-basica') }}" class="form-checkout" method="GET">
	                            @csrf
	                            <input type="hidden" name="promocion" value="1" />
		                        <button style="cursor: pointer;">
		                            <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
		                        </button><br><br>
	                    	</form>

	                    @endif

    	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->

	</div> <!-- /shadowbox -->

@stop