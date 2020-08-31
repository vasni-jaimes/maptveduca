
//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)

let funciones = {

	validarAgregarClase: function(e) {
		e.preventDefault();

		/* 	PRIMER PASO DEL REGISTRO */
		let nombre_curso = document.querySelector("input[name='nombre_clase']"),
			img_clase = document.querySelector("input[name='img_clase']"),
			instructores = document.querySelector("select[name='select_instructores[]']"),
			categorias = document.querySelector("select[name='select_categorias[]']"),
			curso_extra = document.querySelector("input[name='curso_extra']"),
			select_carreras = document.querySelector("select[name='select_carreras[]']"),
			select_categorias = document.querySelector("select[name='select_categorias[]']"),

			/* BIENVENIDA A LA CLASE */
			video_bienvenida = document.querySelector("input[name='video_bienvenida']"),
			descripcion = document.querySelector("textarea[name='descripcion']"),
			select_sesiones = document.querySelector("select[name='select_sesiones']"),

			/* AGREGAR SESSIONES */
			url_zoom = document.querySelectorAll("input[name='url_zoom[]']"),
			id_reunion = document.querySelectorAll("input[name='id_reunion[]']"),
			codigo_acceso = document.querySelectorAll("input[name='codigo_acceso[]']"),
			fecha_inicio = document.querySelectorAll("input[name='fecha_inicio[]']"),
			hora_inicio = document.querySelectorAll("input[name='hora_inicio[]']"),

			/* STATUS */
			error_videos = false;

			//SE ELIMINAN LOS RASTROS DE ERRORES

			document.querySelectorAll('.errors').forEach(function(item) {
				item.innerHTML = '';
			});


			document.querySelectorAll('.chosen-choices').forEach((item) => {
				item.style.borderColor = "#e5e6e7";
			});

			if (document.querySelector('.has-error')) {
				document.querySelectorAll('.has-error').forEach((item) => {
					item.classList.remove('has-error');
				});
			}

			//SE ELIMINAN LOS RASTROS DE ERRORES\\


			if (nombre_curso.value == '') {
				nombre_curso.parentNode.classList.add('has-error');
				nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
			}

			if (e.target.getAttribute('name') == 'frm-agregar_clase') {
				if (img_clase.value == '') {
					img_clase.parentNode.classList.add('has-error');
					img_clase.nextElementSibling.innerHTML = 'El campo es requerido';
					error_videos = true;
				}
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

			if (select_sesiones.value == '') {
				select_sesiones.parentNode.classList.add('has-error');
				select_sesiones.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
			}



			// SESSIONES ZOOM
			url_zoom.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			id_reunion.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			codigo_acceso.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			fecha_inicio.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			hora_inicio.forEach((item, index) => {
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
		        //document.querySelector("form[name='frm-agregar_clase']").submit();

		        if (e.target.getAttribute('name') == 'frm-editar_clase') {
		        	document.querySelector("form[name='frm-editar_clase']").submit();
		        	return false;
		        }

		        document.querySelector("form[name='frm-agregar_curso']").submit();
		    }
	},

	agregarSessionesClase: function(e) {

		let numeroSesiones = e.target.value;
		let htmlSessiones = "";
		let numeroClones = document.querySelectorAll(".clone-horarios_sesion").length;
		let conteo = (numeroSesiones > numeroClones) ? numeroSesiones - numeroClones : numeroClones - numeroSesiones;

		if (numeroSesiones > numeroClones) {
			for(var i = 1; i <= conteo; i++) {
				htmlSessiones += '<div class="clone-horarios_sesion">'
	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">URL Zoom: </label>'
	                                    +'<div class="col-sm-10">'
	                                        +'<input type="text" class="form-control" name="url_zoom[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                +'</div>'

	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">ID de Reunión: </label>'
	                                    +'<div class="col-sm-10">'
	                                        +'<input type="text" class="form-control" name="id_reunion[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                +'</div>'

	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">Codigo de acceso: </label>'
	                                    +'<div class="col-sm-10">'
	                                        +'<input type="text" class="form-control" name="codigo_acceso[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                +'</div>'

	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">Fecha de Lanzamiento: </label>'
	                                    +'<div class="col-sm-2">'
	                                        +'<input class="form-control datepicker" name="fecha_inicio[]" data-date-format="yyyy-mm-dd">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                    +'<label class="pt-2 font-weight-bold"> : </label>'
	                                    +'<div class="col-sm-2 clockpicker" data-autoclose="true">'
	                                        +'<input class="form-control" name="hora_inicio[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                               +'</div>'
	                               +'<div class="hr-line-dashed"></div>'
	                            +'</div>';
			}

			document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
		}
		else {

			let clonesZoom = document.querySelectorAll(".clone-horarios_sesion");
			for (var i = 0; i <= numeroClones; i++) {

				if ( i >= numeroSesiones) {
					clonesZoom[i].remove();
				}
			}

			document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
		}

		//INICIALIZAR DATEPICKER Y CLOCKPICKER
		$('.clockpicker').clockpicker();
        $('.datepicker').datepicker({
            todayHighlight: true,
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

	},

	elimiarArchivoUpdateCurso: function(e) {
		e.preventDefault();

		e.target.disabled = true;

		let token = document.querySelector("input[name='_token']").value,
			documento = e.target.getAttribute('data-metadata');
        let opciones = {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({"documento": documento, "_token": token}),
            headers:{
                "Content-Type": "application/json"
            }
        };

        fetch("/admin/eliminar-archivo", opciones)
            .then(response => response.json())
            .then(res => {
            	if (res.message == 'ok') {
            		e.target.parentElement.parentElement.remove();
            		alert('Se elimino el archivo correctamente');
            	}
            	else if (res.message == 'no_parameters') {
            		alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
            		e.removeAttribute('disabled');
            	}
            	else if (res.message == 'no_delete') {
            		alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
            		e.removeAttribute('disabled');
            	}
            })
	},

	validacionAgregarCurso: function(e) {
		e.preventDefault();
		e.stopPropagation();

		/* 	PRIMER PASO DEL REGISTRO */
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

		if (e.target.getAttribute('name') == 'frm-agregar_curso') {
			if (img_curso.value == '') {
				img_curso.parentNode.classList.add('has-error');
				img_curso.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
			}
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

	        if (e.target.getAttribute('name') == 'frm-agregar_curso') {
	        	document.querySelector("form[name='frm-agregar_curso']").submit();
	        	return false;
	        }

	        document.querySelector("form[name='frm-actualizar_curso']").submit();
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