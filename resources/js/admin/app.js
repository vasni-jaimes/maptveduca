import { funciones } from './functions.js';


//FORMULARIO PARA AGREGAR UN CURSO Y ACTUALIZAR
const frmAgregarCurso = document.querySelector("form[name='frm-agregar_curso']");
if (frmAgregarCurso) {

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


	if (frmAgregarCurso) {
		frmAgregarCurso.addEventListener('submit', funciones.validacionAgregarCurso);
		frmAgregarCurso.addEventListener('input', funciones.validacionAgregarCurso);
		$(document).change("input", funciones.validacionAgregarCurso);
		$("select").change(funciones.validacionAgregarCurso);
	}


	// if (frmActualizarCurso) {
	// 	frmActualizarCurso.addEventListener('submit', funciones.validacionAgregarCurso);
	// 	frmActualizarCurso.addEventListener('input', funciones.validacionAgregarCurso);
	// 	$("select").change(funciones.validacionAgregarCurso);
	// }
}