<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="nosotros">
    
        <div class="banner-cursos"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Faq / Contacto</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">
            
            <div class="wrapper-nosotros">
            
                <div class="banner-title bg-yellow">
                    <h2>Preguntas frecuentes</h2>
                </div> <!-- /bg-black -->

                <div class="wrapper-maptv">

                    <div class="row-faqs">

                        <div class="titulo-faq">
                            <p>¿Pregunta 1?</p>
                        </div> <!-- /titulo-faq -->
                        
                        <div class="respuesta-faq">
                            <div><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit </p></div>
                        </div> <!-- /respuesta-faq -->
                        
                         <div class="titulo-faq">
                            <p>¿Pregunta 2?</p>
                        </div> <!-- /titulo-faq -->
                        
                        <div class="respuesta-faq">
                            <div><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit </p></div>
                        </div> <!-- /respuesta-faq -->

                    </div> <!-- /row-maptv -->

                </div> <!-- /wrapper-maptv -->
            
            </div> <!-- /wrapper-nosotros -->
            
            <div class="banner-title bg-black">
                <h2>Contacto</h2>
            </div> <!-- /bg-black -->
            
            <div class="wrapper-maptv">
                
                <div class="row-form">
                    
                    <form class="form-contacto">
                        <div>
                            <input class="input" type="text" placeholder="Nombre">
                            <input class="input" type="text" placeholder="Correo electrónico">
                        </div>
                        <div>
                            <input class="input" type="text" placeholder="Ciudad">
                            <input class="input" type="text" placeholder="País">
                        </div>
                        <div class="textarea">
                            <label>Mensaje</label>
                            <textarea placeholder=""></textarea>
                        </div>
                        <div class="hs-button">
                            <input type="submit" class="button">
                        </div>
                    </form>
                    
                </div> <!-- /row-maptv -->
                
            </div> <!-- /wrapper-maptv -->
            
        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /inicio -->

@stop