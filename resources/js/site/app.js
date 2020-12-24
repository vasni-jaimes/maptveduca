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

//REDIRECCION DE CLASES - CURSOS
let sidebar_single = document.querySelectorAll('.sidebar-single ul li.active');
if (sidebar_single) {
	for (var i = 0; i <= sidebar_single.length - 1; i++) {
		sidebar_single[i].addEventListener('click', function(e) {
			//alert('');
			let url = e.target.getAttribute('data-url');
			window.location.href = url;
		});
	}
}

//AGREGAR FAVORITOS EN MIS CURSOS
let favorito = document.querySelector('.favorito');
if (favorito) {
	favorito.addEventListener('click', funciones.guardarFavoritos);
}

//ANIMACION EN MICUENTA DE PASAR POR SECCIONES
let li_micuenta = document.querySelectorAll('.li-micuenta');
if (li_micuenta) {
	for(var i = 0; i <= li_micuenta.length - 1; i++) {
		li_micuenta[i].addEventListener("click", funciones.micuentaActive)
	}
}
