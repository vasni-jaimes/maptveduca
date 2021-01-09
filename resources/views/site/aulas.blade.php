<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

<div class="banner-small"></div> <!-- /banner-small -->

<section class="aulas">

    <div class="hoja-1200">

        <ul class="flex breadcrumb-curso">
            <li><a href="{{ route('micuenta.index') }}">TABLERO PERSONAL</a> / AULAS VIRTUALES</li>
        </ul> <!-- /breadcrumb-curso -->  

        <div class="wrapper-aulas">
            <h1>Aulas Virtuales</h1>
            @if ($materias->count() > 0)
                <ul class="lista-materias">
                    @foreach($materias as $materia)
                        <li><a href="{{ route('aula-virtual.show', $materia->slug) }}">{{ $materia->nombre }}</a></li>
                    @endforeach
                </ul> <!-- /lista-materias -->
            @else
                <p>No tienes cursos para aula virtual</p>
            @endif
        </div> <!-- /wrapper-aulas -->

     </div> <!-- /hoja-1200 -->
     
</section> <!-- /aulas -->

@stop