<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Agregar Status')

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/iCheck/custom.css" rel="stylesheet">
     <link href="/admini/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/admini/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/admini/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <style type="text/css">
        .iradio_square-green {
            margin-right: 10px;
        }
    </style>
@stop



@section("contenido")
    
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Status Inscripciones</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear status de inscripcion</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.inscripciones"))
        @if (session()->get("status.inscripciones") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.inscripciones") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se envio el status con exito
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
                    <h5>Formulario - Inscripciones</h5>
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
                    <form action="{{ route('inscripciones.store') }}" method="POST" accept-charset="UTF-8" name="frm-agregar_status_ins">
                        @csrf

                        @if ($status)

                            <div class="i-checks"><label> <input type="radio" value="1" {{ $status->status == 1 ? "checked" : "" }} name="status"> <i></i> Activar Indefinido </label></div>
                            <div class="i-checks"><label> <input type="radio" value="2" {{ $status->status == 2 ? "checked" : "" }} name="status"> <i></i> Desactivar Indefinido </label></div>
                            <div class="i-checks"><label> <input type="radio" value="3" {{ $status->status == 3 ? "checked" : "" }} name="status"> <i></i> Activar programada </label></div>

                            <br><br>
                            <div class="form-group row div-grupos" {{ $status->status == 3 || $status->status == 1 ? "style=display:flex" : "style=display:none" }}>
                                <label class="col-sm-2 col-form-label"> Grupos: </label>
                                <div class="col-sm-10 mb-3">
                                    <select data-placeholder="Grupos" class="chosen-select" style="width:350px;" multiple tabindex="4" name="select_grupos[]">
                                        @foreach($grupos as $grupo)
                                            <option value="{{ $grupo->id }}" 
                                                @if (in_array($grupo->id, old('select_grupos', $mygrupos))) selected @endif >
                                                {{ $grupo->nombre }}
                                            </option>    
                                        @endforeach
                                    </select>
                                    <span class='form-text m-b-none errors'> {!! $errors->first('select_grupos.*') !!} </span>
                                </div>
                            </div>


                            <div class="activa_programa" {{ $status->status == 3 ? "style=display:block" : "style=display:none" }}>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Fecha de inicio: </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio", $status->fecha_inicio) }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio') !!} </span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Fecha de fin: </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_fin" data-date-format="yyyy-mm-dd" value="{{ old("fecha_fin", $status->fecha_fin) }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_fin') !!} </span>
                                    </div>
                                </div>
                            </div>
                        @else


                            <div class="i-checks"><label> <input type="radio" value="1" name="status"> <i></i> Activar Indefinido </label></div>
                            <div class="i-checks"><label> <input type="radio" value="2" name="status"> <i></i> Desactivar Indefinido </label></div>
                            <div class="i-checks"><label> <input type="radio" value="3" name="status"> <i></i> Activar programada </label></div>

                            <br><br>
                            <div class="form-group row div-grupos" style="display: none">
                                <label class="col-sm-2 col-form-label"> Grupos: </label>
                                <div class="col-sm-10 mb-3">
                                    <select data-placeholder="Grupos" class="chosen-select" style="width:350px;" multiple tabindex="4" name="select_grupos[]">
                                        @foreach($grupos as $grupo)
                                            <option value="{{ $grupo->id }}" 
                                                @if(is_array(old('select_grupos')) && in_array($instructor->id, old('select_grupos'))) selected @endif>
                                                {{ $grupo->nombre }}
                                            </option>    
                                        @endforeach
                                    </select>
                                    <span class='form-text m-b-none errors'> {!! $errors->first('select_grupos.*') !!} </span>
                                </div>
                            </div>


                            <div class="activa_programa" style="display: none">
                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Fecha de inicio: </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio') !!} </span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Fecha de fin: </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_fin" data-date-format="yyyy-mm-dd" value="{{ old("fecha_fin") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_fin') !!} </span>
                                    </div>
                                </div>
                            </div>


                        @endif


                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="#" class="btn btn-white btn-sm" type="submit">Cancel</a>
                                <button class="btn btn-primary btn-sm" type="submit">Agregar Status</button>
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
                radioClass: 'iradio_square-green',
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