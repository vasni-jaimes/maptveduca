<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="single-curso sesiones">

        <div class="hoja-1400">
            
            <ul class="flex breadcrumb-curso">
                <li><a href="#">Clases en línea</a></li>
                <li><a href="#">Aprende a mezclar con Logic</a></li>
                <li><span>Sesiones</span></li>
            </ul> <!-- /breadcrumb-curso -->
            
            <div class="wrapper-curso">
                <div class="flex">

                    <div class="sidebar-single">
                        
                        <div class="perfil-profesor">
                        
                            <div class="img-profesor" style="background-image: url('/site/img/fulano.jpg');"></div>
                            
                            <div class="bio-profesor">
                                <p>José Antonio Cordero</p>
                                <p>Productor e ingeniero de sonido especializado en mezcla.</p>
                                <p>Cuenta con una trayectoria acumulada de más de 8 años en la industria musical de la región centro de México.</p>
                            </div> <!-- /bio-profesor -->
                            
                        </div> <!-- /row-perfil -->
                        
                    </div> <!-- /sidebar-single -->
                    
                    <div class="single-contenido">
                        
                        <div class="txt-single">
                            <h3>Aprende a mezclar con ProTools</h3>
                            <p>Producción musical / Curso base / Profesor titular: José Antonio Cordero</p>
                        </div> <!-- /txt-single -->
                        
                        <div class="flex">
                        
                            <div class="row-sesiones">
                            
                                <p><span class="txt-yellow">Bienvenida</span></p>

                                <div class="row-video">
                                    <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div> <!-- /row-video -->

                                <div class="txt-single">
                                    <p><span class="txt-yellow">SESIÓN 1 · LUNES 00 DE JUNIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                    <p><span class="txt-yellow">SESIÓN 2 · LUNES 00 DE JUNIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                    <p><span class="txt-yellow">SESIÓN 3 · LUNES 00 DE JUNIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                    <p><span class="txt-yellow">SESIÓN 4 · LUNES 00 DE JULIO, 2020 · 18:00 HORAS (Hora Cd. de México)</span></p>
                                </div> <!-- /txt-single -->

                                <div class="row-clases">

                                    <h3>¿Cómo se imparten las clases en línea?</h3>

                                    <p>Las clases en línea se imparten a través de la plataforma Zoom.</p>
                                    <p>Una vez que te registres a una clase recibirás en tu correo la información para accesar en la fecha y hora indicadas.</p>
                                    <a class="btn-zoom" href="#">Haz tu cuenta en Zoom y descarga la aplicación </a>
                                    <p><small>Siempre verifica que tus descargas y cuentas se realicen desde sitios oficiales de Zoom.</small></p>

                                </div> <!-- /row-clases -->

                            </div> <!-- /row-sesiones -->

                            <div class="sidebar-registro">
                                <p><span href="#">En curso</span></p>
                                <div class="txt-curso">
                                    <div>
                                        <p><strong>¡Estás listo para comenzar!</strong></p>
                                        <p>Ahora podrás encontrar esta clase en tu tablero personal para acceder rápidamente a ella.</p>
                                        <p><strong>¿Qué sigue?</strong></p>
                                        <p>Revisa tu correo electrónico y guarda los datos de acceso a las sesiones.</p>
                                    </div>
                                </div> <!-- /txt-curso -->
                            </div> <!-- /sidebar-registro -->
                            
                        </div> <!-- /flex -->
                        
                    </div> <!-- /single-contenido -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1400 -->
    </section> <!-- /clases-sesiones -->

@stop