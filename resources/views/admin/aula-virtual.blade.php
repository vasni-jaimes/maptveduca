<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Agregar Instructor')

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/iCheck/custom.css" rel="stylesheet">
     <link href="/admini/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/admini/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/admini/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
@stop



@section("contenido")
    
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Crear nuevo Instructor</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Instructores</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo instructor</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>

    <!-- MENSAJES AL MOMENTO DE AGREGAR UNA PUBLICACION -->
    @if (session()->has("status.newAula"))
        @if (session()->get("status.newAula") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.newAula") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se creo la publicacion correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif


    <!-- MENSAJES AL MOMENTO DE ELIMINAR UNA PUBLICACION -->
    @if (session()->has("status.deletePublicacion"))
        @if (session()->get("status.deletePublicacion") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.deletePublicacion") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se elimino la publicacion correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif


    <!-- MENSAJES AL MOMENTO DE ELIMINAR UNA RESPUESTA -->
    @if (session()->has("status.deletePublicacion"))
        @if (session()->get("status.deletePublicacion") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.deletePublicacion") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se elimino la respuesta correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif



     <!-- MENSAJE PARA EDITAR PUBLICIDAD -->
    @if (session()->has("status.updatePublicidad"))
        @if (session()->get("status.updatePublicidad") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.updatePublicidad") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se actualizo la publicacion correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif


    <!-- MENSAJE PARA EDITAR RESPUESTA -->
    @if (session()->has("status.updateRespuesta"))
        @if (session()->get("status.updateRespuesta") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.updateRespuesta") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se actualizo la respuesta correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif


        <!-- MENSAJE POR AGREGAR LA RESPUESTA -->
    @if (session()->has("status.newRespuesta"))
        @if (session()->get("status.newRespuesta") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.newRespuesta") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se agrego la respuesta correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif




    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row justify-content-center mt-3">
        <div class="col-lg-10">
            <div class="ibox">
                @foreach($publicaciones as $publicacion)
                    <div class="row justify-content-center mt-3">
                        <div class="col-lg-10">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>{{  $publicacion->nombre }}</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content" id="app">
                                	<div class="sk-spinner sk-spinner-double-bounce">
                                        <div class="sk-double-bounce1"></div>
                                        <div class="sk-double-bounce2"></div>
                                    </div>

                                    <div class="social-feed-box">

                                        <div class="float-right social-action dropdown">
                                            <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu m-t-xs">
                                                <li><a href="#" class="editar_public" data-pub="{{ $publicacion->id }}">editar</a></li>
                                                <li>
                                                    <form method="POST" action="{{ route('eliminar.publicacion', $publicacion->id) }}" name="eliminarPublicacion">
                                                        @csrf
                                                        <a href="#" class="eliminar_public">eliminar</a></li>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="social-avatar">
                                            <div class="media-body">
                                                <a href="#">
                                                    Profr. {{ $publicacion->instructor->nombres." ".$publicacion->instructor->apellidos }}
                                                </a>
                                                <small class="text-muted">{{ $publicacion->created_at }}</small>
                                            </div>
                                        </div>
                                        <div class="social-body">
                                            <p>
                                                {!! $publicacion->publicacion !!}
                                            </p>
                                        </div>

                                        <!-- EDITAR PUBLCIACION -->
                                        <div class="social-comment editar-publicacion" data-pub="{{ $publicacion->id }}">
                                            <div class="media-body">
                                                <form action="{{ route('aula-publicidad.update', $publicacion->id) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                                    @csrf
                                                    <textarea name="publicaciontxt" class="form-control" placeholder="editar publicacion">{{ $publicacion->publicacion }}</textarea><br>
                                                    <input type="file" name="archivos_aula[]" multiple=""><br><br>
                                                    <button class="btn btn-white btn-sm cancelar-edicion" type="submit">Cancelar</button>
                                                    <button class="btn btn-primary btn-sm editarp" type="submit">Editar Publicacion</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /EDITAR PUBLCIACION -->

                                        <hr>
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
                                            </div>
                                        @endif


                                        <div class="social-footer">

                                            @if ($respuestas->where('publicacion_id', $publicacion->id)->count() > 0)
                                                
                                                @foreach($respuestas->where('publicacion_id', $publicacion->id) as $respuesta)
                                                    
                                                    <div class="social-comment">

                                                        <div class="float-right social-action dropdown">
                                                            <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu m-t-xs">
                                                                @if ($respuesta->instructor_id == Auth::guard('admins')->user()->instructor_id)
                                                                    <li><a href="#" class="editar_resp" data-resp="{{ $respuesta->id }}">editar</a></li>
                                                                @endif
                                                                <li>
                                                                    <form method="POST" action="{{ route('eliminar.respuesta', $respuesta->id) }}" name="eliminarPublicacion">
                                                                        @csrf
                                                                        <a href="#" class="eliminar_public">eliminar</a></li>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="media-body">
                                                            <a href="#">
                                                                @if ($respuesta->instructor_id == Auth::guard('admins')->user()->instructor_id)
                                                                     Profr. {{ $respuesta->instructor->nombres." ".$respuesta->instructor->apellidos }}
                                                                @else
                                                                    {{ $respuesta->usuario->nombre." ".$respuesta->usuario->apaterno }}
                                                                @endif

                                                            </a><br>
                                                            {!! $respuesta->respuesta !!}
                                                            <br/>
                                                        </div>
                                                    </div>

                                                    @if ($respuesta->archivos != null)
                                                        <br>
                                                        <hr>
                                                        <div class="btn-archivo flex flex-center between">
                                                            <ul>
                                                                @php  
                                                                    $archivos = json_decode($respuesta->archivos);
                                                                @endphp

                                                                @for($i = 0; $i <= count($archivos) - 1; $i++)
                                                                    <li> <a href="{{ route('down.downloadFileResp', [$curso->slug,$publicacion->id,$respuesta->id,$i]) }}" style="text-decoration: none;outline:none; color: black;">{{ basename($archivos[$i]) }} </a> </li>
                                                                @endfor
                                                            </ul>
                                                        </div>
           
                                                    @endif

                                                    @if ($respuesta->instructor_id == Auth::guard('admins')->user()->instructor_id)
                                                        <!-- EDITAR RESPUESTA -->
                                                        <div class="social-comment editar-respuesta" data-resp="{{ $respuesta->id }}">
                                                            <div class="media-body">
                                                                <form action="{{ route('aula-respuesta.update', [$publicacion->id,$respuesta->id]) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <textarea name="publicaciontxt" class="form-control" placeholder="publicacion">{{ $respuesta->respuesta }}</textarea><br>
                                                                    <input type="file" name="archivos_aula[]" multiple=""><br><br>
                                                                    <button class="btn btn-white btn-sm cancelar-edicion" type="submit">Cancelar</button>
                                                                    <button class="btn btn-primary btn-sm editarr" type="submit">Editar Respuesta</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /EDITAR RESPUESTA -->
                                                        <hr><br>
                                                    @endif

                                                @endforeach

                                            @endif
                                            
                                            <div class="social-comment agregar-respuesta">
                                                <div class="media-body">
                                                    <form action="{{ route('aula-virtual-respuesta.store', $publicacion->id) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                                        @csrf
                                                        <textarea name="publicaciontxt" class="form-control" placeholder="publicacion"></textarea><br>
                                                        <input type="file" name="archivos_aula[]" multiple=""><br><br>
                                                        <button class="btn btn-primary btn-sm" type="submit">Publicar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <hr>
                <h2> Publicación Nueva </h2><br>
                <div class="social-comment ibox-content">
                    <div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <div class="media-body agregar-nuevo_post">
                        <form action="{{ route('aula-virtual.store', $curso->slug) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" placeholder="titulo de la publicacion" name="titulo" value="{{ old("nombre_evento") }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('titulo') !!} </span>
                                </div>
                            </div>
                            <textarea name="publicaciontxt" class="form-control" placeholder="publicacion"></textarea><br>
                            <input type="file" name="archivos_aula[]" multiple=""><br><br>
                            <button class="btn btn-primary btn-sm" type="submit">Publicar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section("js-content")

    <!-- Mainly scripts -->
    <script src="/admini/js/jquery-3.1.1.min.js"></script>
    <script src="/admini/js/popper.min.js"></script>
    <script src="/admini/js/bootstrap.js"></script>
    <script src="/admini/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/admini/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Chosen -->
    <script src="/admini/js/plugins/chosen/chosen.jquery.js"></script>
    <!-- Data picker -->
   <script src="/admini/js/plugins/datapicker/bootstrap-datepicker.js"></script>
   <!-- Clock picker -->
    <script src="/admini/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/admini/js/inspinia.js"></script>
    <script src="/admini/js/plugins/pace/pace.min.js"></script>
    <!-- iCheck -->
    <script src="/admini/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });
            $('.chosen-select').chosen({width: "100%"});
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            $('.clockpicker').clockpicker();

            var mem = $('.datepicker').datepicker({
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
       });
    </script>
    <script src="/admini/js/app.js"></script>

@stop