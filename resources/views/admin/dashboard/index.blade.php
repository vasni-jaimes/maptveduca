<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Dashboard')


@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
@stop


@section("contenido")


	<h1> Dashboard </h1>

	<figure>
		<img src="/site/img/logo-amarillo.png" />
	</figure>	

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

@stop