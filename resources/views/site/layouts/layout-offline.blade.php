<!DOCTYPE html>
<html>
	<head>
		<title>@yield('titulo', 'Maptveduca')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">  
		<link rel="stylesheet" href="/site/css/style.css">
		<link rel="stylesheet" type="text/css" href="/site/js/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="/site/js/stacktable/stacktable.css"/> 
		<link rel="stylesheet" type="text/css" href="/site/js/mmenu/mmenu.css"/>
		<link rel="icon" href="/site/img/favicon.png" type="image/gif" sizes="64x64">
	    
	</head>

	<body>
		<div class="page">
			@yield('contenido')

			<footer>
				<div class="hoja-1000">
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