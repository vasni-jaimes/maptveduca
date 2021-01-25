<div>
    <span class="ico-filtro" id="ico-filtro"><img src="site/img/filtro.png"></span>
</div> <!-- /text-right -->

<div class="sidebar-cursos">
    <div class="close-sidebar"><span>X</span></div>
    @foreach($categorias as $categoria)
        <ul>
            <li style="cursor: pointer; font-weight: bold" class="{{ "padre-".$categoria->quitarAcentos($categoria->nombre) }}" data-cat="{{ "padre-".$categoria->quitarAcentos($categoria->nombre) }}"> 
                {{ $categoria->nombre }} ({{ $categoria->obtenerConteoCat( $categoria->id )}}) 
            </li>
        </ul>

        <ul>
            <li style="cursor: pointer" class="nuevo" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> Nuevo ({{ ($categoria->cursos->count() > 5) ? 5 : $categoria->cursos->count() }}) </li>
            @foreach($categoria->subcategorias as $subcategoria)
                    <li style="cursor: pointer" class="{{ $categoria->quitarAcentos($subcategoria->nombre) }}" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> 
                        {{ $subcategoria->nombre }} ({{ $categoria->ObtenerCursos( $subcategoria->id )->count() }}) 
                    </li>
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
                <li style="cursor: pointer" class="{{ md5($instructor->id) }}" data-cat="{{ md5($instructor->id) }}"> 
                    {{ $instructor->nombres." ".$instructor->apellidos }} ({{ $instructor->cursos->count() }}) 
                </li>
        @endforeach
    <ul>


</div> <!-- /sidebar-cursos --> 