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
let sidebar_single = document.querySelectorAll('.single-curso .sidebar-single ul li.active');
if (sidebar_single) {
	for (var i = 0; i <= sidebar_single.length - 1; i++) {
		sidebar_single[i].addEventListener('click', function(e) {
			//alert('');
			let url = e.target.getAttribute('data-url');
			window.location.href = url;
		});
	}
}

//AGREGAR FAVORITOS EN MIS CURSOS Y EVENTOS
let favorito = document.querySelector('.favcurso');
if (favorito) {
	favorito.addEventListener('click', function(e) {
		funciones.guardarFavoritos(e, "curso");
	});
}

//AGREGAR FAVORITOS EN MIS CURSOS Y EVENTOS
let favoritoEvent = document.querySelector('.favevento');
if (favoritoEvent) {
	favoritoEvent.addEventListener('click', function(e) {
		funciones.guardarFavoritos(e, "evento");
	});
}



//ANIMACION EN MICUENTA DE PASAR POR SECCIONES
let li_micuenta = document.querySelectorAll('.li-micuenta');
if (li_micuenta) {
	for(var i = 0; i <= li_micuenta.length - 1; i++) {
		li_micuenta[i].addEventListener("click", funciones.micuentaActive)
	}
}


//EMPEZAR CURSO
let empezar_curso = document.querySelector('.empezar_curso');
if (empezar_curso) {
	empezar_curso.addEventListener('click', funciones.empezarCurso);
}


//REGISTRARSE AL EVENTO
let registro_evento = document.querySelector('.registrarte_evento');
if (registro_evento) {
	registro_evento.addEventListener('click', funciones.registroEvento);
}


//ELIMINAR DE FAVORITOS
let delete_fav = document.querySelectorAll('.delete_curso-fav');
if (delete_fav) {
	for (var i = 0; i <= delete_fav.length - 1; i++) {
		delete_fav[i].addEventListener('click', function(e) {
			funciones.eliminarCursoFav(e, "curso");
		});
	}
}

let delete_faveve = document.querySelectorAll('.delete_evento-fav');
if (delete_faveve) {
	for (var i = 0; i <= delete_faveve.length - 1; i++) {
		delete_faveve[i].addEventListener('click', function(e) {
			funciones.eliminarCursoFav(e, "evento");
		});
	}
}


//EDITAR DATOS DEL PERFIL DE USUARIO
let btn_perfil = document.querySelector('.btn_perfil');
if (btn_perfil) {
	btn_perfil.addEventListener('click', funciones.editarPerfil);
}



//ELIMINAR RESPUESTA
const acciones_respuestas = document.querySelectorAll('.acciones_respuestas form a');
if (acciones_respuestas) {
	for (var i = 0; i <= acciones_respuestas.length - 1; i++) {
		acciones_respuestas[i].addEventListener('click', funciones.eliminarRespuesta);
	}
}


//MOSTRAR FORMULARIO PARA EDITAR PUBLICACION
const form_editar = document.querySelectorAll('a.form-editar_show');
if (form_editar) {
	for (var i = 0; i <= form_editar.length - 1; i++) {
		form_editar[i].addEventListener('click', funciones.mostrarFormEditarResp);
	}
}


const btn_cancelar = document.querySelectorAll('.btn-cancelar');
if (btn_cancelar) {
	for (var i = 0; i <= form_editar.length - 1; i++) {
		btn_cancelar[i].addEventListener('click', funciones.ocultarEditarRespuesta);
	}
}




