
//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)

let funciones = {

	validacionAgregarCurso: function(e) {
		e.preventDefault();
		e.stopPropagation();

		/* 	PARARIMER PASO DEL REGISTRO */
		let nombre_curso = document.querySelector("input[name='nombre_curso']"),
			img_curso = document.querySelector("input[name='img_curso']"),
			instructores = document.querySelector("select[name='select_instructores[]']"),
			categorias = document.querySelector("select[name='select_categorias[]']"),
			curso_extra = document.querySelector("input[name='curso_extra']"),
			select_carreras = document.querySelector("select[name='select_carreras[]']"),
			select_categorias = document.querySelector("select[name='select_categorias[]']"),

			/* BIENVENIDA AL CURSO */
			video_bienvenida = document.querySelector("input[name='video_bienvenida']"),
			descripcion = document.querySelector("textarea[name='descripcion']"),

			/* TEMARIO */
			nombres_cursos = document.querySelectorAll("input[name='nombre_video[]']"),
			videos_url = document.querySelectorAll("input[name='video_url[]']"),
			descripcion_curso = document.querySelectorAll("textarea[name='descripcion_curso[]']"),

			/* STATUS */
			error_videos = false;

		document.querySelectorAll('.errors').forEach(function(item) {
			item.innerHTML = '';
		});

		if (document.querySelector('.has-error')) {
			document.querySelectorAll('.has-error').forEach((item) => {
				item.classList.remove('has-error');
			});
		}

		document.querySelectorAll('.chosen-choices').forEach((item) => {
			item.style.borderColor = "#e5e6e7";
		});

		if (nombre_curso.value == '') {
			nombre_curso.parentNode.classList.add('has-error');
			nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}

		if (img_curso.value == '') {
			img_curso.parentNode.classList.add('has-error');
			img_curso.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}

		if (instructores.value == '' || instructores.value == null || instructores.value == undefined) {
			instructores.parentNode.classList.add('has-error');
			instructores.parentNode.children[1].firstChild.style.borderColor = "red";
			instructores.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}

		if (categorias.value == '' || categorias.value == null || categorias.value == undefined) {
			categorias.parentNode.classList.add('has-error');
			categorias.parentNode.children[1].firstChild.style.borderColor = "red";
			categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}

		if (curso_extra.checked == false) {
			if (select_carreras.value == '') {
				select_carreras.parentNode.classList.add('has-error');
				select_carreras.parentNode.children[1].firstChild.style.borderColor = "red";
				select_carreras.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
			}
		}

		if (select_categorias.value == '') {
			select_categorias.parentNode.classList.add('has-error');
			select_categorias.parentNode.children[1].firstChild.style.borderColor = "red";
			select_categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}


		if (video_bienvenida.value == '')  {
			video_bienvenida.parentNode.classList.add('has-error');
			video_bienvenida.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}

		if (descripcion.value == '') {
			descripcion.parentNode.classList.add('has-error');
			descripcion.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}


		// Validar nombre y videos URL
		nombres_cursos.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});

		// Validar nombre y videos URL
		videos_url.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});


		// Validar nombre y videos URL
		descripcion_curso.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});


		if (error_videos == true) {
			if (e.type == 'submit') {
				window.scrollTo(0, document.querySelectorAll(".has-error")[0].offsetTop);
			}

			return false;
		}


		if (e.type == 'submit') {
			e.target.disabled = true;
	        document.querySelector('.ibox-content').classList.add('sk-loading');
	        document.querySelector("form[name='frm-agregar_curso']").submit();
	    }
	},

	validarEmail: function(email) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    	return regex.test(email) ? true : false;
	},

	htmlVideoCurso: function(contador) {
		contador++;
		return '<div class="clone-videos">'
                	+'<div class="form-group row">'
                        +'<label class="col-sm-2 col-form-label">Nombre del video: </label>'
                        +'<div class="col-sm-10">'
                            +'<input type="text" class="form-control" name="nombre_video[]">' 
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>'
                    +'</div>'
                    +'<div class="form-group row">'
                        +'<label class="col-sm-2 col-form-label">Video url: </label>'
                        +'<div class="col-sm-10">'
                            +'<input type="text" class="form-control" name="video_url[]">' 
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>'
                    +'</div>'
                    +'<div class="form-group row">'
                        +'<label class="col-sm-2 col-form-label">Descripcion: </label>'
                        +'<div class="col-sm-10">'
                            +'<textarea class="form-control" name="descripcion_curso[]" rows="3"></textarea>'
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>'
                    +'</div>'
                    +'<div class="form-group row mb-5">'
                        +'<label class="col-sm-2 col-form-label">Material Extra: </label>'
                        +'<div class="col-sm-10">'
                            +'<input id="logo" type="file" name="material_extra['+contador+'][]" multiple class="form-control" accept="jpg,jpeg,png">'
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>' 
                    +'</div>'
                +'</div>';
	},
};


exports.funciones = funciones;