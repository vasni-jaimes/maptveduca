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
  } //EVENTO PARA AGREGAR URL DE VIDEOS


  $(document).on('click', '.add-url_video', function (e) {
    e.preventDefault();
    var contador = $(".add-url_video").index($(this));
    var htmlVideo = _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].htmlAgregarVideo(contador);
    var padreVideoUrl = $(this).parent().next().next();
    padreVideoUrl.append(htmlVideo);
  }); //EVENTO PARA ELIMINAR URL DE VIDEOS

  var container_videourl = document.querySelectorAll(".remove-url_video");
  container_videourl.forEach(function (item) {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      e.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.remove();
      e.target.parentElement.nextElementSibling.nextElementSibling.firstElementChild.remove();
    });
  }); //EVENTO PARA OBTENER LAS SUBCATEGORIAS DEPENDIENDO DE LA CATEGORIA

  var select_categorias = document.querySelector("select[name=select_categorias]");

  if (select_categorias) {
    select_categorias.addEventListener('change', function (e) {
      e.preventDefault();
      _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].obtenerSubmenus(e);
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
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validacionAgregarCurso); //ELIMINAR ARCHIVO DE CURSO EXTRA EN UPDATE

    var eliminar_archivo = document.querySelectorAll(".eliminar_archivo");
    eliminar_archivo.forEach(function (item) {
      item.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].elimiarArchivoUpdateCurso);
    });
  }
} //FORMULARIO  CLASES


var frmAgregarClase = document.querySelector("form[name='frm-agregar_clase']");
var frmActualizarClase = document.querySelector("form[name='frm-editar_clase']");

if (frmAgregarClase || frmActualizarClase) {
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

  if (frmActualizarClase) {
    frmActualizarClase.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
    frmActualizarClase.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarClase);
  }
} //FORMULARIO EVENTOS


var frmAgregarEvento = document.querySelector("form[name='frm-agregar_evento']");
var frmEditarEvento = document.querySelector("form[name='frm-editar_evento']");

if (frmAgregarEvento || frmEditarEvento) {
  if (frmAgregarEvento) {
    frmAgregarEvento.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
    frmAgregarEvento.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
  }

  if (frmEditarEvento) {
    frmEditarEvento.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
    frmEditarEvento.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarEvento);
  } //EVENTO PARA EL TIPO DE EVENTOS
  // const select_tipo = document.querySelector("select[name='select_tipo']");
  // select_tipo.addEventListener('change', funciones.cambiarTipoEvento);

} //FORMULARIO INSTRUCTORES


var frmAgregarInstructor = document.querySelector("form[name='frm-agregar_instructor']");
var frmActualizarInstructor = document.querySelector("form[name='frm-editar_instructor']");

if (frmAgregarInstructor || frmActualizarInstructor) {
  if (frmAgregarInstructor) {
    frmAgregarInstructor.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
    frmAgregarInstructor.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
  }

  if (frmActualizarInstructor) {
    frmActualizarInstructor.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
    frmActualizarInstructor.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarInstructor);
  }
} //Cambiar status curso


var tabla_cursos = document.querySelector("table.tabla-cursos");

if (tabla_cursos) {
  var btn_activar = document.querySelectorAll(".btn-activar");

  if (btn_activar) {
    btn_activar.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status", e);
      });
    });
  }

  var btn_desactivar = document.querySelectorAll(".btn-desactivar");

  if (btn_desactivar) {
    btn_desactivar.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status", e);
      });
    });
  }
} //Cambiar status clase


var tabla_clases = document.querySelector("table.tabla-clases");

if (tabla_clases) {
  var _btn_activar = document.querySelectorAll(".btn-activar");

  if (_btn_activar) {
    _btn_activar.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-clase", e);
      });
    });
  }

  var _btn_desactivar = document.querySelectorAll(".btn-desactivar");

  if (_btn_desactivar) {
    _btn_desactivar.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-clase", e);
      });
    });
  }
} //Cambiar status eventos


var tabla_eventos = document.querySelector("table.tabla-eventos");

if (tabla_eventos) {
  var _btn_activar2 = document.querySelectorAll(".btn-activar");

  if (_btn_activar2) {
    _btn_activar2.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-evento", e);
      });
    });
  }

  var _btn_desactivar2 = document.querySelectorAll(".btn-desactivar");

  if (_btn_desactivar2) {
    _btn_desactivar2.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-evento", e);
      });
    });
  }
} //Cambiar status instructores


var tabla_instructores = document.querySelector("table.tabla-instructores");

if (tabla_instructores) {
  var _btn_activar3 = document.querySelectorAll(".btn-activar");

  if (_btn_activar3) {
    _btn_activar3.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-instructor", e);
      });
    });
  }

  var _btn_desactivar3 = document.querySelectorAll(".btn-desactivar");

  if (_btn_desactivar3) {
    _btn_desactivar3.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-instructor", e);
      });
    });
  }
} //VALIDAR QUE EL PRECIO SOLO TENGA NUMEROS


var precio = document.querySelector('input[name="precio"]');

if (precio) {
  precio.addEventListener('input', function (e) {
    e.target.value = _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].format(e.target.value);
  });
} //CAMBIAR LOS ALUMNOS POR CURSO


var curso = document.querySelector('select[name="select_cursos"]');

if (curso) {
  curso.addEventListener('change', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].obtenerAlumnosxCurso);
} //VALIDAR AL MOMENTO DE ENVIAR UN MENSAJE


var formSendMensajes = document.querySelector('form[name="frm-agregar_mensaje"]');

if (formSendMensajes) {
  formSendMensajes.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarMensajes);
  formSendMensajes.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarMensajes);
  $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarMensajes);
  $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarMensajes);
} //ELIMINAR PUBLICACION


var eliminar_public = document.querySelectorAll('.eliminar_public');

if (eliminar_public) {
  for (var i = 0; i <= eliminar_public.length - 1; i++) {
    eliminar_public[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].eliminarPublicacion);
  }
} //CLICK EN EDITAR PARA MOSTRAR FORMULARIO DE EDITAR


var editar_public = document.querySelectorAll('.editar_public');

if (editar_public) {
  for (var i = 0; i <= editar_public.length - 1; i++) {
    editar_public[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].desplegarFormularioEdit);
  }
} //EDITAR PUBLICACION


var editar_publicacion = document.querySelectorAll('.editar-publicacion button.editarp');

if (editar_publicacion) {
  for (var i = 0; i <= editar_publicacion.length - 1; i++) {
    editar_publicacion[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].editarPublicacion);
  }
} //CANCELAR EDICION


var cancelar_edicion = document.querySelectorAll('.cancelar-edicion');

if (cancelar_edicion) {
  for (var i = 0; i <= cancelar_edicion.length - 1; i++) {
    cancelar_edicion[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cancelarEdicion);
  }
} //EDITAR RESPUESTA PARA MOSTRAR FORMULARIO


var editar_resp = document.querySelectorAll('.editar_resp');

if (editar_resp) {
  for (var i = 0; i <= editar_resp.length - 1; i++) {
    editar_resp[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].mostrarFormularioResp);
  }
} //EDITAR RESPUESTA.


var editarr = document.querySelectorAll('.editarr');

if (editarr) {
  for (var i = 0; i <= editarr.length - 1; i++) {
    editarr[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].editarRespuesta);
  }
} //AGREGAR RESPUESTA.


var agregar_respuesta = document.querySelectorAll('.agregar-respuesta button');
var agregar_nuevo_post = document.querySelector('.agregar-nuevo_post button');

if (agregar_respuesta) {
  for (var i = 0; i <= agregar_respuesta.length - 1; i++) {
    agregar_respuesta[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].agregarRespuesta);
  }
}

if (agregar_nuevo_post) {
  agregar_nuevo_post.addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].agregarRespuesta);
} //BOOTN GUARDAR CALIFICACIONES


var frm_agregar_calificaciones = document.querySelector('form[name="frm-agregar_calificaciones"] button');

if (frm_agregar_calificaciones) {
  frm_agregar_calificaciones.addEventListener('click', function (e) {
    e.preventDefault();
    e.target.disabled = true;
    document.querySelector('.ibox-content').classList.add('sk-loading');
    document.querySelector("form[name='frm-agregar_calificaciones']").submit();
    return false;
  });
} //Eliminar archivo


var delete_filex = document.querySelectorAll('.delete-filex');

if (delete_filex) {
  for (var i = 0; i <= delete_filex.length - 1; i++) {
    delete_filex[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].alertConfirmDelete);
  }
} //Eliminar archivo de respuesta


var delete_resp_filex = document.querySelectorAll('.delete-resp_filex');

if (delete_resp_filex) {
  for (var i = 0; i <= delete_resp_filex.length - 1; i++) {
    delete_resp_filex[i].addEventListener('click', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].alertConfirmDeleteResp);
  }
} //FORMULARIO USUARIO


var frmAgregarUsuario = document.querySelector("form[name='frm-agregar_usuario']");
var frmActualizarUsuario = document.querySelector("form[name='frm-editar_usuario']");

if (frmAgregarUsuario || frmActualizarUsuario) {
  if (frmAgregarUsuario) {
    frmAgregarUsuario.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
    frmAgregarUsuario.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
  }

  if (frmActualizarUsuario) {
    frmActualizarUsuario.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
    frmActualizarUsuario.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarUsuario);
  }
} //CHECK USUARIOS CON SUSCRIPCION


var suscripcion = document.querySelector('input[name="suscripcion"]');

if (suscripcion) {
  $('input[name="suscripcion"]').on('ifChanged', function (event) {
    if ($(this).is(':checked')) {
      $("select[name='select_carreras']").parents(".form-group").css("display", "flex");
    } else {
      $("select[name='select_carreras']").parents(".form-group").css("display", "none");
    }
  });
} //Cambiar status curso


var tabla_usuarios = document.querySelector("table.tabla-usuarios");

if (tabla_usuarios) {
  var _btn_activar4 = document.querySelectorAll(".btn-activar");

  if (_btn_activar4) {
    _btn_activar4.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-user", e);
      });
    });
  }

  var _btn_desactivar4 = document.querySelectorAll(".btn-desactivar");

  if (_btn_desactivar4) {
    _btn_desactivar4.forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].cambiarStatus("/admin/cambiar-status-user", e);
      });
    });
  }
} //FORMULARIO GRUPOS


var frmAgregarGrupo = document.querySelector("form[name='frm-agregar_grupo']");
var frmActualizarGrupo = document.querySelector("form[name='frm-editar_grupo']");

if (frmAgregarGrupo || frmActualizarGrupo) {
  if (frmAgregarGrupo) {
    frmAgregarGrupo.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
    frmAgregarGrupo.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
  }

  if (frmActualizarGrupo) {
    frmActualizarGrupo.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
    frmActualizarGrupo.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
    $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
    $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarAgregarGrupo);
  }
} //STATUS DE INSCRIPCION


var activa_programa = $('input[name="status"]');

if (activa_programa) {
  activa_programa.on('ifChecked', function (event) {
    if ($(this).val() == 3) {
      $('.activa_programa').css('display', 'block');
      $('.div-grupos').css('display', 'flex');
    } else if ($(this).val() == 1) {
      $('.div-grupos').css('display', 'flex');
      $('.activa_programa').css('display', 'none');
    } else {
      $('.div-grupos').css('display', 'none');
      $('.activa_programa').css('display', 'none');
    }
  });
} //FORMULARIO FECHAS


var frmAgregarFecha = document.querySelector("form[name='frm-agregar_fecha']");

if (frmAgregarFecha) {
  frmAgregarFecha.addEventListener('submit', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarFechasContenido);
  frmAgregarFecha.addEventListener('input', _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarFechasContenido);
  $(document).change("input", _functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarFechasContenido);
  $("select").change(_functions_js__WEBPACK_IMPORTED_MODULE_0__["funciones"].validarFechasContenido);
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
  validarFechasContenido: function validarFechasContenido(e) {
    e.preventDefault();
    var inicio_trimestre = document.querySelector("input[name='inicio_trimestre']");
    /* STATUS */

    var error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });
    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (inicio_trimestre.value == '') {
      inicio_trimestre.parentNode.classList.add('has-error');
      inicio_trimestre.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (error_videos == true) {
      if (e.type == 'submit') {
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');
      document.querySelector("form[name='frm-agregar_fecha']").submit();
      return false;
    }
  },
  validarAgregarGrupo: function validarAgregarGrupo(e) {
    e.preventDefault();
    var nombre_grupo = document.querySelector("input[name='nombre_grupo']");
    /* STATUS */

    var error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });
    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (nombre_grupo.value == '') {
      nombre_grupo.parentNode.classList.add('has-error');
      nombre_grupo.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (error_videos == true) {
      if (e.type == 'submit') {
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');

      if (e.target.getAttribute('name') == 'frm-agregar_grupo') {
        document.querySelector("form[name='frm-agregar_grupo']").submit();
        return false;
      }

      document.querySelector("form[name='frm-editar_grupo']").submit();
      return false;
    }
  },
  validarAgregarUsuario: function validarAgregarUsuario(e) {
    e.preventDefault();
    var nombre = document.querySelector("input[name='nombre']");
    var amaterno = document.querySelector("input[name='amaterno']");
    var apaterno = document.querySelector("input[name='apaterno']");
    var email = document.querySelector("input[name='email']");
    var fecha_nacimineto = document.querySelector("input[name='fecha_nacimineto']");
    var password = document.querySelector("input[name='password']");
    var password_confirm = document.querySelector("input[name='password_confirmation']");
    /* STATUS */

    var error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });
    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (nombre.value == '') {
      nombre.parentNode.classList.add('has-error');
      nombre.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (amaterno.value == '') {
      amaterno.parentNode.classList.add('has-error');
      amaterno.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (apaterno.value == '') {
      apaterno.parentNode.classList.add('has-error');
      apaterno.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (email.value == '') {
      email.parentNode.classList.add('has-error');
      email.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (!funciones.validarEmail(email.value)) {
      email.parentNode.classList.add('has-error');
      email.nextElementSibling.innerHTML = 'El email no es valido';
      error_videos = true;
    }

    if (fecha_nacimineto.value == '') {
      fecha_nacimineto.parentNode.classList.add('has-error');
      fecha_nacimineto.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (e.target.getAttribute('name') == 'frm-agregar_usuario') {
      if (password.value == '') {
        password.parentNode.classList.add('has-error');
        password.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true; // password.classList.add('campo-requerido');
        // validate = false;
      }

      if (password.value.length < 8) {
        password.parentNode.classList.add('has-error');
        password.nextElementSibling.innerHTML = 'El campo debe tener un minimo de 8 caracteres';
        error_videos = true; // password.classList.add('campo-requerido');
        // validate = false;			
      }

      if (password.value !== password_confirm.value) {
        password_confirm.parentNode.classList.add('has-error');
        password_confirm.nextElementSibling.innerHTML = 'Los passwords no coinciden';
        error_videos = true; // password.classList.add('campo-requerido')
        // validate = false;
      }
    }

    if (e.target.getAttribute('name') == 'frm-editar_usuario') {
      if (password.value != '') {
        if (password.value.length < 8) {
          password.parentNode.classList.add('has-error');
          password.nextElementSibling.innerHTML = 'El campo debe tener un minimo de 8 caracteres';
          error_videos = true; // password.classList.add('campo-requerido');
          // validate = false;			
        }
      }
    }

    if (error_videos == true) {
      if (e.type == 'submit') {
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');

      if (e.target.getAttribute('name') == 'frm-agregar_usuario') {
        document.querySelector("form[name='frm-agregar_usuario']").submit();
        return false;
      }

      document.querySelector("form[name='frm-editar_usuario']").submit();
      return false;
    }
  },
  alertConfirmDeleteResp: function alertConfirmDeleteResp(e) {
    e.preventDefault();
    var respuesta = e.target.getAttribute('data-rsp');
    var file = e.target.getAttribute('data-file');
    var li = e.target.parentElement;
    swal({
      title: "¿Estas Segur@?",
      text: "¿Estas segur@ que quieres eliminar el archivo?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(function (willDelete) {
      if (willDelete) {
        var token = document.querySelector("input[name='_token']").value;
        var opciones = {
          method: "POST",
          credentials: "same-origin",
          body: JSON.stringify({
            "respuesta": respuesta,
            "archivo": file,
            "_token": token
          }),
          headers: {
            "Content-Type": "application/json"
          }
        };
        fetch('/admin/eliminar-archivo_resp', opciones).then(function (response) {
          return response.json();
        }).then(function (res) {
          if (res.message == 'ok') {
            li.remove();
            swal("Se Elimino el archivo correctamente", {
              icon: "success"
            });
          } else {
            swal("Ocurrio un error, intentelo más tarde", {
              icon: "error"
            });
          }
        })["catch"](function (error) {
          swal("Ocurrio un error, intentelo más tarde", {
            icon: "error"
          });
        });
      } else {
        swal("Se cancelo la eliminacion");
      }
    });
  },
  alertConfirmDelete: function alertConfirmDelete(e) {
    e.preventDefault();
    var publicacion = e.target.getAttribute('data-pub');
    var file = e.target.getAttribute('data-file');
    var li = e.target.parentElement;
    swal({
      title: "¿Estas Segur@?",
      text: "¿Estas segur@ que quieres eliminar el archivo?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(function (willDelete) {
      if (willDelete) {
        var token = document.querySelector("input[name='_token']").value;
        var opciones = {
          method: "POST",
          credentials: "same-origin",
          body: JSON.stringify({
            "publicacion": publicacion,
            "archivo": file,
            "_token": token
          }),
          headers: {
            "Content-Type": "application/json"
          }
        };
        fetch('/admin/eliminar-archivo', opciones).then(function (response) {
          return response.json();
        }).then(function (res) {
          if (res.message == 'ok') {
            li.remove();
            swal("Se Elimino el archivo correctamente", {
              icon: "success"
            });
          } else {
            swal("Ocurrio un error, intentelo más tarde", {
              icon: "error"
            });
          }
        })["catch"](function (error) {
          swal("Ocurrio un error, intentelo más tarde", {
            icon: "error"
          });
        });
      } else {
        swal("Se cancelo la eliminacion");
      }
    });
  },
  agregarRespuesta: function agregarRespuesta(e) {
    e.preventDefault();
    var modal = document.querySelectorAll('.ibox-content');

    for (var i = 0; i <= modal.length - 1; i++) {
      modal[i].classList.add('sk-loading');
    }

    e.target.parentElement.submit();
  },
  editarRespuesta: function editarRespuesta(e) {
    e.preventDefault();
    var modal = document.querySelectorAll('.ibox-content');

    for (var i = 0; i <= modal.length - 1; i++) {
      modal[i].classList.add('sk-loading');
    }

    e.target.parentElement.submit();
  },
  mostrarFormularioResp: function mostrarFormularioResp(e) {
    e.preventDefault();
    var resp = e.target.getAttribute('data-resp');
    document.querySelector('.editar-respuesta[data-resp="' + resp + '"]').style.display = "block";
  },
  cancelarEdicion: function cancelarEdicion(e) {
    e.preventDefault();
    e.target.parentElement.parentElement.parentElement.style.display = "none";
    return false;
  },
  desplegarFormularioEdit: function desplegarFormularioEdit(e) {
    e.preventDefault();
    var pub = e.target.getAttribute('data-pub');
    document.querySelector('.editar-publicacion[data-pub="' + pub + '"]').style.display = "block";
  },
  editarPublicacion: function editarPublicacion(e) {
    e.preventDefault();
    var modal = document.querySelectorAll('.ibox-content');

    for (var i = 0; i <= modal.length - 1; i++) {
      modal[i].classList.add('sk-loading');
    }

    e.target.parentElement.submit();
  },
  eliminarPublicacion: function eliminarPublicacion(e) {
    e.preventDefault();
    var modal = document.querySelectorAll('.ibox-content');

    for (var i = 0; i <= modal.length - 1; i++) {
      modal[i].classList.add('sk-loading');
    } //quitar division de eliminar y editar


    e.target.parentElement.parentElement.parentElement.classList.remove('show');
    e.target.parentElement.parentElement.parentElement.parentElement.classList.remove('show'); //generar evento submit

    e.target.parentElement.submit();
  },
  validarMensajes: function validarMensajes(e) {
    e.preventDefault();
    mensaje = document.querySelector('textarea[name="mensaje"]');
    /* STATUS */

    var error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (mensaje.value == '') {
      mensaje.parentNode.classList.add('has-error');
      mensaje.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (error_videos == true) {
      if (e.type == 'submit') {
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');
      document.querySelector("form[name='frm-agregar_mensaje']").submit();
      return false;
    }
  },
  obtenerAlumnosxCurso: function obtenerAlumnosxCurso(e) {
    e.preventDefault();
    var curso_id = e.target.value;
    var token = document.querySelector("input[name='_token']").value;

    if (curso_id) {
      var opciones = {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
          "curso_id": curso_id,
          "_token": token
        }),
        headers: {
          "Content-Type": "application/json"
        }
      };
      fetch('/admin/buscar-alumnos', opciones).then(function (response) {
        return response.json();
      }).then(function (res) {
        if (res.message == 'ok') {
          var options = '<select data-placeholder="Usuarios" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_usuarios[]">';
          res.items.forEach(function (item) {
            options += "<option value=" + item.id + ">" + item.nombre + ' ' + item.apaterno + ' ' + item.amaterno + "</option>";
          });
          options += "</select>";
          document.querySelector('.sub-usuarios').innerHTML = options;
          $('.chosen-select').chosen({
            width: "100%"
          });
          $('.custom-file-input').on('change', function () {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
          });
        } else {
          swal("Error", "Ocurrio un error, intentalo más tarde", "error");
        }
      });
    }
  },
  format: function format(num) {
    var str = num.toString().replace("$", ""),
        parts = false,
        output = [],
        i = 1,
        formatted = null;

    if (str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }

    str = str.split("").reverse();

    for (var j = 0, len = str.length; j < len; j++) {
      if (str[j] != ",") {
        output.push(str[j]);

        if (i % 3 == 0 && j < len - 1) {
          output.push(",");
        }

        i++;
      }
    }

    formatted = output.reverse().join("");
    return formatted + (parts ? "." + parts[1].substr(0, 2) : ""); //return("$" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
  },
  cambiarTipoEvento: function cambiarTipoEvento(e) {
    e.preventDefault();
    var tipo_event = e.target.value;

    if (tipo_event == 1) {
      document.querySelector(".eventos_one").style.display = "block";
      document.querySelector(".eventos_two").style.display = "none";
      return false;
    }

    if (tipo_event == 2) {
      document.querySelector(".eventos_one").style.display = "none";
      document.querySelector(".eventos_two").style.display = "block";
      return false;
    }
  },
  obtenerSubmenus: function obtenerSubmenus(e) {
    e.preventDefault();
    var select_catego = e.target.value;
    var token = document.querySelector("input[name='_token']").value;
    var opciones = {
      method: "POST",
      credentials: "same-origin",
      body: JSON.stringify({
        "categoria": select_catego,
        "_token": token
      }),
      headers: {
        "Content-Type": "application/json"
      }
    };
    fetch('/admin/obtenerSubcategorias', opciones).then(function (response) {
      return response.json();
    }).then(function (res) {
      if (res.message == 'ok') {
        var options = '<select data-placeholder="Subcategorias" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_subcategorias[]">';
        res.main.forEach(function (item) {
          options += "<option value=" + item.id + ">" + item.nombre + "</option>";
        });
        options += '</select>'; //$(".div-subcate").html(options);

        document.querySelector(".div-subcate").innerHTML = options;
        $('.chosen-select').chosen({
          width: "100%"
        });
        $('.custom-file-input').on('change', function () {
          var fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        document.querySelector("div.div-subcate select").parentNode.children[1].firstChild.style.borderColor = "red";
      } else {
        swal("Error", "Ocurrio un error, intentalo más tarde", "error");
      }
    });
  },
  cambiarStatus: function cambiarStatus(url, e) {
    //e.preventDefault();
    swal({
      title: "¿Estas seguro?",
      text: "¿Quieres cambiar el estatus?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(function (willDelete) {
      if (!willDelete) {
        return false;
      } else {
        e.target.disabled = true;
        var token = document.querySelector("input[name='_token']").value,
            status = e.target.getAttribute('data-st');
        id = e.target.getAttribute('data-id');
        var opciones = {
          method: "POST",
          credentials: "same-origin",
          body: JSON.stringify({
            "status": status,
            "_token": token,
            "id": id
          }),
          headers: {
            "Content-Type": "application/json"
          }
        };
        fetch(url, opciones).then(function (response) {
          return response.json();
        }).then(function (res) {
          if (res.message == 'ok') {
            var span = status == 1 ? "<span class='float-center label label-primary'>Activo</span>" : "<span style='cursor:pointer' class='float-center label label-danger'>Inactivo</span>";
            var btn = status == 0 ? '<a href="#" data-id="' + id + '" data-st="1" class="btn-primary btn btn-xs btn-activar">Activar</a>' : '<a href = "#" class="btn-danger btn btn-xs btn-desactivar" data-id="' + id + '" data-st="0">Desactivar</a>';
            var td = e.target.parentElement; // ELIMINAR SPAN DE STATUS EN EL LISTADO Y AGREGAR EL NUEVO

            td.parentElement.previousElementSibling.firstElementChild.remove();
            td.parentElement.previousElementSibling.insertAdjacentHTML('afterbegin', span); //ELIMINAR BOTON AL QUE SE LE HIZO CLICK Y AGREGAR EL NUEVO

            e.target.remove();
            td.insertAdjacentHTML('beforeend', btn); //VOLVER ACTIVAR LOS EVENTOS

            document.querySelectorAll(".btn-activar").forEach(function (item) {
              item.addEventListener('click', function (e) {
                e.preventDefault();
                funciones.cambiarStatus(url, e);
              });
            });
            document.querySelectorAll(".btn-desactivar").forEach(function (item) {
              item.addEventListener('click', function (e) {
                e.preventDefault();
                funciones.cambiarStatus(url, e);
              });
            }); //ALERT

            swal("Muy bien", "Se cambio el status correctamente", "success");
          } else if (res.message == 'error_input') {
            swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
            e.removeAttribute('disabled');
          } else if (res.message == 'error') {
            swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
            e.removeAttribute('disabled');
          }
        });
      }
    });
  },
  validarAgregarInstructor: function validarAgregarInstructor(e) {
    e.preventDefault();
    var nombre = document.querySelector("input[name='nombre_instructor']");
    var apellido = document.querySelector("input[name='apellido_instructor']");
    var email = document.querySelector("input[name='email']");
    var bibliografia = document.querySelector("textarea[name='bibliografia']");
    var especialidad = document.querySelector("input[name='especialidad']");
    var password = document.querySelector("input[name='password']");
    var password_confirm = document.querySelector("input[name='password_confirmation']");
    var img_instructor = document.querySelector("input[name='avatar']");
    /* STATUS */

    var error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });
    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (nombre.value == '') {
      nombre.parentNode.classList.add('has-error');
      nombre.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (apellido.value == '') {
      apellido.parentNode.classList.add('has-error');
      apellido.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (email.value == '') {
      email.parentNode.classList.add('has-error');
      email.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (!funciones.validarEmail(email.value)) {
      email.parentNode.classList.add('has-error');
      email.nextElementSibling.innerHTML = 'El email no es valido';
      error_videos = true;
    }

    if (especialidad.value == '') {
      especialidad.parentNode.classList.add('has-error');
      especialidad.nextElementSibling.innerHTML = 'El email no es valido';
      error_videos = true;
    }

    if (bibliografia.value == '') {
      bibliografia.parentNode.classList.add('has-error');
      bibliografia.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (e.target.getAttribute('name') == 'frm-agregar_instructor') {
      if (password.value == '') {
        password.parentNode.classList.add('has-error');
        password.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true; // password.classList.add('campo-requerido');
        // validate = false;
      }

      if (password.value.length < 8) {
        password.parentNode.classList.add('has-error');
        password.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true; // password.classList.add('campo-requerido');
        // validate = false;			
      }

      if (password.value !== password_confirm.value) {
        password_confirm.parentNode.classList.add('has-error');
        password_confirm.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true; // password.classList.add('campo-requerido')
      }
    }

    console.log(e.target.getAttribute('name'));

    if (e.target.getAttribute('name') == 'frm-agregar_instructor') {
      if (img_instructor.value == '') {
        img_instructor.parentNode.classList.add('has-error');
        img_instructor.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true;
      }
    }

    if (error_videos == true) {
      if (e.type == 'submit') {
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');

      if (e.target.getAttribute('name') == 'frm-agregar_instructor') {
        document.querySelector("form[name='frm-agregar_instructor']").submit();
        return false;
      }

      document.querySelector("form[name='frm-editar_instructor']").submit();
      return false; //document.querySelector("form[name='frm-editar_evento']").submit();
    }
  },
  validarAgregarEvento: function validarAgregarEvento(e) {
    e.preventDefault();
    var nombre_evento = document.querySelector("input[name='nombre_evento']");
    var img_evento = document.querySelector("input[name='img_evento']");
    var instructores = document.querySelector("select[name='select_instructores[]']");
    var select_tipo = document.querySelector("select[name='select_tipo']");
    var video_bienvenida = document.querySelector("input[name='video_bienvenida']");
    var descripcion = document.querySelector("textarea[name='descripcion']");
    var fecha_inicio = document.querySelector("input[name='fecha_inicio']");
    var hora_inicio = document.querySelector("input[name='hora_inicio']");
    var evento_especial = document.querySelector("input[name='evento_especial']");
    var precio = document.querySelector("input[name='precio']");
    var url_video = document.querySelector("input[name='url_video']");
    /* STATUS */

    var error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });
    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (nombre_evento.value == '') {
      nombre_evento.parentNode.classList.add('has-error');
      nombre_evento.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (e.target.getAttribute('name') == 'frm-agregar_evento') {
      if (img_evento.value == '') {
        img_evento.parentNode.classList.add('has-error');
        img_evento.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true;
      }
    }

    if (instructores.value == '' || instructores.value == null || instructores.value == undefined) {
      instructores.parentNode.classList.add('has-error');
      instructores.parentNode.children[1].firstChild.style.borderColor = "red";
      instructores.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (select_tipo.value == '' || select_tipo.value == null || select_tipo.value == undefined) {
      select_tipo.parentNode.classList.add('has-error'); //select_tipo.parentNode.children[1].firstChild.style.borderColor = "red";

      select_tipo.nextElementSibling.innerHTML = 'El campo es requerido';
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

    if (fecha_inicio.value == '') {
      error_videos = true;
      fecha_inicio.parentNode.classList.add('has-error');
      fecha_inicio.nextElementSibling.innerHTML = 'El campo es requerido';
    }

    if (hora_inicio.value == '') {
      error_videos = true;
      hora_inicio.parentNode.classList.add('has-error');
      hora_inicio.nextElementSibling.innerHTML = 'El campo es requerido';
    }

    if (evento_especial.checked == true) {
      if (precio.value == '') {
        error_videos = true;
        precio.parentNode.classList.add('has-error');
        precio.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    }

    if (url_video.value == '') {
      error_videos = true;
      url_video.parentNode.classList.add('has-error');
      url_video.nextElementSibling.innerHTML = 'El campo es requerido';
    }

    if (error_videos == true) {
      if (e.type == 'submit') {
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading');

      if (e.target.getAttribute('name') == 'frm-agregar_evento') {
        document.querySelector("form[name='frm-agregar_evento']").submit();
        return false;
      }

      document.querySelector("form[name='frm-editar_evento']").submit();
    }
  },
  validarAgregarClase: function validarAgregarClase(e) {
    e.preventDefault();
    /* 	PRIMER PASO DEL REGISTRO */

    var nombre_curso = document.querySelector("input[name='nombre_clase']"),
        img_clase = document.querySelector("input[name='img_clase']"),
        instructores = document.querySelector("select[name='select_instructores[]']"),
        categorias = document.querySelector("select[name='select_categorias']"),

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
    error_videos = false; //SE ELIMINAN LOS RASTROS DE ERRORES

    document.querySelectorAll('.errors').forEach(function (item) {
      item.innerHTML = '';
    });
    document.querySelectorAll('.chosen-choices').forEach(function (item) {
      item.style.borderColor = "#e5e6e7";
    });

    if (document.querySelector('.has-error')) {
      document.querySelectorAll('.has-error').forEach(function (item) {
        item.classList.remove('has-error');
      });
    } //SE ELIMINAN LOS RASTROS DE ERRORES\\


    if (nombre_curso.value == '') {
      nombre_curso.parentNode.classList.add('has-error');
      nombre_curso.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (e.target.getAttribute('name') == 'frm-agregar_clase') {
      if (img_clase.value == '') {
        img_clase.parentNode.classList.add('has-error');
        img_clase.nextElementSibling.innerHTML = 'El campo es requerido';
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
      categorias.parentNode.classList.add('has-error'); //categorias.parentNode.children[1].firstChild.style.borderColor = "red";

      categorias.nextElementSibling.innerHTML = 'El campo es requerido';
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
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
      }

      return false;
    }

    if (e.type == 'submit') {
      e.target.disabled = true;
      document.querySelector('.ibox-content').classList.add('sk-loading'); //document.querySelector("form[name='frm-agregar_clase']").submit();

      if (e.target.getAttribute('name') == 'frm-editar_clase') {
        document.querySelector("form[name='frm-editar_clase']").submit();
        return false;
      }

      document.querySelector("form[name='frm-agregar_clase']").submit();
    }
  },
  agregarSessionesClase: function agregarSessionesClase(e) {
    var numeroSesiones = e.target.value;
    var htmlSessiones = "";
    var numeroClones = document.querySelectorAll(".clone-horarios_sesion").length;
    var conteo = numeroSesiones > numeroClones ? numeroSesiones - numeroClones : numeroClones - numeroSesiones;

    if (numeroSesiones > numeroClones) {
      for (var i = 1; i <= conteo; i++) {
        htmlSessiones += '<div class="clone-horarios_sesion">' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">URL Zoom: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="url_zoom[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">ID de Reunión: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="id_reunion[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Codigo de acceso: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="codigo_acceso[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Fecha de Lanzamiento: </label>' + '<div class="col-sm-2">' + '<input class="form-control datepicker" name="fecha_inicio[]" data-date-format="yyyy-mm-dd">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '<label class="pt-2 font-weight-bold"> : </label>' + '<div class="col-sm-2 clockpicker" data-autoclose="true">' + '<input class="form-control" name="hora_inicio[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="hr-line-dashed"></div>' + '</div>';
      }

      document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
    } else {
      var clonesZoom = document.querySelectorAll(".clone-horarios_sesion");

      for (var i = 0; i <= numeroClones; i++) {
        if (i >= numeroSesiones) {
          clonesZoom[i].remove();
        }
      }

      document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
    } //INICIALIZAR DATEPICKER Y CLOCKPICKER


    $('.clockpicker').clockpicker();
    $('.datepicker').datepicker({
      todayHighlight: true,
      keyboardNavigation: false,
      forceParse: false,
      calendarWeeks: true,
      autoclose: true
    });
  },
  elimiarArchivoUpdateCurso: function elimiarArchivoUpdateCurso(e) {
    e.preventDefault();
    e.target.disabled = true;
    var token = document.querySelector("input[name='_token']").value,
        documento = e.target.getAttribute('data-metadata'),
        slug = e.target.getAttribute('data-slug'),
        sesion = e.target.getAttribute('data-sesion');
    var opciones = {
      method: "POST",
      credentials: "same-origin",
      body: JSON.stringify({
        "documento": documento,
        "session": sesion,
        "slug": slug,
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
        swal("Muy bien", "Se elimino el archivo correctamente", "success");
      } else if (res.message == 'no_parameters') {
        swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
        e.removeAttribute('disabled');
      } else if (res.message == 'no_delete') {
        swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
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
        categorias = document.querySelector("select[name='select_categorias']"),
        curso_extra = document.querySelector("input[name='curso_extra']"),
        select_carreras = document.querySelector("select[name='select_carreras[]']"),
        select_subcategorias = document.querySelector("select[name='select_subcategorias[]']"),

    /* BIENVENIDA AL CURSO */
    video_bienvenida = document.querySelector("input[name='video_bienvenida']"),
        descripcion = document.querySelector("textarea[name='descripcion']"),

    /* TEMARIO */
    nombres_cursos = document.querySelectorAll("input[name='nombre_video[]']"),
        nombres_videos = document.querySelectorAll(".nombre_videos"),
        videos_url = document.querySelectorAll(".url_videos"),
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
      categorias.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (select_subcategorias.value == '' || select_subcategorias.value == null || select_subcategorias.value == undefined) {
      select_subcategorias.parentNode.parentNode.classList.add('has-error');
      select_subcategorias.parentNode.children[1].firstChild.style.borderColor = "red";
      select_subcategorias.parentNode.nextElementSibling.innerHTML = 'El campo es requerido';
      error_videos = true;
    }

    if (curso_extra.checked == false) {
      if (select_carreras.value == '') {
        select_carreras.parentNode.classList.add('has-error');
        select_carreras.parentNode.children[1].firstChild.style.borderColor = "red";
        select_carreras.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
        error_videos = true;
      }
    } // if (select_carreras.value == '') {
    // 		select_carreras.parentNode.classList.add('has-error');
    // 		select_carreras.parentNode.children[1].firstChild.style.borderColor = "red";
    // 		select_carreras.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
    // 		error_videos = true;
    // }


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
        item.parentNode.nextElementSibling.innerHTML = 'El campo es requerido';
      }
    }); //Validar nombres de videos

    nombres_videos.forEach(function (item, index) {
      if (item.value == '') {
        error_videos = true;
        item.parentNode.classList.add('has-error');
        item.parentNode.nextElementSibling.innerHTML = 'El campo es requerido';
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
        var posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
        window.scrollTo(0, posicion);
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
  getCoords: function getCoords(elem) {
    // OBTENER LA POSICION RELATIVA DE UN ELENETO DENTTO DE WINDOW
    var box = elem.getBoundingClientRect();
    var body = document.body;
    var docEl = document.documentElement;
    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;
    var clientTop = docEl.clientTop || body.clientTop || 0;
    var clientLeft = docEl.clientLeft || body.clientLeft || 0;
    var top = box.top + scrollTop - clientTop;
    var left = box.left + scrollLeft - clientLeft;
    return Math.round(top) - 200;
  },
  validarEmail: function validarEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
  },
  htmlAgregarVideo: function htmlAgregarVideo(contador) {
    return '<div class="div-container_videourl d-flex col-11" style="padding: 0;">' + '<input type="text" placeholder="Nombre del video" class="form-control mt-3 nombre_videos" name="nombre_video_url[' + contador + '][]">' + '<input type="text" placeholder="Url del video" class="form-control mt-3 url_videos" name="video_url[' + contador + '][]">' + '</div>' + '<span class="form-text m-b-none errors"></span>';
  },
  htmlVideoCurso: function htmlVideoCurso(contador) {
    contador++;
    return '<div class="clone-videos">' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Nombre del video: </label>' + '<div class="col-sm-10">' + '<input type="text" class="form-control" name="nombre_video[]">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Video url: </label>' + '<div class="col-sm-10">' + '<div class="d-flex">' + '<input type="text" placeholder="Nombre del video" class="form-control nombre_videos" name="nombre_video_url[' + contador + '][]">' + '<input type="text" placeholder="Url del video" class="form-control url_videos" name="video_url[' + contador + '][]">' + '<button class="btn btn-success ml-4 add-url_video"> + </button>' + '<button class="btn btn-danger ml-2 remove-url_video"> - </button>' + '</div>' + '<span class="form-text m-b-none errors"></span>' + '<div class="parent_mas-videos"></div>' + '</div>' + '</div>' + '<div class="form-group row">' + '<label class="col-sm-2 col-form-label">Descripcion: </label>' + '<div class="col-sm-10">' + '<textarea class="form-control" name="descripcion_curso[]" rows="3"></textarea>' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '<div class="form-group row mb-5">' + '<label class="col-sm-2 col-form-label">Material Extra: </label>' + '<div class="col-sm-10">' + '<input id="logo" type="file" name="material_extra[' + contador + '][]" multiple class="form-control" accept="jpg,jpeg,png">' + '<span class="form-text m-b-none errors"></span>' + '</div>' + '</div>' + '</div>';
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