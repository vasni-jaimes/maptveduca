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
            <h2>Lista de Usuarios</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Usuarios</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Lista de Usuarios</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>
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
                            @if (!$usuarios->isEmpty())
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido(s)</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usuarios as $usuario)
                                            <tr class="gradeX">
                                                <td> {{ $usuario->nombre }} </td>
                                                <td> {{ $usuario->amaterno." ".$usuario->apaterno }} </td>
                                                <td> {{ $usuario->email }} </td>
                                                <td class="center"> {!! $usuario->status == 1 ? "<span class='float-center label label-primary'>Activo</span>" : "<span class='float-center label label-danger'>Inactivo</span>" !!} </td>
                                                <td class="center">
                                                    
                                                    <div class="btn-group">
                                                      <a href = "#" class="btn-info btn btn-xs mr-3">Ver perfil</a>
                                                      <a href="#" class="btn-danger btn btn-xs mr-3">Eliminar usuario</a>
                                                      <a href = "#" class="btn-info btn btn-xs mr-3">Editar</a>
                                                      @if ($usuario->status == 1)
                                                          <a href = "#" class="btn-danger btn btn-xs ml-2">Desactivar</a>
                                                        @else
                                                            <a href="#" class="btn-primary btn btn-xs ml-2">Activar</a>
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

@stop