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


    @if (session()->has("status.newInstructor"))
        @if (session()->get("status.newInstructor") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.newInstructor") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se creo el instructor correctamente
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

    @php $i = 0; @endphp
    @foreach($temario as $tema)
        <div class="row justify-content-center mt-3">
            <div class="col-lg-10">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{  $tema->nombre_video }}</h5>
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
                                    <li><a href="#">Config</a></li>
                                </ul>
                            </div>

                            @foreach($publicaciones as $publicacion)
                                @if( $publicacion->session_id == $i )
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
                                @endif
                            @endforeach

                            <div class="social-footer">

                                @if ($publicaciones->where('session_id', $i)->count() > 0)
                                    @if ( $respuestas->where('publicacion_id', $publicaciones->where('session_id', $i)[0]->id)->count() > 0 )
                                        @foreach($respuestas->where('publicacion_id', $publicaciones->where('session_id', $i)[0]->id) as $respuesta)
                                            <div class="social-comment">
                                                <div class="media-body">
                                                    <a href="#">
                                                        @if ($respuesta->instructor_id != null)
                                                             Profr. {{ $respuesta->instructor->nombres." ".$respuesta->instructor->apellidos }}
                                                        @else
                                                            {{ $respuesta->usuario->nombre." ".$respuesta->usuario->apaterno }}
                                                        @endif

                                                    </a><br>
                                                    {!! $respuesta->respuesta !!}
                                                    <br/>
                                                </div>
                                            </div>
                                            <hr>
                                        @endforeach
                                    @endif
                                @endif

                                <div class="social-comment">
                                    <div class="media-body">
                                        @if ( $publicaciones->where('session_id', $i)->count() > 0 )
                                            <form action="{{ route('aula-virtual-respuesta.store', $publicaciones->where('session_id', $i)[0]->id) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @else
                                             <form action="{{ route('aula-virtual.store', [$curso->slug, $i]) }}" name="publicar-texto" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @endif
                                                @csrf
                                                <textarea name="publicaciontxt" class="form-control" placeholder="Write comment..."></textarea><br>
                                                <input type="file" name="archivo_aula"><br><br>
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
        @php $i++; @endphp
    @endforeach

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