<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="cursos">

        <div class="banner-cursos"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Cursos</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">
            
            <div class="wrapper-cursos flex flex-start">

                @include("site.layouts.layout-sidebar")
                
                <div class="row-cursos interior-curso">


                    @foreach($instructores as $instructor)
                        @if ($instructor->cursos->count() > 0)
                            <div class="row-yellow {{ md5($instructor->id) }}">
                                <div class="div-item {{ md5($instructor->id) }}">
                                    <h3> {{ $instructor->nombres. " ".$instructor->apellidos }} </h3>

                                    <div class="row-slide">
                                        <ul class="slide-cursos">
                                            @foreach($instructor->cursos as $curso)
                                                <li>
                                                    <a href="{{ route("single-cursos.show", $curso->slug) }}"> <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> </a> <!-- /img-slide -->
                                                </li>
                                            @endforeach
                                        </ul>

                                        @if ($instructor->cursos->where("extra", 1)->count() > 0)
                                            <div class="row-extra flex between">
                                                <span>Cursos <br> extra ></span>
                                                
                                                <ul class="slide-extra">
                                                    @foreach($instructor->cursos as $curso)
                                                        <li>
                                                           <a href="{{ route("single-cursos.show", $curso->slug) }}"> <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> </a> <!-- /img-slide -->
                                                        </li>
                                                    @endforeach
                                                </ul> <!-- /slide-extra -->
                                                
                                            </div> <!-- /row-extra -->
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    
                    @foreach($categorias as $categoria)

                        @if ($categoria->obtenerConteoCat($categoria->id) > 0)
                            <div class="row-yellow {{ $categoria->quitarAcentos($categoria->nombre) }}">
                                <div class="titulo-cursos">
                                    <h2> {{ $categoria->nombre }} </h2>
                                </div> <!-- /titulo-cursos -->

                                <!-- LO NUEVO DE LAS CATEGORIAS -->
                                @foreach($categoria->cursos as $curso)

                                    <div class="div-item {{ $categoria->quitarAcentos($categoria->nombre). " nuevo" }}">
                                        <h3> Nuevo </h3>

                                        <div class="row-slide">
                                            <ul class="slide-cursos">
                                                <li>
                                                    <a href="{{ route("single-cursos.show", $curso->slug) }}"> <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> </a> <!-- /img-slide -->
                                                </li>
                                            </ul>

                                            @if ($categoria->cursos->where("extra", 1)->count() > 0)
                                                <div class="row-extra flex between">
                                                    <span>Cursos <br> extra ></span>
                                                    
                                                    <ul class="slide-extra">
                                                        <li>
                                                           <a href="{{ route("single-cursos.show", $curso->slug) }}"> <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> </a> <!-- /img-slide -->
                                                        </li>
                                                    </ul> <!-- /slide-extra -->
                                                    
                                                </div> <!-- /row-extra -->
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <!-- /LO NUEVO DE LAS CATEGORIAS -->

                                <!-- SUBCATEGORIAS -->
                                @foreach($categoria->subcategorias as $subcategoria)
                                    
                                    @php $cursos = $categoria->ObtenerCursos($subcategoria->id); @endphp
                                    @if ($cursos->count() > 0)

                                        <div class="div-item {{ $categoria->quitarAcentos($subcategoria->nombre). " ".$categoria->quitarAcentos($categoria->nombre) }}">
                                            <h3> {{ $subcategoria->nombre }} </h3>

                                            <div class="row-slide">
                                                <ul class="slide-cursos">
                                                    @foreach($cursos as $curso)
                                                        @if ($curso->extra == 0)
                                                            <li>
                                                                <a href="{{ route("single-cursos.show", $curso->slug) }}"> <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> </a> <!-- /img-slide -->
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul> <!-- /slide-cursos -->

                                                @if ($cursos->where("extra", 1)->count() > 0)
                                                    <div class="row-extra flex between">
                                                        <span>Cursos <br> extra ></span>
                                                        
                                                        <ul class="slide-extra">
                                                            @foreach($cursos as $curso)
                                                                <li>
                                                                   <a href="{{ route("single-cursos.show", $curso->slug) }}"> <div class="img-slide" style="background-image: url({{Storage::url($curso->url_img) }});"></div> </a> <!-- /img-slide -->
                                                                </li>
                                                            @endforeach
                                                        </ul> <!-- /slide-extra -->
                                                        
                                                    </div> <!-- /row-extra -->
                                                @endif
                                            </div> <!-- /row-slide -->
                                        </div>

                                    @endif
                                @endforeach
                                <!-- /SUBCATEGORIAS -->
                            </div>
                        @endif
                    @endforeach
                    
                    <div class="row-botones">
                        
                        <div class="banner-botones">
                            <h4>¿ESTUDIANDO POR TU CUENTA?</h4>
                            <p>Te damos algunas recomendaciones para que aproveches al máximo este curso</p>
                        </div> <!-- /banner-botones -->
                        
                    </div> <!-- /row-botones -->

                </div> <!-- /row-cursos -->

            </div> <!-- /flex -->
            
        </div> <!-- /hoja-1000 -->
    </section> <!-- /cursos -->

@stop

@section('js-content')
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop