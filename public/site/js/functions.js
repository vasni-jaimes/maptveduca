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
  validarRegistro: function validarRegistro(e) {
    e.preventDefault();
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