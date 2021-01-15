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
            <h2>Calificaciones</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Calificaciones - alumnos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Calificaciones</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.calificacion"))
        @if (session()->get("status.calificacion") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.calificacion") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se mando la calificacion correctamente
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
                    <h5>Calificaciones</h5>
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
                    <form action="{{ route('calificaciones.store', [$alumno_id, $slug_curso]) }}" method="POST" accept-charset="UTF-8" name="frm-agregar_calificaciones">
                        @csrf

                        <h1>  {{ $curso->nombre }} </h1>

                        <div class="hr-line-dashed"></div><br>

                        @if ($trimestreAlumno >= 1)

                            <h2> Primer Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_uno" value="{{ old("calificacion_uno", $califi["primero"]) }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_uno') !!} </span>
                                </div>
                            </div>

                        @endif


                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 2)

                            <h2> Segundo Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_dos" value="{{ old("calificacion_dos", $califi["segundo"]) }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_dos') !!} </span>
                                </div>
                            </div>

                        @endif


                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 3)

                            <h2> Tercer Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_tres" value="{{ old("calificacion_tres", $califi["tercero"]) }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_tres') !!} </span>
                                </div>
                            </div>

                        @endif


                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 4)

                            <h2> Cuarto Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_cuatro" value="{{ old("calificacion_cuatro", $califi["cuarto"]) }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_cuatro') !!} </span>
                                </div>
                            </div>

                        @endif

                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 5)

                            <h2> Quinto Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_cinco" value="{{ old("calificacion_cinco", $califi["quinto"]) }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_cinco') !!} </span>
                                </div>
                            </div>

                        @endif

                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 6)

                            <h2> Sexto Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_seis" value="{{ old("calificacion_seis") }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_seis') !!} </span>
                                </div>
                            </div>

                        @endif

                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 7)

                            <h2> Septimo Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_siete" value="{{ old("calificacion_siete") }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_siete') !!} </span>
                                </div>
                            </div>

                        @endif

                        <div class="hr-line-dashed"></div>

                        @if ($trimestreAlumno >= 8)

                            <h2> Octavo Trimestre </h2><br>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Calificacion: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="calificacion_ocho" value="{{ old("calificacion_ocho") }}"> 
                                    <span class='form-text m-b-none errors'> {!! $errors->first('calificacion_ocho') !!} </span>
                                </div>
                            </div>

                        @endif


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