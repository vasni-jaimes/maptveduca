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

	//ELIMINAR ARCHIVO DE CURSO EXTRA EN UPDATE
	if (frmActualizarCurso) {
		const eliminar_archivo = document.querySelectorAll(".eliminar_archivo");
		eliminar_archivo.forEach( (item) => {
			item.addEventListener('click', funciones.elimiarArchivoUpdateCurso)	
		})
		
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
	}
}


const frmAgregarClase = document.querySelector("form[name='frm-agregar_clase']");
if (frmAgregarClase) {
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
}



