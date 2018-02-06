$('div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar').live('click', function() {
	if (lugar_seleccionado != this.id) {
		seleccionarLugar(this.id);

		var num = this.id.replace("lugar_", "");
		showMarkers(num);
	}

	eliminarDivInfoValorizacion();
	desplegar_info_valorizacion = false;
});

$('div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar div.lugar_descripcion a.desplegar_prestadores').live('click', function() {
	var num = this.id.replace("desplegar_prestadores_", "");
	$('#prestadores_' + num).toggle();
});

function seleccionarLugar(id) {
	if (lugar_seleccionado != "") {
		$("#" + lugar_seleccionado).removeClass("lugar_seleccionado");
	}

	lugar_seleccionado = id;
	$("#" + id).addClass("lugar_seleccionado");
}

/**
 * Obtener y cargar nuevos lugares en mapa
 */
function cargarLugares(filtros) {
	$("#input_filtros").attr('value', filtros.x0 + ';' + filtros.y0 + ';' + filtros.x1 + ';' + filtros.y1);
	$("#zoom_level").attr('value', map.getZoom());
	$("#punto_centro_lat").attr('value', map.getCenter().lat());
	$("#punto_centro_lng").attr('value', map.getCenter().lng());

	$.ajax({
		url: obtener_lugares_url,
		type: 'post',
		data: $("#formulario_buscar").serialize(),
		beforeSend: function() {
			clearMarkers();
			imprimirNumeroLugaresEncontrados(0);
			imprimirCargandoLugares();
			$('#demasiados_resultados').hide();
		},
		error: function(XMLHttpRequest, textStatus) {
		},
		success: function(datos) {
			$("#input_historico").attr('value', 'no');
			clearMarkers();
			var locations = $.parseJSON(datos);
			if (locations != '') {
				setMarkers(map, locations);
				generarDivInfoValorizacion();
			} else {
				imprimirSinLugares();
				eliminarDivInfoValorizacion();
			}
		}
	});
}

function imprimirNumeroLugaresEncontrados(numero_lugares_encontrados) {
	if (numero_lugares_encontrados == limite_lugares_retornados) {
		numero_lugares_encontrados = limite_lugares_retornados + "+";
		$('#demasiados_resultados').show();
	}

	$('div#paneles div.panel_izquierdo #numero_lugares_encontrados').html(numero_lugares_encontrados);
}

function limpiarListaLugares() {
	$('div#paneles div.panel_izquierdo div#direcciones_googlemap').html('');
}

function generarInfoGlobo(data) {
	retorno = '<div class="globo_info">'
	+ '<h1>' + data.lugar.nombre + '</h1>'
	+ '<h2>' + data.lugar.direccion + '</h2>';
	if (data.lugar.telefono != null) {
		retorno += '<h2>Fono: ' + data.lugar.telefono + '</h2>';
	}
	if (data.lugar.web != null) {
		retorno += '<div><a href="' + data.lugar.web + '" target="_blank">Web</a></div>';
	}
	codigo_lugar = data.lugar.CodLugar;
	if (data.prestadores.length > 0){
		cantidad = data.prestadores.length;
		listado_prestadores = '';
		for (var x = 0; x < cantidad; x++) {
			if (data.prestadores[x].nombre != null) {
				listado_prestadores += data.prestadores[x].rut_prestador + ';';
			}
		}
		if (config_mostrar_valorizacion == true) {
			retorno += '<div class="valorizar"><img src="' + icono_url + 'valorizar.png"><a href="#" onclick="javascript:valorizarPrestadores(\''
			+ listado_prestadores + '\', \'' + codigo_lugar + '\');">Valorizar (' + cantidad + ' prestadores)</a></div>';
		}
	}

	retorno += '</div>';
	return retorno;
}

function generarInfoLugar(data, num_lugar) {
	var listado_prestadores = '';
	var ocultar_listado_prestadores = false;

	if (data.prestadores.length > 1) {
		ocultar_listado_prestadores = true;
	}

	var img_valorizar = '<img src="' + icono_url + 'valorizar.png">';
	for (var x = 0; x < data.prestadores.length; x++) {
		if (data.prestadores[x].nombre != null) {
			listado_prestadores += '<li id="prestador_' + x + '" name="' + data.prestadores[x].rut_prestador + '" title="' +  data.lugar.CodLugar +'">' + data.prestadores[x].nombre + '</li>';
		}
	}

	retorno = '<h1>' + data.lugar.nombre + '</h1>'
	+ '<h2>' + data.lugar.direccion + '</h2>';

	if (data.lugar.operativo == '0') {
		retorno += '<div class="no_operativo">No Operativo</div>';
	}

	if (data.web != null) {
		retorno += '<div><a href="' + data.lugar.web + '" target="_blank">Web</a></div>';
	}

	if (ocultar_listado_prestadores == true) {
		retorno += '<div>'
		+ '<a href="javascript:void()" class="desplegar_prestadores" id="desplegar_prestadores_' + num_lugar + '">'
		+ '<img src="' + icono_url  + 'mas.png">'
		+ 'Mostrar prestadores'
		+ '</a>'
		+ '</div>'
		+ '<ul id="prestadores_' + num_lugar + '" class="oculto">' + listado_prestadores + '</ul>';
	} else {
		if (listado_prestadores != '') {
			retorno += '<ul>' + listado_prestadores + '</ul>';
		}
	}

	retorno += '</div>'
	+ '<div class="clear"></div>';

	return retorno;
}

function imprimirSinLugares() {
	var sin_lugares = "<div class=\"sin_lugares\">"
	+ "<img src=\"" + icono_url + "alerta.png\">"
	+ "<h1>No se encontraron lugares con los filtros seleccionados</h1>"
	+ "</div>";
	$('div#paneles div.panel_izquierdo div#direcciones_googlemap').html(sin_lugares);
}

function imprimirCargandoLugares() {
	var cargando_lugares = "<div class=\"cargando_lugares\">"
	+ "<img src=\"" + icono_url + "ajax_loader.gif\">"
	+ "<h1>Cargando datos de lugares<br>Favor espere</h1>"
	+ "</div>";
	$('div#paneles div.panel_izquierdo div#direcciones_googlemap').html(cargando_lugares);
}

function valorizarPrestadores(prestadores, cod_lugar) {
	$("#dialog").dialog('destroy');
	$("#prestador_valores").dialog({
		autoOpen: false,
		title: "<img src=\"" + icono_url + "valorizar.png\">Valorización prestadores",
		modal: true,
		position: ['center',50],
		height: 'auto',
		width: 580,
		closeOnEscape: true,
		resizable: false,
		draggable: true
	});
	if ($("#rut_beneficiario").attr('value') == $("#rut_beneficiario").attr('title')) {
		$("#prestador_valores").html('<div class="ui-state-error error"><b>Atención:</b> Debe ingresar su RUT, seleccionar un grupo y prestación para valorizar</div>');
		$("#prestador_valores").dialog('open');
		return false;
	}
	if ($("#input_prestaciones").attr('value') != $("#input_prestaciones").attr('title')) {
		var rut_convenio = prestadores;
		var rut_beneficiario = $("#rut_beneficiario").attr('value');
		var prestacion = $("#input_prestaciones").attr('value');
		var codigo_lugar = cod_lugar;
		var rut_v = rut_beneficiario.split('-');
		if (!validarRUT(rut_v[0], rut_v[1])) {
			$("#prestador_valores").html('<div class="ui-state-error">Error: RUT no válido</div>');
			$("#prestador_valores").dialog('open');
			return false;
		}
		if (prestacion.length < 5) {
			$("#prestador_valores").html('<div class="ui-state-error">Error: Prestación no válida</div>');
			$("#prestador_valores").dialog('open');
			return false;
		}
		$.ajax({
			type: 'post',
			url: url_valorizar_prestadores,
			data: {
				rut_convenio: rut_convenio,
				rut_beneficiario:rut_beneficiario,
				prestacion: prestacion,
				codigo_lugar: codigo_lugar
			},
			beforeSend: function() {
				$("#prestador_valores").html('<p class="centrado">' + ajax_loader + ' Valorizando, por favor espere unos momentos...</p>');
				$("#prestador_valores").dialog('open');
			},
			error: function() {
				$("#prestador_valores").html('<div class="ui-state-error">Error de conexión</div>');
				$("#prestador_valores").dialog('open');
			},
			success: function(data) {
				//alert(data);
				var valorizaciones = $.parseJSON(data);
				var html = '<table><tr><th>Prestador</th><th>Monto</th><th>Copago</th></tr>';
				for (x=0;x<valorizaciones.length - 1;x++) {
					if (valorizaciones[x].datos.Error.Codigo != 0) {
						html += '<tr><td>'
							+ valorizaciones[x].prestador.nombre
							+ '</td><td>'
							+ '¡No se puede valorizar esta prestación!'
							+ '</td><td>----'
							+ '</td></tr>';
					} else {
						html += '<tr><td>'
							+ valorizaciones[x].prestador.nombre
							+ '</td><td>$'
							+ valorizaciones[x].datos.Respuesta.Monto
							+ '</td><td>$' + valorizaciones[x].datos.Respuesta.Copago
							+ '</td></tr>';
					}
				}
				html += '</table>';
				$("#prestador_valores").html(html);
				$("#prestador_valores").dialog('open');
			}
		});
	}
	return true;
}

function generarDivInfoValorizacion() {
	eliminarDivInfoValorizacion();

	if (markers_valorizados.length > 0 && desplegar_info_valorizacion == true) {
		MyOverlay.prototype.draw = function() {
		var projeccion = this.getProjection();
		var html = '';

		for (i = 0; i < markers_valorizados.length; i++) {
			var posicion = projeccion.fromLatLngToContainerPixel(markers_valorizados[i].posicion);
			if (markers_valorizados[i].ruts_prestadores != '') {
				html = '<a href="#" onclick="valorizarPrestadores(\'' + markers_valorizados[i].ruts_prestadores + '\', \'' + markers_valorizados[i].codigo_lugar + '\');">Valorizar</a>';
			} else {
				html = "$" + markers_valorizados[i].valorizacion;
			}

			var div = $(document.createElement('div'))
				.attr('id', 'info_valorizacion_' + i)
				.html(html)
				.appendTo("div#paneles div.panel_derecho div#map")
				.addClass("infoValorizacion")
				.css({
					top: posicion.y,
					left: posicion.x - 10,
					zIndex: 1
				});
			}
		}

		var overlay = new MyOverlay({
			map: map
		});
	}
}

function eliminarDivInfoValorizacion() {
	$('div.infoValorizacion').remove();
}

function MarkerValorizado(posicion, valorizacion, ruts_prestadores, codigo_lugar) {
	if (typeof(posicion) == 'undefined') {
		this.posicion = '';
	} else {
		this.posicion = posicion;
	}

	if (typeof(valorizacion) == 'undefined') {
		this.valorizacion = '';
	} else {
		this.valorizacion = valorizacion;
	}

	if (typeof(ruts_prestadores) == 'undefined') {
		this.ruts_prestadores = '';
	} else {
		this.ruts_prestadores = ruts_prestadores;
	}

	if (typeof(codigo_lugar) == 'undefined') {
		this.codigo_lugar = '';
	} else {
		this.codigo_lugar = codigo_lugar;
	}
}
