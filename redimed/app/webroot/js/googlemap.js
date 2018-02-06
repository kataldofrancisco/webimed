function setMarkers(map, locations) {
	markersArray = [];
	markers_valorizados = [];

	imprimirNumeroLugaresEncontrados(locations.length);
	limpiarListaLugares();

	/**
	 * agregar escucha cuando cierran un globo
	 */
	google.maps.event.addListener(infowindow, 'closeclick', function() {
		if (lugar_seleccionado != "") {
			$("#" + lugar_seleccionado).removeClass("lugar_seleccionado");
			lugar_seleccionado = "";
		}
	});

	for (var i = 0; i < locations.length; i++) {
		var location = locations[i];
		var latitude_longitude = new google.maps.LatLng(location.lugar.latitud, location.lugar.longitud);
		var icono_nombre = (location.lugar.operativo == '1') ? "marca_azul.png" : "marca_roja.png";
		locations[i].lugar.grupo_distanciax = 0;
		locations[i].lugar.grupo_distanciay = 0;
		var grupo_posicion = 0;
		for (var j = 0; j < locations.length; j++) {
			if (j > i) {
				if (locations[i].lugar.latitud == locations[j].lugar.latitud) {
					if (locations[i].lugar.longitud == locations[j].lugar.longitud) {
						grupo_posicion ++;
						if(grupo_posicion == 1) {
							locations[i].lugar.grupo_distanciax = 0;
							locations[i].lugar.grupo_distanciay = 33;
						}
						if(grupo_posicion == 2) {
							locations[i].lugar.grupo_distanciax = 20;
							locations[i].lugar.grupo_distanciay = 31;
						}
						if(grupo_posicion == 3) {
							locations[i].lugar.grupo_distanciax =-10;
							locations[i].lugar.grupo_distanciay = 11;
						}
						if(grupo_posicion == 4) {
							locations[i].lugar.grupo_distanciax = 20;
							locations[i].lugar.grupo_distanciay = 16;
						}
						if(grupo_posicion == 5) {
							locations[i].lugar.grupo_distanciax = 0;
							locations[i].lugar.grupo_distanciay = 12;
						}
						if(grupo_posicion == 6) {
							locations[i].lugar.grupo_distanciax = 19;
							locations[i].lugar.grupo_distanciay = 10;
						}
						if(grupo_posicion == 7) {
							locations[i].lugar.grupo_distanciax = -1;
							locations[i].lugar.grupo_distanciay = -2;
						}
						locations[i].lugar.marker_posicion = grupo_posicion;

					}
				}
			}
			if(grupo_posicion > 7) {
				locations[i].lugar.grupo_distanciax = 0;
				locations[i].lugar.grupo_distanciay = 0;
				locations[i].lugar.nombre_icono = '';
			}
			else {
				extension_nombre_icono = "_" + locations[i].lugar.marker_posicion + '.png';
				locations[i].lugar.nombre_icono = icono_nombre.replace(".png",extension_nombre_icono);
			}
			locations[i].lugar.marker_posicion = grupo_posicion;
		}
		var folder_markers = 'markers/';
		var icono = new google.maps.MarkerImage((icono_url + icono_nombre), new google.maps.Size(20, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
		var icono_sombra = '';
		if (locations[i].lugar.marker_posicion==0) {
			icono_sombra = new google.maps.MarkerImage((icono_url + 'marca_sombra.png'), new google.maps.Size(37, 32), new google.maps.Point(0,0), new google.maps.Point(0, 32));
		}
		else {
			icono = new google.maps.MarkerImage((icono_url + folder_markers + locations[i].lugar.nombre_icono ), new google.maps.Size(35, 35), new google.maps.Point(0,0), new google.maps.Point(locations[i].lugar.grupo_distanciax, locations[i].lugar.grupo_distanciay));
		}
		var marker = new google.maps.Marker({
			position: latitude_longitude,
			map: map,
			shadow: icono_sombra,
			icon: icono,
			title: location.lugar.nombre,
			html: generarInfoGlobo(location),
			rotate: 180,
			zIndex: i
		});

		markersArray.push(marker);

		var ruts_prestadores = '';
		if (location.lugar.cercano == true) {
			if (location.prestadores.length == 1) {
				if (location.prestadores[0].nombre != null) {
					markers_valorizados.push(new MarkerValorizado(marker.getPosition(), location.prestadores[0].valorizacion));
				}
			} else if (location.prestadores.length > 1) {
				for (x = 0; x < location.prestadores.length; x++) {
					if (location.prestadores[x].nombre != null) {
						ruts_prestadores += location.prestadores[x].rut_prestador + ";";
					}
				}
				markers_valorizados.push(new MarkerValorizado(marker.getPosition(), '', ruts_prestadores, location.lugar.CodLugar));
			}
		}

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(this.html);
			infowindow.open(map, this);
			switchPaneles();

			$('#prestadores_' + this.zIndex).show();

			seleccionarLugar("lugar_" + this.zIndex);
			$('#direcciones_googlemap').scrollTo($("#lugar_" + this.zIndex), 1000, {margin:true});

			eliminarDivInfoValorizacion();
			desplegar_info_valorizacion = false;
		});
		if (i % 2 == 0) {
			var panel_direcciones = '<div class="lugar altrow" id="lugar_' + i + '">'
			+ '<img src=" ' + icono_url + icono_nombre + '" class="lugar_icono">'
			+ '<div class="lugar_descripcion">'
			+ generarInfoLugar(location, i)
			+ '</div>';
		} else {
			var panel_direcciones = '<div class="lugar" id="lugar_' + i + '">'
			+ '<img src=" ' + icono_url + icono_nombre + '" class="lugar_icono">'
			+ '<div class="lugar_descripcion">'
			+ generarInfoLugar(location, i)
			+ '</div>';
		}

		$('#direcciones_googlemap').append(panel_direcciones);
	}
}

function clearMarkers() {
	if (markersArray) {
		for (i in markersArray) {
			markersArray[i].setMap(null);
		}
	}
}

function showMarkers(id) {
	if (markersArray) {
		infowindow.setContent(markersArray[id].html);
		infowindow.open(map, markersArray[id]);
	}
}


function centrarDireccion(direccion, iconoPosicion) {
	geocoder = new google.maps.Geocoder();
	var address = direccion + ', Chile';
	var es_santiago = false;
	geocoder.geocode({
		'address': address
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			pza_armas = new google.maps.LatLng(-33.437856, -70.650394);
			if (es_santiago) {
				map.setCenter(pza_armas);
			} else {
				map.setCenter(results[0].geometry.location);
			}
			if (iconoPosicion == "aqui.png") {
				cargarLugares(obtenerAreaMapa());
			}

			if (mi_posicion_actual != "") {
				mi_posicion_actual.setMap(null);
			}

			var icono = new google.maps.MarkerImage((icono_url + iconoPosicion), new google.maps.Size(56, 62), new google.maps.Point(0, 0), new google.maps.Point(0, 62));

			if (es_santiago) {
				coordenadas_actual = pza_armas;
			} else {
				coordenadas_actual = results[0].geometry.location
			}

			mi_posicion_actual = new google.maps.Marker({
				map: map,
				icon: icono,
				position: coordenadas_actual,
				zIndex: -1
			});
		} else {
			alert("Geocode no se ha posicionado con éxito debido a: " + status);
		}
	});
}

function obtenerAreaMapa() {
	var bounds = map.getBounds();
	var southWest = bounds.getSouthWest();
	var northEast = bounds.getNorthEast();
	var filtros = new Object();
	filtros["x0"] = southWest.lat();
	filtros["y0"] = southWest.lng();
	filtros["x1"] = northEast.lat();
	filtros["y1"] = northEast.lng();
	return filtros;
}

function MyOverlay(options) {
	this.setValues(options);
}
