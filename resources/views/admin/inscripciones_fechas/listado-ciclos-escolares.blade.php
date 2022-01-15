<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->


@section('titulo', 'Lista de Cursos')

@section('css-content')
    <!-- FooTable -->
    <link href="/admini/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@stop



@section("contenido")


    @if (session()->has("status.lista_ciclos"))
        @if (session()->get("status.lista_ciclos") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.lista_ciclos") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se elimino correctamente el ciclo
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif

    


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Lista de Ciclos Escolares</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Lista de Ciclos Escolares</strong>
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
                            <a href="{{ route('vista-crear_ciclo.fechas') }}" class="btn btn-primary btn-xs btn-bold">Agregar Nuevo Ciclo Escolar</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            @if (!$ciclos->isEmpty())
                                <table class="table table-striped table-bordered table-hover dataTables-example tabla-ciclos">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha Inicio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ciclos as $ciclo)
                                            <tr class="gradeX">
                                                <td> {{ $ciclo->nombre }} </td>
                                                <td>
                                                    @foreach($ciclo->fechasTrimestres as $fecha)
                                                        {{ $helper->getFechaEspanol($fecha->fecha_inicio) }}
                                                        @break
                                                    @endforeach
                                                </td>
                                                <td class="center">
                                                    <div class="btn-group">
                                                     	<a href="{{ route('vista-editar_ciclo.fechas', $ciclo->slug) }}" class="btn-primary btn btn-xs mr-3">Editar Ciclo Escolar</a>
                                                        <form method="POST" action="{{ route("eliminar-ciclo.fechas", $ciclo->slug) }}" name="eliminar_ciclos">
                                                            @csrf
                                                            <a href="#" class="btn-danger btn btn-xs mr-3 btn-eliminar_ciclos">Eliminar Ciclo Escolar</a>
                                                        </form>
                                                   </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha Inicio</th>
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