<!DOCTYPE html>
<html>
	<head>
		<title>@yield('titulo', 'Maptveduca')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">  
		<link rel="stylesheet" href="/site/css/style.css">
		<link rel="stylesheet" type="text/css" href="/site/js/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="/site/js/stacktable/stacktable.css"/> 
		<link rel="stylesheet" type="text/css" href="/site/js/mmenu/mmenu.css"/>
		@yield("css-content")
		<link rel="icon" href="/site/img/favicon.png" type="image/gif" sizes="64x64">
	    
	</head>

	<body>
		<div class="page">
			@yield('contenido')

			<footer>
				<div class="hoja-1000">
                    <div class="flex between">
                        <div class="flex-footer">
                            <div class="flex">
                                <ul>
                                    <!--<li><a href="#">Membresía Básica</a></li>-->
                                    <li><a href="{{ route("membresias.index") }}">Membresía Académica</a></li>
                                    <!--<li><a href="#">Guías de estudio</a></li>-->
                                </ul>
                                <ul>
                                    <li><a href="{{ route("cursos") }}">Cursos</a></li>
                                    <li><a href="{{ route("clases-linea.index") }}">Clases en línea</a></li>
                                    <li><a href="{{ route("eventos.index") }}">Eventos</a></li>
                                </ul>
                            </div>
                            <div class="flex">
                                <ul>
                                    <li><a href="{{ route("faqs") }}">FAQ/Contacto</a></li>
                                    <!--<li><a href="#">Contacto</a></li>-->
                                </ul>
                                <ul>
                                    <li><a href="{{ route("nosotros.index") }}">Nosotros</a></li>
                                    <!--<li><a href="#">Colegio MAP</a></li>-->
                                </ul>
                            </div>
                        </div> <!-- /flex -->
                        <div class="row-redes flex flex-column">
                            <ul class="flex-redes end">
                                <li><a href="https://www.facebook.com/maptveduca" target="_blank"><img src="/site/img/facebook.png"></a></li>
                                <li><a href="https://www.instagram.com/maptveduca/" target="_blank"><img src="/site/img/instagram.png"></a></li>
                                <li><a href="https://www.youtube.com/c/MAPtvMéxico" target="_blank"><img src="/site/img/youtube.png"></a></li>
                            </ul> <!-- /flex -->
                            <a class="btn-footer" href="#">Estudia presencialmente con nosotros en Colegio MAP (Puebla, Puebla, México)</a>
                        </div> <!-- /row-redes -->
                    </div> <!-- /flex -->
                    <div class="row-copyright">
                        <div class="flex between">
                            <p>2020  MAPtv Educa. Todos los derechos reservados</p>
                            <ul class="flex">
                                <li><a href="{{ route("privacidad") }}">Aviso de Privacidad</a></li>
                                <li>/</li>
                                <li><a href="{{ route("terminos") }}">Términos y Condiciones</a></li>
                            </ul> <!-- /flex -->
                        </div> <!-- /flex -->
                    </div> <!-- /row-copyright -->
   				</div> <!-- /hoja-1000 -->
			</footer>
		</div> <!-- /page --> 

		<nav id="menu">
		    <ul class="flex between menu">
		        <li><a href="#">Inicio</a></li>
		        <li><a href="#">Cursos</a></li>
		        <li><a href="#">Membresías</a></li>
		        <li><a href="#">Clases en línea</a></li>
		        <li><a href="#">Eventos</a></li>
		        <li><a href="#">Nosotros</a></li>
		        <li><a href="#">FAQ/Contacto</a></li>
		    </ul>
		</nav>

		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="/site/js/global.js"></script>
		<script type="text/javascript" src="/site/js/stacktable/stacktable.js"></script>
		<script type="text/javascript" src="/site/js/slick/slick.js"></script>
		<script type="text/javascript" src="/site/js/mmenu/mmenu.js"></script>
		@yield('js-content')
		<script>
			document.addEventListener (
			    "DOMContentLoaded", () => {
			     	new Mmenu( "#menu", {
				        "extensions": [
				        	"pagedim-black",
				          	"position-right",
				          	"theme-dark"
				        ],
				        "navbars": [
				        	{
				            	"position": "top",
				            	"content": [
				              		"prev",
				              		"title"
				            	]
				          	}
				        ]
			      	});
			    }
			);
		</script>
	</body>
</html>