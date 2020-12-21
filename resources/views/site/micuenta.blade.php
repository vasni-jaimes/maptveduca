<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->

@section('contenido')

<div class="banner-small"></div> <!-- /banner-small -->

<section class="micuenta">

    <div class="hoja-1200">
        
        <div>
            <span class="ico-filtro" id="ico-tablero"><img src="site/img/filtro.png"></span>
        </div> <!-- /text-right -->

        <ul class="flex breadcrumb-curso">
            <li>TABLERO PERSONAL</li>
        </ul> <!-- /breadcrumb-curso -->  
        
        <div class="wrapper-micuenta">
            
            <div class="flex flex-start">
            
                <div class="sidebar-single sidebar-tablero">

                    <div class="sidebar-perfil">
                        <img src="/site/img/ico-user.png">
                        <h2>{{ auth()->user()->nombre. " ".auth()->user()->amaterno. " ".auth()->user()->apaterno }}</h2>
                    </div> <!-- /row-tablero -->

                    <ul class="li-micuenta">
                        <li class="active" data-seccion="perfil"><a href="">Perfil</a></li>
                        <li data-seccion="inbox"><a href="">Inbox</a></li>
                        <li data-seccion="pagos"><a href="">Pagos</a></li>
                        <li data-seccion="favoritos"><a href="">Favoritos</a></li>
                        @if (auth()->user()->tieneSuscripcion() == true && auth()->user()->suscripcion[0]->id == 1)
                            <li data-seccion="cursos"><a href="">Cursos</a></li>
                            <li data-seccion="eventos"><a href="">Eventos</a></li>
                            <li data-seccion="clases"><a href="">Clases en línea</a></li>
                        @elseif (auth()->user()->tieneSuscripcion() == true && auth()->user()->suscripcion[0]->id == 2)
                        <li data-seccion="academico"><a href="">Control Académico</a></li>
                        @endif
                    </ul>

                </div> <!-- /sidebar-single -->
                
                <div class="wrapper-tablero">

                    <div style="margin-bottom: 30px;" data-seccion="perfil" class="section active">
                        <h3>Perfil</h3>
                        <div class="row-perfil">
                            <div class="flex">
                                <div class="item-perfil">
                                    <h4>Informarción personal</h4>
                                    <form class="form-perfil" action="" method="">
                                        <fieldset>
                                            <label>Correo electrónico</label>
                                            <input type="text" class="input" placeholder="usuario@gmail.com" value="{{ auth()->user()->email }}">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Nombre</label>
                                            <input type="text" class="input" placeholder="Usuario" value="{{ auth()->user()->nombre }}">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Apellido Materno</label>
                                            <input type="text" class="input" placeholder="Apellido Materno" value="{{ auth()->user()->amaterno }}">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Apellido Paterno</label>
                                            <input type="text" class="input" placeholder="Apellido Paterno" value="{{ auth()->user()->apaterno }}">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset class="columns">
                                            <div class="flex flex-perfil between">
                                                <div>
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="text" class="input" placeholder="DD/MM/AAAA" class="input" value="{{ auth()->user()->fecha_nacimiento }}">
                                                    <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                                </div>
                                                <div>
                                                    <label>Contraseña</label>
                                                    <input type="text" class="input" placeholder="···············" class="input">
                                                    <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div> <!-- /item-perfil -->
                                <div class="item-perfil">
                                    <h4>Membresía</h4>
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
                                
                                <div class="s-membresia">
                                    <div class="close-shadow"></div> <!-- /close-shadow -->
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
                                    <div class="item-inbox">
                                        <span>25/Junio/ 2020 18:00 hrs</span>
                                        <div class="item-mensaje">
                                            <div class="txt-mensaje">
                                                <p><strong>De:</strong> MAPtv Educa </p>
                                                <p><strong>Mensaje:</strong></p>
                                                <p>Hola, Usuario. El siguiente pago de tu membresía se cargará automáticamente dentro de 7 días. Para cambiar tu método de pago ve a la sección “Pagos”, ubicada en el menú lateral de tu tablero personal. Las membresías se cargan de manera automática cada 30 días.</p>
                                                <p>Has elegido la membresía académica, bajo el programa Técnico Profesional en Producción Musical. Si por alguna razón quisieras modificar tu membresía, dirígete a la sección “Perfil”, ubicada en el menú lateral de tu tablero personal.</p>
                                                <p>Recuerda que para el tipo de membresía que has elegido aplican algunas restricciones de cancelación.</p>
                                                <p>¡Bienvenido!</p>
                                            </div> <!-- /txt-mensaje -->
                                            <a href="javascript:void(0)">Ver mensaje completo</a>
                                        </div> <!-- /item-mensaje -->
                                    </div> <!-- /item-inbox -->
                                    <div class="item-inbox">
                                        <span>18/Junio/ 2020 18:00 hrs</span>
                                        <div class="item-mensaje">
                                            <div class="txt-mensaje">
                                                <p><strong>De:</strong> MAPtv Educa </p>
                                                <p><strong>Mensaje:</strong></p>
                                                <p>Hola, Usuario. El siguiente pago de tu membresía se cargará automáticamente dentro de 7 días. Para cambiar tu método de pago ve a la sección “Pagos”, ubicada en el menú lateral de tu tablero personal. Las membresías se cargan de manera automática cada 30 días.</p>
                                                <p>Has elegido la membresía académica, bajo el programa Técnico Profesional en Producción Musical. Si por alguna razón quisieras modificar tu membresía, dirígete a la sección “Perfil”, ubicada en el menú lateral de tu tablero personal.</p>
                                                <p>Recuerda que para el tipo de membresía que has elegido aplican algunas restricciones de cancelación.</p>
                                                <p>¡Bienvenido!</p>
                                            </div> <!-- /txt-mensaje -->
                                            <a href="javascript:void(0)">Ver mensaje completo</a>
                                        </div> <!-- /item-mensaje -->
                                    </div> <!-- /item-inbox -->
                                    <div class="item-inbox">
                                        <span>17/Junio/ 2020 18:00 hrs</span>
                                        <div class="item-mensaje">
                                            <div class="txt-mensaje">
                                                <p><strong>De:</strong> MAPtv Educa </p>
                                                <p><strong>Mensaje:</strong></p>
                                                <p>Hola, Usuario. El siguiente pago de tu membresía se cargará automáticamente dentro de 7 días. Para cambiar tu método de pago ve a la sección “Pagos”, ubicada en el menú lateral de tu tablero personal. Las membresías se cargan de manera automática cada 30 días.</p>
                                                <p>Has elegido la membresía académica, bajo el programa Técnico Profesional en Producción Musical. Si por alguna razón quisieras modificar tu membresía, dirígete a la sección “Perfil”, ubicada en el menú lateral de tu tablero personal.</p>
                                                <p>Recuerda que para el tipo de membresía que has elegido aplican algunas restricciones de cancelación.</p>
                                                <p>¡Bienvenido!</p>
                                            </div> <!-- /txt-mensaje -->
                                            <a href="javascript:void(0)">Ver mensaje completo</a>
                                        </div> <!-- /item-mensaje -->
                                    </div> <!-- /item-inbox -->
                                </div> <!-- /tab-mensaje -->
                                
                                <div class="s-tab tab-2">
                                    <div class="item-inbox">
                                        <span>25/Junio/ 2020 18:00 hrs</span>
                                        <div class="item-mensaje">
                                            <div class="txt-mensaje">
                                                <p><strong>De:</strong> MAPtv Educa </p>
                                                <p><strong>Notificación:</strong></p>
                                                <p>Hola, Usuario. El siguiente pago de tu membresía se cargará automáticamente dentro de 7 días. Para cambiar tu método de pago ve a la sección “Pagos”, ubicada en el menú lateral de tu tablero personal. Las membresías se cargan de manera automática cada 30 días.</p>
                                                <p>Has elegido la membresía académica, bajo el programa Técnico Profesional en Producción Musical. Si por alguna razón quisieras modificar tu membresía, dirígete a la sección “Perfil”, ubicada en el menú lateral de tu tablero personal.</p>
                                                <p>Recuerda que para el tipo de membresía que has elegido aplican algunas restricciones de cancelación.</p>
                                                <p>¡Bienvenido!</p>
                                            </div> <!-- /txt-mensaje -->
                                            <a href="javascript:void(0)">Ver mensaje completo</a>
                                        </div> <!-- /item-mensaje -->
                                    </div> <!-- /item-inbox -->
                                    <div class="item-inbox">
                                        <span>18/Junio/ 2020 18:00 hrs</span>
                                        <div class="item-mensaje">
                                            <div class="txt-mensaje">
                                                <p><strong>De:</strong> MAPtv Educa </p>
                                                <p><strong>Notificación:</strong></p>
                                                <p>Hola, Usuario. El siguiente pago de tu membresía se cargará automáticamente dentro de 7 días. Para cambiar tu método de pago ve a la sección “Pagos”, ubicada en el menú lateral de tu tablero personal. Las membresías se cargan de manera automática cada 30 días.</p>
                                                <p>Has elegido la membresía académica, bajo el programa Técnico Profesional en Producción Musical. Si por alguna razón quisieras modificar tu membresía, dirígete a la sección “Perfil”, ubicada en el menú lateral de tu tablero personal.</p>
                                                <p>Recuerda que para el tipo de membresía que has elegido aplican algunas restricciones de cancelación.</p>
                                                <p>¡Bienvenido!</p>
                                            </div> <!-- /txt-mensaje -->
                                            <a href="javascript:void(0)">Ver mensaje completo</a>
                                        </div> <!-- /item-mensaje -->
                                    </div> <!-- /item-inbox -->
                                    <div class="item-inbox">
                                        <span>17/Junio/ 2020 18:00 hrs</span>
                                        <div class="item-mensaje">
                                            <div class="txt-mensaje">
                                                <p><strong>De:</strong> MAPtv Educa </p>
                                                <p><strong>Notificación:</strong></p>
                                                <p>Hola, Usuario. El siguiente pago de tu membresía se cargará automáticamente dentro de 7 días. Para cambiar tu método de pago ve a la sección “Pagos”, ubicada en el menú lateral de tu tablero personal. Las membresías se cargan de manera automática cada 30 días.</p>
                                                <p>Has elegido la membresía académica, bajo el programa Técnico Profesional en Producción Musical. Si por alguna razón quisieras modificar tu membresía, dirígete a la sección “Perfil”, ubicada en el menú lateral de tu tablero personal.</p>
                                                <p>Recuerda que para el tipo de membresía que has elegido aplican algunas restricciones de cancelación.</p>
                                                <p>¡Bienvenido!</p>
                                            </div> <!-- /txt-mensaje -->
                                            <a href="javascript:void(0)">Ver mensaje completo</a>
                                        </div> <!-- /item-mensaje -->
                                    </div> <!-- /item-inbox -->
                                </div> <!-- /tab-notificacion -->
                                
                            </div> <!-- /row-tabs -->
                        </div> <!-- /row-perfil -->
                    </div>
                    
                    <div style="margin-bottom: 30px;" data-seccion="pagos" class="section">
                        <h3>Pagos</h3>
                        <div class="row-perfil">
                            <div class="flex">
                                <div class="item-perfil">
                                    <h4>Informarción de pago</h4>
                                    <form class="form-perfil" action="" method="">
                                        <fieldset>
                                            <label>Nombre en la tarjeta</label>
                                            <input type="text" class="input" placeholder="Nombre y Apellido">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Número de tarjeta</label>
                                            <input type="text" class="input" placeholder="**** **** **** 1234">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset class="columns">
                                            <div class="flex flex-perfil between">
                                                <div>
                                                    <label>Vencimiento</label>
                                                    <input type="text" class="input" placeholder="12/34" class="input">
                                                    <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                                </div>
                                                <div>
                                                    <label>CVV</label>
                                                    <input type="text" class="input" placeholder="***" class="input">
                                                    <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <label>Apellido Materno</label>
                                            <input type="text" class="input" placeholder="Apellido Materno">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Apellido Paterno</label>
                                            <input type="text" class="input" placeholder="Apellido Paterno">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset class="f-domicilio columns">
                                            <label>Domicilio</label>
                                            <div class="flex flex-domicilio between">
                                                <input type="text" class="input first" placeholder="Calle">
                                                <input type="text" class="input" placeholder="Número ext.">
                                                <input type="text" class="input" placeholder="Número int.">
                                            </div> <!-- /flex -->
                                            <div class="flex flex-colonia between">
                                                <input type="text" class="input" placeholder="Colonia, barrio, fraccionamiento">
                                                <input type="text" class="input" placeholder="Código postal">
                                            </div> <!-- /flex -->
                                            <div class="flex between">
                                                <input type="text" class="input" placeholder="Ciudad">
                                                <input type="text" class="input" placeholder="Estado">
                                                <input type="text" class="input" placeholder="País">
                                            </div> <!-- /flex -->
                                        </fieldset>
                                    </form>
                                </div> <!-- /item-perfil -->
                                <div class="item-perfil">
                                    <h4>Historial de pagos</h4>
                                    <table class="tabla-perfil">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Descripción</th>
                                            <th>Forma de pago</th>
                                        </tr>
                                        <tr>
                                            <td>20/06/2020</td>
                                            <td>$500.00</td>
                                            <td>Membresía básica</td>
                                            <td>Tarjeta de crédito</td>
                                        </tr>
                                        <tr>
                                            <td>20/07/2020</td>
                                            <td>$200.00</td>
                                            <td>Clase en línea</td>
                                            <td>Tarjeta de crédito</td>
                                        </tr>
                                    </table>
                                </div> <!-- /item-perfil -->
                            </div> <!-- /flex -->
                        </div> <!-- /row-perfil -->
                    </div>
                    
                    <div style="margin-bottom: 30px;" data-seccion="favoritos" class="section">
                        <h3>Favoritos</h3>
                        <div class="row-favoritos">
                            @if ($favoritosCursos->count() > 0)
                                <div class="row-black item-favoritos">
                                    <h3>Cursos</h3>
                                    <ul class="slide-cursos">
                                        @foreach($favoritosCursos as $curso)
                                            <li>
                                                <span class="delete"></span>
                                                <a href="#"> <div class="img-slide" style="background-image: url({{ Storage::url($curso->cursos->url_img) }});"></div> </a> <!-- /img-slide -->
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="item-favoritos">
                                    <h3>Cursos</h3>
                                    <p>¡Aún no tienes cursos favoritos! Ve a la sección CURSOS y márca cuantos quieras como favoritos.</p>
                                    <p>Los encontrarás aquí cuando vuelvas.</p>
                                </div>
                            @endif
                            

                            @if ($favoritosEventos->count() > 0)
                                <div class="row-black item-favoritos">
                                    <h3>Eventos</h3>
                                    <ul class="slide-cursos">
                                        @foreach($favoritosEventos as $evento)
                                            <li>
                                                <a href="#"> <div class="img-slide" style="background-image: url({{ Storage::url($evento->eventos->img_evento) }});"></div> </a> <!-- /img-slide -->
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="item-favoritos">
                                    <h3>Eventos</h3>
                                    <p>¡Aún no tienes eventos favoritos! Ve a la sección EVENTOS y márca cuantos quieras como favoritos.</p>
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
                                    <p>¡Aún no tienes clases en línea favoritos! Ve a la sección CLASES EN LÍNEA y márca cuantos quieras como favoritos.</p>
                                    <p>Los encontrarás aquí cuando vuelvas.</p>
                                </div>
                            @endif
                            
                            <div class="shadow-favorito" id="shadow-favorito">
                                <div class="f-shadow">
                                    <div class="s-favorito">
                                        <div class="close-shadow"></div> <!-- /close-shadow -->
                                        <p>¿Seguro quieres quitar este item de tus favoritos?</p>
                                        <ul>
                                            <li><a href="#">No</a></li>
                                            <li><a href="#">Si</a></li>
                                        </ul>
                                    </div> <!-- /s-favorito -->
                                </div> <!-- /f-favorito -->
                            </div> <!-- /shadow-favorito -->
                            
                        </div> <!-- /row-favoritos -->
                    </div>


                    @if (auth()->user()->tieneSuscripcion() == true && auth()->user()->suscripcion[0]->id == 1)
                    
                        <div style="margin-bottom: 30px;" data-seccion="cursos" class="section">
                            <h3>Mis cursos</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TUS CURSOS EN PROGRESO.</p>
                                <div class="flex-cursos">
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                        <li class="col-3">
                                            <a href="#">
                                                <img src="/site/img/fulano.jpg">
                                                <div class="txt-clase">
                                                    <p>Nombre del curso</p>
                                                </div> <!-- /txt-clase -->
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- /row-favoritos -->
                        </div>
                        
                        <div style="margin-bottom: 30px;" data-seccion="eventos" class="section">
                            <h3>Mis eventos</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TUS EVENTOS PRÓXIMOS Y ADQUIRIDOS</p>
                                <div class="flex-cursos">
                                    <p>PRÓXIMOS</p>
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    </ul>
                                    <p>ARCHIVADOS</p>
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al evento</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    </ul>
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

                    @elseif (auth()->user()->tieneSuscripcion() == true && auth()->user()->suscripcion[0]->id == 2)
                    
                        <div style="margin-bottom: 30px;" data-seccion="academico" class="section">
                            <h3>Mis materias</h3>
                            <div class="row-favoritos">
                                <p>AQUÍ ENCONTRARÁS TODOS LOS CURSOS CORRESPONDIENTES A TU PROGRAMA ACADÉMICO, ORDENADOS POR TRIMESTRE EN PROGRESO</p>
                                <div class="flex-cursos">
                                    <p>1er Trimestre</p>
                                    <ul class="flex between wrap">
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al curso</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al curso</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al curso</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                        <li class="col-3">
                                            <img src="/site/img/fulano.jpg">
                                            <div class="txt-clase">
                                                <p>Nombre del curso</p>
                                                <p>00/00/000</p>
                                                <a href="#">Ir al curso</a>
                                            </div> <!-- /txt-clase -->
                                        </li>
                                    </ul>
                                </div>
                            </div> <!-- /row-favoritos -->
                        </div>
                    @endif
                    
                </div> <!-- /wrapper-tablero -->
                
            </div> <!-- /flex -->

        </div> <!-- /wrapper-micuenta -->

    </div> <!-- /hoja-1200 -->
    
</section> <!-- /micuenta -->

@stop

@section('js-content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop