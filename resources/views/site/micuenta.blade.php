<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@stop

@section('contenido')

<div class="banner-small"></div> <!-- /banner-small -->

<section class="micuenta">

    <div class="hoja-1200">

        <ul class="flex breadcrumb-curso">
            <li>TABLERO PERSONAL</li>
        </ul> <!-- /breadcrumb-curso -->  
        
        <div>
            <span class="ico-filtro" id="ico-tablero"><img src="site/img/filtro.png"></span>
        </div> <!-- /text-right -->
        
        <div class="wrapper-micuenta">
            
            <div class="flex flex-start">
            
                <div class="sidebar-single sidebar-tablero">

                    <div class="sidebar-perfil">
                        <img src="/site/img/ico-user.png">
                        <h2>{{ auth()->user()->nombre. " ".auth()->user()->apaterno. " ".auth()->user()->amaterno }}</h2>
                    </div> <!-- /row-tablero -->

                    <ul class="li-micuenta">
                        <li class="active" data-seccion="perfil"><a href="">Perfil</a></li>
                        <li data-seccion="inbox"><a href="">Inbox</a></li>
                        <li data-seccion="pagos"><a href="">Pagos</a></li>
                        <li data-seccion="favoritos"><a href="">Favoritos</a></li>
                        @if (auth()->user()->tieneSuscripcion() == true && (auth()->user()->ultimaSuscripcion()->id == 1 || auth()->user()->ultimaSuscripcion()->id == 2))
                            <li data-seccion="cursos"><a href="">Cursos</a></li>
                            <li data-seccion="eventos"><a href="">Eventos</a></li>
                            <li data-seccion="clases"><a href="">Clases en línea</a></li>
                        @endif
                        @if (auth()->user()->tieneSuscripcion() == true && auth()->user()->ultimaSuscripcion()->id == 2)
                            <li class="item-control">
                                <a href="#">Control Académico</a>
                                <ul>
                                    <li class="active" data-seccion="meterias"><a href="">Materias</a></li>
                                    <li><a href="{{ route('aulas-virtuales.show') }}">Aulas Virtuales</a></li>
                                    <li data-seccion="status"><a href="">Status académico</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div> <!-- /sidebar-single -->
                
                <div class="wrapper-tablero">

                    <div style="margin-bottom: 30px;" data-seccion="perfil" class="section active">
                        <h3>Perfil</h3>
                        <div class="row-perfil">
                            <div class="flex">
                                <div class="item-perfil">
                                    <h4>Información personal</h4>
                                    <form class="form-perfil" action="{{ route('usuario.editar') }}" method="POST" name="form_editar">
                                        @csrf
                                        <fieldset>
                                            <label>Correo electrónico</label>
                                            <input type="text" name="email" class="input" placeholder="usuario@gmail.com" value="{{ auth()->user()->email }}">
                                        </fieldset>
                                        <fieldset>
                                            <label>Nombre</label>
                                            <input type="text" name="nombre" class="input" placeholder="Usuario" value="{{ auth()->user()->nombre }}">
                                        </fieldset>
                                        <fieldset>
                                            <label>Apellido Materno</label>
                                            <input type="text" name="amaterno" class="input" placeholder="Apellido Materno" value="{{ auth()->user()->amaterno }}">
                                        </fieldset>
                                        <fieldset>
                                            <label>Apellido Paterno</label>
                                            <input type="text" name="apaterno" class="input" placeholder="Apellido Paterno" value="{{ auth()->user()->apaterno }}">
                                        </fieldset>
                                        <fieldset class="columns">
                                            <div class="flex flex-perfil between">
                                                <div>
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="text" name="fecha_nacimiento" class="input datepicker" data-date-format="yyyy-mm-dd" placeholder="DD/MM/AAAA" value="{{ auth()->user()->fecha_nacimiento }}">
                                                </div>
                                                <div>
                                                    <label>Contraseña</label>
                                                    <input type="text" name="password" class="input" placeholder="···············" class="input">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <input type="submit" class="btn_perfil" value="Guardar" />
                                    </form>
                                </div> <!-- /item-perfil -->
                                <div class="item-perfil">
                                    <h4>Membresía</h4>
                                    @if (count(auth()->user()->suscripcion) > 0)
                                        @for ($i = 0; $i <= count(auth()->user()->suscripcion) - 1; $i++)
                                            @if (auth()->user()->suscripcion[$i]->id == 1)
                                                <a href="#">Membresía Basica
                                                    <span class="ico-edit" id="edit-membresia">
                                                        <img src="/site/img/edit.png">
                                                        <p>Modificar membresía</p>
                                                    </span>
                                                </a>
                                            @elseif (auth()->user()->suscripcion[$i]->id == 2)
                                                 <a href="#">Membresía Académica
                                                    <span class="ico-edit" id="edit-membresia">
                                                        <img src="/site/img/edit.png">
                                                        <p>Modificar membresía</p>
                                                    </span>
                                                </a>
                                            @endif
                                        @endfor
                                    @else
                                        <p>No tienes ninguna suscripcion activa</p>
                                    @endif
                                </div> <!-- /item-perfil -->
                            </div> <!-- /flex -->
                        </div> <!-- /row-perfil -->
                        
                        <div class="shadow-favorito" id="shadow-membresia">
                            <div class="f-shadow">
                                <div class="s-membresia">
                                    <div class="close-shadow"></div> <!-- /close-shadow -->
                                    <p>¿QUÉ CAMBIO DESEAS HACER?</p>
                                    <a href="#">Quiero una membresía académica</a>
                                    <small>Conoce más sobre la Membresía Académica</small>
                                    <a class="cancelar" href="#">Quiero cancelar mi membresía</a>
                                    <small>Al cancelar tu membresía básica tendrás acceso a sus privilegios hasta que termine tu periodo pagado.</small>
                                </div> <!-- /s-membresia -->
                                
                                <!--<div class="s-membresia">
                                    <div class="close-shadow"></div> <!-- /close-shadow
                                    <p>¿QUÉ CAMBIO DESEAS HACER?</p>
                                    <a href="#">Quiero cambiar mi membresía a básica o cancelar mi membresía académica</a>
                                    <small>Si das click en la opción de arriba, nos comunicaremos  contigo en un lapso de 24 horas para dar seguimiento a tu solicitud.</small>
                                </div> <!-- /s-membresia -->
                            </div> <!-- /f-favorito -->
                        </div> <!-- /shadow-favorito -->
                    </div>

                    <div style="margin-bottom: 30px;" data-seccion="inbox" class="section">
                        <h3>Inbox</h3>
                        <div class="row-perfil">
                            <div class="row-tabs">
                                <ul>
                                    <li class="tab tab-active" data-id="1">Mensajes</li>
                                    <li class="tab" data-id="2">Notificaciones</li>
                                </ul>
                                
                                <div class="s-tab tab-1">
                                    @forelse($mensajes as $mensaje)
                                        <div class="item-inbox">
                                            <p><small class="notificacion"></small><span>{{ $mensaje->FormatoLetras($mensaje->created_at) }}</span></p>
                                            <div class="item-mensaje">
                                                <div class="txt-mensaje">
                                                    @if ($mensaje->admin->id == 1)
                                                        <p><strong>De:</strong> MAPtv Educa </p>
                                                    @else
                                                        <p>
                                                            <strong>De:</strong> 
                                                            {{ $mensaje->admin->nombre." ".$mensaje->admin->amaterno }} 
                                                        </p>
                                                    @endif
                                                    <p><strong>Mensaje:</strong></p>
                                                    <p>{!! $mensaje->mensaje !!}</p>
                                                </div> <!-- /txt-mensaje -->
                                                <a href="javascript:void(0)">Ver mensaje completo</a>
                                            </div> <!-- /item-mensaje -->
                                        </div> <!-- /item-inbox -->
                                    @empty
                                        <div class="item-inbox" style="margin-top: 10px;">
                                            <span> No hay mensajes </span>
                                        </div>
                                    @endforelse
                
                                </div> <!-- /tab-mensaje -->


                                <div class="s-tab tab-2">
                                    @forelse($notificaciones as $notificacion)
                                        <div class="item-inbox">
                                            <p><small class="notificacion"></small><span>{{ $notificacion->FormatoLetras($notificacion->created_at) }}</span></p>
                                            <div class="item-mensaje">
                                                <div class="txt-mensaje">
                                                    <p><strong>De:</strong> MAPtv Educa </p>
                                                    <p><strong>Notificación:</strong></p>
                                                    <p> {!! $notificacion->mensaje !!} </p>
                                                </div> <!-- /txt-mensaje -->
                                                <a href="javascript:void(0)">Ver mensaje completo</a>
                                            </div> <!-- /item-mensaje -->
                                        </div> <!-- /item-inbox -->
                                    @empty
                                        <div class="item-inbox" style="margin-top: 10px;">
                                            <span> No hay notificaciones </span>
                                        </div>
                                    @endforelse
                            
                                </div> <!-- /tab-notificacion -->
                                
                            </div> <!-- /row-tabs -->
                        </div> <!-- /row-perfil -->
                    </div>
                    
                    <div style="margin-bottom: 30px;" data-seccion="pagos" class="section">
                        <h3>Pagos</h3>
                        <div class="row-perfil">
                            <div class="flex">
                                <div class="item-perfil">
                                    <h4>Información de pago</h4>
                                    <p>Realiza tus pagos o actualiza tu información de pago en PayPal</p>
                                    <a href="{{ route("checkout", "membresia-academica") }}"><img src="site/img/paypal.png"></a>
                                </div> <!-- /item-perfil -->
                                <div class="item-perfil">
                                    <h4>Historial de pagos</h4>
                                    @if ($pagos->count() > 0)
                                        <table class="tabla-perfil">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Monto</th>
                                                <th>Descripción</th>
                                                <th>Forma de pago</th>
                                            </tr>
                                            @foreach($pagos as $pago)
                                                <tr>
                                                    <td>{{ $pago->FormatoLetras($pago->fehca_inicio) }}</td>

                                                    @if ($pago->membresia_id != null)
                                                        <td>${{ $pago->FormatPrecio($pago->membresia->precio) }}</td>
                                                        <td>{{ $pago->membresia->nombre }}</td>
                                                    @elseif ($pago->evento_id != null)
                                                        <td>${{ $pago->FormatPrecio($pago->evento->precio) }}</td>
                                                        <td> Evento especial </td>
                                                    @endif

                                                    <td> Paypal </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    @else
                                        <p>Aún no hay pagos realizados</p>
                                    @endif
                                </div> <!-- /item-perfil -->
                            </div> <!-- /flex -->
                        </div> <!-- /row-perfil -->
                    </div>
                    
                    <div style="margin-bottom: 30px;" data-seccion="favoritos" class="section">
                        <h3>Favoritos</h3>
                        <div class="row-favoritos">
                            @if ($favoritosCursos->count() > 0)
                                <div class="row-black item-favoritos item-cursos">
                                    <h3>Cursos</h3>
                                    <ul class="slide-cursos">
                                        @foreach($favoritosCursos as $curso)
                                            <li>
                                                <span class="delete delete_curso-fav" data-slg="{{ $curso->cursos->slug }}"></span>
                                                <a href="{{ route("single-cursos.show", $curso->cursos->slug) }}"> <div class="img-slide" style="background-image: url({{ Storage::url($curso->cursos->url_img) }});"></div> </a> <!-- /img-slide -->
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="item-favoritos">
                                    <h3>Cursos</h3>
                                    <p>¡Aún no tienes cursos favoritos! Ve a la sección <a href="{{ route("cursos") }}">CURSOS</a> y márca cuantos quieras como favoritos.</p>
                                    <p>Los encontrarás aquí cuando vuelvas.</p>
                                </div>
                            @endif
                            

                            @if ($favoritosEventos->count() > 0)
                                <div class="row-black item-favoritos item-eventos">
                                    <h3>Eventos</h3>
                                    <ul class="slide-cursos">
                                        @foreach($favoritosEventos as $evento)
                                            <li>
                                                <span class="delete delete_evento-fav" data-slg="{{ $evento->eventos->slug }}"></span>
                                                <a href="{{ route("evento.show", $evento->eventos->slug) }}"> <div class="img-slide" style="background-image: url({{ Storage::url($evento->eventos->img_evento) }});"></div> </a> <!-- /img-slide -->
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="item-favoritos">
                                    <h3>Eventos</h3>
                                    <p>¡Aún no tienes eventos favoritos! Ve a la sección <a href="{{ route("eventos.index") }}">EVENTOS</a> y márca cuantos quieras como favoritos.</p>
                                    <p>Los encontrarás aquí cuando vuelvas.</p>
                                </div>
                            @endif
                            
                            @if ($favoritosClases->count() > 0)
                                <div class="row-black item-favoritos">
                                    <h3>Clases en línea</h3>
                                    <ul class="slide-cursos">
                                        <li>
                                            @foreach($favoritosClases as $clase)
                                                <a href="#"> <div class="img-slide" style="background-image: url({{ Storage::url($clase->clases->img) }});"></div> </a> <!-- /img-slide -->
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="item-favoritos">
                                    <h3>Clases en línea</h3>
                                    <p>¡Aún no tienes clases en línea favoritos! Ve a la sección <a href="{{ route("clases-linea.index") }}">CLASES EN LÍNEA</a> y márca cuantos quieras como favoritos.</p>
                                    <p>Los encontrarás aquí cuando vuelvas.</p>
                                </div>
                            @endif
                            
                            <div class="shadow-favorito" id="shadow-favorito">
                                <div class="f-shadow">
                                    <div class="s-favorito">
                                        <div class="close-shadow"></div> <!-- /close-shadow -->
                                        <p>¿Seguro quieres quitar este curso de tus favoritos?</p>
                                        <ul>
                                            <li><a href="#" class="no_delete-fav">No</a></li>
                                            <li><a href="#" class="si_delete-fav">Si</a></li>
                                        </ul>
                                    </div> <!-- /s-favorito -->
                                </div> <!-- /f-favorito -->
                            </div> <!-- /shadow-favorito -->

                            <div class="shadow-favorito" id="shadow-favorito_evento">
                                <div class="f-shadow">
                                    <div class="s-favorito">
                                        <div class="close-shadow"></div> <!-- /close-shadow -->
                                        <p>¿Seguro quieres quitar este evento de tus favoritos?</p>
                                        <ul>
                                            <li><a href="#" class="no_delete-fav">No</a></li>
                                            <li><a href="#" class="si_delete-fav">Si</a></li>
                                        </ul>
                                    </div> <!-- /s-favorito -->
                                </div> <!-- /f-favorito -->
                            </div> <!-- /shadow-favorito -->

                            
                            <div class="shadow-favorito" id="shadow-exito">
                                <div class="f-shadow">
                                    <div class="s-favorito">
                                        <div class="close-shadow"></div> <!-- /close-shadow -->
                                        <p>Se elimino de favoritos correctamente</p>
                                        <ul>
                                            <li><a href="#" class="ok_favoritos-micuenta">OK</a></li>
                                        </ul>
                                    </div> <!-- /s-favorito -->
                                </div> <!-- /f-favorito -->
                            </div> <!-- /shadow-favorito -->


                            <div class="shadow-favorito" id="loading" style="z-index: 9999">
                                <div class="f-shadow">
                                    <img src="/site/img/musica.gif">
                                </div> <!-- /f-favorito -->
                            </div> <!-- /shadow-favorito -->


                        </div> <!-- /row-favoritos -->
                    </div>


                    @if (auth()->user()->tieneSuscripcion() == true && (auth()->user()->ultimaSuscripcion()->id == 1 || auth()->user()->ultimaSuscripcion()->id == 2))
                    
                        <div style="margin-bottom: 30px;" data-seccion="cursos" class="section">
                            <h3>Mis cursos</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TUS CURSOS EN PROGRESO.</p>
                                <div class="flex-cursos">
                                    @if ($tableroCursos->count() > 0)
                                        <ul class="flex between wrap">
                                            {{-- @foreach($materias as $materia)
                                                <li class="col-3">
                                                    <a href="{{ route('single-cursos.show', $materia->cursos->slug) }}">
                                                        <img src="{{ Storage::url($materia->cursos->url_img) }}">
                                                        <div class="txt-clase">
                                                            <p>{{ $materia->cursos->nombre }}</p>
                                                        </div> <!-- /txt-clase -->
                                                    </a>
                                                </li>
                                            @endforeach --}}

                                            @foreach($tableroCursos as $curso)
                                                <li class="col-3">
                                                    <a href="{{ route('single-cursos.show', $curso->slug) }}">
                                                        <img src="{{ Storage::url($curso->url_img) }}">
                                                        <div class="txt-clase">
                                                            <p>{{ $curso->nombre }}</p>
                                                        </div> <!-- /txt-clase -->
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p> Aún no tienes cursos. </p>
                                    @endif
                                </div>
                            </div> <!-- /row-favoritos -->
                        </div>
                        
                        <div style="margin-bottom: 30px;" data-seccion="eventos" class="section">
                            <h3>Mis eventos</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TUS EVENTOS PRÓXIMOS Y ADQUIRIDOS</p>
                                <div class="flex-cursos">
                                    @if ($tableroEventos->count() > 0)
                                        <p>PRÓXIMOS</p>
                                        <ul class="flex between wrap">
                                            @foreach($tableroEventos as $eventos)
                                                <li class="col-3">
                                                    <img src="{{ Storage::url($eventos->img_evento) }}">
                                                    <div class="txt-clase">
                                                        <p>{{ $eventos->nombre }}</p>
                                                        <p>{{ $eventos->fecha_lanzamiento }}</p>
                                                        <a href="{{ route('evento.show', $eventos->slug) }}">Ir al evento</a>
                                                    </div> <!-- /txt-clase -->
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if ($eventosOld->count() > 0)
                                        <p>ARCHIVADOS</p>
                                        <ul class="flex between wrap">
                                            @foreach($eventosOld as $eventoOld)
                                                <li class="col-3">
                                                    <img src="{{ Storage::url($eventoOld->img_evento) }}">
                                                    <div class="txt-clase">
                                                        <p>{{ $eventoOld->nombre }}</p>
                                                        <p>{{ $eventoOld->fecha_lanzamiento }}</p>
                                                        <a href="{{ route('evento.show', $eventoOld->slug) }}">Ir al evento</a>
                                                    </div> <!-- /txt-clase -->
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @if ($tableroEventos->count() <= 0 && $eventosOld->count() <= 0)
                                        <p> Aún no tienes eventos. </p>
                                    @endif
                                </div>
                            </div> <!-- /row-favoritos -->
                        </div>
                        
                        <div style="margin-bottom: 30px;" data-seccion="clases" class="section">
                            <h3>Mis clases en línea</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TUS CLASES EN LÍNEA PRÓXIMAS Y ADQUIRIDAS</p>
                                <div class="flex-cursos">
                                    <p>PRÓXIMAS</p>
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    </ul>
                                    <p>EN CURSO</p>
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    </ul>
                                    <p>CONCLUIDAS</p>
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir a la clase</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- /row-favoritos -->
                        </div>

                    @endif

                    @if (auth()->user()->tieneSuscripcion() == true && auth()->user()->ultimaSuscripcion()->id == 2)
                    
                        <div style="margin-bottom: 30px;" data-seccion="meterias" class="section">
                            <h3>Mis materias</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TODOS LOS CURSOS CORRESPONDIENTES A TU PROGRAMA ACADÉMICO, ORDENADOS POR TRIMESTRE EN PROGRESO</p>
                                <div class="flex-cursos">
                                    @if ($materias->count() > 0)
                                        <p>{{ $tituloTrimestre }}</p>
                                        <ul class="flex flex-materias wrap">
                                            @foreach($materias as $materia)
                                                <li class="col-2">
                                                    <img src="{{ Storage::url($materia->cursos->url_img) }}">
                                                    <div class="txt-clase">
                                                        <p>{{ $materia->cursos->nombre }}</p>
                                                        <a href="{{ route('single-cursos.show', $materia->cursos->slug) }}">Ir al curso</a>
                                                    </div> <!-- /txt-clase -->
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p> Aún no hay cursos. </p>
                                    @endif
                                </div>
                            </div> <!-- /row-favoritos -->
                            
                            <div class="row-itinerario">
                                <p>Itinerario de sesiones en Zoom</p>
                                <div class="item-itinerario">
                                    <h4>Materia 1</h4>
                                    <div class="lista-itinerario">
                                        <ul>
                                            <li>Viernes 21 enero · 20:00 hrs | ID Zoom: 123 234 345 |  Link: <a href="#">linkasesiónzoom.com</a></li>
                                            <li>Viernes 21 enero · 20:00 hrs | ID Zoom: 123 234 345 |  Link: <a href="#">linkasesiónzoom.com</a></li>
                                            <li>Viernes 21 enero · 20:00 hrs | ID Zoom: 123 234 345 |  Link: <a href="#">linkasesiónzoom.com</a></li>
                                            <li>Viernes 21 enero · 20:00 hrs | ID Zoom: 123 234 345 |  Link: <a href="#">linkasesiónzoom.com</a></li>
                                        </ul>
                                    </div>
                                </div> <!-- /item-itinerario -->
                                <div class="item-itinerario">
                                    <h4>Materia 2</h4>
                                </div> <!-- /item-itinerario -->
                                <div class="item-itinerario">
                                    <h4>Materia 3</h4>
                                </div> <!-- /item-itinerario -->
                                <div class="item-itinerario">
                                    <h4>Materia 4</h4>
                                </div> <!-- /item-itinerario -->
                                <div class="item-itinerario">
                                    <h4>Materia 5</h4>
                                </div> <!-- /item-itinerario -->
                            </div> <!-- /row-itinerario -->
                            
                        </div>
                        
                        <div style="margin-bottom: 30px;" data-seccion="status" class="section">
                            <h3>Status académico</h3>
                            <div class="row-perfil row-status">
                                <div class="flex">
                                    <div class="item-perfil">
                                        <h4>Información del alumno</h4>
                                        <p>ALUMNO: {{ auth()->user()->nombre. " ".auth()->user()->apaterno. " ".auth()->user()->amaterno }}</p>
                                        <ul>
                                            <li>Programa académico: Técnico Profesional en Producción Musical</li>
                                            <li>Inscrito desde: Octubre 2020 (cuarto trimestre 2020)</li>
                                            <li>Activo desde: Junio 2020</li>
                                        </ul>
                                    </div> <!-- /item-perfil -->
                                    <div class="item-perfil">
                                        <h4>Kardex del alumno</h4>
                                        <table class="tabla-perfil">
                                            <tr>
                                                <th>Trimestre</th>
                                                <th>Materia</th>
                                                <th>Calificación general</th>
                                            </tr>
                                            <tr>
                                                <td>Oct - Dic 2020</td>
                                                <td>Materia</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td class="vacio">&nbps;</td>
                                                <td>Materia</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td class="vacio">&nbps;</td>
                                                <td>Materia</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td>Ene - Mar 2021</td>
                                                <td>Materia</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td class="vacio">&nbps;</td>
                                                <td>Materia</td>
                                                <td>100</td>
                                            </tr>
                                            <tr>
                                                <td class="vacio">&nbps;</td>
                                                <td>Materia</td>
                                                <td>100</td>
                                            </tr>
                                        </table>
                                        <div class="text-right">
                                            <a class="descarga">
                                                <div class="flex flex-center">
                                                    <img src="/site/img/descarga.png">
                                                    <p>Descargar en pdf</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div> <!-- /item-perfil -->
                                </div> <!-- /flex -->
                            </div> <!-- /row-perfil -->
                        </div>

                    @endif

                </div> <!-- /wrapper-tablero -->
                
            </div> <!-- /flex -->

        </div> <!-- /wrapper-micuenta -->

    </div> <!-- /hoja-1200 -->
    
</section> <!-- /micuenta -->

@stop

@section('js-content')
    <!-- Data picker -->
    <script src="/admini/js/plugins/datapicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        
        var mem = $('.datepicker').datepicker({
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop