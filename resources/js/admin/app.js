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
			e.target.parentNode.nextElementSibling.nextElementSibling.lastElementChild.remove();
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
}


const frmAgregarInstructor = document.querySelector("form[name='frm-agregar_instructor']");
if (frmAgregarInstructor) {

	if (frmAgregarInstructor) {
		frmAgregarInstructor.addEventListener('submit', funciones.validarAgregarInstructor);
		frmAgregarInstructor.addEventListener('input', funciones.validarAgregarInstructor);
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

