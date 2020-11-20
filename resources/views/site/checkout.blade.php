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
                        
    	               {{--  <form action="" class="form-checkout" method="POST" name="">
    	                	
                            <div class="flex between">
                                <fieldset class="columna">
                                    <div>
                                        <label>Nombre completo</label>
                                        <input type="text" class="input">
                                        <p>Este es el nombre que quedará registrado en tu boleta y certificado oficial. Asegúrate de escribirlo tal cual está en tus documentos oficiales de identificación.</p>
                                    </div>
                                    <div>
                                        <label>Programa de estudios</label>
                                        <select class="input">
                                            <option value="Técnico Profesional en Producción Musical">Técnico Profesional en Producción Musical</option>
                                        </select>
                                    </div>
                                </fieldset>
                                <fieldset class="columna">
                                    <div>
                                        <label>Nombre en la tarjeta</label>
                                        <input type="text" class="input">
                                    </div>
                                    <div>
                                        <label>Número de tarjeta</label>
                                        <input type="text" class="input">
                                    </div>
                                    <div class="flex between">
                                        <div>
                                            <label>Vencimiento</label>
                                            <input type="text" placeholder="12/34" class="input">
                                        </div>
                                        <div>
                                            <label>CVV</label>
                                            <input type="text" placeholder="***" class="input">
                                        </div>
                                    </div>
                                    <p>Recuerda que los cargos se realizarán de manera automática. Puedes revisar y editar esta información en tu tablero personal. </p>
                                </fieldset>
                            </div> <!-- /flex -->
                            
                            <div>
                                <fieldset>
                                    <label>Domicilio</label>
                                    <div class="flex between">
                                        <input type="text" class="input first" placeholder="Calle">
                                        <input type="text" class="input" placeholder="Número exterior">
                                        <input type="text" class="input" placeholder="Número interior">
                                    </div> <!-- /flex -->
                                    <div class="flex between">
                                        <input type="text" class="input" placeholder="Colonia, barrio, fraccionamiento">
                                        <input type="text" class="input" placeholder="Código postal">
                                        <input type="text" class="input" placeholder="Ciudad">
                                    </div> <!-- /flex -->
                                    <div class="flex between">
                                        <input type="text" class="input" placeholder="Estado">
                                        <input type="text" class="input" placeholder="País">
                                    </div> <!-- /flex -->
                                    <p>Una vez envíes tus datos, un miembro de nuestro equipo dará seguimiento a tu inscripción y recibirás la información necesaria para iniciar tus estudios. Nosotros nos encargamos del resto</p>
                                </fieldset>
                            </div>
                            
                            <input type="submit" class="button" value="Enviar">
    	                </form> --}} <!-- /form -->

                        <form action="{{ route('paago-membresia', $membresia->slug) }}" class="form-checkout" method="GET">
                            @csrf
                            <div>
                                <label>Programa de estudios</label><br>
                                <select class="input" name="carrera">
                                   <option value=""> Carreras </option>
                                   @foreach($membresia->carreras as $carreras)
                                        <option value="{{ $carreras->id }}"> {{ $carreras->nombre }} </option>
                                   @endforeach
                                </select>
                            </div><br>
                            <button>
                                <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
                            </button>

                        </form>
                        
    	                <div class="row-terminos">
    	                    <p>Al registrarte estás aceptando lo estipulado en nuestros</p>
    	                    <ul>
    	                        <li><a href="#">Términos y Condiciones de Uso</a> y <a href="#">Aviso de privacidad</a></li>
    	                    </ul> <!-- /flex -->
    	                </div> <!-- /row-terminos -->
    	            </div> <!-- /formulario -->
                @else
                    <div class="formulario membresia-academica">

    	                <h2>Te damos la bienvenida a la familia MAPtv Educa.</h2>
                        
    	                {{-- <form action="" class="form-checkout basica" method="POST" name="">
    	                	
                            <div class="flex between">
                                <fieldset class="columna">
                                    <h3>MEMBRESÍA BÁSICA</h3>
                                    <div>
                                        <label>Nombre en la tarjeta</label>
                                        <input type="text" class="input">
                                    </div>
                                    <div>
                                        <label>Número de tarjeta</label>
                                        <input type="text" class="input">
                                    </div>
                                    <div class="flex between">
                                        <div>
                                            <label>Vencimiento</label>
                                            <input type="text" placeholder="12/34" class="input">
                                        </div>
                                        <div>
                                            <label>CVV</label>
                                            <input type="text" placeholder="" class="input">
                                        </div>
                                    </div>
                                    <p>Recuerda que los cargos se realizarán de manera automática. Puedes revisar y editar esta información en tu tablero personal. </p>
                                </fieldset>
                            </div> <!-- /flex -->
                            
                            <div>
                                <fieldset>
                                    <label>Domicilio</label>
                                    <div class="flex between">
                                        <input type="text" class="input first" placeholder="Calle">
                                        <input type="text" class="input" placeholder="Número exterior">
                                        <input type="text" class="input" placeholder="Número interior">
                                    </div> <!-- /flex -->
                                    <div class="flex between">
                                        <input type="text" class="input" placeholder="Colonia, barrio, fraccionamiento">
                                        <input type="text" class="input" placeholder="Código postal">
                                        <input type="text" class="input" placeholder="Ciudad">
                                    </div> <!-- /flex -->
                                    <div class="flex between">
                                        <input type="text" class="input" placeholder="Estado">
                                        <input type="text" class="input" placeholder="País">
                                    </div> <!-- /flex -->
                                    <p>Una vez envíes tus datos, un miembro de nuestro equipo dará seguimiento a tu inscripción y recibirás la información necesaria para iniciar tus estudios. Nosotros nos encargamos del resto</p>
                                </fieldset>
                            </div>
                            
                            <input type="submit" class="button" value="Enviar">    
    	                </form> <!-- /form --> --}}

                        <form action="{{ route('paago-membresia', $membresia->slug) }}" class="form-checkout basica" method="GET" name="">
                            <button>
                                <img src="https://www.paypalobjects.com/marketing/web/mx/logos-buttons/Paga-con-yellow_227x44.png" alt="Check out with PayPal" />
                            </button>
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



        @if (session()->has("error"))
            <div class="error">
                {{ session()->get("error") }}
            </div>
        @endif

	</div> <!-- /shadowbox -->

@stop