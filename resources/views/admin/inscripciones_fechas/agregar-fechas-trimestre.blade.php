<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Fecha de Inscripción')

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@stop



@section("contenido")
    
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agregar Ciclo Escolar</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('listado-ciclos') }}">Lista de Ciclos Escolares</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Agregar Ciclo Escolar</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.crear_ciclos"))
        @if (session()->get("status.crear_ciclos") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.crear_ciclos") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se creo el Ciclo Escolar correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif

    <div class="row justify-content-center mt-3">
        <div class="col-lg-10">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Formulario - Agregar Ciclo Escolar</h5>
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
                    <form action="{{ route("guardar-ciclo.fechas") }}" method="POST" accept-charset="UTF-8" name="frm-agregar_ciclo-escolar">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre del ciclo: </label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="nombre_ciclo" value="{{ old("nombre_ciclo") }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('nombre_ciclo') !!} </span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        
                        <div class="form-group row"><label class="col-sm-2 col-form-label">Primer Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-1" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-1") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-1') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-1" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-1") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-1') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="form-group row"><label class="col-sm-2 col-form-label">Segundo Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-2" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-2") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-2') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-2" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-2") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-2') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>


                        <div class="form-group row"><label class="col-sm-2 col-form-label">Tercer Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-3" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-3") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-3') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-3" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-3") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-3') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="hr-line-dashed"></div>


                        <div class="form-group row"><label class="col-sm-2 col-form-label">Cuarto Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-4" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-4") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-4') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-4" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-4") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-4') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Quinto Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-5" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-5") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-5') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-5" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-5") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-5') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Sexto Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-6" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-6") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-6') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-6" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-6") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-6') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Septimo Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-7" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-7") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-7') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-7" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-7") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-7') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row"><label class="col-sm-2 col-form-label">Octavo Trimestre</label>
                            <div class="col-sm-10">
                                <div class="row" style="align-items:baseline">
                                    <label>DE </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_inicio-8" data-date-format="yyyy-mm-dd" value="{{ old("fecha_inicio-8") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_inicio-8') !!} </span>
                                    </div>
                                    <label> A </label>
                                    <div class="col-sm-2">
                                        <input class="form-control datepicker" name="fecha_final-8" data-date-format="yyyy-mm-dd" value="{{ old("fecha_final-8") }}">
                                        <span class='form-text m-b-none errors'> {!! $errors->first('fecha_final-8') !!} </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route("listado-ciclos") }}" class="btn btn-white btn-sm" type="submit">Cancel</a>
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

    <!-- Data picker -->
   <script src="/admini/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/admini/js/inspinia.js"></script>
    <script src="/admini/js/plugins/pace/pace.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            $('.datepicker').datepicker({
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