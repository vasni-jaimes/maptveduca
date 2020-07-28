import { funciones } from './functions.js';


//FORMULARIO PARA AGREGAR UN CURSO Y ACTUALIZAR
const frmAgregarCurso = document.querySelector("form[name='frm-agregar_curso']");
//const frmActualizarCurso = document.querySelector("form[name='frm-actualizar_curso']");
if (frmAgregarCurso) {

	const bottonAdd = document.querySelector(".add-clone_videos");
	if (bottonAdd) {
		bottonAdd.addEventListener('click', (e) => {
			e.preventDefault();
		    const htmlVideo = funciones.htmlVideoCurso();
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



	// const eliminarArchivo = document.querySelectorAll(".eliminar_archivo");
	// if (eliminarArchivo) {
	// 	eliminarArchivo.forEach((item, index) => {
	// 		item.addEventListener('click', (e) => {
	// 			e.preventDefault();
	// 			e.target.disabled = true;

	// 			let token = document.querySelector("input[name='_token']").value,
	// 				pdf = e.target.getAttribute('data-metadata');
	// 	        let opciones = {
	// 	            method: "POST",
	// 	            credentials: "same-origin",
	// 	            body: JSON.stringify({"pdf": pdf, "_token": token}),
	// 	            headers:{
	// 	                "Content-Type": "application/json"
	// 	            }
	// 	        };

	// 	        fetch("/admin/cursos/eliminarmaterial", opciones)
	// 	            .then(response => response.json())
	// 	            .then(res => {
	// 	            	if (res.message == 'ok') {
	// 	            		e.target.parentElement.parentElement.remove();
	// 	            		alert('Se elimino el archivo correctamente');
	// 	            	}
	// 	            	else if (res.message == 'no_parameters') {
	// 	            		alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
	// 	            		e.removeAttribute('disabled');
	// 	            	}
	// 	            	else if (res.message == 'no_integer') {
	// 	            		alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
	// 	            		e.removeAttribute('disabled');
	// 	            	}
	// 	            	else if (res.message == 'no_delete') {
	// 	            		alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
	// 	            		e.removeAttribute('disabled');
	// 	            	}
	// 	            })
	// 		})
	// 	});
	// }


	// if (frmAgregarCurso) {
	// 	frmAgregarCurso.addEventListener('submit', funciones.validacionAgregarCurso);
	// 	frmAgregarCurso.addEventListener('input', funciones.validacionAgregarCurso);
	// 	$(document).change("input", funciones.validacionAgregarCurso);
	// 	$("select").change(funciones.validacionAgregarCurso);
	// }

	// if (frmActualizarCurso) {
	// 	frmActualizarCurso.addEventListener('submit', funciones.validacionAgregarCurso);
	// 	frmActualizarCurso.addEventListener('input', funciones.validacionAgregarCurso);
	// 	$("select").change(funciones.validacionAgregarCurso);
	// }
}