<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')


    <div class="shadowbox" id="registro">

	    <div class="wrapper-form wrapper-checkout">
	        <div>
	            <img class="logo" src="/site/img/logo.png">
                @if ($membresia->id == 2)
    	            <div class="formulario membresia-basica">

    	                <h2>Te damos la bienvenida a la familia MAPtv Educa.</h2>

                        <form action="{{ route('paago-membresia', $membresia->slug) }}" class="form-checkout" method="GET">
                            @csrf

                            @if ($status)
                                @if ($status->status == 1)
                                    <div>
                                        <label>Selecciona el programa que deseas cursar</label><br>
                                        <select class="input" name="carrera">
                                           @foreach($membresia->carreras as $carreras)
                                                <option value="{{ $carreras->id }}" selected> {{ $carreras->nombre }} </option>
                                           @endforeach
                                        </select>
                                    </div><br>
                                    
                                    <p>El costo de esta membresía es de:</p>
                                    <p><small>Cantidades en pesos mexicanos</small></p><br>
                                    <p><strong>${{ number_format($membresia->precio, 2) }} mensuales</strong></p>
                                    <p><small>hasta concluir tus estudios o solicitar una cancelación</small></p><br>

                                    <button style="cursor: pointer;">
                                        <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
                                    </button><br><br>
                                    
                                    <p class="small">Una vez que envíes tus datos, recibirás un correo electrónico de bienvenida con instrucciones para empezar a estudiar.</p>
                                    <p class="small">Si tienes alguna duda, por favor comunícate con nosotros a <a href="mailto:maptveduca.info@gmail.com">maptveduca.info@gmail.com</a></p>
                                @elseif ($status->status == 2)
                                    <h2> Los pagos se habilitarán próximamente </h2>
                                @elseif ($status->status == 3)
                                    @if ($fechas)
                                        <div>
                                            <label>Selecciona el programa que deseas cursar</label><br>
                                            <select class="input" name="carrera">
                                               @foreach($membresia->carreras as $carreras)
                                                    <option value="{{ $carreras->id }}" selected> {{ $carreras->nombre }} </option>
                                               @endforeach
                                            </select>
                                        </div><br>
                                        
                                        <p>El costo de esta membresía es de:</p>
                                        <p><small>Cantidades en pesos mexicanos</small></p><br>
                                        <p><strong>${{ number_format($membresia->precio, 2) }} mensuales</strong></p>
                                        <p><small>hasta concluir tus estudios o solicitar una cancelación</small></p><br>

                                        <button style="cursor: pointer;">
                                            <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
                                        </button><br><br>
                                        
                                        <p class="small">Una vez que envíes tus datos, recibirás un correo electrónico de bienvenida con instrucciones para empezar a estudiar.</p>
                                        <p class="small">Si tienes alguna duda, por favor comunícate con nosotros a <a href="mailto:maptveduca.info@gmail.com">maptveduca.info@gmail.com</a></p>
                                    @else
                                         <h2> Los pagos se habilitarán en el siguiente periodo: </h2>
                                         <p> {!! "del: ".Carbon::parse($status->fecha_inicio)->format('d-m-Y'). "<br> al: ".Carbon::parse($status->fecha_fin)->format('d-m-Y') !!} </p>
                                    @endif
                                @endif
                            @else
                                <h2> Los pagos se habilitarán próximamente </h2>
                            @endif


                            @if (session()->has("error"))
                                <div class="error" style="color: red; margin-top: 20px;">
                                    {{ session()->get("error") }}
                                </div>
                            @endif

                        </form>
                        
    	                <div class="row-terminos">
    	                    <p>Al registrarte estás aceptando lo estipulado en nuestros</p>
    	                    <ul>
    	                        <li><a href="#">Términos y Condiciones de Uso</a> y <a href="#">Aviso de privacidad</a></li>
    	                    </ul> <!-- /flex -->
    	                </div> <!-- /row-terminos -->
    	            </div> <!-- /formulario -->
                @else
                    <div class="formulario membresia-basica">

                        <h2>¡Únete a la familia<br> MAPtv Educa!</h2>
    	                <p>Comienza hoy tu camino en la produccion musical.</p>

                        <p>EL costo de la membresia básica (suscripción) es de:</p>
                        <h2>$250.00 MXM mensuales</h2>
                        <p>puedes cancelar tu membresia en cualquier momento</p>

                        <h3>Obtén tu prueba gratuita por 30 días</h3>
                        <p>Después de finalizado tu periodo gratuito comenzará a cobrarse la suscripción mensual.</p>

                        <form action="{{ route('paago-membresia', $membresia->slug) }}" class="form-checkout basica" method="GET" name="">
                            <button style="cursor: pointer;">
                                <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
                            </button>

                            @if (session()->has("error"))
                                <div class="error" style="color: red; margin-top: 20px;">
                                    {{ session()->get("error") }}
                                </div>
                            @endif
                            
                        </form>
                        
    	                <div class="row-terminos">
    	                    <p>Al registrarte estás aceptando lo estipulado en nuestros</p>
    	                    <ul>
    	                        <li><a href="#">Términos y Condiciones de Uso</a> y <a href="#">Aviso de privacidad</a></li>
    	                    </ul> <!-- /flex -->
    	                </div> <!-- /row-terminos -->
    	            </div> <!-- /formulario -->
                @endif
	        </div>
	    </div> <!-- /wrapper-form -->

	</div> <!-- /shadowbox -->



    <!-- LOADING -->
    <div class="shadow-favorito" id="loading" style="z-index: 9999">
        <div class="f-shadow">
            <img src="/site/img/musica.gif">
        </div> <!-- /f-favorito -->
    </div> <!-- /shadow-favorito -->

@stop


@section('js-content')
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop