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
            <h2>Crear nuevo Mensaje</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Mensajes</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo mensaje</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.newMensaje"))
        @if (session()->get("status.newMensaje") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.newMensaje") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se mando el mensaje correctamente
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
                    <h5>Formulario - Evento Nuevo</h5>
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
                    <form action="{{ route('sendMensaje') }}" method="POST" accept-charset="UTF-8" name="frm-agregar_mensaje">
                        @csrf


                        @if ($cursos)

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Cursos: </label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="select_cursos">
                                        <option value="">Cursos</option>
                                        @forelse($cursos as $curso)
                                            <option value="{{ $curso->id }}"> {{ $curso->nombre }} </option>
                                        @empty
                                            <option value=""> No se encontraron resultados </option>
                                        @endforelse
                                    </select>
                                    <span class='form-text m-b-none errors'> {!! $errors->first('select_cursos') !!} </span>
                                </div>
                            </div>

                        @endif

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Usuarios: </label>
                            <div class="col-sm-10 mb-3 sub-usuarios">
                                <select data-placeholder="Usuarios" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_usuarios[]">
                                    @foreach($usuarios as $usuario)
                                        {{-- @if ($usuario->tieneSuscripcion()) --}}
                                            <option value="{{ $usuario->id }}">
                                                {{ $usuario->nombre.' '. $usuario->apaterno.' '.$usuario->amaterno }}
                                            </option>
                                        {{-- @endif --}}
                                    @endforeach
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_usuarios.*') !!} </span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Mensaje: </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="mensaje" rows="3">{{ old("mensaje") }}</textarea>
                                <span class='form-text m-b-none errors'> {!! $errors->first('mensaje') !!} </span>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Enviar Mensaje</button>
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