<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')


    <div class="shadowbox" id="registro">

	    <div class="wrapper-form wrapper-checkout">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
                
    	            <div class="formulario membresia-basica">

    	                <h2>Sentimos mucho que tengas que irte.</h2>
                        {{-- <p>Por favor compártenos la razón por la cual deseas cancelar tu membresía.</p> --}}

                        {{-- <form>
                            <textarea></textarea>
                        </form> --}}

                        <p>Si cancelas ahora podrás seguir teniendo acceso a la plataforma hasta que
                            caduque tu periodo pagado. Podrás reactivar tu membresía académica en cualquier

                            momento desde tu Tablero Personal.</p>

                        <p>Recuerda estar al pendiente de las fechas de inicio de trimestre para aprovechar

                            los beneficios de la membresía académica.</p>

                        <p>¡Esperamos volver a verte pronto!</p>

                        <a class="btn-amarillo" href="{{ route('cancelar-subscripcion', auth()->user()->suscripcion_id) }}">Cancelar membresía</a>

    	            </div> <!-- /formulario -->
	        </div>
	    </div> <!-- /wrapper-form -->

	</div> <!-- /shadowbox -->

@stop