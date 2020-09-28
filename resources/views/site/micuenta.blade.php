<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

<div class="banner-small"></div> <!-- /banner-small -->

<section class="micuenta">

    <div class="hoja-1200">

        <ul class="flex breadcrumb-curso">
            <li>TABLERO PERSONAL</li>
        </ul> <!-- /breadcrumb-curso -->  
        
        <div class="wrapper-micuenta">
            
            <div class="flex flex-start">
            
                <div class="sidebar-single sidebar-tablero">

                    <div class="sidebar-perfil">
                        <img src="/site/img/ico-user.png">
                        <h2>Usuario Apellido</h2>
                    </div> <!-- /row-tablero -->

                    <ul>
                        <li class="active"><a href="#">Perfil</a></li>
                        <li><a href="#">Inbox</a></li>
                        <li><a href="#">Pagos</a></li>
                        <li><a href="#">Favoritos</a></li>
                        <li><a href="#">Cursos</a></li>
                        <li><a href="#">Eventos</a></li>
                        <li><a href="#">Clases en línea</a></li>
                        <li><a href="#">Control Académico</a></li>
                    </ul>

                </div> <!-- /sidebar-single -->
                
                <div class="wrapper-tablero">

                    <div style="margin-bottom: 30px;">
                        <h3>Perfil</h3>
                        <div class="row-perfil">
                            <div class="flex">
                                <div class="item-perfil">
                                    <h4>Informarción personal</h4>
                                    <form class="form-perfil" action="" method="">
                                        <fieldset>
                                            <label>Correo electrónico</label>
                                            <input type="text" class="input" placeholder="usuario@gmail.com">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
                                        </fieldset>
                                        <fieldset>
                                            <label>Nombre</label>
                                            <input type="text" class="input" placeholder="Usuario">
                                            <span class="ico-edit"><img src="/site/img/edit.png"></span>
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
                                        <fieldset class="columns">
                                            <div class="flex flex-perfil between">
                                                <div>
                                                    <label>Fecha de nacimiento</label>
                                                    <input type="text" class="input" placeholder="DD/MM/AAAA" class="input">
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
                                    <a href="#">Membresía Académica<span class="ico-edit"><img src="/site/img/edit.png"></span></a>
                                </div> <!-- /item-perfil -->
                            </div> <!-- /flex -->
                        </div> <!-- /row-perfil -->
                    </div>

                    <div style="margin-bottom: 30px;">
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
                    
                    <div style="margin-bottom: 30px;">
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
                    
                    <div style="margin-bottom: 30px;">
                        <h3>Favoritos</h3>
                        <div class="row-favoritos">
                            <h3>Cursos</h3>
                            <div class="row-slide">
                                <p>¡Aún no tienes cursos favoritos! Ve a la sección CURSOS y márca cuantos quieras como favoritos.</p>
                                <p>Los encontrarás aquí cuando vuelvas.</p>
                            </div> <!-- /row-slide -->
                        </div> <!-- /row-favoritos -->
                    </div>
                    
                </div> <!-- /wrapper-tablero -->
                
            </div> <!-- /flex -->

        </div> <!-- /wrapper-micuenta -->

    </div> <!-- /hoja-1200 -->
    
</section> <!-- /micuenta -->

@stop