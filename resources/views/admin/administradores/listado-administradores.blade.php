<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->


@section('titulo', 'Lista de Usuarios')

@section('css-content')
    <!-- FooTable -->
    <link href="/admini/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@stop



@section("contenido")

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Lista de Administradores</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Lista de Administradores</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.deleteUsuario"))
        @if (session()->get("status.deleteUsuario") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.deleteUsuario") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se elimino el usuario correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            @if (!$usrAdmin->isEmpty())
                                <table class="table table-striped table-bordered table-hover dataTables-example tabla-usuarios">
                                    <thead>
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Apellido(s)</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usrAdmin as $admin)
                                            <tr class="gradeX">
                                                <td> {{ $admin->nombres }} </td>
                                                <td> {{ $admin->apellidos }} </td>
                                                <td> {{ $admin->email }} </td>
                                                <td>
                                                    {{ $admin->getRoleNames()->first() }}
                                                </td>
                                                <td class="center"> {!! $admin->status == 1 ? "<span class='float-center label label-primary'>Activo</span>" : "<span class='float-center label label-danger'>Inactivo</span>" !!}</td>
                                                <td class="center">
                                                    
                                                    <div class="btn-group">
                                                        <form action="" method="POST" name="form_eliminar-administrador">
                                                            @csrf
                                                            <input type="hidden" name="admin_id" value="{{ $helper::base64_encode_url($admin->id) }}">
                                                            <button class="btn-danger btn btn-xs mr-3">Eliminar</button>    
                                                        </form>
                                                      
                                                      <a href = "{{ route("editar-administradores.edit", $helper::base64_encode_url($admin->id)) }}" class="btn-info btn btn-xs mr-3">Editar</a>
                                                      @if ($admin->status == 1)
                                                          <a href = "#" class="btn-danger btn btn-xs ml-2 btn-desactivar" data-st="0" data-id="{{ $helper::base64_encode_url($admin->id) }}">Desactivar</a>
                                                        @else
                                                            <a href="#" class="btn-primary btn btn-xs ml-2 btn-desactivar" data-st="1" data-id="{{ $helper::base64_encode_url($admin->id) }}">Activar</a>
                                                        @endif
                                                   </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido(s)</th>
                                            <th>Email</th>
                                            <th>Rol</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            @else
                                <h2> No se encontraron resultados </h2>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop


@section('js-content')

	<!-- Mainly scripts -->
    <script src="/admini/js/jquery-3.1.1.min.js"></script>
    <script src="/admini/js/popper.min.js"></script>
    <script src="/admini/js/bootstrap.js"></script>
    <script src="/admini/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/admini/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/admini/js/plugins/dataTables/datatables.min.js"></script>
    <script src="/admini/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/admini/js/inspinia.js"></script>
    <script src="/admini/js/plugins/pace/pace.min.js"></script>
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                ordering: false,
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
         
                    {extend: 'print',
                    	customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
         
                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    	}
                    }
                 ]
         
             });
         
         });
         
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/admini/js/app.js"></script>

@stop