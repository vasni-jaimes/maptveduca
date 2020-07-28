
//FUNCION PARA VALIDAR EL FORMULARIO DE AGREGAR UN NUEVO USUARIO (CLIENTE)

let funciones = {

	validarRegistro: function(e) {
		e.preventDefault();

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