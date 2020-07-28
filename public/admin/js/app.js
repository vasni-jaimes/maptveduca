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

var frmAgregarCurso = document.querySelector("form[name='frm-agregar_curso']"); //const frmActualizarCurso = document.querySelector("form[name='frm-actualizar_curso']");

if (frmAgregarCurso) {
  var bottonAdd = document.querySelector(".add-clone_videos");

  if (bottonAdd) {
    bottonAdd.addEventListener('click', function (e) {
      e.preventDefault();
      var htmlVideo = _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].htmlVideoCurso();
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
  } // const eliminarArchivo = document.querySelectorAll(".eliminar_archivo");
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

/***/ }),

/***/ "./resources/js/admin/functions.js":
/*!*****************************************!*\
  !*** ./resources/js/admin/functions.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)
var funciones = {
  // validacionAgregarCurso: function(e) {
  // 	e.preventDefault();
  // 	e.stopPropagation();
  // 	let nombre_curso = document.querySelector("input[name='nombre_curso']"),
  // 		precio = document.querySelector("input[name='precio']"),
  // 		precio_regular = document.querySelector("input[name='precio_regular']"),
  // 		duracion = document.querySelector("input[name='duracion']"),
  // 		objetivo = document.querySelector("textarea[name='objetivo']"),
  // 		dirigido = document.querySelector("textarea[name='dirigido']"),
  // 		instructores = document.querySelector("select[name='select_instructores[]']"),
  // 		categorias = document.querySelector("select[name='select_categorias[]']"),
  // 		fecha_lanzamiento = document.querySelectorAll("input[name='fecha_lanzamiento[]']"),
  // 		hora_lanzamiento = document.querySelectorAll("input[name='hora_lanzamiento[]']"),
  // 		fecha_termino = document.querySelectorAll("input[name='fecha_termino[]']"),
  // 		hora_termino = document.querySelectorAll("input[name='hora_termino[]']"),
  // 		brunch_inicio = document.querySelectorAll("input[name='brunch_inicio[]']"),
  // 		lunch_inicio = document.querySelectorAll("input[name='lunch_inicio[]']"),
  // 		nombres_cursos = document.querySelectorAll("input[name='nombre_video[]']"),
  // 		videos_url = document.querySelectorAll("input[name='video_url[]']"),
  // 		error_videos = false;
  // 	document.querySelectorAll('.errors').forEach(function(item) {
  // 		item.innerHTML = '';
  // 	});
  // 	if (document.querySelector('.has-error')) {
  // 		document.querySelectorAll('.has-error').forEach((item) => {
  // 			item.classList.remove('has-error');
  // 		});
  // 	}
  // 	if (document.querySelector('.is-invalid')) {
  // 		document.querySelector('.is-invalid').classList.remove('is-invalid');
  // 	}
  // 	if (nombre_curso.value == '') {
  // 		nombre_curso.parentNode.classList.add('has-error');
  // 		nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (precio.value == '') {
  // 		precio.parentNode.classList.add('has-error');
  // 		precio.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (precio_regular.value == '') {
  // 		precio_regular.parentNode.classList.add('has-error');
  // 		precio_regular.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (duracion.value == '') {
  // 		duracion.parentNode.classList.add('has-error');
  // 		duracion.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (objetivo.value == '') {
  // 		objetivo.parentNode.classList.add('has-error');
  // 		objetivo.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (dirigido.value == '') {
  // 		dirigido.parentNode.classList.add('has-error');
  // 		dirigido.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (instructores.value == '' || instructores.value == null || instructores.value == undefined) {
  // 		instructores.parentNode.classList.add('has-error');
  // 		instructores.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	if (categorias.value == '' || categorias.value == null || categorias.value == undefined) {
  // 		categorias.parentNode.classList.add('has-error');
  // 		categorias.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		error_videos = true;
  // 	}
  // 	// Validar Horarios
  // 	fecha_lanzamiento.forEach((item, index) => {
  // 		if (item.value == '') {
  // 			error_videos = true;
  // 			item.parentNode.classList.add('has-error');
  // 			item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		}
  // 	});
  // 	// Validar Horarios
  // 	hora_lanzamiento.forEach((item, index) => {
  // 		if (item.value == '') {
  // 			error_videos = true;
  // 			item.parentNode.classList.add('has-error');
  // 			item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		}
  // 	});
  // 	// Validar Horarios
  // 	fecha_termino.forEach((item, index) => {
  // 		if (item.value == '') {
  // 			error_videos = true;
  // 			item.parentNode.classList.add('has-error');
  // 			item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		}
  // 	});
  // 	// Validar Horarios
  // 	hora_termino.forEach((item, index) => {
  // 		if (item.value == '') {
  // 			error_videos = true;
  // 			item.parentNode.classList.add('has-error');
  // 			item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		}
  // 	});
  // 	//Validar Brunch y Lunch
  // 	brunch_inicio.forEach((item, index) => {
  // 		var lado = document.querySelectorAll('input[name="brunch_fin[]"]');
  // 		if ((lado[index].value != '' && item.value == '') || (lado[index].value == '' && item.value != '')) {
  // 			if (item.value == '') {
  // 				error_videos = true;
  // 				item.parentNode.classList.add('has-error');
  // 				item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 			}
  // 			else {
  // 				error_videos = true;
  // 				lado[index].parentNode.classList.add('has-error');
  // 				lado[index].nextElementSibling.innerHTML = 'El campo es requerido';
  // 			}
  // 		}
  // 	});
  // 	//Validar Brunch y Lunch
  // 	lunch_inicio.forEach((item, index) => {
  // 		var lado = document.querySelectorAll('input[name="lunch_fin[]"]');
  // 		if ((lado[index].value != '' && item.value == '') || (lado[index].value == '' && item.value != '')) {
  // 			if (item.value == '') {
  // 				error_videos = true;
  // 				item.parentNode.classList.add('has-error');
  // 				item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 			}
  // 			else {
  // 				error_videos = true;
  // 				lado[index].parentNode.classList.add('has-error');
  // 				lado[index].nextElementSibling.innerHTML = 'El campo es requerido';
  // 			}
  // 		}
  // 	});
  // 	// Validar nombre y videos URL
  // 	nombres_cursos.forEach((item, index) => {
  // 		if (item.value == '') {
  // 			error_videos = true;
  // 			item.parentNode.classList.add('has-error');
  // 			item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		}
  // 	});
  // 	// Validar nombre y videos URL
  // 	videos_url.forEach((item, index) => {
  // 		if (item.value == '') {
  // 			error_videos = true;
  // 			item.parentNode.classList.add('has-error');
  // 			item.nextElementSibling.innerHTML = 'El campo es requerido';
  // 		}
  // 	});
  // 	if (error_videos == true) {
  // 		if (e.type == 'submit') {
  // 			window.scrollTo(0, document.querySelectorAll(".has-error")[0].offsetTop);
  // 		}
  // 		return false;
  // 	}
  // 	if (e.type == 'submit') {
  // 		e.target.disabled = true;
  //         document.querySelector('.ibox-content').classList.add('sk-loading');
  //         document.querySelector("form").submit();
  //     }
  // },
  validarEmail: function validarEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
  },
  htmlVideoCurso: function htmlVideoCurso() {
    return '<div class="clone-videos">' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Nombre del video: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="nombre_video[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Video url: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="video_url[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '</div>';
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