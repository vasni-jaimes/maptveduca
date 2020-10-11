<span class="ico-filtro"><img src="site/img/filtro.png"></span>

<div class="sidebar-cursos">

    @foreach($categorias as $categoria)
        <ul>
            <li style="cursor: pointer; font-weight: bold" class="{{ $categoria->quitarAcentos($categoria->nombre) }}" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> 
                {{ $categoria->nombre }}( {{ $categoria->obtenerConteoCat( $categoria->id ) }} ) 
            </li>
        </ul>

        <ul>
            <li style="cursor: pointer" class="nuevo" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> Nuevo( {{ ($categoria->cursos->count() > 5) ? 5 : $categoria->cursos->count() }} ) </li>
            @foreach($categoria->subcategorias as $subcategoria)
                    <li style="cursor: pointer" class="{{ $categoria->quitarAcentos($subcategoria->nombre) }}" data-cat="{{ $categoria->quitarAcentos($categoria->nombre) }}"> 
                        {{ $subcategoria->nombre }}( {{ $categoria->ObtenerCursos( $subcategoria->id )->count() }} ) 
                    </li>
            @endforeach
        <ul>
        <br>
    @endforeach

    <ul>
        <li style="cursor: pointer; font-weight: bold" class="profesores" data-cat="profesores"> 
            Profesor( 0 ) 
        </li>
    </ul>

    <ul>
        @foreach($instructores as $instructor)
                <li style="cursor: pointer" class="{{ md5($instructor->id) }}" data-cat="{{ md5($instructor->id) }}"> 
                    {{ $instructor->nombres." ".$instructor->apellidos }}( {{ $instructor->cursos->count() }} ) 
                </li>
        @endforeach
    <ul>


    {{-- <ul>https://www.facebook.com/profile.php?id=100005089786064&fref=search&__tn__=%2Cd%2CP-R&eid=ARCmGLqaq3tbcY1U0HnXJ1GGqGRFGJ1kdUKmrlIC8E02fug3FQgG5eIJDDXkU-DqzmC8F71bbj6LwODd
        <li>Producción musical (0)</li>
        <li>Música (0)</li>
    </ul>
    <ul>
        <li>Nuevo (0)</li>
    </ul>
    <ul>
        <li>Cursos base (0)</li>
        <li>Cursos extra (0)</li>
    </ul>
    <ul>
        <li>Principiante (0)</li>
        <li>Intermedio (0)</li>
        <li>Avanzado (0)</li>
    </ul>
    <ul>
        <li>Grabación (0)</li>
        <li>Mezcla (0)</li>
        <li>DAW’s (0)</li>
        <li>Teoría musical (0)</li>
        <li>Solfeo (0)</li>
        <li>Composición (0)</li>
        <li>Análisis (0)</li>
        <li>Ensamble (0)</li>
    </ul>
    <ul>
        <li>Canto (0)</li>
        <li>Piano (0)</li>
        <li>Guitarra (0)</li>
        <li>Bajo (0)</li>
        <li>Batería (0)</li>
    </ul>
    <ul>
        <li>Music Business (0)</li>
    </ul>
    <ul>
        <li>Profesor 1 (0)</li>
        <li>Profesor 2 (0)</li>
        <li>Profesor 3 (0)</li>
        <li>Profesor 4 (0)</li>
    </ul> --}}

</div> <!-- /sidebar-cursos --> 