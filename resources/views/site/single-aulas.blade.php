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
            <h1>{{ $curso->nombre }}</h1>
            <ul class="acordeon-materias">

                @foreach($publicaciones as $publicacion)

                    <li>
                        <div class="boton-acordeon flex between">
                            <p>Lección: {{  $publicacion->nombre }}</p>
                            <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>{{ $publicacion->created_at }}</span></p>
                        </div> <!-- /flex -->
                        <div class="wrapper-acordeon">

                            <div class="row-acordeon">
                                <p>Profr. {{ $publicacion->instructor->nombres." ".$publicacion->instructor->apellidos }}</p>
                                <p>{!! $publicacion->publicacion !!}</p>
                            </div> <!-- /row-acordeon -->

                            @if ($publicacion->archivos != null)
                                <div class="btn-archivo flex flex-center between">
                                    <ul>
                                        @php  
                                            $archivos = json_decode($publicacion->archivos);
                                        @endphp

                                        @for($i = 0; $i <= count($archivos) - 1; $i++)
                                            <li> <a href="{{ route('down.publicacion', [$curso->slug,$publicacion->id,$i]) }}" style="text-decoration: none;outline:none; color: black;">{{ basename($archivos[$i]) }} </a> </li>
                                        @endfor
                                    </ul>
                                    <div class="ver-mas">
                                        <img src="/site/img/plus.png">
                                    </div> <!-- /ver-mas -->
                                </div> <!-- /btn-archivo -->
                            @endif

                            <div class="wrapper-respuesta">
                                <p>Respondiendo a Lección: {{  $publicacion->nombre }}</p>
                                <div class="row-forma">
                                    <form action="{{ route('aula-virtual-web.store', $publicacion->id) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @csrf
                                        <textarea class="mytextarea" name="publicaciontxt"></textarea>
                                        <div class="flex between">
                                            <div class="btn-archivo flex flex-center">
                                                <input type="file" name="upload[]" id="upload" multiple="" class="cargar-cv">
                                                <label for="upload"><span>Adjuntar archivos</span></label>
                                                <ul>
                                                    <li class="conteo-archivos">Archivo 1</li>
                                                </ul>
                                            </div> <!-- /flex -->
                                            <button class="btn-publicar">Publicar</button>
                                        </div> <!-- /flex -->
                                    </form>
                                </div> <!-- /row-forma -->
                            </div> <!-- /wrapper-respuesta -->

                            <div class="row-respuesta">
                                @if ($respuestas->where('publicacion_id', $publicacion->id)->count() > 0)
                                    @foreach($respuestas->where('publicacion_id', $publicacion->id) as $respuesta)

                                        <div class="boton-alumno flex between">
                                            @if ($respuesta->instructor_id != null)
                                                <p> Profr. {{ $respuesta->instructor->nombres." ".$respuesta->instructor->apellidos }}</p>
                                            @else
                                                <p> {{ $respuesta->usuario->nombre." ".$respuesta->usuario->apaterno }} </p>
                                            @endif
                                            <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>{{ $respuesta->created_at }}</span></p>
                                        </div> <!-- /flex -->
                                        <div class="respuesta-alumno">
                                            <div class="row-acordeon">
                                                <p>{!! $respuesta->respuesta !!}</p>
                                            </div> <!-- /row-acordeon -->
                                            @if ($respuesta->archivos != null)
                                                <div class="btn-archivo flex flex-center between">
                                                    <ul>
                                                        @php  
                                                            $archivos = json_decode($respuesta->archivos);
                                                        @endphp

                                                        @for($i = 0; $i <= count($archivos) - 1; $i++)
                                                            <li> <a href="{{ route('down.publicacion.web', [$curso->slug, $publicacion->id,$respuesta->id, $i]) }}" style="text-decoration: none;outline:none; color: black;">{{ basename($archivos[$i]) }} </a> </li>
                                                        @endfor
                                                    </ul>
                                                </div> <!-- /btn-archivo -->
                                            @endif
                                        </div> <!-- /respuesta-alumno -->

                                    @endforeach
                                @endif

                            </div> <!-- /row-respuesta -->
                        </div> <!-- /wrapper-acordeon -->
                    </li>

                @endforeach
                {{-- <li>
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
                </li> --}}
            </ul> <!-- /acordeon-materias -->
        </div> <!-- /wrapper-aulas -->
        
        {{-- <div class="wrapper-aulas">
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
        </div> --}} <!-- /wrapper-aulas -->

     </div> <!-- /hoja-1200 -->
     
</section> <!-- /aulas -->

<script src="/site/js/tinymce.min.js"></script>

<script>

    tinymce.init({
        selector: '.mytextarea'
    });

</script>

@stop