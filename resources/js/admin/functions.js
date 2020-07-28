
//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)

let funciones = {

	// validacionAgregarCurso: function(e) {
	// 	e.preventDefault();
	// 	e.stopPropagation();

	// 	let nombre_curso = document.querySelector("input[name='nombre_curso']"),
	// 		precio = document.querySelector("input[name='precio']"),
	// 		precio_regular = document.querySelector("input[name='precio_regular']"),
	// 		duracion = document.querySelector("input[name='duracion']"),

	// 		objetivo = document.querySelector("textarea[name='objetivo']"),
	// 		dirigido = document.querySelector("textarea[name='dirigido']"),
	// 		instructores = document.querySelector("select[name='select_instructores[]']"),
	// 		categorias = document.querySelector("select[name='select_categorias[]']"),

	// 		fecha_lanzamiento = document.querySelectorAll("input[name='fecha_lanzamiento[]']"),
	// 		hora_lanzamiento = document.querySelectorAll("input[name='hora_lanzamiento[]']"),
	// 		fecha_termino = document.querySelectorAll("input[name='fecha_termino[]']"),
	// 		hora_termino = document.querySelectorAll("input[name='hora_termino[]']"),

	// 		brunch_inicio = document.querySelectorAll("input[name='brunch_inicio[]']"),
	// 		lunch_inicio = document.querySelectorAll("input[name='lunch_inicio[]']"),

	// 		nombres_cursos = document.querySelectorAll("input[name='nombre_video[]']"),
	// 		videos_url = document.querySelectorAll("input[name='video_url[]']"),
	// 		error_videos = false;

	// 	document.querySelectorAll('.errors').forEach(function(item) {
	// 		item.innerHTML = '';
	// 	});

	// 	if (document.querySelector('.has-error')) {
	// 		document.querySelectorAll('.has-error').forEach((item) => {
	// 			item.classList.remove('has-error');
	// 		});
	// 	}

	// 	if (document.querySelector('.is-invalid')) {
	// 		document.querySelector('.is-invalid').classList.remove('is-invalid');
	// 	}

	// 	if (nombre_curso.value == '') {
	// 		nombre_curso.parentNode.classList.add('has-error');
	// 		nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}

	// 	if (precio.value == '') {
	// 		precio.parentNode.classList.add('has-error');
	// 		precio.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}

	// 	if (precio_regular.value == '') {
	// 		precio_regular.parentNode.classList.add('has-error');
	// 		precio_regular.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}

	// 	if (duracion.value == '') {
	// 		duracion.parentNode.classList.add('has-error');
	// 		duracion.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}

	// 	if (objetivo.value == '') {
	// 		objetivo.parentNode.classList.add('has-error');
	// 		objetivo.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}
		

	// 	if (dirigido.value == '') {
	// 		dirigido.parentNode.classList.add('has-error');
	// 		dirigido.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}

	// 	if (instructores.value == '' || instructores.value == null || instructores.value == undefined) {
	// 		instructores.parentNode.classList.add('has-error');
	// 		instructores.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}

	// 	if (categorias.value == '' || categorias.value == null || categorias.value == undefined) {
	// 		categorias.parentNode.classList.add('has-error');
	// 		categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		error_videos = true;
	// 	}


	// 	// Validar Horarios
	// 	fecha_lanzamiento.forEach((item, index) => {
	// 		if (item.value == '') {
	// 			error_videos = true;
	// 			item.parentNode.classList.add('has-error');
	// 			item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		}
	// 	});

	// 	// Validar Horarios
	// 	hora_lanzamiento.forEach((item, index) => {
	// 		if (item.value == '') {
	// 			error_videos = true;
	// 			item.parentNode.classList.add('has-error');
	// 			item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		}
	// 	});

	// 	// Validar Horarios
	// 	fecha_termino.forEach((item, index) => {
	// 		if (item.value == '') {
	// 			error_videos = true;
	// 			item.parentNode.classList.add('has-error');
	// 			item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		}
	// 	});

	// 	// Validar Horarios
	// 	hora_termino.forEach((item, index) => {
	// 		if (item.value == '') {
	// 			error_videos = true;
	// 			item.parentNode.classList.add('has-error');
	// 			item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		}
	// 	});


	// 	//Validar Brunch y Lunch
	// 	brunch_inicio.forEach((item, index) => {
	// 		var lado = document.querySelectorAll('input[name="brunch_fin[]"]');
	// 		if ((lado[index].value != '' && item.value == '') || (lado[index].value == '' && item.value != '')) {
	// 			if (item.value == '') {
	// 				error_videos = true;
	// 				item.parentNode.classList.add('has-error');
	// 				item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 			}
	// 			else {
	// 				error_videos = true;
	// 				lado[index].parentNode.classList.add('has-error');
	// 				lado[index].nextElementSibling.innerHTML = 'El campo es requerido';
	// 			}
	// 		}
	// 	});


	// 	//Validar Brunch y Lunch
	// 	lunch_inicio.forEach((item, index) => {
	// 		var lado = document.querySelectorAll('input[name="lunch_fin[]"]');
	// 		if ((lado[index].value != '' && item.value == '') || (lado[index].value == '' && item.value != '')) {
	// 			if (item.value == '') {
	// 				error_videos = true;
	// 				item.parentNode.classList.add('has-error');
	// 				item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 			}
	// 			else {
	// 				error_videos = true;
	// 				lado[index].parentNode.classList.add('has-error');
	// 				lado[index].nextElementSibling.innerHTML = 'El campo es requerido';
	// 			}
	// 		}
	// 	});


	// 	// Validar nombre y videos URL
	// 	nombres_cursos.forEach((item, index) => {
	// 		if (item.value == '') {
	// 			error_videos = true;
	// 			item.parentNode.classList.add('has-error');
	// 			item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		}
	// 	});

	// 	// Validar nombre y videos URL
	// 	videos_url.forEach((item, index) => {
	// 		if (item.value == '') {
	// 			error_videos = true;
	// 			item.parentNode.classList.add('has-error');
	// 			item.nextElementSibling.innerHTML = 'El campo es requerido';
	// 		}
	// 	});

	// 	if (error_videos == true) {
	// 		if (e.type == 'submit') {
	// 			window.scrollTo(0, document.querySelectorAll(".has-error")[0].offsetTop);
	// 		}

	// 		return false;
	// 	}

	// 	if (e.type == 'submit') {
	// 		e.target.disabled = true;
	//         document.querySelector('.ibox-content').classList.add('sk-loading');
	//         document.querySelector("form").submit();
	//     }
	// },

	validarEmail: function(email) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    	return regex.test(email) ? true : false;
	},

	htmlVideoCurso: function() {
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
                +'</div>';
	},
};


exports.funciones = funciones;