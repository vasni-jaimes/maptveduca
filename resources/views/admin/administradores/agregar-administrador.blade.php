<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Agregar Administrador')

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
            <h2>Crear nuevo Administrador</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route("listado-administradores.index") }}">Lista de Administradores</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo administrador</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.newAdmin"))
        @if (session()->get("status.newAdmin") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.newAdmin") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se creo el Usuario correctamente
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
                    <h5>Formulario - Administrador Nuevo</h5>
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
                    <form action="" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" name="frm-agregar_administrador">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombres" value="{{ old("nombres") }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('nombres') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Apellido(s): </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="apellidos" value="{{ old("apellidos") }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('apellidos') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" value="{{ old("email") }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('email') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Rol: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="select_roles">
                                    <option value="">roles</option>
                                    @forelse($roles as $rol)
                                        <option value="{{ $rol->id }}" @if (old('select_roles') == $rol->id) selected @endif> {{ $rol->name }} </option>
                                    @empty
                                        <option value=""> No se encontraron resultados </option>
                                    @endforelse
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_roles') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row" style="display: none;">
                            <label class="col-sm-2 col-form-label">Categoria a revisar: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="select_categorias">
                                    <option value="">Categorias</option>
                                    @forelse($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @if (old('select_categorias') == $categoria->id) selected @endif> 
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

    <!-- Custom and plugin javascript -->
    <script src="/admini/js/inspinia.js"></script>
    <script src="/admini/js/plugins/pace/pace.min.js"></script>
    
    <script src="/admini/js/app.js"></script>

@stop