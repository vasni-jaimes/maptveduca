<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="single-curso">

        <div class="hoja-1400">
            
            <ul class="flex breadcrumb-curso">
                <li><a href="#">Cursos</a></li>
                <li><span>Grabación</span></li>
            </ul> <!-- /breadcrumb-curso -->
            
            <div class="wrapper-curso">
                <div class="flex">

                    <div class="sidebar-single">
                        <h3>Contenido del curso</h3>
                        
                        <ul class="row-leccion">
                            <li class="active">Bienvenida</li>
                            <li>Lección 1</li>
                            <li>Lección 2</li>
                            <li>Lección 3</li>
                            <li>Lección 4</li>
                            <li>Lección 5</li>
                            <li>Lección 6</li>
                            <li>Lección 7</li>
                            <li>Lección 8</li>
                            <li>Lección 9</li>
                            <li>Lección 10</li>
                        </ul> <!-- /row-leccion -->
                        
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
                            <h3>Grabación 1</h3>
                            <p>Producción musical / Curso base / Profesor titular: José Antonio Cordero</p>
                            <div class="descripcion-single">
                                <p>Te damos la bienvenida al curso “Grabación 1”. En este video, tu profesor titular, José Antonio Cordero (Josean) te explica de qué se trata este curso y qué habrás aprendido al concluirlo...</p>
                                <p>Texto que describe los puntos que se tocan en el video de bienvenida...</p>
                            </div> <!-- /descripcion-single -->
                        </div> <!-- /txt-single -->
                    
                        <div class="banner-botones">
                            <h4>¿ESTUDIANDO POR TU CUENTA?</h4>
                            <p>Te damos algunas recomendaciones para que aproveches al máximo este curso</p>
                        </div> <!-- /banner-botones -->
                        
                    </div> <!-- /single-contenido -->
                    
                    <div class="sidebar-registro">
                        <span><a href="#">Empezar curso</a></span>
                        <div class="favorito">
                            <p>Marca este curso como favorito</p>
                        </div> <!-- /favorito -->
                    </div> <!-- /sidebar-registro -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1400 -->

    </section> <!-- /single-curso -->

@stop