<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-offline')
<!-- /HEADER AND FOOTER -->



@section('contenido')

	<header>
	    <div class="hoja-900">
	        <div class="flex flex-header between flex-center">
	            <img class="logo" src="/site/img/logo.png">
	            <a href="{{ route('login') }}">Inicia sesión</a>
	        </div> <!-- /flex -->
	    </div> <!-- /hoja-900 -->
	</header>

	<section class="video-home">
	    <video autoplay="true" muted="" loop="" id="myVideo">
	        <source src="/site/video-sitio.mp4" type="video/mp4">
	    </video>
	    <div class="txt-video">
	        <div class="hoja-900">
	            <h1>Cursos virtuales de música y producción musical</h1>
	            <p>Un proyecto de <span class="amarillo">MAP Colegio de Música, Audio y Producción</span></p>
	            <a class="btn-amarillo" href="{{ route("registro.show") }}">Regístrate gratis</a>
	        </div> <!-- /hoja-900 -->
	    </div> <!-- /txt-video -->
	</section> <!-- /video-home -->
	    
	<section class="wrapper-contenido">
	    
	    <div class="hoja-1000">
	        
	        <h2>¿Qué hay en MAPtv Educa?</h2>
	        <div class="banner-contenido">
	            <h3>Carrera técnica en producción musical</h3>
	        </div> <!-- /banner-contenido -->
	        <div class="lista-contenido">
	            <div class="item-lista">
	                <div class="img-lista" style="background-image: url('/site/img/sitio/guitarra.jpg');"></div> <!-- /img-lista -->
	                <p>Cursos de producción</p>
	                <p>musical y música</p>
	            </div> <!-- /item-lista -->
	            <div class="item-lista">
	                <div class="img-lista" style="background-image: url('/site/img/sitio/clases-en-linea.jpg');"></div> <!-- /img-lista -->
	                <p>Clases en vivo de producción</p>
	                <p>musical y música</p>
	            </div> <!-- /item-lista -->
	            <div class="item-lista">
	                <div class="img-lista" style="background-image: url('/site/img/sitio/masterclasses.jpg');"></div> <!-- /img-lista -->
	                <p>Clínicas, conciertos </p>
	                <p>y masterclasses</p>
	            </div> <!-- /item-lista -->
	        </div> <!-- /lista-contenido -->
	    </div> <!-- /hoja-1200 -->
	    
	</section> <!-- /wrapper-contenido -->
	    
	<section class="wrapper-profesores">
	    <div class="hoja-1000">
	        <h2>¿Qué profesores están en MAPtv Educa?</h2>
	        <ul class="slide">

	        	@foreach($instructores as $instructor)

	        		<li>
		                <div class="img-slide" style="background-image: url({{Storage::url($instructor->img) }});"></div> <!-- /img-slide -->
		                <p> {{ $instructor->nombres." ".$instructor->apellidos }} </p>
		                <p>{{ $instructor->especialidad }}</p>
		            </li>

	        	@endforeach

	            {{-- <li>
	                <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> /img-slide
	                <p>Profr. Fulano</p>
	                <p>Especialidad</p>
	            </li> --}}
	        
	        </ul>
	    </div> <!-- /hoja-1200 -->
	    
	</section> <!-- /wrapper-profesores -->

    <!--<section class="wrapper-eventos">
        
        <div class="hoja-1000">

            <h2>Eventos</h2>
            
            <ul class="slide">

	        	@foreach($instructores as $instructor)

	        		<li>
		                <div class="img-slide" style="background-image: url({{Storage::url($instructor->img) }});"></div> <!-- /img-slide
		            </li>

	        	@endforeach
	        
	        </ul>
            
        </div> <!-- /hoja-1000
        
    </section>-->
	    
	<section class="wrapper-academica">
	    
	    <div class="hoja-800">
	        <h2>¿Cómo funciona?</h2>
	        <p>MAPtv Educa es una plataforma de apoyo a los estudiantes y profesores de latinoamérica que quieren hacer una diferencia en la industria musical. Cuidamos la calidad de contenido que merecen nuestros usuarios y lo mantenemos actualizado para brindar la mejor experiencia.</p>
	        <p>Es por esto que, con tu ayuda, podemos seguir manteniendo activa esta plataforma y brindándote la experiencia de grandes exponentes de la industria musical latina.</p>
	        <!--<p>Conoce las formas en las que nos ayudas a funcionar:</p>-->
	        <table>
	            <tr>
	                <th>&nbsp</th>
	                <!--<th>Membresía básica</th>-->
	                <th>Membresía académica <span>Estudia la carrera técnica en Producción Musical</span></th>
	            </tr>
	            <tr>
	                <td>Material audiovisual de estudio</td>
	                <!--<td><span class="circle"></span></td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr>
	                <td>Acceso a eventos virtuales básicos</td>
	                <!--<td><span class="circle"></span></td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr>
	                <td>Acceso a clínicas y conciertos/masterclass básicas</td>
	                <!--<td><span class="circle"></span></td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr>
	                <td>Carrera técnica con reconocimiento oficial SEP</td>
	                <!--<td>&nbsp</td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr>
	                <td>Acceso a aulas virtuales</td>
	                <!--<td>&nbsp</td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr>
	                <td>Retroalimentación y sesiones en vivo de profesores titulares</td>
	                <!--<td>&nbsp</td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr>
	                <td>Certificado con validez oficial</td>
	                <!--<td>&nbsp</td>-->
	                <td><span class="circle"></span></td>
	            </tr>
                <tr>
	                <td>Modalidad trimestral de estudio</td>
	                <!--<td>&nbsp</td>-->
	                <td><span class="circle"></span></td>
	            </tr>
	            <tr class="last-tr">
	                <td class="last-td">&nbsp</td>
	                <!--<td class="last-td"><span>$123 MXN mensuales</span><a href="#" class="bg-amarillo">Prueba gratuita por 30 días</a></td>-->
	                <td class="last-td"><span>$2,000 MXN mensuales<br>en modalidad trimestral</span></td>
	            </tr>
	        </table>
	        
            <div class="txt-inicio">
                <p><strong>Inicio de trimestre:</strong> {{ $adminFecha->inicio_trimestre }} <span>¡Inscríbete hoy!</span></p>
            </div> <!-- /txt-inicio -->
            
	        <div class="row-registro">
	            <p>¿Quieres conocer el sitio antes de decidir?</p>
	            <a class="btn-amarillo" href="{{ route("registro.show") }}">Regístrate gratis</a>
	        </div> <!-- /row-registro -->

	        <div class="banner-title bg-black">
                <h2>Contacto</h2>
            </div> <!-- /bg-black -->
            
            <div class="wrapper-maptv">
                
                <div class="row-form">
                    
                    <form action="{{ route('contacto.store') }}" class="form-contacto form" method="POST" name="contacto">
                        @csrf
                        <div>
                            <input class="input" name="nombre" type="text" placeholder="Nombre" value="{{ old('nombre') }}">
                            {{-- <span class='form-text m-b-none errors'> {!! $errors->first('nombre') !!} </span> --}}
                            <input class="input" name="email" type="text" placeholder="Correo electrónico" value="{{ old('email') }}">
                            {{-- <span class='form-text m-b-none errors'> {!! $errors->first('email') !!} </span> --}}
                        </div>
                        <div>
                            <input class="input" name="ciudad" type="text" placeholder="Ciudad" value="{{ old('ciudad') }}">
                            {{-- <span class='form-text m-b-none errors'> {!! $errors->first('ciudad') !!} </span> --}}
                            <input class="input" name="pais" type="text" placeholder="País" value="{{ old('pais') }}">
                            {{-- <span class='form-text m-b-none errors'> {!! $errors->first('pais') !!} </span> --}}
                        </div>
                        <div class="textarea">
                            <label>Mensaje</label>
                            <textarea placeholder="" name="mensaje">{{ old('mensaje') }}</textarea>
                            {{-- <span class='form-text m-b-none errors'> {!! $errors->first('mensaje') !!} </span> --}}
                        </div>
                        <br>

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}


                        <div class="hs-button">
                            <input type="submit" class="button enviar-mensaje">
                        </div>
                    </form>
                    
                </div> <!-- /row-maptv -->
            
            </div> <!-- /wrapper-maptv -->
            
	    </div> <!-- /hoja-1000 -->
	    
	</section> <!-- /wrapper-academica -->


	<!-- LOADING -->
    <div class="shadow-favorito" id="loading" style="z-index: 9999">
        <div class="f-shadow">
            <img src="/site/img/musica.gif">
        </div> <!-- /f-favorito -->
    </div> <!-- /shadow-favorito -->


    @if (session()->has("status.newContacto") || $errors->any())
        @if (session()->get("status.newContacto") == "error" || $errors->any())
            <!-- exito -->
            <div class="shadow-favorito" id="shadow-exito" style="display: block;">
                <div class="f-shadow">
                    <div class="s-favorito">
                        <div class="close-shadow"></div> <!-- /close-shadow -->
                        <p>Ocurrio un error, intentelo más tarde</p>
                        <ul>
                            <li><a href="#" class="ok_favoritos-micuenta">OK</a></li>
                        </ul>
                    </div> <!-- /s-favorito -->
                </div> <!-- /f-favorito -->
            </div> <!-- /shadow-favorito -->
        @else
            <!-- exito -->
            <div class="shadow-favorito" id="shadow-exito" style="display: block;">
                <div class="f-shadow">
                    <div class="s-favorito">
                        <div class="close-shadow"></div> <!-- /close-shadow -->
                        <p>Se mando tu mensaje correctamente</p>
                        <ul>
                            <li><a href="#" class="ok_favoritos-micuenta">OK</a></li>
                        </ul>
                    </div> <!-- /s-favorito -->
                </div> <!-- /f-favorito -->
            </div> <!-- /shadow-favorito -->
        @endif
    @endif



    @section('js-content')
        <script type="text/javascript" src="/site/js/app.js"></script>
    @stop

@stop