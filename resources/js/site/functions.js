
//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)

let funciones = {

	editarPerfil: function(e) {
		e.preventDefault();
		e.stopPropagation();

		let nombre = document.querySelector("input[name='nombre']"),
			apaterno = document.querySelector("input[name='apaterno']"),
			amaterno = document.querySelector("input[name='amaterno']"),
			fecha_nacimiento = document.querySelector("input[name='fecha_nacimiento']"),
			email = document.querySelector("input[name='email']"),
			password = document.querySelector("input[name='password']"),
			validate = true;

		if (document.querySelectorAll(".campo-requerido")) {
			document.querySelectorAll('.campo-requerido').forEach((item) => {
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
			alert('k')
			return false;
		}


		if (e.type == 'click') {
	        e.target.disabled = true;
	        document.querySelector("form[name='form_editar']").submit();
	        return false;
	    }

	},

	eliminarCursoFav: function(e, section) {
		e.preventDefault();

		let slug = e.target.getAttribute('data-slg');
		if (slug) {
			let token = document.querySelector("input[name='_token']").value;

			let opciones = {
	            method: "POST",
	            credentials: "same-origin",
	            body: JSON.stringify({"slug": slug, "_token": token, "seccion": section }),
	            headers:{
	                "Content-Type": "application/json"
	            }
	        };

	        fetch('/usuario/eliminarFavoritos', opciones)
	            .then(response => response.json())
	            .then(res => {
	            	if (res.message == 'ok') {
	            		swal("OK", "Se elimino de favoritos correctamente", "success");
	            		e.target.parentNode.remove();
	            	}
	            	else {
	            		//alert('no');
	            		swal("Error", "Ocurrio un error, intentalo más tarde", "error");
	            	}
	            });
		}
	},

	registroEvento: function(e) {
		e.preventDefault();
		let slug = e.target.getAttribute('data-crs');
		if (slug) {
			let token = document.querySelector("input[name='_token']").value;

			let opciones = {
	            method: "POST",
	            credentials: "same-origin",
	            body: JSON.stringify({"slug": slug, "_token": token }),
	            headers:{
	                "Content-Type": "application/json"
	            }
	        };

	        fetch('/usuario/registrarEvento', opciones)
	            .then(response => response.json())
	            .then(res => {
	            	if (res.message == 'ok') {
	            		swal("OK", "Se agrego a tu tablero correctamente", "success");
	            		//alert('ok');
	            		location.reload();
	            	}
	            	else {
	            		//alert('no');
	            		swal("Error", "Ocurrio un error, intentalo más tarde", "error");
	            	}
	            });
		}
	},

	empezarCurso: function(e) {
		e.preventDefault();
		let slug = e.target.getAttribute('data-crs');
		if (slug) {
			let token = document.querySelector("input[name='_token']").value;

			let opciones = {
	            method: "POST",
	            credentials: "same-origin",
	            body: JSON.stringify({"slug": slug, "_token": token }),
	            headers:{
	                "Content-Type": "application/json"
	            }
	        };

	        fetch('/usuario/empezarCurso', opciones)
	            .then(response => response.json())
	            .then(res => {
	            	if (res.message == 'ok') {
	            		swal("OK", "Se agrego a tu tablero correctamente", "success");
	            		//alert('ok');
	            		location.reload();
	            	}
	            	else {
	            		//alert('no');
	            		swal("Error", "Ocurrio un error, intentalo más tarde", "error");
	            	}
	            });
		}

	},

	micuentaActive: function(e) {
		e.preventDefault();

		let seccion = e.target.parentNode.getAttribute('data-seccion');
		$('.wrapper-tablero div.section').removeClass('active');
		$('.wrapper-tablero div.section[data-seccion='+seccion+']').addClass('active');
		
		if (seccion == 'favoritos') {
			$('.slide-cursos').slick("refresh");
		}

		//ul li
		$('.li-micuenta li').removeClass('active');
		e.target.parentNode.classList.add('active');
	},

	guardarFavoritos: function(e, section) {
		e.preventDefault();
		let data_crs = e.target.parentNode.getAttribute('data-crs');
		let seccion = section;

		if (data_crs) {
			let token = document.querySelector("input[name='_token']").value;

			let opciones = {
	            method: "POST",
	            credentials: "same-origin",
	            body: JSON.stringify({"curso": data_crs, "_token": token, "seccion": seccion }),
	            headers:{
	                "Content-Type": "application/json"
	            }
	        };


	        fetch('/usuario/favorito', opciones)
	            .then(response => response.json())
	            .then(res => {
	            	if (res.message == 'ok') {
	            		swal("OK", "Se agrego el "+seccion+" a favoritos", "success");
	            		//alert('ok');
	            		document.querySelector('.favorito').remove();
	            	}
	            	else {
	            		//alert('no');
	            		swal("Error", "Ocurrio un error, intentalo más tarde", "error");
	            	}
	            });
		}
	},

	filtrosCursos: function(e) {
		e.preventDefault();
		e.stopPropagation();

		//Recargar el Slider
		$('.slide-cursos, .slide-extra').slick("refresh");

		let cat = document.querySelectorAll(".row-yellow");
		let div = document.querySelectorAll(".div-item");

		cat.forEach( (item) => {
			item.style.display = "none";
		});

		div.forEach( (item) => {
			item.style.display = "none";
		});

		let categoria = e.target.getAttribute('data-cat');
		let subcategoria = e.target.getAttribute('class');

		document.querySelector(".row-yellow."+categoria).style.display = "block";

		if (categoria == subcategoria) {
			document.querySelectorAll("div."+categoria).forEach( (item) => {
				item.style.display = "block";
			});
			
			return false;
		}

		document.querySelector("div."+subcategoria+"."+categoria).style.display = "block";
	},

	validarRegistro: function(e) {
		e.preventDefault();
		e.stopPropagation();

		let nombre = document.querySelector("input[name='nombre']"),
			apaterno = document.querySelector("input[name='apaterno']"),
			amaterno = document.querySelector("input[name='amaterno']"),
			fecha_nacimiento = document.querySelector("input[name='fecha_nacimiento']"),
			email = document.querySelector("input[name='email']"),
			password = document.querySelector("input[name='password']"),
			password_confirm = document.querySelector("input[name='password_confirmation']"),
			validate = true;

		if (document.querySelectorAll(".campo-requerido")) {
			document.querySelectorAll('.campo-requerido').forEach((item) => {
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
			password.classList.add('campo-requerido')
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

	validarLogin: function(e) {
		e.preventDefault();
		e.stopPropagation();

		let email = document.querySelector("input[name='email']"),
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

	validarEmail: function(email) {
		var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    	return regex.test(email) ? true : false;
	},
};


exports.funciones = funciones;