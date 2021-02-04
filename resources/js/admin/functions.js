
//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)

let funciones = {

	validarAgregarUsuario: function(e) {
		e.preventDefault();

		let nombre = document.querySelector("input[name='nombre']");
		let amaterno = document.querySelector("input[name='amaterno']");
		let apaterno = document.querySelector("input[name='apaterno']");
		let email = document.querySelector("input[name='email']");
		let fecha_nacimineto = document.querySelector("input[name='fecha_nacimineto']");
		let password = document.querySelector("input[name='password']");
		let password_confirm = document.querySelector("input[name='password_confirmation']");

		/* STATUS */
		let error_videos = false;

		//SE ELIMINAN LOS RASTROS DE ERRORES
		document.querySelectorAll('.errors').forEach(function(item) {
			item.innerHTML = '';
		});

		document.querySelectorAll('.chosen-choices').forEach((item) => {
			item.style.borderColor = "#e5e6e7";
		});

		if (document.querySelector('.has-error')) {
			document.querySelectorAll('.has-error').forEach((item) => {
				item.classList.remove('has-error');
			});
		}
		//SE ELIMINAN LOS RASTROS DE ERRORES\\


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
				error_videos = true;
				// password.classList.add('campo-requerido');
				// validate = false;
			}

			if (password.value.length < 8) {
				password.parentNode.classList.add('has-error');
				password.nextElementSibling.innerHTML = 'El campo debe tener un minimo de 8 caracteres';
				error_videos = true;
				// password.classList.add('campo-requerido');
				// validate = false;			
			}

			if (password.value !== password_confirm.value) {
				password_confirm.parentNode.classList.add('has-error');
				password_confirm.nextElementSibling.innerHTML = 'Los passwords no coinciden';
				error_videos = true;
				// password.classList.add('campo-requerido')
				// validate = false;
			}
		}


		if (e.target.getAttribute('name') == 'frm-editar_usuario') {
			if (password.value != '') {
				if (password.value.length < 8) {
					password.parentNode.classList.add('has-error');
					password.nextElementSibling.innerHTML = 'El campo debe tener un minimo de 8 caracteres';
					error_videos = true;
					// password.classList.add('campo-requerido');
					// validate = false;			
				}
			}
		}


		if (error_videos == true) {
			if (e.type == 'submit') {
				let posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
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

	        // document.querySelector("form[name='frm-editar_instructor']").submit();
	        // return false;
	    }


	},

	alertConfirmDeleteResp: function(e) {
		e.preventDefault();

		let respuesta = e.target.getAttribute('data-rsp');
		let file = e.target.getAttribute('data-file');
		let li = e.target.parentElement;

		swal({
			title: "¿Estas Segur@?",
			text: "¿Estas segur@ que quieres eliminar el archivo?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				let token = document.querySelector("input[name='_token']").value;

				let opciones = {
		            method: "POST",
		            credentials: "same-origin",
		            body: JSON.stringify({"respuesta": respuesta, "archivo": file, "_token": token }),
		            headers:{
		                "Content-Type": "application/json"
		            }
		        };


		        fetch('/admin/eliminar-archivo_resp', opciones)
		            .then(response => response.json())
		            .then(res => {
		            	if (res.message == 'ok') {
		            			
		            			li.remove();
		            			swal("Se Elimino el archivo correctamente", {
									icon: "success",
						  		});
		            	}
		            	else {
		            		swal("Ocurrio un error, intentelo más tarde", {
								icon: "error",
						  	});
		            	}
		            })
			        .catch(function(error) {
						swal("Ocurrio un error, intentelo más tarde", {
							icon: "error",
						});
					});

		  	} else {
		    	swal("Se cancelo la eliminacion");
		  	}
		});
	},

	alertConfirmDelete: function(e) {
		e.preventDefault();

		let publicacion = e.target.getAttribute('data-pub');
		let file = e.target.getAttribute('data-file');
		let li = e.target.parentElement;

		swal({
			title: "¿Estas Segur@?",
			text: "¿Estas segur@ que quieres eliminar el archivo?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {

				let token = document.querySelector("input[name='_token']").value;

				let opciones = {
		            method: "POST",
		            credentials: "same-origin",
		            body: JSON.stringify({"publicacion": publicacion, "archivo": file, "_token": token }),
		            headers:{
		                "Content-Type": "application/json"
		            }
		        };


		        fetch('/admin/eliminar-archivo', opciones)
		            .then(response => response.json())
		            .then(res => {
		            	if (res.message == 'ok') {
		            			
		            			li.remove();
		            			swal("Se Elimino el archivo correctamente", {
									icon: "success",
						  		});
		            	}
		            	else {
		            		swal("Ocurrio un error, intentelo más tarde", {
								icon: "error",
						  	});
		            	}
		            })
			        .catch(function(error) {
						swal("Ocurrio un error, intentelo más tarde", {
							icon: "error",
						});
					});

		  	} else {
		    	swal("Se cancelo la eliminacion");
		  	}
		});
	},

	agregarRespuesta: function(e) {
		e.preventDefault();

		const modal = document.querySelectorAll('.ibox-content');
		for (var i = 0; i <= modal.length - 1; i++) {
			modal[i].classList.add('sk-loading');
		}

		e.target.parentElement.submit();

	},

	editarRespuesta: function(e) {
		e.preventDefault();

		const modal = document.querySelectorAll('.ibox-content');
		for (var i = 0; i <= modal.length - 1; i++) {
			modal[i].classList.add('sk-loading');
		}

		e.target.parentElement.submit();
		
	},

	mostrarFormularioResp: function(e) {
		e.preventDefault();
		let resp = e.target.getAttribute('data-resp');
		document.querySelector('.editar-respuesta[data-resp="'+resp+'"]').style.display = "block";
	},

	cancelarEdicion: function(e) {
		e.preventDefault();
		e.target.parentElement.parentElement.parentElement.style.display = "none";
		return false;
	},

	desplegarFormularioEdit: function(e) {
		e.preventDefault();
		let pub = e.target.getAttribute('data-pub');
		document.querySelector('.editar-publicacion[data-pub="'+pub+'"]').style.display = "block";
	},

	editarPublicacion: function(e) {
		e.preventDefault();

		const modal = document.querySelectorAll('.ibox-content');
		for (var i = 0; i <= modal.length - 1; i++) {
			modal[i].classList.add('sk-loading');
		}

		e.target.parentElement.submit();
	},

	eliminarPublicacion: function(e) {
		e.preventDefault();
		const modal = document.querySelectorAll('.ibox-content');
		for (var i = 0; i <= modal.length - 1; i++) {
			modal[i].classList.add('sk-loading');
		}

		//quitar division de eliminar y editar
		e.target.parentElement.parentElement.parentElement.classList.remove('show');
		e.target.parentElement.parentElement.parentElement.parentElement.classList.remove('show');

		//generar evento submit
		e.target.parentElement.submit();
	},

	validarMensajes: function(e) {
		e.preventDefault();
		mensaje = document.querySelector('textarea[name="mensaje"]');

		/* STATUS */
		let error_videos = false;

		//SE ELIMINAN LOS RASTROS DE ERRORES
		document.querySelectorAll('.errors').forEach(function(item) {
			item.innerHTML = '';
		});

		if (document.querySelector('.has-error')) {
			document.querySelectorAll('.has-error').forEach((item) => {
				item.classList.remove('has-error');
			});
		}
		//SE ELIMINAN LOS RASTROS DE ERRORES\\


		if (mensaje.value == '') {
			mensaje.parentNode.classList.add('has-error');
			mensaje.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}


		if (error_videos == true) {
			if (e.type == 'submit') {
				let posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
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

	obtenerAlumnosxCurso: function(e) {
		e.preventDefault();


		let curso_id = e.target.value;
		let token = document.querySelector("input[name='_token']").value;

		if (curso_id) {

			let opciones = {
	            method: "POST",
	            credentials: "same-origin",
	            body: JSON.stringify({"curso_id": curso_id, "_token": token}),
	            headers:{
	                "Content-Type": "application/json"
	            }
	        };


	        fetch('/admin/buscar-alumnos', opciones)
	            .then(response => response.json())
	            .then(res => {
	            	if (res.message == 'ok') {
	            		let options = '<select data-placeholder="Usuarios" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_usuarios[]">';
	            		res.items.forEach( function(item) { 
	            			options += "<option value="+item.id+">"+item.nombre+' '+item.apaterno+' '+item.amaterno+"</option>";
	            		});

	            		options += "</select>";

	            		document.querySelector('.sub-usuarios').innerHTML = options;
	            		$('.chosen-select').chosen({width: "100%"});
				        $('.custom-file-input').on('change', function() {
				            let fileName = $(this).val().split('\\').pop();
				            $(this).next('.custom-file-label').addClass("selected").html(fileName);
				        });
	            	}
	            	else {
	            		swal("Error", "Ocurrio un error, intentalo más tarde", "error");
	            	}
	            });
		}

	},

	format: function(num) {

	    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0) {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++) {
	        if(str[j] != ",") {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1)) {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	    //return("$" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	},

	cambiarTipoEvento: function(e) {
		e.preventDefault();

		let tipo_event = e.target.value;

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

	obtenerSubmenus: function(e) {
		e.preventDefault();

		let select_catego = e.target.value;
		let token = document.querySelector("input[name='_token']").value;

		let opciones = {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({"categoria": select_catego, "_token": token}),
            headers:{
                "Content-Type": "application/json"
            }
        };


        fetch('/admin/obtenerSubcategorias', opciones)
            .then(response => response.json())
            .then(res => {
            	if (res.message == 'ok') {
            		let options = '<select data-placeholder="Subcategorias" class="chosen-select" multiple style="width:350px;" tabindex="4" name="select_subcategorias[]">';
            		res.main.forEach( function(item) { 
            				options += "<option value="+item.id+">"+item.nombre+"</option>";
            		});
            		options += '</select>';
            		//$(".div-subcate").html(options);
            		document.querySelector(".div-subcate").innerHTML = options;

            		$('.chosen-select').chosen({width: "100%"});
			        $('.custom-file-input').on('change', function() {
			            let fileName = $(this).val().split('\\').pop();
			            $(this).next('.custom-file-label').addClass("selected").html(fileName);
			        });

			        document.querySelector("div.div-subcate select").parentNode.children[1].firstChild.style.borderColor = "red";

            	}
            	else {
            		swal("Error", "Ocurrio un error, intentalo más tarde", "error");
            	}
            });

	},
	cambiarStatus: function(url, e) {
		//e.preventDefault();

		swal({
		  title: "¿Estas seguro?",
		  text: "¿Quieres cambiar el estatus?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
			if (!willDelete) {
		  		return false;
		  	}
		  	else {
		  		e.target.disabled = true;

				let token = document.querySelector("input[name='_token']").value,
					status = e.target.getAttribute('data-st');
					id = e.target.getAttribute('data-id');

		        let opciones = {
		            method: "POST",
		            credentials: "same-origin",
		            body: JSON.stringify({"status": status, "_token": token, "id": id}),
		            headers:{
		                "Content-Type": "application/json"
		            }
		        };

		        fetch(url, opciones)
		            .then(response => response.json())
		            .then(res => {
		            	if (res.message == 'ok') {
		            		let span = (status == 1) ? "<span class='float-center label label-primary'>Activo</span>" : "<span style='cursor:pointer' class='float-center label label-danger'>Inactivo</span>";
		            		let btn = (status == 0) ? '<a href="#" data-id="'+id+'" data-st="1" class="btn-primary btn btn-xs btn-activar">Activar</a>' : '<a href = "#" class="btn-danger btn btn-xs btn-desactivar" data-id="'+id+'" data-st="0">Desactivar</a>';
		            		let td = e.target.parentElement;

		            		// ELIMINAR SPAN DE STATUS EN EL LISTADO Y AGREGAR EL NUEVO
		            		td.parentElement.previousElementSibling.firstElementChild.remove();
		            		td.parentElement.previousElementSibling.insertAdjacentHTML('afterbegin', span);

		            		//ELIMINAR BOTON AL QUE SE LE HIZO CLICK Y AGREGAR EL NUEVO
		            		e.target.remove();
		            		td.insertAdjacentHTML('beforeend', btn);

		            		//VOLVER ACTIVAR LOS EVENTOS
		            		document.querySelectorAll(".btn-activar").forEach( (item) => {
								item.addEventListener('click', function(e) {
									e.preventDefault()
									funciones.cambiarStatus(url, e);
								})
							});

							document.querySelectorAll(".btn-desactivar").forEach( (item) => {
								item.addEventListener('click', function(e) {
									e.preventDefault()
									funciones.cambiarStatus(url, e);
								});
							});

							//ALERT
		            		swal("Muy bien", "Se cambio el status correctamente", "success");
		            	}
		            	else if (res.message == 'error_input') {
		            		swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
		            		e.removeAttribute('disabled');
		            	}
		            	else if (res.message == 'error') {
		            		swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
		            		e.removeAttribute('disabled');
		            	}
		            });
		  	}
		});
	},

	validarAgregarInstructor: function(e) {
		e.preventDefault();

		let nombre = document.querySelector("input[name='nombre_instructor']");
		let apellido = document.querySelector("input[name='apellido_instructor']");
		let email = document.querySelector("input[name='email']");
		let bibliografia = document.querySelector("textarea[name='bibliografia']");
		let especialidad = document.querySelector("input[name='especialidad']");
		let password = document.querySelector("input[name='password']");
		let password_confirm = document.querySelector("input[name='password_confirmation']");
		let img_instructor = document.querySelector("input[name='avatar']");

		/* STATUS */
		let error_videos = false;

		//SE ELIMINAN LOS RASTROS DE ERRORES
		document.querySelectorAll('.errors').forEach(function(item) {
			item.innerHTML = '';
		});

		document.querySelectorAll('.chosen-choices').forEach((item) => {
			item.style.borderColor = "#e5e6e7";
		});

		if (document.querySelector('.has-error')) {
			document.querySelectorAll('.has-error').forEach((item) => {
				item.classList.remove('has-error');
			});
		}
		//SE ELIMINAN LOS RASTROS DE ERRORES\\

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
				error_videos = true;
				// password.classList.add('campo-requerido');
				// validate = false;
			}

			if (password.value.length < 8) {
				password.parentNode.classList.add('has-error');
				password.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
				// password.classList.add('campo-requerido');
				// validate = false;			
			}

			if (password.value !== password_confirm.value) {
				password_confirm.parentNode.classList.add('has-error');
				password_confirm.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
				// password.classList.add('campo-requerido')
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
				let posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
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
	        return false;

	        //document.querySelector("form[name='frm-editar_evento']").submit();
	    }
	},

	validarAgregarEvento: function(e) {
		e.preventDefault();

		let nombre_evento = document.querySelector("input[name='nombre_evento']");
		let img_evento = document.querySelector("input[name='img_evento']");
		let instructores = document.querySelector("select[name='select_instructores[]']");
		let select_tipo = document.querySelector("select[name='select_tipo']");
		let video_bienvenida = document.querySelector("input[name='video_bienvenida']");
		let descripcion = document.querySelector("textarea[name='descripcion']");
		let fecha_inicio = document.querySelector("input[name='fecha_inicio']");
		let hora_inicio = document.querySelector("input[name='hora_inicio']");
		let evento_especial = document.querySelector("input[name='evento_especial']");
		let precio = document.querySelector("input[name='precio']");
		let url_video = document.querySelector("input[name='url_video']");


		/* STATUS */
		let error_videos = false;

		//SE ELIMINAN LOS RASTROS DE ERRORES
		document.querySelectorAll('.errors').forEach(function(item) {
			item.innerHTML = '';
		});

		document.querySelectorAll('.chosen-choices').forEach((item) => {
			item.style.borderColor = "#e5e6e7";
		});

		if (document.querySelector('.has-error')) {
			document.querySelectorAll('.has-error').forEach((item) => {
				item.classList.remove('has-error');
			});
		}
		//SE ELIMINAN LOS RASTROS DE ERRORES\\


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
			select_tipo.parentNode.classList.add('has-error');
			//select_tipo.parentNode.children[1].firstChild.style.borderColor = "red";
			select_tipo.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}


		if (video_bienvenida.value == '')  {
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
				let posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
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

	validarAgregarClase: function(e) {
		e.preventDefault();

		/* 	PRIMER PASO DEL REGISTRO */
		let nombre_curso = document.querySelector("input[name='nombre_clase']"),
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
			error_videos = false;

			//SE ELIMINAN LOS RASTROS DE ERRORES
			document.querySelectorAll('.errors').forEach(function(item) {
				item.innerHTML = '';
			});


			document.querySelectorAll('.chosen-choices').forEach((item) => {
				item.style.borderColor = "#e5e6e7";
			});

			if (document.querySelector('.has-error')) {
				document.querySelectorAll('.has-error').forEach((item) => {
					item.classList.remove('has-error');
				});
			}

			//SE ELIMINAN LOS RASTROS DE ERRORES\\

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
				categorias.parentNode.classList.add('has-error');
				//categorias.parentNode.children[1].firstChild.style.borderColor = "red";
				categorias.nextElementSibling.innerHTML = 'El campo es requerido';
				error_videos = true;
			}


			if (video_bienvenida.value == '')  {
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
			}



			// SESSIONES ZOOM
			url_zoom.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			id_reunion.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			codigo_acceso.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			fecha_inicio.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			hora_inicio.forEach((item, index) => {
				if (item.value == '') {
					error_videos = true;
					item.parentNode.classList.add('has-error');
					item.nextElementSibling.innerHTML = 'El campo es requerido';
				}
			});


			if (error_videos == true) {
				if (e.type == 'submit') {
					let posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
					window.scrollTo(0, posicion);
				}

				return false;
			}


			if (e.type == 'submit') {
				e.target.disabled = true;
		        document.querySelector('.ibox-content').classList.add('sk-loading');
		        //document.querySelector("form[name='frm-agregar_clase']").submit();

		        if (e.target.getAttribute('name') == 'frm-editar_clase') {
		        	document.querySelector("form[name='frm-editar_clase']").submit();
		        	return false;
		        }

		        document.querySelector("form[name='frm-agregar_clase']").submit();
		    }
	},

	agregarSessionesClase: function(e) {

		let numeroSesiones = e.target.value;
		let htmlSessiones = "";
		let numeroClones = document.querySelectorAll(".clone-horarios_sesion").length;
		let conteo = (numeroSesiones > numeroClones) ? numeroSesiones - numeroClones : numeroClones - numeroSesiones;

		if (numeroSesiones > numeroClones) {
			for(var i = 1; i <= conteo; i++) {
				htmlSessiones += '<div class="clone-horarios_sesion">'
	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">URL Zoom: </label>'
	                                    +'<div class="col-sm-10">'
	                                        +'<input type="text" class="form-control" name="url_zoom[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                +'</div>'

	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">ID de Reunión: </label>'
	                                    +'<div class="col-sm-10">'
	                                        +'<input type="text" class="form-control" name="id_reunion[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                +'</div>'

	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">Codigo de acceso: </label>'
	                                    +'<div class="col-sm-10">'
	                                        +'<input type="text" class="form-control" name="codigo_acceso[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                +'</div>'

	                                +'<div class="form-group row">'
	                                    +'<label class="col-sm-2 col-form-label">Fecha de Lanzamiento: </label>'
	                                    +'<div class="col-sm-2">'
	                                        +'<input class="form-control datepicker" name="fecha_inicio[]" data-date-format="yyyy-mm-dd">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                                    +'<label class="pt-2 font-weight-bold"> : </label>'
	                                    +'<div class="col-sm-2 clockpicker" data-autoclose="true">'
	                                        +'<input class="form-control" name="hora_inicio[]">'
	                                        +'<span class="form-text m-b-none errors"></span>'
	                                    +'</div>'
	                               +'</div>'
	                               +'<div class="hr-line-dashed"></div>'
	                            +'</div>';
			}

			document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
		}
		else {

			let clonesZoom = document.querySelectorAll(".clone-horarios_sesion");
			for (var i = 0; i <= numeroClones; i++) {

				if ( i >= numeroSesiones) {
					clonesZoom[i].remove();
				}
			}

			document.querySelector(".container-horarios_clases").insertAdjacentHTML("beforeend", htmlSessiones);
		}

		//INICIALIZAR DATEPICKER Y CLOCKPICKER
		$('.clockpicker').clockpicker();
        $('.datepicker').datepicker({
            todayHighlight: true,
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

	},

	elimiarArchivoUpdateCurso: function(e) {
		e.preventDefault();

		e.target.disabled = true;

		let token = document.querySelector("input[name='_token']").value,
			documento = e.target.getAttribute('data-metadata'),
			slug = e.target.getAttribute('data-slug'),
			sesion = e.target.getAttribute('data-sesion');

        let opciones = {
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({"documento": documento, "session": sesion, "slug": slug, "_token": token}),
            headers:{
                "Content-Type": "application/json"
            }
        };

        fetch("/admin/eliminar-archivo", opciones)
            .then(response => response.json())
            .then(res => {
            	if (res.message == 'ok') {
            		e.target.parentElement.parentElement.remove();
            		swal("Muy bien", "Se elimino el archivo correctamente", "success");
            	}
            	else if (res.message == 'no_parameters') {
            		swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
            		e.removeAttribute('disabled');
            	}
            	else if (res.message == 'no_delete') {
            		swal("Algo salio mal", "Ocurrio un problema, intentalo más tarde", "error");
            		e.removeAttribute('disabled');
            	}
            })
	},

	validacionAgregarCurso: function(e) {
		e.preventDefault();
		e.stopPropagation();

		/* 	PRIMER PASO DEL REGISTRO */
		let nombre_curso = document.querySelector("input[name='nombre_curso']"),
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

		document.querySelectorAll('.errors').forEach(function(item) {
			item.innerHTML = '';
		});

		if (document.querySelector('.has-error')) {
			document.querySelectorAll('.has-error').forEach((item) => {
				item.classList.remove('has-error');
			});
		}

		document.querySelectorAll('.chosen-choices').forEach((item) => {
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
		}

		// if (select_carreras.value == '') {
		// 		select_carreras.parentNode.classList.add('has-error');
		// 		select_carreras.parentNode.children[1].firstChild.style.borderColor = "red";
		// 		select_carreras.nextElementSibling.nextElementSibling.innerHTML = 'El campo es requerido';
		// 		error_videos = true;
		// }


		if (video_bienvenida.value == '')  {
			video_bienvenida.parentNode.classList.add('has-error');
			video_bienvenida.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}

		if (descripcion.value == '') {
			descripcion.parentNode.classList.add('has-error');
			descripcion.nextElementSibling.innerHTML = 'El campo es requerido';
			error_videos = true;
		}


		// Validar nombre y videos URL
		nombres_cursos.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});

		// Validar nombre y videos URL
		videos_url.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.parentNode.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});


		//Validar nombres de videos
		nombres_videos.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.parentNode.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});


		// Validar nombre y videos URL
		descripcion_curso.forEach((item, index) => {
			if (item.value == '') {
				error_videos = true;
				item.parentNode.classList.add('has-error');
				item.nextElementSibling.innerHTML = 'El campo es requerido';
			}
		});


		if (error_videos == true) {
			if (e.type == 'submit') {
				let posicion = funciones.getCoords(document.querySelectorAll(".has-error")[0]);
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

	getCoords: function(elem) { // OBTENER LA POSICION RELATIVA DE UN ELENETO DENTTO DE WINDOW
		var box = elem.getBoundingClientRect();

		var body = document.body;
		var docEl = document.documentElement;

		var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
		var scrollLeft = window.pageXOffset || docEl.scrollLeft || body.scrollLeft;

		var clientTop = docEl.clientTop || body.clientTop || 0;
		var clientLeft = docEl.clientLeft || body.clientLeft || 0;

		var top  = box.top +  scrollTop - clientTop;
		var left = box.left + scrollLeft - clientLeft;

		return Math.round(top) - 200;
	},

	validarEmail: function(email) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    	return regex.test(email) ? true : false;
	},

	htmlAgregarVideo: function(contador) {
		return '<div class="div-container_videourl d-flex col-11" style="padding: 0;">'
					+'<input type="text" placeholder="Nombre del video" class="form-control mt-3 nombre_videos" name="nombre_video_url['+contador+'][]">'
					+'<input type="text" placeholder="Url del video" class="form-control mt-3 url_videos" name="video_url['+contador+'][]">'
				+'</div>'
				+'<span class="form-text m-b-none errors"></span>';
	},

	htmlVideoCurso: function(contador) {
		contador++;
		return '<div class="clone-videos">'
                	+'<div class="form-group row">'
                        +'<label class="col-sm-2 col-form-label">Nombre del video: </label>'
                        +'<div class="col-sm-10">'
                            +'<input type="text" class="form-control" name="nombre_video[]">' 
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>'
                    +'</div>'
                    +'<div class="form-group row">'
                        +'<label class="col-sm-2 col-form-label">Video url: </label>'
                        +'<div class="col-sm-10">'
                        	+'<div class="d-flex">'
                        		+'<input type="text" placeholder="Nombre del video" class="form-control nombre_videos" name="nombre_video_url['+contador+'][]">'
                            	+'<input type="text" placeholder="Url del video" class="form-control url_videos" name="video_url['+contador+'][]">'
                            	+'<button class="btn btn-success ml-4 add-url_video"> + </button>'
                                +'<button class="btn btn-danger ml-2 remove-url_video"> - </button>'
                            +'</div>'
                            +'<span class="form-text m-b-none errors"></span>'
                            +'<div class="parent_mas-videos"></div>'
                        +'</div>'
                    +'</div>'
                    +'<div class="form-group row">'
                        +'<label class="col-sm-2 col-form-label">Descripcion: </label>'
                        +'<div class="col-sm-10">'
                            +'<textarea class="form-control" name="descripcion_curso[]" rows="3"></textarea>'
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>'
                    +'</div>'
                    +'<div class="form-group row mb-5">'
                        +'<label class="col-sm-2 col-form-label">Material Extra: </label>'
                        +'<div class="col-sm-10">'
                            +'<input id="logo" type="file" name="material_extra['+contador+'][]" multiple class="form-control" accept="jpg,jpeg,png">'
                            +'<span class="form-text m-b-none errors"></span>'
                        +'</div>' 
                    +'</div>'
                +'</div>';
	},
};


exports.funciones = funciones;