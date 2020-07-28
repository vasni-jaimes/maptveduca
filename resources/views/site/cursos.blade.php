<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="cursos">

        <div class="banner-cursos"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Cursos</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1400">
            
            <div class="wrapper-cursos flex flex-start">

                @include("site.layouts.layout-sidebar")
                
                <div class="row-cursos interior-curso">
            
                    <div class="row-yellow">
                    
                        <div class="titulo-cursos">
                            <h2>Producción musical</h2>
                        </div> <!-- /titulo-cursos -->

                        <h3>Nivel 1</h3>
                        
                        <div class="row-slide">

                            <ul class="slide-cursos">
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                            </ul> <!-- /slide-cursos -->

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>
                                
                                <ul class="slide-extra">
                                    <li>
                                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                    </li>
                                    <li>
                                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                    </li>
                                </ul> <!-- /slide-extra -->
                                
                            </div> <!-- /row-extra -->

                        </div> <!-- /row-slide -->
                        
                        <h3>Nivel 2</h3>
                        
                        <div class="row-slide">

                            <ul class="slide-cursos">
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                            </ul> <!-- /slide-cursos -->

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>
                                
                                <ul class="slide-extra">
                                    <li>
                                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                    </li>
                                    <li>
                                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                    </li>
                                </ul> <!-- /slide-extra -->
                                
                            </div> <!-- /row-extra -->

                        </div> <!-- /row-slide -->
                        
                        <h3>Nivel 3</h3>
                        
                        <div class="row-slide">

                            <ul class="slide-cursos">
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                                <li>
                                    <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                </li>
                            </ul> <!-- /slide-cursos -->

                            <div class="row-extra flex between">
                                <span>Cursos <br> extra ></span>
                                
                                <ul class="slide-extra">
                                    <li>
                                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                    </li>
                                    <li>
                                        <div class="img-slide" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-slide -->
                                    </li>
                                </ul> <!-- /slide-extra -->
                                
                            </div> <!-- /row-extra -->

                        </div> <!-- /row-slide -->
                        
                    </div> <!-- /bg-yellow -->
                    
                    <div class="row-botones">
                        
                        <div class="banner-botones">
                            <h4>¿ESTUDIANDO POR TU CUENTA?</h4>
                            <p>Te damos algunas recomendaciones para que aproveches al máximo este curso</p>
                        </div> <!-- /banner-botones -->
                        
                    </div> <!-- /row-botones -->

                </div> <!-- /row-cursos -->

            </div> <!-- /flex -->
            
        </div> <!-- /hoja-1400 -->
    </section> <!-- /cursos -->

@stop