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
	        
	        <div class="row-registro">
	            <p>¿Quieres conocer el sitio antes de decidir?</p>
	            <a class="btn-amarillo" href="{{ route("registro.show") }}">Regístrate gratis</a>
	        </div> <!-- /row-registro -->
            
	    </div> <!-- /hoja-1000 -->
	    
	</section> <!-- /wrapper-academica -->

@stop