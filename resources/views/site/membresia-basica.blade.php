<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="membresia">

        <div class="banner-cursos"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Membresia básica</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">
        
            <div class="wrapper-columnas">
                
                <div class="row-columnas">
                    
                    <div class="flex between">

                        <div class="col-6">
                            <p>Si lo que quieres es aprender a tu propio ritmo y explorar nuestros cursos libremente, te reomendamos la membresía básica, que te dará acceso a todos nuestros cursos (principales y extra), además de la mayoría de clínicas y conciertos/masterclass.</p>
                            <p>¡Mira todo lo que puedes hacer!</p>
                        </div> <!-- /col-6 -->

                        <div class="col-6">
                            <div class="row-video">
                                <iframe src="https://www.youtube.com/embed/CBZyA-Pj52U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div> <!-- /row-video -->
                        </div> <!-- /col-6 -->

                    </div> <!-- /flex -->
                    
                </div> <!-- /row-columnas -->
                
                <div class="wrapper-herramienta">
                    
                    <h2>¿Cómo puedo aprovechar mi membresía básica?</h2>
                        
                    <div class="row-membresia">

                        <div class="row-herramienta flex flex-center between">
                            <div class="col-2"><span class="num">1</span></div>
                            <div class="col-10 item-texto text-center">
                                <p>Echa un vistazo a las guías de estudio que hemos preparado para ti:</p>
                                <p><a href="{{ route('guia-estudio') }}"><span class="amarillo">GUÍA DE ESTUDIO <br> PRODUCCIÓN MUSICAL</span></a></p>
                            </div> <!-- /item-texto -->
                        </div> <!-- /row-herramienta -->

                        <div class="row-herramienta flex flex-center between">
                            <div class="col-2"><span class="num">2</span></div>
                            <div class="col-10 item-texto text-center">
                                <p>Complementa tu aprendizaje con<br>
                                    uno de nuestros eventos y<br>
                                    actividades adicionales.</p>
                            </div> <!-- /item-texto -->
                        </div> <!-- /row-herramienta -->

                        <div class="row-herramienta flex flex-center between">
                            <div class="col-2"><span class="num">3</span></div>
                            <div class="col-10 item-texto text-center">
                                <p>Recuerda utilizar tu tablero<br>
                                    personal para acceder más<br>
                                    rápidamente a los cursos, clases<br>
                                    o eventos de tu interés.<br><br>

                                    ¡Puedes marcarlos como<br>
                                    favoritos para enviarlos a tu<br>
                                    tablero!</p>
                            </div> <!-- /item-texto -->
                        </div> <!-- /row-herramienta -->
                            
                    </div> <!-- /row-membresia -->

                </div> <!-- /wrapper-herramienta -->
                
                <div class="hoja-900">

                    <div class="wrapper-basica">

                        <h2>¿Qué obtengo con esta membresía?</h2>

                        <table style="width: 100%; border-spacing: 10px; border-collapse: separate; table-layout: fixed;">
                            <tr>
                                <th><img src="/site/img/ico-basica.png"></th>
                                <th>Membresía básica</th>
                            </tr>
                            <tr>
                                <td>Acceso a cursos principales</td>
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Acceso a cursos y material extra</td>
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>Acceso a clínicas y conciertos / masterclass básicas</td>
                                <td><span class="circle"></span></td>
                            </tr>
                            <tr>
                                <td>&nbsp</td>
                                <td>$250 MXN mensuales</td>
                            </tr>
                        </table>

                    </div> <!-- /wrapper-basica -->
                    
                    <a class="btn-grande" href="{{ route("checkout", "membresia-basica") }}">¡PRUÉBALA GRATIS POR 30 DÍAS!</a>
     
                </div> <!-- /hoja-900 -->
                
            </div> <!-- /wrapper-columnas -->
            
        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /membresia -->

@stop