<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="single-curso">

        <div class="hoja-1400">
            
            <ul class="flex breadcrumb-curso">
                <li><a href="#">Clases en línea</a></li>
                <li><span>Aprende a mezclar con ProTools</span></li>
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
                        
                        <div class="row-video">
                            <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div> <!-- /row-video -->
                        
                        <div class="txt-single">
                            <h3>Aprende a mezclar con ProTools</h3>
                            <p>Producción musical / Curso base / Profesor titular: José Antonio Cordero</p>
                            <p><span class="txt-yellow">LUNES · A PARTIR DEL 00 DE JUNIO AL 00 DE JULIO, 2020 · 18:00 HRS (Hora Cd. de México) | 4 sesiones de 90 minutos</span></p>
                            <div class="descripcion-single">
                                <p>En este video, tu profesor titular, José Antonio Cordero (Josean) te explica los temas que se abarcarán a lo largo de las sesiones de esta clase en línea.</p>
                            </div> <!-- /descripcion-single -->
                        </div> <!-- /txt-single -->
                    
                        <div class="row-clases">
            
                            <h3>¿Cómo se imparten las clases en línea?</h3>

                            <p>Las clases en línea se imparten a través de la plataforma Zoom.</p>
                            <p>Una vez que te registres a una clase recibirás en tu correo la información para accesar en la fecha y hora indicadas.</p>
                            <a class="btn-zoom" href="#">Haz tu cuenta en Zoom y descarga la aplicación </a>
                            <p><small>Siempre verifica que tus descargas y cuentas se realicen desde sitios oficiales de Zoom.</small></p>

                        </div> <!-- /row-clases -->

                    </div> <!-- /single-contenido -->
                    
                    <div class="sidebar-registro">
                        <span><a href="#">Regístrate</a></span>
                        <div class="favorito">
                            <p>Marca este curso como favorito</p>
                        </div> <!-- /favorito -->
                    </div> <!-- /sidebar-registro -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1400 -->
    </section> <!-- /single-curso -->

@stop