<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->


@section('titulo', 'Lista de Cursos')

@section('css-content')
    <!-- FooTable -->
    <link href="/admini/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
@stop



@section("contenido")

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Lista de Cursos</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Aulas Virtuales</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Lista de Cursos</strong>
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
                            @if (!$materias->isEmpty())
                                <table class="table table-striped table-bordered table-hover dataTables-example tabla-cursos">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Imagen</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($materias as $materia)
                                            <tr class="gradeX">
                                                <td> {{ $materia->nombre }} </td>
                                                <td> <img src="{{ Storage::url($materia->url_img) }}" style="width: 100px"> </td>
                                                <td class="center">
                                                    <div class="btn-group">
                                                     	<a href = "{{ route('listado-grupos.aulas', $materia->slug) }}" class="btn-info btn btn-xs mr-3">Ver Grupos</a>
                                                   </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Imagen</th>
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