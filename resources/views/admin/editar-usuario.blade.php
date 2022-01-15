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
            <h2>Editar Usuario</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Usuarios</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Editar Usuario</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.updateUsuario"))
        @if (session()->get("status.updateUsuario") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.updateUsuario") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se actualizo el usuario correctamente
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
                    <h5>Formulario - Editar Usuario</h5>
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
                    {{-- {{ route('editar-instructor.update', $helper::base64_encode_url($id)) }} --}}
                    <form action="{{ route('usuarios.update', $id) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" name="frm-editar_usuario">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre del usuario: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombre" value="{{ old("nombre", $usuario->nombre) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('nombre') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Apellido materno: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="amaterno" value="{{ old("amaterno", $usuario->amaterno) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('amaterno') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Apellido paterno: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="apaterno" value="{{ old("apaterno", $usuario->apaterno) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('apaterno') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="{{ old("email", $usuario->email) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('email') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fecha de Nacimiento: </label>
                            <div class="col-sm-2">
                                <input class="form-control datepicker" name="fecha_nacimineto" data-date-format="yyyy-mm-dd" value="{{ old("fecha_nacimineto", $usuario->fecha_nacimiento) }}">
                                <span class='form-text m-b-none errors'> {!! $errors->first('fecha_nacimineto') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Grupos: </label>
                            <div class="col-sm-10 mb-3">
                                <select data-placeholder="grupos" class="chosen-select" style="width:350px;" name="select_grupo">
                                    @foreach($grupos as $grupo)
                                        <option value="{{ $grupo->id }}" {{ $usuario->grupo_id == $grupo->id ? "selected" : "" }}>
                                            {{ $grupo->nombre }} 
                                        </option>
                                    @endforeach
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_carreras') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-2 col-form-label">Suscripcion: </label>
                            <div class="i-checks col-sm-10">
                                <label> <input type="checkbox" value="1" name="suscripcion" @if(old("suscripcion", $usuario->tieneSuscripcion()) == true) checked @endif> <i></i></label>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-2 col-form-label">Renovar Automaticamente: </label>
                            <div class="i-checks col-sm-10">
                                <label> <input type="checkbox" value="1" name="renovar" @if(old("renovar", $usuario->renovar) == true) checked @endif> <i></i></label>
                            </div>
                        </div>

                        <div class="form-group row" style="{{ $usuario->tieneSuscripcion() == true ? "display: flex" : "display: none" }}">
                            <label class="col-sm-2 col-form-label"> Carreras: </label>
                            <div class="col-sm-10 mb-3">
                                <select data-placeholder="Carreras" class="chosen-select" style="width:350px;" name="select_carreras">
                                    @foreach($careers as $career)
                                        <option value="{{ $career->id }}"
                                            @if($usuario->tieneSuscripcion()->carrera_id == $career->id) selected @endif>
                                            {{ $career->nombre }} 
                                        </option>
                                    @endforeach
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_carreras') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Regalar meses: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="meses_regalo">
                                    <option value="">meses</option>
                                    @for($i=1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i < 10 ? "0".$i : $i }}</option>
                                    @endfor
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('meses_regalo') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('password') !!} </span>
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