<!-- HEADER AND FOOTER -->
@extends('admin.layouts.admin-layout')
<!-- /HEADER AND FOOTER -->

@section('titulo', 'Editar Curso')

@section('css-content')
    <!-- Chosen -->
    <link href="/admini/css/plugins/iCheck/custom.css" rel="stylesheet">
     <link href="/admini/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="/admini/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="/admini/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/admini/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
@stop



@section("contenido")
    
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Crear nuevo curso</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Cursos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo curso</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    @if (session()->has("status.updateCurso"))
        @if (session()->get("status.updateCurso") == "error")
            <div class="row justify-content-center">
                <div class="alert alert-danger fade show col-md-10 mt-3" role="alert">
                    Ocurrio un error, intentelo más tarde.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>

        @elseif (session()->get("status.updateCurso") == "success")
            <div class="row justify-content-center">
                <div class="alert alert-success fade show col-md-10 mt-3" role="alert">
                    Se actualizo el curso correctamente
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
    @endif


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row justify-content-center mt-3">
        <div class="col-lg-10">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Formulario - Curso Nuevo</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" id="app">
                	<div class="sk-spinner sk-spinner-double-bounce">
                        <div class="sk-double-bounce1"></div>
                        <div class="sk-double-bounce2"></div>
                    </div>
                    <form action="{{ route('actualizar-curso.update', $helper::base64_encode_url($curso->id)) }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" name="frm-actualizar_curso">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nombre del curso: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nombre_curso" value="{{ old("nombre_curso", $curso->nombre) }}"> 
                                <span class='form-text m-b-none errors'> {!! $errors->first('nombre_curso') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-2 col-form-label">Imagen del curso: </label>
                            <div class="col-sm-10">
                                <input id="logo" type="file" name="img_curso" class="form-control" accept="image/png, image/jpeg, image/jpg">
                                <span class='form-text m-b-none errors'> {!! $errors->first('img_curso') !!} </span>
                            </div>  
                            <div class="img-admin_editcurso col-sm-10 offset-sm-2 mt-3">
                                <figure>
                                    <img src="{{ Storage::url($curso->url_img) }}">
                                </figure>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> instructor: </label>
                            <div class="col-sm-10 mb-3">
                                <select data-placeholder="Instructores" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_instructores[]">
                                    @foreach($instructors as $instructor)
                                        <option value="{{ $instructor->id }}" 
                                            @if(in_array($instructor->id, old('select_instructores', $myInstructors))) selected @endif>
                                            {{ $instructor->nombres." ".$instructor->apellidos }}
                                        </option>    
                                    @endforeach
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_instructores.*') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label class="col-sm-2 col-form-label">Curso extra: </label>
                            <div class="i-checks col-sm-10">
                                <label> <input type="checkbox" value="1" name="curso_extra" @if(old("curso_extra") == 1 || $curso->extra == 1) checked @endif> <i></i></label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Carreras: </label>
                            <div class="col-sm-10 mb-3">
                                <select data-placeholder="Carreras" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_carreras[]">
                                    @foreach($careers as $career)
                                        <option value="{{ $career->id }}"
                                            @if (in_array($career->id, old('select_carreras', $myCareers))) selected @endif > 
                                            {{ $career->nombre }} 
                                        </option>
                                    @endforeach
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_carreras') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Categoria: </label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="select_categorias">
                                    <option value="">Categorias</option>
                                    @forelse($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @if (old('select_categorias', $curso->categoria_id) == $categoria->id) selected @endif> {{ $categoria->nombre }} </option>
                                    @empty
                                        <option value=""> No se encontraron resultados </option>
                                    @endforelse
                                </select>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_categorias') !!} </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> Subcategorias: </label>
                            <div class="col-sm-10 mb-3">
                                <div class="div-subcate">
                                    <select data-placeholder="Subcategorias" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_subcategorias[]">
                                        @foreach($subcategorias as $subcategoria)
                                            <option value="{{ $subcategoria->id }}"
                                                @if (in_array($subcategoria->id, old('select_subcategorias', $mySubcategorias))) selected @endif > 
                                                {{ $subcategoria->nombre }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class='form-text m-b-none errors'> {!! $errors->first('select_categorias') !!} </span>
                            </div>
                        </div>


                        <div class="hr-line-dashed"></div>

                        <h2> Bienvenida del Curso </h2>

                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Video de Bienvenida: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="video_bienvenida" value="{{ old("video_bienvenida", $curso->video_bienvenida) }}">
                                <span class='form-text m-b-none errors'> {!! $errors->first('video_bienvenida') !!} </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Descripcion: </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="descripcion" rows="3">{{ old("descripcion", str_replace('<br />',PHP_EOL, $curso->descripcion_bienvenida)) }}</textarea>
                                <span class='form-text m-b-none errors'> {!! $errors->first('descripcion') !!} </span>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>

                        <div class="col-lg-10 d-flex">
                    		<h5>Agregar videos del curso</h5>
                    		<button class="btn btn-success ml-4 add-clone_videos"> + </button>
                    		<button class="btn btn-danger ml-2 remove-clone_videos"> - </button>
                    	</div>

                    	<div class="hr-line-dashed"></div>

                    	<div class="container-videos_curso">
		                	@if (old("video_url"))
                                @php $j = 0 @endphp
	                    		@for($i=0; $i <= count(old("video_url")) - 1; $i++)
			                    	<div class="clone-videos">
				                    	<div class="form-group row">
				                            <label class="col-sm-2 col-form-label">Nombre del video: </label>
				                            <div class="col-sm-10">
				                                <input type="text" class="form-control" name="nombre_video[]" value="{{ old("nombre_video.{$i}") }}">
				                                <span class='form-text m-b-none errors'> {!! $errors->first('nombre_video.'.$i) !!} </span>
				                            </div>
				                        </div>
				                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Video url: </label>
                                            <div class="col-sm-10">
                                                @if (old("video_url.{$i}"))
                                                    @for ($l=0; $l <= count(old("video_url.{$i}")) - 1; $l++)
                                                        @if ($l == 0)
                                                            <div class="d-flex">
                                                                <input type="text" placeholder="Nombre del video" class="form-control nombre_videos" name="nombre_video_url[{{ $i }}][{{ $l }}]" value="{{ old("nombre_video_url.{$i}.{$l}") }}">
                                                                <input type="text" placeholder="Url del video" class="form-control url_videos" name="video_url[{{ $i }}][{{ $l }}]" value="{{ old("video_url.{$i}.{$l}") }}">
                                                                <button class="btn btn-success ml-4 add-url_video"> + </button>
                                                                <button class="btn btn-danger ml-2 remove-url_video"> - </button>
                                                            </div>
                                                            <span class='form-text m-b-none errors'> {!! $errors->first('video_url.'.$i.'.'.$l) !!} </span>

                                                            <div class="parent_mas-videos">
                                                        @else
                                                            <div class="div-container_videourl d-flex col-11" style="padding: 0">
                                                                <input type="text" placeholder="Nombre del video" class="form-control mt-3 nombre_videos" name="nombre_video_url[{{ $i }}][{{ $l }}]" value="{{ old("nombre_video_url.{$i}.{$l}") }}">
                                                                <input type="text" placeholder="Url del video" class="form-control mt-3 url_videos" style="margin: 0 !important;" name="video_url[{{ $i }}][{{ $l }}]" value="{{ old("video_url.{$i}.{$l}") }}">
                                                            </div>
                                                            <span class='form-text m-b-none errors'> {!! $errors->first('video_url.'.$i.'.'.$l) !!} </span>
                                                        @endif
                                                    @endfor
                                                    </div>
                                                @else
                                                    <div class="d-flex">
                                                        <input type="text" placeholder="Nombre del video" class="form-control nombre_videos" name="nombre_video_url[{{ $i }}][]" value="{{ old("nombre_video_url.{$i}") }}">
                                                        <input type="text" placeholder="Url del video" class="form-control url_videos" name="video_url[{{ $i }}][]" value="{{ old("video_url.{$i}") }}">
                                                        <button class="btn btn-success ml-4 add-url_video"> + </button>
                                                        <button class="btn btn-danger ml-2 remove-url_video"> - </button>
                                                    </div>
                                                    <span class='form-text m-b-none errors'> {!! $errors->first('video_url.'.$i) !!} </span>
                                                    <div class="parent_mas-videos"></div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Descripcion: </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="descripcion_curso[]" rows="3">{{ old("descripcion_curso.{$i}") }}</textarea>
                                                <span class='form-text m-b-none errors'> {!! $errors->first('descripcion_curso.'.$i) !!} </span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <label class="col-sm-2 col-form-label">Material Extra: </label>
                                            <div class="col-sm-10">
                                                <input id="logo" type="file" name="material_extra[{{ $i }}][]" class="form-control">
                                                <span class='form-text m-b-none errors'> {!! $errors->first('material_extra.'.$i.'.*') !!} </span>
                                            </div>

                                            <div class="col-sm-10 offset-sm-2">
                                                <?php $imagenes = $helper->todasImagenesCurso($curso->id, "material_extra", $j); ?>
                                                @if ($imagenes)
                                                     @for ($i = 0; $i <= count($imagenes) - 1; $i++)
                                                        <div>
                                                            <a target="_blank" href="{{ Storage::url("cursos/".$imagenes[$i]) }}">
                                                                {{ basename($imagenes[$i]) }}
                                                            </a>
                                                            <span><i class="fa fa-times eliminar_archivo" aria-hidden="true" data-metadata="{{ Storage::url("cursos/".$imagenes[$i]) }}" style="color:red;cursor:pointer"></i></span>
                                                        </div>
                                                     @endfor
                                                @endif
                                            </div>

                                        </div>
				                    </div>
                                     @php $j++; @endphp
				                @endfor
				            @else
                                @php $j = 0 @endphp
                                @foreach($temario as $team)
    				            	<div class="clone-videos">
    			                    	<div class="form-group row">
    			                            <label class="col-sm-2 col-form-label">Nombre del video: </label>
    			                            <div class="col-sm-10">
    			                                <input type="text" class="form-control" name="nombre_video[]" value="{{ old("nombre_video.".$j, $team->nombre_video) }}"> 
    			                                <span class='form-text m-b-none errors'> {!! $errors->first('nombre_video.*') !!} </span>
    			                            </div>
    			                        </div>

    			                        <div class="form-group row">
    			                            <label class="col-sm-2 col-form-label">Video url: </label>
    			                            <div class="col-sm-10">
                                                @for($a = 0; $a <= count($team->url_video) - 1; $a++)
                                                    @if ($a == 0)
                                                        <div class="d-flex">
                                                            <input type="text" placeholder="Nombre del video" class="form-control nombre_videos" name="nombre_video_url[{{ $j }}][{{ $a }}]" value="{{ $team->nombre_video_url[$a] }}">
                                                            <input type="text" placeholder="Url del video" class="form-control url_videos" name="video_url[{{ $j }}][{{ $a }}]" value="{{ $team->url_video[$a] }}">
                                                            <button class="btn btn-success ml-4 add-url_video"> + </button>
                                                            <button class="btn btn-danger ml-2 remove-url_video"> - </button>
                                                        </div>
                                                        <span class='form-text m-b-none errors'> {!! $errors->first('video_url.'.$j.'.'.$a) !!} </span>

                                                        <div class="parent_mas-videos">
                                                    @else
                                                        <div class="div-container_videourl d-flex col-11" style="padding: 0">
                                                            <input type="text" placeholder="Nombre del video" class="form-control nombre_videos" name="nombre_video_url[{{ $j }}][{{ $a }}]" value="{{ $team->nombre_video_url[$a] }}">
                                                            <input type="text" placeholder="Url del video" class="form-control mt-3 url_videos" style="margin: 0 !important;" name="video_url[{{ $j }}][{{ $a }}]" value="{{ $team->url_video[$a] }}">
                                                        </div>
                                                        <span class='form-text m-b-none errors'> {!! $errors->first('video_url.'.$j.'.'.$a) !!} </span>
                                                    @endif
                                                @endfor
                                                </div>
    			                            </div>
    			                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Descripcion: </label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="descripcion_curso[]" rows="3">{{ old("descripcion_curso.".$j, str_replace('<br />',PHP_EOL, $team->descripcion_curso)) }}</textarea>
                                                <span class='form-text m-b-none errors'> {!! $errors->first('descripcion_curso.*') !!} </span>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-5">
                                            <label class="col-sm-2 col-form-label">Material Extra: </label>
                                            <div class="col-sm-10">
                                                <input id="logo" type="file" name="material_extra[{{ $j }}][]" class="form-control">
                                                <span class='form-text m-b-none errors'> {!! $errors->first('material_extra'). $errors->first('material_extra.'.$j.'.*') !!} </span>
                                            </div>
                                            <div class="col-sm-10 offset-sm-2">
                                                <?php $imagenes = $helper->todasImagenesCurso($curso->id, "material_extra", $j); ?>
                                                @if ($imagenes)
                                                     @for ($i = 0; $i <= count($imagenes) - 1; $i++)
                                                        <div>
                                                            <a target="_blank" href="{{ Storage::url("cursos/".$imagenes[$i]) }}">
                                                                {{ basename($imagenes[$i]) }}
                                                            </a>
                                                            <span><i class="fa fa-times eliminar_archivo" aria-hidden="true" data-metadata="{{ "public/cursos/".$imagenes[$i] }}" style="color:red;cursor:pointer"></i></span>
                                                        </div>
                                                     @endfor
                                                @endif
                                            </div>
                                        </div>
    			                    </div>
                                    @php $j++; @endphp
                                @endforeach
				            @endif
		                </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white btn-sm" type="submit">Cancel</button>
                                <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop


@section("js-content")

    <!-- Mainly scripts -->
    <script src="/admini/js/jquery-3.1.1.min.js"></script>
    <script src="/admini/js/popper.min.js"></script>
    <script src="/admini/js/bootstrap.js"></script>
    <script src="/admini/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/admini/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Chosen -->
    <script src="/admini/js/plugins/chosen/chosen.jquery.js"></script>
    <!-- Data picker -->
   <script src="/admini/js/plugins/datapicker/bootstrap-datepicker.js"></script>
   <!-- Clock picker -->
    <script src="/admini/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/admini/js/inspinia.js"></script>
    <script src="/admini/js/plugins/pace/pace.min.js"></script>
    <!-- iCheck -->
    <script src="/admini/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });
            $('.chosen-select').chosen({width: "100%"});
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            $('.clockpicker').clockpicker();

            var mem = $('.datepicker').datepicker({
                todayHighlight: true,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
       });
    </script>
    <script src="/admini/js/app.js"></script>

@stop