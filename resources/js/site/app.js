import { funciones } from './functions.js';

const form_registro = document.querySelector("form[name='form_registro']");
if (form_registro) {
	form_registro.addEventListener("submit", funciones.validarRegistro);
}

const form_login = document.querySelector("form[name='form_login']");
if (form_login) {
	form_login.addEventListener("submit", funciones.validarLogin);
}


let sidebar_cursos = document.querySelector(".sidebar-cursos");
if (sidebar_cursos) {

	const categorias = document.querySelectorAll(".sidebar-cursos ul");
	if (categorias) {
		for(var i = 0; i <= categorias.length - 1; i++) {
			categorias[i].addEventListener("click", funciones.filtrosCursos)
		}
	}
}
