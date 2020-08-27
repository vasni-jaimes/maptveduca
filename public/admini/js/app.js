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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/app.js":
/*!***********************************!*\
  !*** ./resources/js/admin/app.js ***!
  \***********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./functions.js */ "./resources/js/admin/functions.js");
/* harmony import */ var _functions_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_functions_js__WEBPACK_IMPORTED_MODULE_0__);
 //FORMULARIO PARA AGREGAR UN CURSO Y ACTUALIZAR

var frmAgregarCurso = document.querySelector("form[name='frm-agregar_curso']");
var frmActualizarCurso = document.querySelector("form[name='frm-actualizar_curso']");

if (frmAgregarCurso || frmActualizarCurso) {
  var bottonAdd = document.querySelector(".add-clone_videos");

  if (bottonAdd) {
    bottonAdd.addEventListener('click', function (e) {
      e.preventDefault();
      var contador = document.querySelectorAll('.clone-videos').length - 1;
      var htmlVideo = _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].htmlVideoCurso(contador);
      document.querySelector('.container-videos_curso').insertAdjacentHTML('beforeend', htmlVideo);
    });
  }

  var bottonRemove = document.querySelector(".remove-clone_videos");

  if (bottonRemove) {
    bottonRemove.addEventListener('click', function (e) {
      e.preventDefault();
      var container = document.querySelector('.container-videos_curso');
      container.lastElementChild.remove();
    });
  } //CHECK DEL CURSO EXTRA Y ESCONDER SELECT DE CARRERAS


  var curso_extra = document.querySelector('input[name="curso_extra"]');

  if (curso_extra) {
    $('input').on('ifChanged', function (event) {
      if ($(this).is(':checked')) {
        $("select[name='select_carreras[]']").parents(".form-group").css("display", "none");
      } else {
        $("select[name='select_carreras[]']").parents(".form-group").css("display", "flex");
      }
    });
  } //ELIMINAR ARCHIVO DE CURSO EXTRA EN UPDATE


  if (frmActualizarCurso) {
    var eliminar_archivo = document.querySelectorAll(".eliminar_archivo");
    eliminar_archivo.forEach(function (item) {
      item.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].elimiarArchivoUpdateCurso);
    });
  }

  if (frmAgregarCurso) {
    frmAgregarCurso.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
    frmAgregarCurso.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
  }

  if (frmActualizarCurso) {
    frmActualizarCurso.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
    frmActualizarCurso.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso);
  }
}

var frmAgregarClase = document.querySelector("form[name='frm-agregar_clase']");

if (frmAgregarClase) {
  var select_sesiones = document.querySelector("select[name='select_sesiones']");

  if (select_sesiones) {
    select_sesiones.addEventListener('change', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].agregarSessionesClase);
  }

  if (frmAgregarClase) {
    frmAgregarClase.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
    frmAgregarClase.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
  }
}

/***/ }),

/***/ "./resources/js/admin/functions.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/functions.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)
var funciones = {
  validarAgregarClase: function validarAgregarClase(e) {
    e.preventDefault();
    /* 	PRIMER PASO DEL REGISTRO */

    var nombre_curso = document.querySelector("input[name='nombre_clase']"),
        img_curso = document.querySelector("input[name='img_clase']"),
        instructores = document.querySelector("select[name='select_instructores[]']"),
        categorias = document.querySelector("select[name='select_categorias[]']"),
        curso_extra = document.querySelector("input[name='curso_extra']"),
        select_carreras = document.querySelector("select[name='select_carreras[]']"),
        select_categorias = document.querySelector("select[name='select_categorias[]']"),

    /* BIENVENIDA A LA CLASE */
    video_bienvenida = document.querySelector("input[name='video_bienvenida']"),
        descripcion = document.querySelector("textarea[name='descripcion']"),
        select_sesiones = document.querySelector("select[name='select_sesiones']"),

    /* AGREGAR SESSIONES */
    url_zoom = document.querySelectorAll("input[name='url_zoom[]']"),
        id_reunion = document.querySelectorAll("input[name='id_reunion[]']"),
        codigo_acceso = document.querySelectorAll("input[name='codigo_acceso[]']"),
        fecha_inicio = document.querySelectorAll("input[name='fecha_inicio[]']"),
        hora_inicio = document.querySelectorAll("input[name='hora_inicio[]']"),

    /* STATUS */
    error_videos = false;
    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    }

    if (nombre_curso.value == '') {
      nombre_curso.parentNode.classList.add('has-error');
      nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (e.target.getAttribute('name') == 'frm-agregar_clase') {
      if (img_curso.value == '') {
        img_curso.parentNode.classList.add('has-error');
        img_curso.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true;
      }
    }

    if (instructores.value == '' || instructores.value == null || instructores.value == undefined) {
      instructores.parentNode.classList.add('has-error');
      instructores.parentNode.children[1].firstChild.style.borderColor = "red";
      instructores.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (categorias.value == '' || categorias.value == null || categorias.value == undefined) {
      categorias.parentNode.classList.add('has-error');
      categorias.parentNode.children[1].firstChild.style.borderColor = "red";
      categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (video_bienvenida.value == '') {
      video_bienvenida.parentNode.classList.add('has-error');
      video_bienvenida.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (descripcion.value == '') {
      descripcion.parentNode.classList.add('has-error');
      descripcion.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (select_sesiones.value == '') {
      select_sesiones.parentNode.classList.add('has-error');
      select_sesiones.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    } // SESSIONES ZOOM


    url_zoom.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    });
    id_reunion.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    });
    codigo_acceso.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    });
    fecha_inicio.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    });
    hora_inicio.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    });

    if (error_videos == true) {
      if (e.type == 'submit') {
        window.scrollTo(0, document.querySelectorAll(".has-error")[0].offsetTop);
      }

      return false;
    }

    return false;
  },
  agregarSessionesClase: function agregarSessionesClase(e) {
    var numeroSesiones = e.target.value;
    var htmlSessiones = "";
    var numeroClones = document.querySelectorAll(".clone-horarios_sesion").length;
    var conteo = numeroSesiones > numeroClones ? numeroSesiones - numeroClones : numeroClones - numeroSesiones;

    for (var i = 1; i <= conteo; i++) {
      htmlSessiones += '<div class="clone-horarios_sesion">' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">URL Zoom: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="url_zoom[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">ID de Reunión: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="id_reunion[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Codigo de acceso: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="codigo_acceso[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Fecha de Lanzamiento: </label>' + '<div class="col-sm-2">' + '<input class="form-control datepicker" name="fecha_inicio[]" data-date-format="yyyy-mm-dd">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '<label class="pt-2 font-weight-bold"> : </label>' + '<div class="col-sm-2 clockpicker" data-autoclose="true">' + '<input class="form-control" name="hora_inicio[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '</div>' + '<div class="hr-line-dashed"></div>';
    }

    document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
  },
  elimiarArchivoUpdateCurso: function elimiarArchivoUpdateCurso(e) {
    e.preventDefault();
    e.target.disabled = true;
    var token = document.querySelector("input[name='_token']").value,
        documento = e.target.getAttribute('data-metadata');
    var opciones = {
      method: "POST",
      credentials: "same-origin",
      body: JSON.stringify({
        "documento": documento,
        "_token": token
      }),
      headers: {
        "Content-Type": "application/json"
      }
    };
    fetch("/admin/eliminar-archivo", opciones).then(function (response) {
      return response.json();
    }).then(function (res) {
      if (res.message == 'ok') {
        e.target.parentElement.parentElement.remove();
        alert('Se elimino el archivo correctamente');
      } else if (res.message == 'no_parameters') {
        alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
        e.removeAttribute('disabled');
      } else if (res.message == 'no_delete') {
        alert('Ocurrio un problema al intentar borrar el archivo, intentelo más tarde');
        e.removeAttribute('disabled');
      }
    });
  },
  validacionAgregarCurso: function validacionAgregarCurso(e) {
    e.preventDefault();
    e.stopPropagation();
    /* 	PRIMER PASO DEL REGISTRO */

    var nombre_curso = document.querySelector("input[name='nombre_curso']"),
        img_curso = document.querySelector("input[name='img_curso']"),
        instructores = document.querySelector("select[name='select_instructores[]']"),
        categorias = document.querySelector("select[name='select_categorias[]']"),
        curso_extra = document.querySelector("input[name='curso_extra']"),
        select_carreras = document.querySelector("select[name='select_carreras[]']"),
        select_categorias = document.querySelector("select[name='select_categorias[]']"),

    /* BIENVENIDA AL CURSO */
    video_bienvenida = document.querySelector("input[name='video_bienvenida']"),
        descripcion = document.querySelector("textarea[name='descripcion']"),

    /* TEMARIO */
    nombres_cursos = document.querySelectorAll("input[name='nombre_video[]']"),
        videos_url = document.querySelectorAll("input[name='video_url[]']"),
        descripcion_curso = document.querySelectorAll("textarea[name='descripcion_curso[]']"),

    /* STATUS */
    error_videos = false;
    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    }

    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (nombre_curso.value == '') {
      nombre_curso.parentNode.classList.add('has-error');
      nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (e.target.getAttribute('name') == 'frm-agregar_curso') {
      if (img_curso.value == '') {
        img_curso.parentNode.classList.add('has-error');
        img_curso.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true;
      }
    }

    if (instructores.value == '' || instructores.value == null || instructores.value == undefined) {
      instructores.parentNode.classList.add('has-error');
      instructores.parentNode.children[1].firstChild.style.borderColor = "red";
      instructores.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (categorias.value == '' || categorias.value == null || categorias.value == undefined) {
      categorias.parentNode.classList.add('has-error');
      categorias.parentNode.children[1].firstChild.style.borderColor = "red";
      categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (curso_extra.checked == false) {
      if (select_carreras.value == '') {
        select_carreras.parentNode.classList.add('has-error');
        select_carreras.parentNode.children[1].firstChild.style.borderColor = "red";
        select_carreras.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true;
      }
    }

    if (select_categorias.value == '') {
      select_categorias.parentNode.classList.add('has-error');
      select_categorias.parentNode.children[1].firstChild.style.borderColor = "red";
      select_categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (video_bienvenida.value == '') {
      video_bienvenida.parentNode.classList.add('has-error');
      video_bienvenida.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (descripcion.value == '') {
      descripcion.parentNode.classList.add('has-error');
      descripcion.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    } // Validar nombre y videos URL


    nombres_cursos.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    }); // Validar nombre y videos URL

    videos_url.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    }); // Validar nombre y videos URL

    descripcion_curso.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    });

    if (error_videos == true) {
      if (e.type == 'submit') {
        window.scrollTo(0, document.querySelectorAll(".has-error")[0].offsetTop);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');

      if (e.target.getAttribute('name') == 'frm-agregar_curso') {
        document.querySelector("form[name='frm-agregar_curso']").submit();
        return false;
      }

      document.querySelector("form[name='frm-actualizar_curso']").submit();
    }
  },
  validarEmail: function validarEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
  },
  htmlVideoCurso: function htmlVideoCurso(contador) {
    contador++;
    return '<div class="clone-videos">' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Nombre del video: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="nombre_video[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Video url: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="video_url[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Descripcion: </label>' + '<div class="col-sm-10">' + '<textarea class="form-control" name="descripcion_curso[]" rows="3"></textarea>' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row mb-5">' + '<label class="col-sm-2 col-form-label">Material Extra: </label>' + '<div class="col-sm-10">' + '<input id="logo" type="file" name="material_extra[' + contador + '][]" multiple class="form-control" accept="jpg,jpeg,png">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '</div>';
  }
};
exports.funciones = funciones;

/***/ }),

/***/ 2:
/*!*****************************************!*\
  !*** multi ./resources/js/admin/app.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Applications/MAMP/htdocs/maptveduca/resources/js/admin/app.js */"./resources/js/admin/app.js");


/***/ })

/******/ });