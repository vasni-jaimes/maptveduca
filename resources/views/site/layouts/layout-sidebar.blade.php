<div>
    <span class="ico-filtro" id="ico-filtro"><img src="site/img/filtro.png"></span>
</div> <!-- /text-right -->

<div class="sidebar-cursos">
    <div class="close-sidebar"><span>X</span></div>

    <ul class="guia-es">
        <li style="cursor: pointer; font-weight: bold">
            <a href="{{ route("guia-estudio") }}" style="color: #000">Guia de estudio</a>
        </li>
    </ul>

    @foreach($categorias as $categoria)

        @if ($categoria->obtenerConteoCat( $categoria->id ))
            <ul>
                <li style="cursor: pointer; font-weight: bold" class="{{ "padre-".$categoria->quitarAcentos($categoria->nombre) }}" data-cat="{{ "padre-".$categoria->quitarAcentos($categoria->nombre) }}"> 
                    {{ $categoria->nombre }} ({{ $categoria->obtenerConteoCat( $categoria->id ) }}) 
                </li>
            </ul>
        @endif

        <ul>
            @if ($categoria->cursos->count())
                <li style="cursor: pointer" class="nuevo" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> Nuevo ({{ ($categoria->cursos->count() > 5) ? 5 : $categoria->cursos->count() }}) </li>
            @endif
            @foreach($categoria->subcategorias as $subcategoria)
                @if ($categoria->ObtenerCursos( $subcategoria->id )->count())
                    <li style="cursor: pointer" class="{{ $categoria->quitarAcentos($subcategoria->nombre) }}" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> 
                        {{ $subcategoria->nombre }} ({{ $categoria->ObtenerCursos( $subcategoria->id )->count() }}) 
                    </li>
                @endif
            @endforeach
        <ul>
        <br>
    @endforeach

    <ul>
        <li style="cursor: pointer; font-weight: bold" class="profesores" data-cat="profesores"> 
            Profesor ({{ $instructores->count() }}) 
        </li>
    </ul>

    <ul>
        @foreach($instructores as $instructor)
            @if ($instructor->cursos->count())
                <li style="cursor: pointer" class="{{ "ab".md5($instructor->id) }}" data-cat="{{ "ab".md5($instructor->id) }}"> 
                    {{ $instructor->nombres." ".$instructor->apellidos }} ({{ $instructor->cursos->count() }}) 
                </li>
            @endif
        @endforeach
    <ul>


</div> <!-- /sidebar-cursos --> 