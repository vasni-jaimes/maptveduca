import { funciones } from './functions.js';

const form_registro = document.querySelector("form[name='form_registro']");
if (form_registro) {
	form_registro.addEventListener("submit", funciones.validarRegistro);
}

const form_login = document.querySelector("form[name='form_login']");
if (form_login) {
	form_login.addEventListener('input', funciones.validarLogin);
	form_login.addEventListener("submit", funciones.validarLogin);
	$(document).change("input", funciones.validarLogin);
}


let sidebar_cursos = document.querySelector(".sidebar-cursos");
if (sidebar_cursos) {

	const categorias = document.querySelectorAll(".sidebar-cursos ul:not(.guia-es)");
	if (categorias) {
		for(var i = 0; i <= categorias.length - 1; i++) {
			categorias[i].addEventListener("click", funciones.filtrosCursos)
		}
	}
}

//REDIRECCION DE CLASES - CURSOS
let sidebar_single = document.querySelectorAll('.single-curso .sidebar-single > ul > li.active');
if (sidebar_single) {
	for (var i = 0; i <= sidebar_single.length - 1; i++) {
		sidebar_single[i].addEventListener('click', function(e) {
			e.stopPropagation();
			let url = e.target.getAttribute('data-url');
			return url == null ? false : window.location.href = url;
		});
	}
}

//TOGGLE CLASS (CURSOS)
let active_tema = document.querySelectorAll('.single-curso .sidebar-single > ul > li.active-tema')
if (active_tema) {
	for (var i = 0; i <= active_tema.length - 1; i++) {
		active_tema[i].addEventListener('click', function(e) {
			e.stopPropagation();
			let url = e.target.getAttribute('data-url');

			if (url != null)
				return false;

			if (e.target.classList.contains('active-tema')) {
				let lista = e.target.firstChild.nextSibling.nextSibling.nextSibling;
				let style = window.getComputedStyle(lista);
				(style.display == 'none') ? lista.style.display = 'block' : lista.style.display = 'none';
			}
			else {
				let lista = e.target.nextSibling.nextSibling;
				let style = window.getComputedStyle(lista);
				(style.display == 'none') ? lista.style.display = 'block' : lista.style.display = 'none';
			}
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


//MOSTRAR MODAL DE FAVORITOS CURSOS
let delete_fav = document.querySelectorAll('.delete_curso-fav');
if (delete_fav) {
	for (var i = 0; i <= delete_fav.length - 1; i++) {
		delete_fav[i].addEventListener('click', function(e) {
			let slug = e.target.getAttribute('data-slg');
			document.querySelector('#shadow-favorito .si_delete-fav').setAttribute('data-slg', slug);
			document.querySelector('#shadow-favorito').style.display = "block";
			//funciones.eliminarCursoFav(e, "curso");
		});
	}
}

//MOSTRAR MODAL DE FAVORITOS EVENTOS
let delete_faveve = document.querySelectorAll('.delete_evento-fav');
if (delete_faveve) {
	for (var i = 0; i <= delete_faveve.length - 1; i++) {
		delete_faveve[i].addEventListener('click', function(e) {
			let slug = e.target.getAttribute('data-slg');
			document.querySelector('#shadow-favorito_evento .si_delete-fav').setAttribute('data-slg', slug);
			document.querySelector('#shadow-favorito_evento').style.display = "block";
			//funciones.eliminarCursoFav(e, "evento");
		});
	}
}



//ELIMINAR FAVORITOS CURSOS
let shadow_favorito = document.querySelectorAll('#shadow-favorito .si_delete-fav');
if (shadow_favorito) {
	for (var i = 0; i <= shadow_favorito.length - 1; i++) {
		shadow_favorito[i].addEventListener('click', function(e) {
			funciones.eliminarCursoFav(e, "curso");
		});
	}
}

//ELIMINAR FAVORITOS EVENTOS
let shadow_favorito_evento = document.querySelectorAll('#shadow-favorito_evento .si_delete-fav');
if (shadow_favorito_evento) {
	for (var i = 0; i <= shadow_favorito_evento.length - 1; i++) {
		shadow_favorito_evento[i].addEventListener('click', function(e) {
			funciones.eliminarCursoFav(e, "evento");
		});
	}
}


//CANCELAR DE NO ELIMINAR UN FAVORITO
const cancel_favorito = document.querySelectorAll('.no_delete-fav');
if (cancel_favorito) {
	for (var i = 0; i <= cancel_favorito.length - 1; i++) {
		cancel_favorito[i].addEventListener('click', function(e) {
			document.querySelector('#shadow-favorito').style.display = "none";
			document.querySelector('#shadow-favorito_evento').style.display = "none";
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
		acciones_respuestas[i].addEventListener('click', function(e) {
			e.preventDefault();
			let rsp = e.target.getAttribute('data-rsp');
			document.querySelector('#shadow-eliminar_respuesta .si_delete-resp').setAttribute('data-rsp', rsp);
			document.querySelector('#shadow-eliminar_respuesta').style.display = "block";
		});
		//acciones_respuestas[i].addEventListener('click', funciones.eliminarRespuesta);
	}
}


//CONFIRMAR ELIMINAR RESPUESTA
const delete_resp = document.querySelector('#shadow-eliminar_respuesta .si_delete-resp');
if (delete_resp) {
	delete_resp.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#shadow-eliminar_respuesta').style.display = "none";
		document.querySelector('#loading').style.display = "block";
		let rsp = e.target.getAttribute('data-rsp');
		document.querySelector('.acciones_respuestas form a.eliminar-resp_a[data-rsp="'+rsp+'"]').parentElement.submit();
	})
}


//CANCELAR ELIMINAR RESPUESTA
const no_delete_resp = document.querySelector('.no_delete-resp');
if (no_delete_resp) {
	no_delete_resp.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#shadow-eliminar_respuesta').style.display = "none";
	})
}


//RESPUESTA
const btn_responder_web = document.querySelector('.btn-responder_web');
if (btn_responder_web) {
	btn_responder_web.addEventListener('click', funciones.mostarrLoadingForm);
}


//EDITAR RESPUESTA
const btn_editar_web = document.querySelectorAll('.btn-editar_web');
if (btn_editar_web) {
	for (var i = 0; i <= btn_editar_web.length - 1; i++) {
		btn_editar_web[i].addEventListener('click', funciones.mostarrLoadingForm);
	}
}


//MOSTRAR FORMULARIO PARA EDITAR PUBLICACION
const form_editar = document.querySelectorAll('a.form-editar_show');
if (form_editar) {
	for (var i = 0; i <= form_editar.length - 1; i++) {
		form_editar[i].addEventListener('click', funciones.mostrarFormEditarResp);
	}
}

//BOTON CANCELAR PARA ELIMINAR FAVORITO
const btn_cancelar = document.querySelectorAll('.btn-cancelar');
if (btn_cancelar) {
	for (var i = 0; i <= form_editar.length - 1; i++) {
		btn_cancelar[i].addEventListener('click', funciones.ocultarEditarRespuesta);
	}
}


//cerrar modal ok
const ok_favoritos = document.querySelector('.ok_favoritos-micuenta');
if (ok_favoritos) {
	ok_favoritos.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#shadow-exito').style.display = "none";
	})
}

//FORM CHECKOUT
const form_checkout = document.querySelector('.form-checkout button');
if (form_checkout) {
	form_checkout.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#loading').style.display = "block";
		document.querySelector('.form-checkout').submit();
	});
}


//UPLADE FILE
let uploadedFile = document.querySelectorAll('input[name="upload[]"]');
if (uploadedFile) {
	for (var i = 0; i <= uploadedFile.length - 1; i++) {
		uploadedFile[i].addEventListener('change', function(e) {
			e.preventDefault();
			var pdrs = e.target.files.length;
			$(e.target).next().next().children().html('Archivo '+pdrs);
			$(e.target).next().next().children().css('display', 'inline-block');
		});
	}
}



//VER MENSAJE
let ver_msj = document.querySelectorAll('a.ver-msj');
if (ver_msj) {
	for (var i = 0; i <= ver_msj.length - 1; i++) {
		ver_msj[i].addEventListener('click', funciones.verMensajeWeb);
	}
}



//VER MENSAJE
let ver_notify = document.querySelectorAll('a.ver-notify');
if (ver_notify) {
	for (var i = 0; i <= ver_notify.length - 1; i++) {
		ver_notify[i].addEventListener('click', funciones.verNotificacioneseWeb);
	}
}


//ENVIAR CONTACTO
let enviar_mensaje = document.querySelector('.enviar-mensaje');
if (enviar_mensaje) {
	enviar_mensaje.addEventListener('click', funciones.validacionContacto);
	$(document).change("input", funciones.validacionContacto);
	//enviar_mensaje.addEventListener('input', funciones.validacionContacto);
}



//ELIMINAR ARCHIVO EN AULAS VIRTUALES
let deletefilex = document.querySelectorAll('.delete-filex');
if (deletefilex) {
	for (var i = 0; i <= deletefilex.length - 1; i++) {
		deletefilex[i].addEventListener('click', function(e) {
			e.preventDefault();
			let rsp = e.target.getAttribute('data-rsp');
			let file = e.target.getAttribute('data-file');
			document.querySelector('#shadow-eliminar_archivo .si_deletefile-resp').setAttribute('data-rsp', rsp);
			document.querySelector('#shadow-eliminar_archivo .si_deletefile-resp').setAttribute('data-file', file);
			document.querySelector('#shadow-eliminar_archivo').style.display = "block";
		});
	}
}


let eliminar_archivo = document.querySelector('#shadow-eliminar_archivo .si_deletefile-resp');
if (eliminar_archivo) {
	eliminar_archivo.addEventListener('click', funciones.eliminarArchivoAulas);
}


//OK ELIMINAR ARCHIVO
let ok_deletefile_resp = document.querySelector('.ok_deletefile-resp');
if (ok_deletefile_resp) {
	ok_deletefile_resp.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#shadow-confirm_deletefile').style.display = "none";
	})
}



//CANCELAR ELIMINAR ARCHIVO
let no_deletefile_resp = document.querySelector('#shadow-eliminar_archivo .no_deletefile-resp');
if (no_deletefile_resp) {
	no_deletefile_resp.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#shadow-eliminar_archivo').style.display = "none";
	})
}



//DALE AL BOTTON OK DE STATUS DE EVENTO
//cerrar modal ok
const ok_evento = document.querySelector('.ok_evento');
if (ok_evento) {
	ok_evento.addEventListener('click', function(e) {
		e.preventDefault();
		document.querySelector('#shadow-eventok').style.display = "none";
	})
}



