<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

<div class="banner-small"></div> <!-- /banner-small -->

<section class="aulas">

    <div class="hoja-1200">

        <ul class="flex breadcrumb-curso">
            <li>TABLERO PERSONAL / AULAS VIRTUALES</li>
        </ul> <!-- /breadcrumb-curso -->  

        <div class="wrapper-aulas">
            <h1>Materia 1</h1>
            <ul class="acordeon-materias">
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 4: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                    <div class="wrapper-acordeon">
                        <div class="row-acordeon">
                            <p>Profr. Nombre Apellido</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim</p>
                        </div> <!-- /row-acordeon -->
                        <div class="btn-archivo flex flex-center between">
                            <ul>
                                <li>Archivo 1</li>
                                <li>Archivo 2</li>
                                <li>Archivo 3</li>
                            </ul>
                            <div class="ver-mas">
                                <img src="/site/img/plus.png">
                            </div> <!-- /ver-mas -->
                        </div> <!-- /btn-archivo -->
                        <div class="wrapper-respuesta">
                            <p>Respondiendo a Lección 4: Nombre de la lección...</p>
                            <div class="row-forma">
                                <!--<form method="post">
                                    <textarea id="mytextarea"></textarea>
                                </form>-->
                                <div class="flex between">
                                    <div class="btn-archivo flex flex-center">
                                        <input type="file" name="upload" id="upload" class="cargar-cv" data-multiple-caption="{count} files selected" multiple="">
                                        <label for="upload"><span>Adjuntar archivos</span></label>
                                        <ul>
                                            <li>Archivo 1</li>
                                        </ul>
                                    </div> <!-- /flex -->
                                    <a href="#" class="btn-publicar">Publicar</a>
                                </div> <!-- /flex -->
                            </div> <!-- /row-forma -->
                        </div> <!-- /wrapper-respuesta -->
                        <div class="row-respuesta">
                            <div class="boton-alumno flex between">
                                <p>Nombre del alumno</p>
                                <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                            </div> <!-- /flex -->
                            <div class="respuesta-alumno">
                                <div class="row-acordeon">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
                                </div> <!-- /row-acordeon -->
                                <div class="btn-archivo flex flex-center between">
                                    <ul>
                                        <li>Archivo 1</li>
                                    </ul>
                                </div> <!-- /btn-archivo -->
                            </div> <!-- /respuesta-alumno -->
                            <div class="boton-alumno flex between">
                                <p>Nombre del alumno</p>
                                <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                            </div> <!-- /flex -->
                            <div class="respuesta-alumno">
                                <div class="row-acordeon">
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
                                </div> <!-- /row-acordeon -->
                                <div class="btn-archivo flex flex-center between">
                                    <ul>
                                        <li>Archivo 1</li>
                                    </ul>
                                </div> <!-- /btn-archivo -->
                            </div> <!-- /respuesta-alumno -->
                        </div> <!-- /row-respuesta -->
                    </div> <!-- /wrapper-acordeon -->
                </li>
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 3: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                </li>
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 2: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                </li>
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 1: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                </li>
            </ul> <!-- /acordeon-materias -->
        </div> <!-- /wrapper-aulas -->
        
        <div class="wrapper-aulas">
            <h1>Materia 1</h1>
            <ul class="acordeon-materias">
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 4: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                    <div class="wrapper-acordeon">
                        <div class="row-acordeon">
                            <p>Profr. Nombre Apellido</p>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim</p>
                        </div> <!-- /row-acordeon -->
                        <div class="btn-archivo">
                            <ul>
                                <li>Archivo 1</li>
                                <li>Archivo 2</li>
                                <li>Archivo 3</li>
                            </ul>
                        </div> <!-- /btn-archivo -->
                    </div> <!-- /wrapper-acordeon -->
                </li>
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 3: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                </li>
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 2: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                </li>
                <li>
                    <div class="boton-acordeon flex between">
                        <p>Lección 1: Nombre de la lección...</p>
                        <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>20/07/2020  00:00</span></p>
                    </div> <!-- /flex -->
                </li>
            </ul> <!-- /acordeon-materias -->
        </div> <!-- /wrapper-aulas -->

     </div> <!-- /hoja-1200 -->
     
</section> <!-- /aulas -->

<script src="/site/js/tinymce.min.js"></script>

<script>

    tinymce.init({
        selector: '#mytextarea'
    });

</script>

@stop