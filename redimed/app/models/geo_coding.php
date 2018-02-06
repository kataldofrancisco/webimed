<?php

/**
 * Description of google_map
 *
 * @author vzurita
 */

class GeoCoding {

	/**
	 * Obtiene la información de geo-localización que Google tiene de la dirección entregada
	 *
	 * @param string $direccion Dirección buscada
	 * @param string $tipo Salida requerida ('json'/'xml') por defecto 'xml'
	 * @return string Formato según $tipo
	 */
	function obtenerCoordenadas($direccion, $tipo = 'xml') {
		App::import('Core', 'HttpSocket');
		$parametros = array(
			'address' => $direccion,
			'sensor' => 'false'
		);
		$HttpSocket = new HttpSocket();
		$respuesta = $HttpSocket->get("http://maps.googleapis.com/maps/api/geocode/$tipo", $parametros);
		return $respuesta;
	}
}
?>
