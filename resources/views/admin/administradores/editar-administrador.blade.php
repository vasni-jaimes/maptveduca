<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Actualizar Administrador')

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
            <h2>Actualizar Administrador</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route("listado-administradores.index") }}">Listado de Administradores</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Actualizar Administrador</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.updateAdmin"))
        @if (session()->get("status.updateAdmin") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.updateAdmin") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se actualizo el administrador correctamente
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
                    <h5>Formulario - Actualizar Administrador</h5>
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
                    <form action="{{ route("actualizar-administradores.update", base64_encode($admin->id)) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" name="frm-editar_administrador">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombres: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombres" value="{{ old("nombres", $admin->nombres) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('nombres') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Apellido(s): </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="apellidos" value="{{ old("apellidos", $admin->apellidos) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('apellidos') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="{{ old("email", $admin->email) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('email') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rol: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="select_roles">
                                    <option value="">roles</option>
                                    @forelse($roles as $rol)
                                        <option value="{{ $rol->id }}" @if (old('select_roles', $admin->roles->contains("id", $rol->id)) == $rol->id) selected @endif> {{ $rol->name }} </option>
                                    @empty
                                        <option value=""> No se encontraron resultados </option>
                                    @endforelse
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_roles') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row" style="{{ $admin->categoria_id == 0 ? "display:none" : "display:felx" }}">
                            <label class="col-sm-2 col-form-label">Categoria a revisar: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="select_categorias">
                                    <option value="">Categorias</option>
                                    @forelse($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @if (old('select_categorias', $admin->categoria_id) == $categoria->id) selected @endif> 
                                            {{ $categoria->nombre }} 
                                        </option>
                                    @empty
                                        <option value=""> No se encontraron resultados </option>
                                    @endforelse
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_roles') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" value="{{ old("password") }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('password') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Confirmar Password: </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password_confirmation" value="{{ old("password_confirmation") }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('password_confirmation') !!} </span>
                            </div>
                        </div>



                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route("listado-administradores.index") }}" class="btn btn-white btn-sm" type="submit">Cancel</a>
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