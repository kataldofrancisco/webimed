<?php

class ActualizarCoordenadasShell extends Shell {

	var $uses = array('CfLugar', 'GeoCoding', 'PrmComuna');

	function main() {
		$lugares_sin_coordenadas = $this->CfLugar->find('all', array('conditions' => array('Longitud' => null)));
		if (!$lugares_sin_coordenadas) {
			$this->out('Proceso 0 lugares sin coordenadas');
			return true;
		}
		$this->out('Procesando ' . count($lugares_sin_coordenadas) . ' lugares sin coordenadas ' . date('Y-m-d H:i:s'));
		foreach ($lugares_sin_coordenadas as $lugares_sin_coordenada) {
			$retorno = $this->getCoordenadas($lugares_sin_coordenada['CfLugar']);
			if ($retorno != false) {
				$this->CfLugar->save($retorno);
				echo ".";
			} else {
				echo "X";
			}
		}
		$this->out('Proceso finalizado.' . date('Y-m-d H:i:s'));
	}

	function getCoordenadas($registro) {
		App::import('Core', 'xml');
		$comuna = $this->PrmComuna->read(null, $registro['CodComuna']);
		$direccion_f = str_replace(' ', '+', $registro['Direccion']);
		$comuna_f = str_replace(' ', '+', $comuna['PrmComuna']['GlosaComuna']);
		$direccion = "$direccion_f+$comuna_f+chile";
		$respuesta = $this->GeoCoding->obtenerCoordenadas($direccion);
		$xml = new Xml($respuesta);
		$axml = $xml->toArray();
		if ($axml['GeocodeResponse']['status'] == 'OK') {
			//$direccion = explode(',', $axml['GeocodeResponse']['Result']['formatted_address']);
			if (!empty($axml['GeocodeResponse']['Result']['Geometry']['Location'])) {
				$registro['Latitud'] = $axml['GeocodeResponse']['Result']['Geometry']['Location']['lat'];
				$registro['Longitud'] = $axml['GeocodeResponse']['Result']['Geometry']['Location']['lng'];
				return $registro;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}

?>
