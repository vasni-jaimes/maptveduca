/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/site/app.js":
/*!**********************************!*\
  !*** ./resources/js/site/app.js ***!
  \**********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./functions.js */ "./resources/js/site/functions.js");
/* harmony import */ var _functions_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_functions_js__WEBPACK_IMPORTED_MODULE_0__);

var form_registro = document.querySelector("form[name='form_registro']");

if (form_registro) {
  form_registro.addEventListener("submit", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarRegistro);
}

var form_login = document.querySelector("form[name='form_login']");

if (form_login) {
  form_login.addEventListener("submit", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarLogin);
}

var sidebar_cursos = document.querySelector(".sidebar-cursos");

if (sidebar_cursos) {
  var categorias = document.querySelectorAll(".sidebar-cursos ul");

  if (categorias) {
    for (var i = 0; i <= categorias.length - 1; i++) {
      categorias[i].addEventListener("click", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].filtrosCursos);
    }
  }
} //REDIRECCION DE CLASES - CURSOS


var sidebar_single = document.querySelectorAll('.single-curso .sidebar-single ul li.active');

if (sidebar_single) {
  for (var i = 0; i <= sidebar_single.length - 1; i++) {
    sidebar_single[i].addEventListener('click', function (e) {
      //document.querySelector('#loading').style.display = "block";
      var url = e.target.getAttribute('data-url');
      window.location.href = url;
    });
  }
} //AGREGAR FAVORITOS EN MIS CURSOS Y EVENTOS


var favorito = document.querySelector('.favcurso');

if (favorito) {
  favorito.addEventListener('click', function (e) {
    _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].guardarFavoritos(e, "curso");
  });
} //AGREGAR FAVORITOS EN MIS CURSOS Y EVENTOS


var favoritoEvent = document.querySelector('.favevento');

if (favoritoEvent) {
  favoritoEvent.addEventListener('click', function (e) {
    _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].guardarFavoritos(e, "evento");
  });
} //ANIMACION EN MICUENTA DE PASAR POR SECCIONES


var li_micuenta = document.querySelectorAll('.li-micuenta');

if (li_micuenta) {
  for (var i = 0; i <= li_micuenta.length - 1; i++) {
    li_micuenta[i].addEventListener("click", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].micuentaActive);
  }
} //EMPEZAR CURSO


var empezar_curso = document.querySelector('.empezar_curso');

if (empezar_curso) {
  empezar_curso.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].empezarCurso);
} //REGISTRARSE AL EVENTO


var registro_evento = document.querySelector('.registrarte_evento');

if (registro_evento) {
  registro_evento.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].registroEvento);
} //MOSTRAR MODAL DE FAVORITOS CURSOS


var delete_fav = document.querySelectorAll('.delete_curso-fav');

if (delete_fav) {
  for (var i = 0; i <= delete_fav.length - 1; i++) {
    delete_fav[i].addEventListener('click', function (e) {
      var slug = e.target.getAttribute('data-slg');
      document.querySelector('#shadow-favorito .si_delete-fav').setAttribute('data-slg', slug);
      document.querySelector('#shadow-favorito').style.display = "block"; //funciones.eliminarCursoFav(e, "curso");
    });
  }
} //MOSTRAR MODAL DE FAVORITOS EVENTOS


var delete_faveve = document.querySelectorAll('.delete_evento-fav');

if (delete_faveve) {
  for (var i = 0; i <= delete_faveve.length - 1; i++) {
    delete_faveve[i].addEventListener('click', function (e) {
      var slug = e.target.getAttribute('data-slg');
      document.querySelector('#shadow-favorito_evento .si_delete-fav').setAttribute('data-slg', slug);
      document.querySelector('#shadow-favorito_evento').style.display = "block"; //funciones.eliminarCursoFav(e, "evento");
    });
  }
} //ELIMINAR FAVORITOS CURSOS


var shadow_favorito = document.querySelectorAll('.shadow-favorito .si_delete-fav');

if (shadow_favorito) {
  for (var i = 0; i <= shadow_favorito.length - 1; i++) {
    shadow_favorito[i].addEventListener('click', function (e) {
      _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].eliminarCursoFav(e, "curso");
    });
  }
} //ELIMINAR FAVORITOS EVENTOS


var shadow_favorito_evento = document.querySelectorAll('.shadow-favorito_evento .si_delete-fav');

if (shadow_favorito_evento) {
  for (var i = 0; i <= shadow_favorito_evento.length - 1; i++) {
    shadow_favorito_evento[i].addEventListener('click', function (e) {
      _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].eliminarCursoFav(e, "evento");
    });
  }
} //CANCELAR DE NO ELIMINAR UN FAVORITO


var cancel_favorito = document.querySelectorAll('.no_delete-fav');

if (cancel_favorito) {
  for (var i = 0; i <= cancel_favorito.length - 1; i++) {
    cancel_favorito[i].addEventListener('click', function (e) {
      document.querySelector('#shadow-favorito').style.display = "none";
      document.querySelector('#shadow-favorito_evento').style.display = "none";
    });
  }
} //EDITAR DATOS DEL PERFIL DE USUARIO


var btn_perfil = document.querySelector('.btn_perfil');

if (btn_perfil) {
  btn_perfil.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].editarPerfil);
} //ELIMINAR RESPUESTA


var acciones_respuestas = document.querySelectorAll('.acciones_respuestas form a');

if (acciones_respuestas) {
  for (var i = 0; i <= acciones_respuestas.length - 1; i++) {
    acciones_respuestas[i].addEventListener('click', function (e) {
      e.preventDefault();
      var rsp = e.target.getAttribute('data-rsp');
      document.querySelector('#shadow-eliminar_respuesta .si_delete-resp').setAttribute('data-rsp', rsp);
      document.querySelector('#shadow-eliminar_respuesta').style.display = "block";
    }); //acciones_respuestas[i].addEventListener('click', funciones.eliminarRespuesta);
  }
} //CONFIRMAR ELIMINAR RESPUESTA


var delete_resp = document.querySelector('#shadow-eliminar_respuesta .si_delete-resp');

if (delete_resp) {
  delete_resp.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#shadow-eliminar_respuesta').style.display = "none";
    document.querySelector('#loading').style.display = "block";
    var rsp = e.target.getAttribute('data-rsp');
    document.querySelector('.acciones_respuestas form a.eliminar-resp_a[data-rsp="' + rsp + '"]').parentElement.submit();
  });
} //CANCELAR ELIMINAR RESPUESTA


var no_delete_resp = document.querySelector('.no_delete-resp');

if (no_delete_resp) {
  no_delete_resp.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#shadow-eliminar_respuesta').style.display = "none";
  });
} //RESPUESTA


var btn_responder_web = document.querySelector('.btn-responder_web');

if (btn_responder_web) {
  btn_responder_web.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].mostarrLoadingForm);
} //EDITAR RESPUESTA


var btn_editar_web = document.querySelectorAll('.btn-editar_web');

if (btn_editar_web) {
  for (var i = 0; i <= btn_editar_web.length - 1; i++) {
    btn_editar_web[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].mostarrLoadingForm);
  }
} //MOSTRAR FORMULARIO PARA EDITAR PUBLICACION


var form_editar = document.querySelectorAll('a.form-editar_show');

if (form_editar) {
  for (var i = 0; i <= form_editar.length - 1; i++) {
    form_editar[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].mostrarFormEditarResp);
  }
} //BOTON CANCELAR PARA ELIMINAR FAVORITO


var btn_cancelar = document.querySelectorAll('.btn-cancelar');

if (btn_cancelar) {
  for (var i = 0; i <= form_editar.length - 1; i++) {
    btn_cancelar[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].ocultarEditarRespuesta);
  }
} //cerrar modal ok


var ok_favoritos = document.querySelector('.ok_favoritos-micuenta');

if (ok_favoritos) {
  ok_favoritos.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#shadow-exito').style.display = "none";
  });
} //FORM CHECKOUT


var form_checkout = document.querySelector('.form-checkout button');

if (form_checkout) {
  form_checkout.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    document.querySelector('.form-checkout').submit();
  });
} //UPLADE FILE


var uploadedFile = document.querySelectorAll('input[name="upload[]"]');

if (uploadedFile) {
  for (var i = 0; i <= uploadedFile.length - 1; i++) {
    uploadedFile[i].addEventListener('change', function (e) {
      e.preventDefault();
      var pdrs = e.target.files.length;
      $(e.target).next().next().children().html('Archivo ' + pdrs);
      $(e.target).next().next().children().css('display', 'inline-block');
    });
  }
} //VER MENSAJE


var ver_msj = document.querySelectorAll('a.ver-msj');

if (ver_msj) {
  for (var i = 0; i <= ver_msj.length - 1; i++) {
    ver_msj[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].verMensajeWeb);
  }
} //VER MENSAJE


var ver_notify = document.querySelectorAll('a.ver-notify');

if (ver_notify) {
  for (var i = 0; i <= ver_notify.length - 1; i++) {
    ver_notify[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].verNotificacioneseWeb);
  }
} //ENVIAR CONTACTO


var enviar_mensaje = document.querySelector('.enviar-mensaje');

if (enviar_mensaje) {
  enviar_mensaje.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    document.querySelector('.form-contacto').submit();
  });
} //ELIMINAR ARCHIVO EN AULAS VIRTUALES


var deletefilex = document.querySelectorAll('.delete-filex');

if (deletefilex) {
  for (var i = 0; i <= deletefilex.length - 1; i++) {
    deletefilex[i].addEventListener('click', function (e) {
      e.preventDefault();
      var rsp = e.target.getAttribute('data-rsp');
      var file = e.target.getAttribute('data-file');
      document.querySelector('#shadow-eliminar_archivo .si_deletefile-resp').setAttribute('data-rsp', rsp);
      document.querySelector('#shadow-eliminar_archivo .si_deletefile-resp').setAttribute('data-file', file);
      document.querySelector('#shadow-eliminar_archivo').style.display = "block";
    });
  }
}

var eliminar_archivo = document.querySelector('#shadow-eliminar_archivo .si_deletefile-resp');

if (eliminar_archivo) {
  eliminar_archivo.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].eliminarArchivoAulas);
} //OK ELIMINAR ARCHIVO


var ok_deletefile_resp = document.querySelector('.ok_deletefile-resp');

if (ok_deletefile_resp) {
  ok_deletefile_resp.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#shadow-confirm_deletefile').style.display = "none";
  });
} //CANCELAR ELIMINAR ARCHIVO


var no_deletefile_resp = document.querySelector('#shadow-eliminar_archivo .no_deletefile-resp');

if (no_deletefile_resp) {
  no_deletefile_resp.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#shadow-eliminar_archivo').style.display = "none";
  });
} //DALE AL BOTTON OK DE STATUS DE EVENTO
//cerrar modal ok


var ok_evento = document.querySelector('.ok_evento');

if (ok_evento) {
  ok_evento.addEventListener('click', function (e) {
    e.preventDefault();
    document.querySelector('#shadow-eventok').style.display = "none";
  });
}

/***/ }),

/***/ "./resources/js/site/functions.js":
/*!****************************************!*\
  !*** ./resources/js/site/functions.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)
var funciones = {
  eliminarArchivoAulas: function eliminarArchivoAulas(e) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    var rsp = e.target.getAttribute('data-rsp');
    var file = e.target.getAttribute('data-file');
    var token = document.querySelector("input[name='_token']").value;
    var opciones = {
      method: "POST",
      credentials: "same-origin",
      body: JSON.stringify({
        "respuesta": rsp,
        "archivo": file,
        "_token": token
      }),
      headers: {
        "Content-Type": "application/json"
      }
    };
    fetch('/eliminar-archivo', opciones).then(function (response) {
      return response.json();
    }).then(function (res) {
      if (res.message == 'ok') {
        document.querySelector('#shadow-confirm_deletefile p').innerHTML = "Se elimino con exito el archivo.";
        document.querySelector('#loading').style.display = "none";
        document.querySelector('#shadow-eliminar_archivo').style.display = "none";
        document.querySelector('#shadow-confirm_deletefile').style.display = "block";
        document.querySelector('span[data-rsp="' + rsp + '"][data-file="' + file + '"]').parentElement.remove();
      } else {
        document.querySelector('#shadow-confirm_deletefile p').innerHTML = "Ocurrio un error intentalo mas tarde.";
        document.querySelector('#loading').style.display = "none";
        document.querySelector('#shadow-eliminar_archivo').style.display = "none";
        document.querySelector('#shadow-confirm_deletefile').style.display = "block";
      }
    })["catch"](function (error) {
      document.querySelector('#shadow-confirm_deletefile p').innerHTML = "Ocurrio un error intentalo mas tarde.";
      document.querySelector('#loading').style.display = "none";
      document.querySelector('#shadow-eliminar_archivo').style.display = "none";
      document.querySelector('#shadow-confirm_deletefile').style.display = "block";
    });
  },
  verNotificacioneseWeb: function verNotificacioneseWeb(e) {
    var notificacion = e.target.getAttribute('data-noti');

    if (notificacion) {
      /* ACCIONES PARA QUITAR PUNTOS PENDIENTES  */
      document.querySelector(".notificacion[data-noti='" + notificacion + "']").remove();
      var html = document.querySelector('.ico-login .notificacion');
      var numeroNotifi = parseInt(html.innerHTML) - 1;

      if (numeroNotifi <= 0) {
        document.querySelector('.ico-login .notificacion').remove();
        document.querySelector('.not-inbox').remove();
      } else {
        document.querySelector('.ico-login .notificacion').innerHTML = numeroNotifi;
      }

      e.target.setAttribute('data-noti', '');
      e.target.classList.remove('ver-notify');
      /* ACCIONES PARA QUITAR PUNTOS PENDIENTES  */

      var token = document.querySelector("input[name='_token']").value;
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "notificacion": notificacion,
          "_token": token
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/ver-notificacion', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          console.log('todo salio bien');
        } else {
          console.log('ocurrio un error');
        }
      });
    }
  },
  verMensajeWeb: function verMensajeWeb(e) {
    var mensaje = e.target.getAttribute('data-msj');

    if (mensaje) {
      /* ACCIONES PARA QUITAR PUNTOS PENDIENTES  */
      document.querySelector(".notificacion[data-msj='" + mensaje + "']").remove();
      var html = document.querySelector('.ico-login .notificacion');
      var numeroNotifi = parseInt(html.innerHTML) - 1;

      if (numeroNotifi <= 0) {
        document.querySelector('.ico-login .notificacion').remove();
        document.querySelector('.not-inbox').remove();
      } else {
        document.querySelector('.ico-login .notificacion').innerHTML = numeroNotifi;
      }

      e.target.setAttribute('data-msj', '');
      e.target.classList.remove('ver-msj');
      /* ACCIONES PARA QUITAR PUNTOS PENDIENTES  */

      var token = document.querySelector("input[name='_token']").value;
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "mensaje": mensaje,
          "_token": token
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/ver-mensaje', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          console.log('todo salio bien');
        } else {
          console.log('ocurrio un error');
        }
      });
    }
  },
  mostarrLoadingForm: function mostarrLoadingForm(e) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    e.target.parentElement.parentElement.submit();
  },
  ocultarEditarRespuesta: function ocultarEditarRespuesta(e) {
    e.preventDefault();
    var resp = e.target.getAttribute('data-resp');
    document.querySelector('.edit-respuesta[data-resp="' + resp + '"]').style.display = "none";
    return false;
  },
  mostrarFormEditarResp: function mostrarFormEditarResp(e) {
    e.preventDefault();
    var resp = e.target.getAttribute('data-resp');
    document.querySelector('.edit-respuesta[data-resp="' + resp + '"]').style.display = "block";
    document.querySelector('.respuesta-alumno[data-resp="' + resp + '"]').style.display = "block";
    document.querySelector('.boton-alumno[data-resp="' + resp + '"]').classList.add('active-acordeon');
    return false;
  },
  editarPerfil: function editarPerfil(e) {
    e.preventDefault();
    e.stopPropagation();
    var nombre = document.querySelector("input[name='nombre']"),
        apaterno = document.querySelector("input[name='apaterno']"),
        amaterno = document.querySelector("input[name='amaterno']"),
        fecha_nacimiento = document.querySelector("input[name='fecha_nacimiento']"),
        email = document.querySelector("input[name='email']"),
        password = document.querySelector("input[name='password']"),
        validate = true;

    if (document.querySelectorAll(".campo-requerido")) {
      document.querySelectorAll('.campo-requerido').forEach(function (item) {
        item.classList.remove('campo-requerido');
      });
    }

    if (email.value == '') {
      email.classList.add('campo-requerido');
      validate = false;
    }

    if (!funciones.validarEmail(email.value)) {
      email.classList.add('campo-requerido');
      validate = false;
    }

    if (nombre.value == '') {
      nombre.classList.add('campo-requerido');
      validate = false;
    }

    if (amaterno.value == '') {
      amaterno.classList.add('campo-requerido');
      validate = false;
    }

    if (apaterno.value == '') {
      apaterno.classList.add('campo-requerido');
      validate = false;
    }

    if (password.value != '') {
      if (password.value.length < 8) {
        password.classList.add('campo-requerido');
        validate = false;
      }
    }

    if (validate == false) {
      alert('k');
      return false;
    }

    if (e.type == 'click') {
      e.target.disabled = true;
      document.querySelector("form[name='form_editar']").submit();
      return false;
    }
  },
  eliminarCursoFav: function eliminarCursoFav(e, section) {
    e.preventDefault(); //OCULTAR MENSAJE DE ELIMINAR FAVORITOS

    document.querySelector('#shadow-favorito').style.display = "none";
    document.querySelector('#shadow-favorito_evento').style.display = "none";
    document.querySelector('#loading').style.display = "block";
    var slug = e.target.getAttribute('data-slg');

    if (slug) {
      var token = document.querySelector("input[name='_token']").value;
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "slug": slug,
          "_token": token,
          "seccion": section
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/usuario/eliminarFavoritos', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          //swal("OK", "Se elimino de favoritos correctamente", "success");
          document.querySelector('.delete[data-slg="' + slug + '"]').parentNode.remove();

          if (section == 'curso') {
            var fav = document.querySelectorAll('.item-cursos ul.slide-cursos li').length;

            if (fav <= 0) {
              var texto = "<p>¡Aún no tienes cursos favoritos! Ve a la sección CURSOS y márca cuantos quieras como favoritos.</p>" + "<p>Los encontrarás aquí cuando vuelvas.</p>";
              document.querySelector('.item-cursos').insertAdjacentHTML('beforeend', texto);
            }
          } else if (section == 'evento') {
            var _fav = document.querySelectorAll('.item-eventos ul.slide-cursos li').length;

            if (_fav <= 0) {
              var _texto = "<p>¡Aún no tienes cursos favoritos! Ve a la sección CURSOS y márca cuantos quieras como favoritos.</p>" + "<p>Los encontrarás aquí cuando vuelvas.</p>";

              document.querySelector('.item-cursos').insertAdjacentHTML('beforeend', _texto);
            }
          }

          document.querySelector('#loading').style.display = "none";
          document.querySelector('#shadow-exito').style.display = "block"; //e.target.parentNode.remove();
        } else {
          //alert('no');
          swal("Error", "Ocurrio un error, intentalo más tarde", "error");
          document.querySelector('#loading').style.display = "none";
        }
      });
    }
  },
  registroEvento: function registroEvento(e) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    var slug = e.target.getAttribute('data-crs');

    if (slug) {
      var token = document.querySelector("input[name='_token']").value;
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "slug": slug,
          "_token": token
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/usuario/registrarEvento', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          //swal("OK", "Se agrego a tu tablero correctamente", "success");
          //alert('ok');
          location.reload();
        } else {
          //alert('no');
          swal("Error", "Ocurrio un error, intentalo más tarde", "error");
          document.querySelector('#loading').style.display = "none";
        }
      });
    }
  },
  empezarCurso: function empezarCurso(e) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    var slug = e.target.getAttribute('data-crs');

    if (slug) {
      var token = document.querySelector("input[name='_token']").value;
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "slug": slug,
          "_token": token
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/usuario/empezarCurso', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          //swal("OK", "Se agrego a tu tablero correctamente", "success");
          //alert('ok');
          location.reload();
        } else {
          //alert('no');
          swal("Error", "Ocurrio un error, intentalo más tarde", "error");
          document.querySelector('#loading').style.display = "none";
        }
      });
    }
  },
  micuentaActive: function micuentaActive(e) {
    e.preventDefault();
    var seccion = e.target.parentNode.getAttribute('data-seccion');

    if (seccion == null) {
      if (e.target.getAttribute('href') != '#') {
        window.location.href = e.target.getAttribute('href');
      }

      return false;
    }

    $('.wrapper-tablero div.section').removeClass('active');
    $('.wrapper-tablero div.section[data-seccion=' + seccion + ']').addClass('active');

    if (seccion == 'favoritos') {
      $('.slide-cursos').slick("refresh");
    } //ul li


    $('.li-micuenta li').removeClass('active');
    e.target.parentNode.classList.add('active');
  },
  guardarFavoritos: function guardarFavoritos(e, section) {
    e.preventDefault();
    document.querySelector('#loading').style.display = "block";
    var data_crs = e.target.parentNode.getAttribute('data-crs');
    var seccion = section;

    if (data_crs) {
      var token = document.querySelector("input[name='_token']").value;
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "curso": data_crs,
          "_token": token,
          "seccion": seccion
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/usuario/favorito', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          //swal("OK", "Se agrego el "+seccion+" a favoritos", "success");
          //alert('ok');
          document.querySelector('#loading').style.display = "none";
          document.querySelector('#shadow-exito').style.display = "block";
          document.querySelector('.favorito').remove();
        } else {
          //alert('no');
          swal("Error", "Ocurrio un error, intentalo más tarde", "error");
          document.querySelector('#loading').style.display = "none";
        }
      });
    }
  },
  filtrosCursos: function filtrosCursos(e) {
    e.preventDefault();
    e.stopPropagation(); //Recargar el Slider

    $('.slide-cursos, .slide-extra').slick("refresh");
    var cat = document.querySelectorAll(".row-yellow");
    var div = document.querySelectorAll(".div-item");
    cat.forEach(function (item) {
      item.style.display = "none";
    });
    div.forEach(function (item) {
      item.style.display = "none";
    });
    var categoria = e.target.getAttribute('data-cat');
    var subcategoria = e.target.getAttribute('class');
    document.querySelector(".row-yellow." + categoria).style.display = "block";

    if (categoria == subcategoria) {
      document.querySelectorAll("div." + categoria).forEach(function (item) {
        item.style.display = "block";
      });
      return false;
    }

    document.querySelector("div." + subcategoria + "." + categoria).style.display = "block";
  },
  validarRegistro: function validarRegistro(e) {
    e.preventDefault();
    e.stopPropagation();
    var nombre = document.querySelector("input[name='nombre']"),
        apaterno = document.querySelector("input[name='apaterno']"),
        amaterno = document.querySelector("input[name='amaterno']"),
        fecha_nacimiento = document.querySelector("input[name='fecha_nacimiento']"),
        email = document.querySelector("input[name='email']"),
        password = document.querySelector("input[name='password']"),
        password_confirm = document.querySelector("input[name='password_confirmation']"),
        validate = true;

    if (document.querySelectorAll(".campo-requerido")) {
      document.querySelectorAll('.campo-requerido').forEach(function (item) {
        item.classList.remove('campo-requerido');
      });
    }

    if (nombre.value == '') {
      nombre.classList.add('campo-requerido');
      validate = false;
    }

    if (apaterno.value == '') {
      apaterno.classList.add('campo-requerido');
      validate = false;
    }

    if (amaterno.value == '') {
      amaterno.classList.add('campo-requerido');
      validate = false;
    }

    if (email.value == '') {
      email.classList.add('campo-requerido');
      validate = false;
    }

    if (!funciones.validarEmail(email.value)) {
      email.classList.add('campo-requerido');
      validate = false;
    }

    if (password.value == '') {
      password.classList.add('campo-requerido');
      validate = false;
    }

    if (password.value.length < 8) {
      password.classList.add('campo-requerido');
      validate = false;
    }

    if (password.value !== password_confirm.value) {
      password.classList.add('campo-requerido');
    }

    if (validate == false) {
      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector("form[name='form_registro']").submit();
      return false;
    }
  },
  validarLogin: function validarLogin(e) {
    e.preventDefault();
    e.stopPropagation();
    var email = document.querySelector("input[name='email']"),
        password = document.querySelector("input[name='password']"),
        validate = true;

    if (email.value == '') {
      email.classList.add('campo-requerido');
      validate = false;
    }

    if (!funciones.validarEmail(email.value)) {
      email.classList.add('campo-requerido');
      validate = false;
    }

    if (password.value == '') {
      password.classList.add('campo-requerido');
      validate = false;
    }

    if (password.value.length < 8) {
      password.classList.add('campo-requerido');
      validate = false;
    }

    if (validate == false) {
      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector("form[name='form_login']").submit();
      return false;
    }
  },
  validarEmail: function validarEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
  }
};
exports.funciones = funciones;

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!******************************************************************!*\
  !*** multi ./resources/js/site/app.js ./resources/sass/app.scss ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Applications/MAMP/htdocs/maptveduca/resources/js/site/app.js */"./resources/js/site/app.js");
module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/maptveduca/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });