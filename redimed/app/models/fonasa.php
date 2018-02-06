<?php
/**
 * Consumo de WS para valorización de prestaciones
 *
 * @author vzurita
 */
App::import('Model','i_valorizacion');
class Fonasa  implements i_valorizacion {

	function  __construct() {
		$tipo_acceso = Configure::read('tipo_acceso');
		$this->url = Configure::read('Fonasa.'.$tipo_acceso);
	}

	function valorizar($rut_beneficiario, $codigo_lugar, $rut_convenio, $codigo_prestacion) {
		Configure::write('debug', 0);
		$item[] = array(
			'CodPrestacion' => $codigo_prestacion,
			'CodItem' => '0',
			'Cantidad' => 1,
		);
		$options = array(
			'trace' => 1,
			'cache_wsdl' => WSDL_CACHE_NONE,
			'connection_timeout' => 5
		);

		$ws = new SoapClient($this->url, $options);
		try {
		$respuesta = $ws->ValPresFona(1,str_pad($rut_beneficiario, 12, '0', STR_PAD_LEFT),$codigo_lugar,(String)str_pad($rut_convenio, 12, '0', STR_PAD_LEFT),$item);
		} catch(SoapFault $e) {
		 CakeLog::write('webservice', print_r($e->getMessage(), true));
		}
		//CakeLog::write('webservice', print_r($ws->__getLastRequest() , true));
		$monto_bonificacion = 0;
		$monto_copago = 0;
		if ($respuesta['CodError'] != 0) {
			CakeLog::write('webservice', $codigo_lugar.'->'.$respuesta['CodError'].':'.$respuesta['GloError']);
		}
		if (isset($respuesta['LisPrestVal'][0][0]->MontoBonif)) {
			$monto_bonificacion = $respuesta['LisPrestVal'][0][0]->MontoBonif;
		}
		if (isset($respuesta['LisPrestVal'][0][0]->MontoCopago)) {
			$monto_copago = $respuesta['LisPrestVal'][0][0]->MontoCopago;
		}
		$retorno = array(
			'Error' => array(
				'Codigo' => $respuesta['CodError'],
				'Glosa' => $respuesta['GloError']
			),
			'Respuesta' => array(
				'Monto' => $monto_bonificacion + $monto_copago,
				'Copago' => $monto_copago
			)
		);
		return $retorno;
	}
}
?>
