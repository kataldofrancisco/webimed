<?php

class HistorialConsultasController extends AppController{
	var $uses = Array('HistorialConsulta'); //nombre de las clases de los modelos
	var $name = 'HistorialConsulta';

	function guardarHistorial() {
		Configure::write('debug', 0);
		$this->layout = 'ajax';
		$codigo_tmp =  explode(']',$this->data['prestacion']);
		$codigo = $codigo_tmp[0];
		$codigo = explode('[', $codigo);
		$this->data['PrmPrestacion_CodPrestacion'] = $codigo[1];
		if ($this->HistorialConsulta->save($this->data)) {
			$retorno = array('estado'=>0, 'glosa'=>'');
		} else {
			$retorno = array('estado'=>1, 'glosa'=>'No se guardaron datos');
		}
		$this->set('json', json_encode($this->data));
		$this->render('/elements/json');
	}
}


?>
