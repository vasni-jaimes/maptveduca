<!-- HEADER AND FOOTER -->
@extends('site.layouts.layout-online')
<!-- /HEADER AND FOOTER -->



@section('contenido')

    <section class="nosotros">
    
        <div class="banner-nosotros"></div> <!-- /banner-cursos -->
        
        <div class="titulo-banner">
            <h1>Nosotros</h1>
        </div> <!-- /titulo-banner -->
        
        <div class="hoja-1000">
            
            <div class="wrapper-nosotros">
            
                <div class="banner-title bg-yellow">
                    <h2>¿Quiénes somos?</h2>
                </div> <!-- /bg-black -->

                <div class="wrapper-maptv">

                    <div class="row-maptv text-center">

                        <p>Somos una nueva plataforma de educación virtual en materia de producción musical y música.</p>
                        <p>MAPtv EDUCA cuenta con el respaldo de su creador: M.A.P. Colegio de Música, Audio y Producción (Puebla, México), una institución con más de 14 años de experiencia en educación media-superior orientada a Producción Musical y Música.</p>
                        <p>A lo largo de los años Colegio MAP ha logrado convertirse en un semillero de nuevos artistas y profesionistas de la música, lo que a su vez ha generado un fortalecimiento importante de la escena musical local y regional.</p>
                        <p>A raíz del impacto social ocasionado por la propagación del COVID19, Colegio MAP decidió crear MAPtv EDUCA, un espacio virtual accesible para todas las personas de habla hispana en el mundo, y así seguir formando profesionales que comparten nuestra misma pasión: la música.</p>
                        <p>A través de MAPtv EDUCA traemos para ti todo el conocimiento y experiencia de nuestros propios profesores y de colaboradores pertenecientes a la industria musical nacional mexicana y latinoamericana.</p>
                        <p>¡No te pierdas la oportunidad de ser parte de nuestra gran comunidad!
                        <p>#EstudiaLoQueAmas</p>

                    </div> <!-- /row-maptv -->

                </div> <!-- /wrapper-maptv -->
            
            </div> <!-- /wrapper-nosotros -->
            
            <div class="banner-title bg-black">
                <h2>Marcas Hermanas</h2>
            </div> <!-- /bg-black -->
            
            <div class="wrapper-maptv">
                
                <div class="row-maptv">
                    <div class="banner-maptv">
                        <div class="txt-maptv text-center">
                            <p><strong>La industria musical es ampliamente diversa.</strong></p> 
                            <p><strong>MAPtv Educa cuenta con divisiones especiales que atienden diferentes áreas, como lo son: Educación presencial, educación virtual, y producciones musicales profesionales tanto discográficas como de eventos masivos.</strong></p>
                            <p><strong>¡Conócelas!</strong></p>
                        </div> <!-- /txt-maptv -->
                    </div> <!-- /row-maptv -->

                    <ul class="flex flex-marcas">
                        <li>
                            <div class="img-marcas">
                                <img src="/site/img/logo-map.png">
                            </div> <!-- /img-marcas -->
                            <div>
                                <p>Colegio MAP (Puebla, México) es un referente en la escena nacional mexicana como una de las escuelas de producción musical y música con mayor crecimiento en los últimos años.</p>
                                <p>Fundada en 2006 y renovada una década después, hoy es una institución que se mantiene fiel a su objetivo inicial: formar a los productores musicales del siglo XXI, multidisciplinarios, competitivos y exitosos.</p>
                                <p>Actualmente cuenta con una de las pocas secciones estudiantiles de la Audio Engineering Society en México, además de ser parte de la ALAEMUS (Asociación Latinoamericana de Escuelas de Música).</p>
                                <p>Colegio MAP se encuentra en la ciudad de Puebla, en Calzada Zavaleta 5620, Concepción La Cruz.</p>
                                <p><a href="https://www.colegiomap.com/" target="_blank">www.colegiomap.com</a></p>
                            </div>
                        </li>
                        <li>
                            <div class="img-marcas">
                                <img src="/site/img/logo-recording.png">
                            </div> <!-- /img-marcas -->
                            <div>
                                <p>MAP Recording es una productora discográfica y estudio de grabación profesional dentro de las instalaciones de Colegio MAP.</p>
                                <p>Fundada como marca en 2018, pero activa desde 2008, MAP Recording ha visto pasar por sus estudios a artistas locales, regionales y nacionales.</p>
                                <p>Ha sido el lugar de nacimiento de la carrera de nuevos artistas y continúa siendo parte del día a día de la comunidad estudiantil de Colegio MAP.</p>
                                <p>www.maprecording.com</p>
                            </div>
                        </li>
                        <li>
                            <div class="img-marcas">
                                <img src="/site/img/logo-maptv.png">
                            </div> <!-- /img-marcas -->
                            <div>
                                <p>MAPtv EDUCA, como plataforma virtual, busca llevar a toda latinoamérica la calidad que ya caracteriza a Colegio MAP.</p>
                                <p>Nuestra oferta académica está creada por las mismas mentes que han llevado a Colegio MAP a ser un referente en producción musical y música en México, añadiendo las ventajas que la interacción en línea brinda tanto a estudiantes como a profesores.</p>
                                <p>Dentro de MAPtv EDUCA encontrarás a los profesores que imparten clases en Colegio MAP, además de colaboradores y artistas invitados, activos al 100% en la industria musical latina.</p>
                                <p>Encuentra algunas de las actividades virtuales que hemos hecho en los últimos meses en nuestro canal de YouTube: MAPtv México.</p>
                                <p><a href="https://www.maptveduca.com/" target="_blank">www.maptveduca.com</a></p>
                            </div>
                        </li>
                    </ul> <!-- /flex -->
                    
                </div> <!-- /row-maptv -->
                
            </div> <!-- /wrapper-maptv -->
            
            <div class="wrapper-equipo">
                
                <div class="banner-title bg-black">
                    <h2>Conoce al equipo Maptv Educa</h2>
                </div> <!-- /bg-black -->
                
                <div class="wrapper-maptv">
                    <ul class="flex between wrap">
                        @foreach($instructores as $instructor)

                            <li>
                                <div class="img-equipo" style="background-image: url({{ Storage::url($instructor->img) }});"></div> <!-- /img-equipo -->
                                <div class="txt-equipo">
                                    <h3>{{ $instructor->nombres. " ".$instructor->apellidos }}</h3>
                                    <p>{{ $instructor->especialidad }}</p>
                                </div> <!-- /txt-equipo -->
                                <div class="txt-bio">
                                    <p>{!! $instructor->bibliografia !!}</p>
                                </div> <!-- /txt-bio -->
                            </li>

                        @endforeach
                    {{--<ul class="flex flex-nosotros between wrap">
                        <li>
                            <div class="img-equipo" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-equipo -->
                            <div class="txt-equipo">
                                <h3>Profesor 1</h3>
                                <p>Especialidad</p>
                            </div> <!-- /txt-equipo -->
                            <div class="txt-bio">
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor </p>
                            </div> <!-- /txt-bio -->
                        </li>
                        <li>
                            <div class="img-equipo" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-equipo -->
                            <div class="txt-equipo">
                                <h3>Profesor 1</h3>
                                <p>Especialidad</p>
                            </div> <!-- /txt-equipo -->
                        </li>
                        <li>
                            <div class="img-equipo" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-equipo -->
                            <div class="txt-equipo">
                                <h3>Profesor 1</h3>
                                <p>Especialidad</p>
                            </div> <!-- /txt-equipo -->
                        </li>
                        <li>
                            <div class="img-equipo" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-equipo -->
                            <div class="txt-equipo">
                                <h3>Profesor 1</h3>
                                <p>Especialidad</p>
                            </div> <!-- /txt-equipo -->
                        </li>
                        <li>
                            <div class="img-equipo" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-equipo -->
                            <div class="txt-equipo">
                                <h3>Profesor 1</h3>
                                <p>Especialidad</p>
                            </div> <!-- /txt-equipo -->
                        </li>
                        <li>
                            <div class="img-equipo" style="background-image: url('/site/img/fulano.jpg');"></div> <!-- /img-equipo -->
                            <div class="txt-equipo">
                                <h3>Profesor 1</h3>
                                <p>Especialidad</p>
                            </div> <!-- /txt-equipo -->
                        </li> --}}
                    </ul>
                    
                </div> <!-- /wrapper-maptv -->
                
            </div> <!-- /wrapper-equipo -->
            
        </div> <!-- /hoja-1000 -->
        
    </section> <!-- /inicio -->

@stop