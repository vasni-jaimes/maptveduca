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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

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

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/site/functions.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/maptveduca/resources/js/site/functions.js */"./resources/js/site/functions.js");


/***/ })

/******/ });