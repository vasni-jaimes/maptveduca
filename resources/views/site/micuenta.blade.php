<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

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
                    </div>
                    
                </div> <!-- /wrapper-tablero -->
                
            </div> <!-- /flex -->

        </div> <!-- /wrapper-micuenta -->

    </div> <!-- /hoja-1200 -->
    
</section> <!-- /micuenta -->

@stop