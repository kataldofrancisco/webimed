function formatoRut(rut) {
	// borramos los puntos, guiones y cambiamos las k por K
	rut = $.trim(rut);
	rut = rut.replace(/[^0123456789Kk]/gi, '');
	rut = rut.replace(/k/gi, 'K');
	// ponemos el guión en caso de no estar presente
	if (rut.length > 1) {
		if (rut.substr(rut.length - 2, 1) != '-') {
			rut = rut.substr(0, rut.length - 1) + '-' + rut.substr(rut.length - 1, 1);
		}
	}
	return rut;
}

function validarRUT(rut, dv) {
	var suma = 0;
	var mod = 0;
	var S = 0;
	var Rf = 0;
	var digito_valido = '';
	rut = parseInt(rut) + '';
	if (dv == "K" || dv == "k") {
		dv = "K";
	} else {
		dv = parseInt(dv) + "";
	}
	// RUT para extranjeros
	if (parseInt(rut) > 99999 && parseInt(rut) < 1000000) {
		if (rut.substr(0, 1) == dv) {
			return true;
		} else {
			return false;
		}
	}
	for (i = rut.length; i > 0; i--) {
		S += parseInt(rut.substr(i - 1, 1)) * (mod + 2);
		mod = (mod + 1) % 6;
	}
	Rf = 11 - (S % 11);
	if (Rf == 11) {
		digito_valido = "0";
	}
	if (Rf == 10) {
		digito_valido = "K";
	}
	if (Rf < 10) {
		digito_valido = Rf + "";
	}
	if (dv == digito_valido) {
		return true;
	}
	return false;
}

function validarEmail(email)
{
	var regx = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	if (regx.test(email)) {
		return true;
	}
	return false;
}

function switchPaneles() {
	$("#panel_derecho").removeClass('full');
	$("#panel_izquierdo").show();
}
