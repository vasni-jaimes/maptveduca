<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

<div class="banner-small"></div> <!-- /banner-small -->

<section class="aulas">

    <div class="hoja-1200">

        <ul class="flex breadcrumb-curso">
            <li> <a href="{{ route('micuenta.index') }}"> TABLERO PERSONAL </a> / <a href="{{ route('aulas-virtuales.show') }}"> AULAS VIRTUALES </a> </li>
        </ul> <!-- /breadcrumb-curso -->  

        <div class="wrapper-aulas">
            <h1>{{ $curso->nombre }}</h1>
            <ul class="acordeon-materias">

                @foreach($publicaciones as $publicacion)

                    <li>
                        <div class="boton-acordeon flex between">
                            <p>Lección: {{  $publicacion->nombre }}</p>
                            @if ($publicacion->archivos != null)
                            <p><a hrfe="#"><img src="/site/img/clip.png"></a><span>{{ $publicacion->created_at }}</span></p>
                            @endif
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
                                            <button class="btn-publicar btn-responder_web">Publicar</button>
                                        </div> <!-- /flex -->
                                    </form>
                                </div> <!-- /row-forma -->
                            </div> <!-- /wrapper-respuesta -->

                            <div class="row-respuesta">
                                @if ($respuestas->where('publicacion_id', $publicacion->id)->count() > 0)
                                    @foreach($respuestas->where('publicacion_id', $publicacion->id) as $respuesta)

                                        <div class="flex">
                                            
                                            <div class="row-alumno">
                                                <div class="boton-alumno flex between">
                                                    @if ($respuesta->instructor_id != null)
                                                        <p> Profr. {{ $respuesta->instructor->nombres." ".$respuesta->instructor->apellidos }}</p>
                                                    @else
                                                        <p> {{ $respuesta->usuario->nombre." ".$respuesta->usuario->apaterno }} </p>
                                                    @endif
                                                    <p>
                                                        @if ($respuesta->archivos != null)
                                                            <a hrfe="#">
                                                                <img src="/site/img/clip.png">
                                                            </a>
                                                        @endif
                                                        <span>{{ $respuesta->created_at }}</span>
                                                    </p>
                                                </div> <!-- /flex -->

                                                <div class="respuesta-alumno">
                                                    <div class="row-acordeon">
                                                        {!! $respuesta->respuesta !!}
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
                                            </div>

                                            @if ($respuesta->user_id == auth()->user()->id)
                                                <div class="acciones_respuestas">
                                                    <ul class="flex">
                                                        <li class="r-editar">
                                                            <a href="#" class="form-editar_show" data-resp="{{ $respuesta->id }}"> Editar </a>
                                                        </li>
                                                        <li class="r-eliminar">
                                                            <form method="POST" action="{{ route('eliminar.resp-web', $respuesta->id) }}" name="eliminar-respuesta">
                                                                @csrf
                                                                <a href="" class="eliminar-resp_a" data-rsp="{{ $respuesta->id }}"> Eliminar </a>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                
                                        @if ($respuesta->user_id == auth()->user()->id)
                        
                                            <div class="wrapper-respuesta edit-respuesta" data-resp="{{ $respuesta->id }}">
                                                <p>Editar Respuesta </p>
                                                <div class="row-forma">
                                                    <form action="{{ route('update.resp-web', [$publicacion->id, $respuesta->id]) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
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
                                                            <button class="btn-publicar btn-cancelar" data-resp="{{ $respuesta->id }}" style="background: #fff">Cancelar</button>
                                                            <button class="btn-publicar btn-editar_web">Editar</button>
                                                        </div> <!-- /flex -->
                                                    </form>
                                                </div> <!-- /row-forma -->
                                                <br>
                                            </div> <!-- /wrapper-respuesta -->

                                        @endif

                                    @endforeach
                                @endif

                            </div> <!-- /row-respuesta -->

                        </div> <!-- /wrapper-acordeon -->

                    </li>
                @endforeach
                
            </ul> <!-- /acordeon-materias -->
        </div> <!-- /wrapper-aulas -->

     </div> <!-- /hoja-1200 -->
     
</section> <!-- /aulas -->


<!-- LOADING -->
<div class="shadow-favorito" id="loading" style="z-index: 9999">
    <div class="f-shadow">
        <img src="/site/img/musica.gif">
    </div> <!-- /f-favorito -->
</div> <!-- /shadow-favorito -->


<!-- ELIMINAR RESPUESTA -->
<div class="shadow-favorito" id="shadow-eliminar_respuesta">
    <div class="f-shadow">
        <div class="s-favorito">
            <div class="close-shadow"></div> <!-- /close-shadow -->
            <p>¿Seguro quieres eliminar tu respuesta?</p>
            <ul>
                <li><a href="#" class="no_delete-resp">No</a></li>
                <li><a href="#" class="si_delete-resp">Si</a></li>
            </ul>
        </div> <!-- /s-favorito -->
    </div> <!-- /f-favorito -->
</div> <!-- /shadow-favorito -->


<script type="text/javascript" src="/site/js/app.js"></script>
{{-- <script src="/site/js/tinymce.min.js"></script> --}}
<script src="https://cdn.tiny.cloud/1/clhjic9y1wb7el9uh6xtffdhm9i3ktjzyt8qvefsh2uhs2nl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>

    tinymce.init({
        selector: '.mytextarea'
    });

</script>

@stop