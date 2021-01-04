<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Agregar Evento')

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
            <h2>Crear nuevo Evento</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Eventos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo evento</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.updateEvento"))
        @if (session()->get("status.updateEvento") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.updateEvento") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se actualizo el evento correctamente
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
                <div class="ibox-title">
                    <h5>Formulario - Editar Evento</h5>
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
                    <form action="{{ route("editar-evento.update", $helper::base64_encode_url($id)) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" name="frm-editar_evento">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre del evento: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombre_evento" value="{{ old("nombre_evento", $evento->nombre) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('nombre_evento') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-sm-2 col-form-label">Imagen de evento: </label>
                            <div class="col-sm-10">
                                <input id="logo" type="file" name="img_evento" class="form-control" accept="image/png, image/jpeg, image/jpg">
                                <span class='form-text m-b-none errors'> {!! $errors->first('img_evento') !!} </span>
                            </div> 
                        </div>

                        <div class="img-admin_editcurso col-sm-10 offset-sm-2 mb-5">
                            <figure>
                                <img src="{{ Storage::url($evento->img_evento) }}">
                            </figure>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> instructor: </label>
                            <div class="col-sm-10 mb-3">
                                <select data-placeholder="Instructores" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_instructores[]">
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" 
                                            @if(in_array($instructor->id, old('select_instructores', $myInstructors))) selected @endif>
                                            {{ $instructor->nombres." ".$instructor->apellidos }}
                                        </option>    
                                    @endforeach
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_instructores.*') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tipo de Evento: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="select_tipo">
                                    <option value="">Tipos</option>
                                    @forelse($tipoeventos as $tipoevento)
                                        <option value="{{ $tipoevento->id }}" @if ($tipoevento->id == $evento->tipo_evento_id) selected @endif > {{ $tipoevento->nombre }} </option>
                                    @empty
                                        <option value=""> No se encontraron resultados </option>
                                    @endforelse
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_tipo') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row mb-5">
                            <label class="col-sm-2 col-form-label">Evento especial: </label>
                            <div class="i-checks col-sm-10">
                                <label> <input type="checkbox" value="1" name="evento_especial" @if(old("evento_especial", $evento->especial) == 1) checked @endif> <i></i></label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Precio: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="precio" value="{{ old("precio") }}">
                                <span class='form-text m-b-none errors'> {!! $errors->first('precio') !!} </span>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <h2> Bienvenida al evento</h2>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Video de Bienvenida: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="video_bienvenida" value="{{ old("video_bienvenida", $evento->video_bienvenida) }}">
                                <span class='form-text m-b-none errors'> {!! $errors->first('video_bienvenida') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descripcion: </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="descripcion" rows="3">{{ old("descripcion", $evento->descripcion) }}</textarea>
                                <span class='form-text m-b-none errors'> {!! $errors->first('descripcion') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fecha de Lanzamiento: </label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="fecha_inicio" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio", Carbon::parse($evento->fecha_lanzamiento)->format("Y-m-d")) }}">
                                <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio') !!} </span>
                            </div>
                            <label class="pt-2 font-weight-bold"> : </label>
                            <div class="col-sm-2 clockpicker" data-autoclose="true">
                                <input class="form-control" name="hora_inicio" value="{{ old('hora_inicio', Carbon::parse($evento->fecha_lanzamiento)->format("H:i")) }}">
                                <span class='form-text m-b-none errors'> {!! $errors->first('hora_inicio') !!} </span>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="eventos_two">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Precio: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="precio" value="{{ old("precio") }}">
                                    <span class='form-text m-b-none errors'> {!! $errors->first('precio') !!} </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL video: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="url_video" value="{{ old("url_video", $evento->video_evento) }}">
                                    <span class='form-text m-b-none errors'> {!! $errors->first('url_video') !!} </span>
                                </div>
                            </div>

                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
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