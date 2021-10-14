import { funciones } from './functions.js';


//FORMULARIO PARA AGREGAR UN CURSO Y ACTUALIZAR
const frmAgregarCurso = document.querySelector("form[name='frm-agregar_curso']");
const frmActualizarCurso = document.querySelector("form[name='frm-actualizar_curso']");
if (frmAgregarCurso || frmActualizarCurso) {

	const bottonAdd = document.querySelector(".add-clone_videos");
	if (bottonAdd) {
		bottonAdd.addEventListener('click', (e) => {
			e.preventDefault();
			let contador = document.querySelectorAll('.clone-videos').length - 1;
		    const htmlVideo = funciones.htmlVideoCurso(contador);
			document.querySelector('.container-videos_curso').insertAdjacentHTML('beforeend', htmlVideo);
		});
	}

	const bottonRemove = document.querySelector(".remove-clone_videos");
	if (bottonRemove) {
		bottonRemove.addEventListener('click', (e) => {
			e.preventDefault();
			let container = document.querySelector('.container-videos_curso');
			container.lastElementChild.remove();
		});
	}

	//CHECK DEL CURSO EXTRA Y ESCONDER SELECT DE CARRERAS
	const curso_extra = document.querySelector('input[name="curso_extra"]');
	if (curso_extra) {
		$('input').on('ifChanged', function(event) {
			if ($(this).is(':checked')) {
				$("select[name='select_carreras[]']")
					.parents(".form-group").css("display", "none");
			}
			else {
				$("select[name='select_carreras[]']")
					.parents(".form-group").css("display", "flex");
			}

		});
	}

	//EVENTO PARA AGREGAR URL DE VIDEOS
	$(document).on('click', '.add-url_video', function(e) {
		e.preventDefault();

		let contador = $(".add-url_video").index($(this));
		let htmlVideo = funciones.htmlAgregarVideo( contador );
		let padreVideoUrl = $(this).parent().next().next();
		padreVideoUrl.append(htmlVideo);
	});


	//EVENTO PARA ELIMINAR URL DE VIDEOS
	const container_videourl = document.querySelectorAll(".remove-url_video");
	container_videourl.forEach( (item) => {
		item.addEventListener('click', function(e) {
			e.preventDefault();
			e.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.remove();
			e.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.remove();
		});
	});

	//EVENTO PARA OBTENER LAS SUBCATEGORIAS DEPENDIENDO DE LA CATEGORIA
	let select_categorias = document.querySelector("select[name=select_categorias]");
	if (select_categorias) {
		select_categorias.addEventListener('change', function(e) {
			e.preventDefault();
			funciones.obtenerSubmenus(e);
		});
	}


	if (frmAgregarCurso) {
		frmAgregarCurso.addEventListener('submit', funciones.validacionAgregarCurso);
		frmAgregarCurso.addEventListener('input', funciones.validacionAgregarCurso);
		$(document).change("input", funciones.validacionAgregarCurso);
		$("select").change(funciones.validacionAgregarCurso);
	}


	if (frmActualizarCurso) {
		frmActualizarCurso.addEventListener('submit', funciones.validacionAgregarCurso);
		frmActualizarCurso.addEventListener('input', funciones.validacionAgregarCurso);
		$("select").change(funciones.validacionAgregarCurso);

		//ELIMINAR ARCHIVO DE CURSO EXTRA EN UPDATE
		const eliminar_archivo = document.querySelectorAll(".eliminar_archivo");
		eliminar_archivo.forEach( (item) => {
			item.addEventListener('click', funciones.elimiarArchivoUpdateCurso)	
		})
	}
}

//FORMULARIO  CLASES
const frmAgregarClase = document.querySelector("form[name='frm-agregar_clase']");
const frmActualizarClase = document.querySelector("form[name='frm-editar_clase']");
if (frmAgregarClase || frmActualizarClase) {
	const select_sesiones = document.querySelector("select[name='select_sesiones']");
	if (select_sesiones) {
		select_sesiones.addEventListener('change', funciones.agregarSessionesClase)
	}

	if (frmAgregarClase) {
		frmAgregarClase.addEventListener('submit', funciones.validarAgregarClase);
		frmAgregarClase.addEventListener('input', funciones.validarAgregarClase);
		$(document).change("input", funciones.validarAgregarClase);
		$("select").change(funciones.validarAgregarClase);
	}

	if (frmActualizarClase) {
		frmActualizarClase.addEventListener('submit', funciones.validarAgregarClase);
		frmActualizarClase.addEventListener('input', funciones.validarAgregarClase);
		$(document).change("input", funciones.validarAgregarClase);
		$("select").change(funciones.validarAgregarClase);
	}
}

//FORMULARIO EVENTOS
const frmAgregarEvento = document.querySelector("form[name='frm-agregar_evento']");
const frmEditarEvento = document.querySelector("form[name='frm-editar_evento']");
if (frmAgregarEvento || frmEditarEvento) {

	if (frmAgregarEvento) {
		frmAgregarEvento.addEventListener('submit', funciones.validarAgregarEvento);
		frmAgregarEvento.addEventListener('input', funciones.validarAgregarEvento);
		$(document).change("input", funciones.validarAgregarEvento);
		$("select").change(funciones.validarAgregarEvento);
	}

	if (frmEditarEvento) {
		frmEditarEvento.addEventListener('submit', funciones.validarAgregarEvento);
		frmEditarEvento.addEventListener('input', funciones.validarAgregarEvento);
		$(document).change("input", funciones.validarAgregarEvento);
		$("select").change(funciones.validarAgregarEvento);
	}

	//EVENTO PARA EL TIPO DE EVENTOS
	// const select_tipo = document.querySelector("select[name='select_tipo']");
	// select_tipo.addEventListener('change', funciones.cambiarTipoEvento);
}

//FORMULARIO INSTRUCTORES
const frmAgregarInstructor = document.querySelector("form[name='frm-agregar_instructor']");
const frmActualizarInstructor = document.querySelector("form[name='frm-editar_instructor']");
if (frmAgregarInstructor || frmActualizarInstructor) {

	if (frmAgregarInstructor) {
		frmAgregarInstructor.addEventListener('submit', funciones.validarAgregarInstructor);
		frmAgregarInstructor.addEventListener('input', funciones.validarAgregarInstructor);
		$(document).change("input", funciones.validarAgregarInstructor);
		$("select").change(funciones.validarAgregarInstructor);
	}

	if (frmActualizarInstructor) {
		frmActualizarInstructor.addEventListener('submit', funciones.validarAgregarInstructor);
		frmActualizarInstructor.addEventListener('input', funciones.validarAgregarInstructor);
		$(document).change("input", funciones.validarAgregarInstructor);
		$("select").change(funciones.validarAgregarInstructor);
	}
}


//Cambiar status curso
let tabla_cursos = document.querySelector("table.tabla-cursos");
if (tabla_cursos) {
	let btn_activar = document.querySelectorAll(".btn-activar");
	if (btn_activar) {
		btn_activar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status", e);
			})
		});
	}

	let btn_desactivar = document.querySelectorAll(".btn-desactivar");
	if (btn_desactivar) {
		btn_desactivar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status", e);
			});
		});
	}
}



//Cambiar status clase
let tabla_clases = document.querySelector("table.tabla-clases");
if (tabla_clases) {
	let btn_activar = document.querySelectorAll(".btn-activar");
	if (btn_activar) {
		btn_activar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-clase", e);
			});
		});
	}

	let btn_desactivar = document.querySelectorAll(".btn-desactivar");
	if (btn_desactivar) {
		btn_desactivar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-clase", e);
			});
		});
	}
}

//Cambiar status eventos
let tabla_eventos = document.querySelector("table.tabla-eventos");
if (tabla_eventos) {
	let btn_activar = document.querySelectorAll(".btn-activar");
	if (btn_activar) {
		btn_activar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-evento", e);
			});
		});
	}

	let btn_desactivar = document.querySelectorAll(".btn-desactivar");
	if (btn_desactivar) {
		btn_desactivar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-evento", e);
			});
		});
	}
}



//Cambiar status instructores
let tabla_instructores = document.querySelector("table.tabla-instructores");
if (tabla_instructores) {
	let btn_activar = document.querySelectorAll(".btn-activar");
	if (btn_activar) {
		btn_activar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-instructor", e);
			});
		});
	}

	let btn_desactivar = document.querySelectorAll(".btn-desactivar");
	if (btn_desactivar) {
		btn_desactivar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-instructor", e);
			});
		});
	}
}

//VALIDAR QUE EL PRECIO SOLO TENGA NUMEROS
const precio = document.querySelector('input[name="precio"]');
if (precio) {
    precio.addEventListener('input', function(e) {
    	e.target.value = funciones.format(e.target.value);
    });
}

//CAMBIAR LOS ALUMNOS POR CURSO
const curso = document.querySelector('select[name="select_cursos"]');
if (curso) {
	curso.addEventListener('change', funciones.obtenerAlumnosxCurso);
}

//VALIDAR AL MOMENTO DE ENVIAR UN MENSAJE
const formSendMensajes = document.querySelector('form[name="frm-agregar_mensaje"]');
if (formSendMensajes) {
	formSendMensajes.addEventListener('submit', funciones.validarMensajes);
	formSendMensajes.addEventListener('input', funciones.validarMensajes);
	$(document).change("input", funciones.validarMensajes);
	$("select").change(funciones.validarMensajes);
}


//ELIMINAR PUBLICACION
const eliminar_public = document.querySelectorAll('.eliminar_public');
if (eliminar_public) {
	for (var i = 0; i <= eliminar_public.length - 1; i++) {
		eliminar_public[i].addEventListener('click', funciones.eliminarPublicacion);
	}
}


//CLICK EN EDITAR PARA MOSTRAR FORMULARIO DE EDITAR
const editar_public = document.querySelectorAll('.editar_public');
if (editar_public) {
	for (var i = 0; i <= editar_public.length - 1; i++) {
		editar_public[i].addEventListener('click', funciones.desplegarFormularioEdit);
	}
}

//EDITAR PUBLICACION
const editar_publicacion = document.querySelectorAll('.editar-publicacion button.editarp');
if (editar_publicacion) {
	for (var i = 0; i <= editar_publicacion.length - 1; i++) {
		editar_publicacion[i].addEventListener('click', funciones.editarPublicacion);
	}
}


//CANCELAR EDICION
const cancelar_edicion = document.querySelectorAll('.cancelar-edicion');
if (cancelar_edicion) {
	for (var i = 0; i <= cancelar_edicion.length - 1; i++) {
		cancelar_edicion[i].addEventListener('click', funciones.cancelarEdicion);
	}
}


//EDITAR RESPUESTA PARA MOSTRAR FORMULARIO
const editar_resp = document.querySelectorAll('.editar_resp');
if (editar_resp) {
	for (var i = 0; i <= editar_resp.length - 1; i++) {
		editar_resp[i].addEventListener('click', funciones.mostrarFormularioResp);
	}
}

//EDITAR RESPUESTA.
const editarr = document.querySelectorAll('.editarr');
if (editarr) {
	for (var i = 0; i <= editarr.length - 1; i++) {
		editarr[i].addEventListener('click', funciones.editarRespuesta);
	}
}

//AGREGAR RESPUESTA.
const agregar_respuesta = document.querySelectorAll('.agregar-respuesta button');
const agregar_nuevo_post = document.querySelector('.agregar-nuevo_post button');
if (agregar_respuesta) {
	for (var i = 0; i <= agregar_respuesta.length - 1; i++) {
		agregar_respuesta[i].addEventListener('click', funciones.agregarRespuesta);
	}
}

if (agregar_nuevo_post) {
	agregar_nuevo_post.addEventListener('click', funciones.agregarRespuesta);
}


//BOOTN GUARDAR CALIFICACIONES
const frm_agregar_calificaciones = document.querySelector('form[name="frm-agregar_calificaciones"] button');
if (frm_agregar_calificaciones) {
	frm_agregar_calificaciones.addEventListener('click', function(e) {
		e.preventDefault();

		e.target.disabled = true;
        document.querySelector('.ibox-content').classList.add('sk-loading');
    	document.querySelector("form[name='frm-agregar_calificaciones']").submit();
    	return false;
	})
}


//Eliminar archivo
const delete_filex = document.querySelectorAll('.delete-filex');
if (delete_filex) {
	for (var i = 0; i <= delete_filex.length - 1; i++) {
		delete_filex[i].addEventListener('click', funciones.alertConfirmDelete);
	}
}


//Eliminar archivo de respuesta
const delete_resp_filex = document.querySelectorAll('.delete-resp_filex');
if (delete_resp_filex) {
	for (var i = 0; i <= delete_resp_filex.length - 1; i++) {
		delete_resp_filex[i].addEventListener('click', funciones.alertConfirmDeleteResp);
	}
}



//FORMULARIO USUARIO
const frmAgregarUsuario = document.querySelector("form[name='frm-agregar_usuario']");
const frmActualizarUsuario = document.querySelector("form[name='frm-editar_usuario']");
if (frmAgregarUsuario || frmActualizarUsuario) {

	if (frmAgregarUsuario) {
		frmAgregarUsuario.addEventListener('submit', funciones.validarAgregarUsuario);
		frmAgregarUsuario.addEventListener('input', funciones.validarAgregarUsuario);
		$(document).change("input", funciones.validarAgregarUsuario);
		$("select").change(funciones.validarAgregarUsuario);
	}

	if (frmActualizarUsuario) {
		frmActualizarUsuario.addEventListener('submit', funciones.validarAgregarUsuario);
		frmActualizarUsuario.addEventListener('input', funciones.validarAgregarUsuario);
		$(document).change("input", funciones.validarAgregarUsuario);
		$("select").change(funciones.validarAgregarUsuario);
	}
}


//CHECK USUARIOS CON SUSCRIPCION
const suscripcion = document.querySelector('input[name="suscripcion"]');
if (suscripcion) {
	$('input[name="suscripcion"]').on('ifChanged', function(event) {
		if ($(this).is(':checked')) {
			$("select[name='select_carreras']")
				.parents(".form-group").css("display", "flex");
		}
		else {
			$("select[name='select_carreras']")
				.parents(".form-group").css("display", "none");
		}

	});
}


//Cambiar status curso
let tabla_usuarios = document.querySelector("table.tabla-usuarios");
if (tabla_usuarios) {
	let btn_activar = document.querySelectorAll(".btn-activar");
	if (btn_activar) {
		btn_activar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-user", e);
			})
		});
	}

	let btn_desactivar = document.querySelectorAll(".btn-desactivar");
	if (btn_desactivar) {
		btn_desactivar.forEach( (item) => {
			item.addEventListener('click', function(e) {
				e.preventDefault();
				funciones.cambiarStatus("/admin/cambiar-status-user", e);
			});
		});
	}
}


//FORMULARIO GRUPOS
const frmAgregarGrupo = document.querySelector("form[name='frm-agregar_grupo']");
const frmActualizarGrupo = document.querySelector("form[name='frm-editar_grupo']");
if (frmAgregarGrupo || frmActualizarGrupo) {

	if (frmAgregarGrupo) {
		frmAgregarGrupo.addEventListener('submit', funciones.validarAgregarGrupo);
		frmAgregarGrupo.addEventListener('input', funciones.validarAgregarGrupo);
		$(document).change("input", funciones.validarAgregarGrupo);
		$("select").change(funciones.validarAgregarGrupo);
	}

	if (frmActualizarGrupo) {
		frmActualizarGrupo.addEventListener('submit', funciones.validarAgregarGrupo);
		frmActualizarGrupo.addEventListener('input', funciones.validarAgregarGrupo);
		$(document).change("input", funciones.validarAgregarGrupo);
		$("select").change(funciones.validarAgregarGrupo);
	}
}



//STATUS DE INSCRIPCION
const activa_programa = $('input[name="status"]');
if (activa_programa) {
	activa_programa.on('ifChecked', function(event) {
 		if ($(this).val() == 3) {
 			$('.activa_programa').css('display', 'block');
 			$('.div-grupos').css('display', 'flex');
 		}
 		else if ($(this).val() == 1) {
 			$('.div-grupos').css('display', 'flex');
 			$('.activa_programa').css('display', 'none');
 		}
 		else {
 			$('.div-grupos').css('display', 'none');
 			$('.activa_programa').css('display', 'none');
 		}
	});
}



//FORMULARIO FECHAS
const frmAgregarFecha = document.querySelector("form[name='frm-agregar_fecha']");
if (frmAgregarFecha) {

	frmAgregarFecha.addEventListener('submit', funciones.validarFechasContenido);
	frmAgregarFecha.addEventListener('input', funciones.validarFechasContenido);
	$(document).change("input", funciones.validarFechasContenido);
	$("select").change(funciones.validarFechasContenido);
}



//FORMULARIO STATUS
const frm_agregar_status_ins = document.querySelector("form[name='frm-agregar_status_ins']");
if (frm_agregar_status_ins) {
	frm_agregar_status_ins.addEventListener('submit', funciones.validarStatusInscripciones);
	$("select").change(funciones.validarStatusInscripciones);
}