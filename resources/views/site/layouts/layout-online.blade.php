<!DOCTYPE html>
<html>
	<head>
		<title>@yield('titulo', 'Maptveduca')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		@csrf
		<link rel="stylesheet" href="/site/css/style.css">
		<link rel="stylesheet" type="text/css" href="/site/js/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="/site/js/stacktable/stacktable.css"/> 
		<link rel="stylesheet" type="text/css" href="/site/js/mmenu/mmenu.css"/>
		@yield("css-content")
		<link rel="icon" href="/site/img/favicon.png" type="image/gif" sizes="64x64">
	    
	</head>

	<body>
		<div class="page">
			<div class="menu-general">
			    <div class="hoja-1200">
			        <div class="flex between">
			            <img src="/site/img/logo-amarillo.png">
			            <ul class="flex flex-center between menu">
			                <li><a href="{{ route("home") }}">Inicio</a></li>
			                <li class="parent">
                                <a href="{{ route("cursos") }}">Cursos</a>
                                <div class="menu-child">
                                    <ul class="flex">
                                        <li>
                                            <span>Producción musical</span>
                                            <ul class="item-child">
                                                <li><span><a href="{{ route("guia-estudio") }}" class="bg-amarillo">Guía de estudio</span></a></li>
                                                <li><a href="#">Cursos base</a></li>
                                                <li><a href="#">Cursos extra</a></li>
                                                <li><span>Área</span></li>
                                                <li><a href="#">Grabación</a></li>
                                                <li><a href="#">Mezcla</a></li>
                                                <li><a href="#">DAW'S</a></li>
                                                <li><span>Nivel</span></li>
                                                <li><a href="#">Principiante</a></li>
                                                <li><a href="#">Intermedio</a></li>
                                                <li><a href="#">Avanzado</a></li>
                                                <li><span>Profesor</span></li>
                                                <li><a href="#">Profesor 1</a></li>
                                                <li><a href="#">Profesor 2</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span>Música</span>
                                            <ul class="item-child">
                                                <li><a href="#">Cursos base</a></li>
                                                <li><a href="#">Cursos extra</a></li>
                                                <li><span>Área</span></li>
                                                <li><a href="#">Teoría</a></li>
                                                <li><a href="#">Solfeo</a></li>
                                                <li><a href="#">Composición</a></li>
                                                <li><a href="#">Análisis</a></li>
                                                <li><a href="#">Ensamble</a></li>
                                                <li><span>Instrumento</span></li>
                                                <li><a href="#">Canto</a></li>
                                                <li><a href="#">Piano</a></li>
                                                <li><a href="#">Guitarra</a></li>
                                                <li><a href="#">Bajo</a></li>
                                                <li><a href="#">Batería</a></li>
                                                <li><span>Profesor</span></li>
                                                <li><a href="#">Profesor 1</a></li>
                                                <li><a href="#">Profesor 2</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <span>Nuevo</span>
                                            <ul class="item-child">
                                                <li><a href="#">Últimos agregados</a></li>
                                            </ul>
                                            <span>Music business</span>
                                            <ul class="item-child">
                                                <li><a href="#">Últimos agregados</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div> <!-- /menu-child -->
                            </li>
			                <li class="parent">
                                <a href="{{ route("membresias.index") }}">Membresías</a>
                                <div class="menu-child">
                                    <ul class="flex">
                                        <li><a href="#">Membresía académica</a></li>
                                    </ul>
                                </div>
                            </li>
			                <li><a href="{{ route("clases-linea.index") }}">Clases en línea</a></li>
			                <li><a href="{{ route("eventos.index") }}">Eventos</a></li>
			                <li><a href="{{ route("nosotros.index") }}">Nosotros</a></li>
			                <li><a href="{{ route("faqs") }}">FAQ/Contacto</a></li>
			            </ul>
			            <div class="toggle">
			                <a class="menu-open" href="#menu" id="navbar-toggle">
			                    <span class="visuallyhidden">Toggle navigation</span>
			                    <span class="icon-bar hamburger-bun bun-top"></span>
			                    <span class="icon-bar hamburger-patty"></span>
			                    <span class="icon-bar hamburger-bun bun-btm"></span>
			                </a>
			                <a class="menu-close" href="#page">
			                    <span class="visuallyhidden">Toggle navigation</span>
			                    <span class="icon-bar hamburger-bun bun-top"></span>
			                    <span class="icon-bar hamburger-patty"></span>
			                    <span class="icon-bar hamburger-bun bun-btm"></span>
			                </a>
			            </div> <!-- /toggle -->
                        <div class="ico-login">
                            <a href="#"><img src="/site/img/ico-user.png"></a>
                            <div class="menu-user">
                                <p>Hola, {{ auth()->user()->nombre }}</p>
                                <ul>
                                    <li><a href="{{ route('micuenta.index') }}">Tablero</a></li>
                                    
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" name="frm_logout_web">
                                            @csrf
                                            <button>Cerrar sesión</button>
                                        </form>
                                    </li>
                                
                                </ul>
                            </div> <!-- /menu-user -->
                            <span class="notificacion">2</span>
                        </div> <!-- /ico-login -->
			        </div> <!-- /flex -->
			    </div> <!-- /hoja-1200 -->
			</div> <!-- /menu-general -->

			@yield('contenido')
            
            <footer>
				<div class="hoja-1000">
                    <div class="flex between">
                        <div class="flex-footer">
                            <div class="flex">
                                <ul>
                                    <!--<li><a href="#">Membresía Básica</a></li>-->
                                    <li><a href="#">Membresía Académica</a></li>
                                    <!--<li><a href="#">Guías de estudio</a></li>-->
                                </ul>
                                <ul>
                                    <li><a href="#">Cursos</a></li>
                                    <li><a href="#">Clases en línea</a></li>
                                    <li><a href="#">Eventos</a></li>
                                </ul>
                            </div>
                            <div class="flex">
                                <ul>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Contacto</a></li>
                                </ul>
                                <ul>
                                    <li><a href="#">Nosotros</a></li>
                                    <li><a href="#">Colegio MAP</a></li>
                                </ul>
                            </div>
                        </div> <!-- /flex -->

                        <div class="row-redes flex flex-column">
                            <ul class="flex-redes end">
                                <li><a href="#"><img src="/site/img/facebook.png"></a></li>
                                <li><a href="#"><img src="/site/img/instagram.png"></a></li>
                                <li><a href="#"><img src="/site/img/youtube.png"></a></li>
                            </ul> <!-- /flex -->
                            <a class="btn-footer" href="#">Estudia presencialmente con nosotros en Colegio MAP (Puebla, Puebla, México)</a>
                        </div> <!-- /row-redes -->
                    </div> <!-- /flex -->
                    <div class="row-copyright">
                        <div class="flex between">
                            <p>2020  MAPtv Educa. Todos los derechos reservados</p>
                            <ul class="flex">
                                <li><a href="#">Aviso de Privacidad</a></li>
                                <li>/</li>
                                <li><a href="#">Términos y Condiciones</a></li>
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