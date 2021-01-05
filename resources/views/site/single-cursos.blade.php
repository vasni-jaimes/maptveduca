<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="single-curso">

        <div class="hoja-1000">
            
            <ul class="breadcrumb-curso">
                <li><a href="#">Cursos</a></li>
                <li><span>{{ $curso->nombre }}</span></li>
            </ul> <!-- /breadcrumb-curso -->
            
            <div class="wrapper-curso">
                <div class="flex">

                    <div class="sidebar-single">
                        <h3>Contenido del curso</h3>
                       {{--  auth()->user()->suscripcion[0] --}}
                        <ul class="row-leccion">
                            <li class="active {{ $clase_id == null ? "active-leccion" : "" }}" data-url="/single-cursos/{{ $curso->slug }}">Bienvenida</li>

                            @if ( auth()->user()->tieneSuscripcion()  )
                                @foreach($temario as $ctemario)
                                    <li class="active {{ $ctemario->slug ==  $clase['slug'] ? "active-leccion" : "" }}" data-url="/single-cursos/{{ $curso->slug."/".$ctemario->slug }}">{{ $ctemario->nombre_video }}
                                        @if (count($ctemario->url_video) > 1)
                                            <ul class="row-leccion">
                                                @for($i = 0; $i <= count($ctemario->url_video) - 1; $i++)
                                                    <li class="active" data-url="/single-cursos/{{ $curso->slug."/".$ctemario->slug."/".$i }}"> Session #{{ $i + 1 }} </li>
                                                @endfor
                                            </ul>
                                        @endif
                                    </li>

                                @endforeach
                            @else
                                @foreach($temario as $ctemario)
                                    <li>{{ $ctemario->nombre_video }}</li>
                                @endforeach
                            @endif

                        </ul> <!-- /row-leccion -->
                        
                        <div class="perfil-profesor">
                        
                            <div class="img-profesor" style="background-image: url({{Storage::url($curso->instructor[0]->img) }});"></div>
                            
                            <div class="bio-profesor">
                                <p>{{ $curso->instructor[0]->nombres. " ".$curso->instructor[0]->apellidos }}</p>
                                <p>{{ $curso->instructor[0]->especialidad }}.</p>
                                <p>{{ $curso->instructor[0]->bibliografia }}</p>
                            </div> <!-- /bio-profesor -->
                            
                        </div> <!-- /row-perfil -->
                        
                    </div> <!-- /sidebar-single -->
                    
                    <div class="single-contenido">
                        
                        <div class="txt-single">
                            <h3>{{ $clase['nombre_video'] }}</h3>
                            <p>Producción musical / {{ $curso->extra ? "CURSO EXTRA" : "CURSO BASE" }} / Profesor titular: {{ $curso->instructor[0]->nombres. " ".$curso->instructor[0]->apellidos }} </p>
                        </div> <!-- /txt-single -->
                        
                        <div class="row-video">
                            <iframe src="{{ $clase['url_video'] }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div> <!-- /row-video -->
                        
                        <div class="txt-single">
                            <h3>{{ $clase['nombre_video'] }}</h3>
                            <p>Producción musical / {{ $curso->extra ? "CURSO EXTRA" : "CURSO BASE" }} / Profesor titular: {{ $curso->instructor[0]->nombres. " ".$curso->instructor[0]->apellidos }} </p>
                            <div class="descripcion-single">
                                <p> {{ $clase['descripcion'] }} </p>
                            </div> <!-- /descripcion-single -->
                        </div> <!-- /txt-single -->
                    
                        <div class="banner-botones">
                            <h4>¿PRIMERA VEZ ESTUDIANDO EN LÍNEA?</h4>
                            <p>Te damos algunas recomendaciones para que aproveches al máximo esta experiencia.</p>
                        </div> <!-- /banner-botones -->
                        
                    </div> <!-- /single-contenido -->
                    
                    <div class="sidebar-registro">

                        @if ( !auth()->user()->tieneSuscripcion() )
                            <div class="txt-sidebar">
                                {{-- <span><a href="#">Empezar curso</a></span> --}}
                                <div>
                                    <p>Obtén tu membresía para comenzar este curso</p>
                                    <hr class="b-bottom">
                                    <p>Membresía básica $500.00 MXN mensuales*</p>
                                    <p><small>* Pruébala por 30 días</small></p>
                                    <a href="#">Obtener</a>
                                    <hr class="b-bottom">
                                    <p>Membresía académica</p>
                                    <p><small>$2,000.00 MXN mensuales*</small></p>
                                    <p><small>Este curso pertenece al plan de estudios del programa: Técnico en Producción Musical</small></p>
                                    <a href="#">Obtener</a>
                                    <p><small>* Recuerda que esta membresía también te da  acceso a todos los cursos que no pertenecen a tu plan de estudios.</small></p>
                                </div>
                            </div> <!-- /txt-sidebar -->

                            @if (!$favorito)
                                <div class="flex flex-center favorito favcurso" data-crs="{{ $curso->slug }}" data-seccion="curso">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este curso como favorito</p>
                                </div> <!-- /favorito -->
                            @endif

                        <br>
                        
                        @elseif ( $validarSide == "sb#2" )

                            <div class="txt-sidebar">
                                @if (!$miTablero)
                                    <span><a href="#" class="empezar_curso" data-crs="{{ $curso->slug }}">Empezar curso</a></span>
                                @else
                                    <div>
                                        <p>¡Estás listo para comenzar!</p>
                                        <p>Ahora podrás encontrar este curso en tu tablero personal para que puedas acceder rápidamente a él.</p>
                                        <p>¿Quieres saber cómo aprovechar mejor este curso?</p>
                                        <p>Echa un vistazo rápido a las recomendaciones para tomar este curso por tu cuenta:</p>
                                        <a href="#">Camino de aprendizaje</a>
                                    </div>
                                @endif
                            </div> <!-- /txt-sidebar -->
                            
                            @if (!$favorito)
                                <div class="flex flex-center favorito favcurso" data-crs="{{ $curso->slug }}" data-seccion="curso">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este curso como favorito</p>
                                </div> <!-- /favorito -->
                            @endif
                            
                            @if ( count($clase["material_extra"]) > 0 )
                                <a class="flex flex-center favorito" href="{{ route("download.material-curso", [$curso->slug, $clase['slug']] ) }}">
                                    <img src="/site/img/descarga.png">
                                    <p>Descarga el material de esta lección</p>
                                </a> <!-- /favorito -->
                            @endif
                        
                        <br>

                        @elseif ( $validarSide == "sb#3" )
                        
                            <div class="txt-sidebar">
                                @if (!$miTablero)
                                    <span><a href="#" class="empezar_curso" data-crs="{{ $curso->slug }}">Empezar curso</a></span>
                                @else
                                    <div>
                                        <p>¡Estás listo para comenzar!</p>
                                        <p>Ahora podrás encontrar este curso en tu tablero personal para acceder rápidamente a él.</p>
                                        <p>¿Qué sigue?</p>
                                        <p>Recuerda ingresar al Aula Virtual de este curso cada semana para subir tus tareas y recibir retroalimentación de tu profesor.</p>
                                        <p>Revisa tus calificaciones en el área de status del alumno.</p>
                                    </div>
                                @endif
                                
                            </div> <!-- /txt-sidebar -->
                            
                            @if (!$favorito)
                                <div class="flex flex-center favorito favcurso" data-crs="{{ $curso->slug }}" data-seccion="curso">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este curso como favorito</p>
                                </div> <!-- /favorito -->
                            @endif
                            
                            @if ( count($clase["material_extra"]) > 0 )
                                <a class="flex flex-center favorito" href="{{ route("download.material-curso", [$curso->slug, $clase['slug']] ) }}">
                                    <img src="/site/img/descarga.png">
                                    <p>Descarga el material de esta lección</p>
                                </a> <!-- /favorito -->
                            @endif
                        
                        <br>
                        

                        @elseif ( $validarSide == "sb#4" )

                            <div class="txt-sidebar">
                                @if (!$miTablero)
                                    <span><a href="#" class="empezar_curso" data-crs="{{ $curso->slug }}">Empezar curso</a></span>
                                @else
                                    <div>
                                        <p>¡Estás listo para comenzar!</p>
                                        <p>Ahora podrás encontrar este curso en tu tablero personal para acceder rápidamente a él.</p>
                                        <p>¿Qué sigue?</p>
                                        <p>Recuerda ingresar al Aula Virtual de este curso cada semana para subir tus tareas y recibir retroalimentación de tu profesor.</p>
                                        <p>Revisa tus calificaciones en el área de status del alumno.</p>
                                    </div>
                                @endif
                            </div> <!-- /txt-sidebar -->
                        
                            @if (!$favorito)
                                <div class="flex flex-center favorito favcurso" data-crs="{{ $curso->slug }}" data-seccion="curso">
                                    <img src="/site/img/estrella.png">
                                    <p>Marca este curso como favorito</p>
                                </div> <!-- /favorito -->
                            @endif
                            
                            @if ( count($clase["material_extra"]) > 0 )
                                <a class="flex flex-center favorito" href="{{ route("download.material-curso", [$curso->slug, $clase['slug']] ) }}">
                                    <img src="/site/img/descarga.png">
                                    <p>Descarga el material de esta lección</p>
                                </a> <!-- /favorito -->
                            @endif

                        @endif
                        
                    </div> <!-- /sidebar-registro -->

                </div> <!-- /flex -->
            </div> <!-- /wrapper-curso -->
            
        </div> <!-- /hoja-1000 -->

    </section> <!-- /single-curso -->

@stop

@section('js-content')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="/site/js/app.js"></script>
@stop