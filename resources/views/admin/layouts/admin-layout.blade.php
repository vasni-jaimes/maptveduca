<!DOCTYPE html>
<html>
   	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('titulo')</title>
		<link href="/admini/css/bootstrap.min.css" rel="stylesheet">
		<link href="/admini/css/font-awesome/css/font-awesome.css" rel="stylesheet">

		
        @yield("css-content")

		<link href="/admini/css/animate.css" rel="stylesheet">
		<link href="/admini/css/style.css" rel="stylesheet">
   	</head>
   	<body>
	   	<div id="wrapper">
		   	<nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <img alt="image" class="rounded-circle" src="/admini/img/user-photo.png" width="40px" height="40px" />
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"> {{ Auth::guard('admins')->user()->nombre }} </span>
                                    @if (Auth::guard('admins')->user()->id == 1)
                                        <span class="text-muted text-xs block">Administrador <b class="caret"></b></span>
                                    @else
                                        <span class="text-muted text-xs block">Maestr@ <b class="caret"></b></span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="profile.html">Perfil</a></li>
                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="POST" name="frm_logout">
                                            @csrf
                                            <a><button class="dropdown-item" style="cursor: pointer;">Logout</button></a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                MTv
                            </div>
                        </li>
                        @if (Auth::guard('admins')->user()->rol_id == 1)
                            <li>
                                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Administradores</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href=""> Lista de Administradores </a></li>
                                    <li> <a href="{{ route('agregar-administrador.create') }}"> Agregar Administrador </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Usuarios</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route("listado-usuarios") }}"> Lista de Usuarios </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">Instructores</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route("listado-instructores.index") }}"> Lista de  Instructores </a></li>
                                    <li> <a href="{{ route("agregar-instructor.create") }}"> Agregar Instructor </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-tv"></i> <span class="nav-label">Cursos</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route('agregar-curso.index') }}"> Lista de Cursos </a></li>
                                    <li> <a href="{{ route('agregar-curso.create') }}"> Agregar Cursos </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-university"></i> <span class="nav-label">Clases en linea</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route('listado-clases.index') }}"> Lista de clases </a></li>
                                    <li> <a href="{{ route('agregar-clase.create') }}"> Agregar clase </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-street-view"></i> <span class="nav-label">Eventos</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route("listado-eventos.index") }}"> Lista de Eventos </a></li>
                                    <li> <a href="{{ route('agregar-evento.create') }}"> Agregar Evento </a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-street-view"></i> <span class="nav-label">Recomendaciones</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route("lista-recomendaciones.index") }}"> Lista de recomendaciones </a></li>
                                </ul>
                            </li>
                        @endif
                        <li>
                            <a href="#"><i class="fa fa-street-view"></i> <span class="nav-label">Mensajes</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li> <a href="#"> Lista de mensajes </a></li>
                                <li> <a href="{{ route('mandarMensaje') }}"> Crear Mensaje </a></li>
                            </ul>
                        </li>
                        @if (Auth::guard('admins')->user()->rol_id == 2)
                            <li>
                                <a href="#"><i class="fa fa-street-view"></i> <span class="nav-label">Aulas virtuales</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li> <a href="{{ route('listado-materias.index') }}"> Lista de Materias </a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ route('calificaciones-alumnos') }}"><i class="fa fa-pie-chart"></i> <span class="nav-label">Calificaciones</span>  </a>
                            </li>

                        @endif
                    </ul>
                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                               <a href="login.html">
                               <i class="fa fa-sign-out"></i> Log out
                               </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                @yield('contenido')
            </div>
	    </div>


	    @yield('js-content')
	</body>
</html>