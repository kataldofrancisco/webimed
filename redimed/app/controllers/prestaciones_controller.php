<?php
/**
 * Description of prestaciones_controller
 *
 * @author vladzur
 */
class PrestacionesController extends AppController {

	var $uses = array('PrmPrestacion', 'PrmGrupo');
	var $components = array('RequestHandler');

	function filtrar() {
		if (empty($this->params['form']['grupo'])) {
			return false;
		}
		$condiciones = array('PrmPrestacion.CodGrupo' => $this->params['form']['grupo']);
		$this->PrmPrestacion->recursive = -1;
		$prestaciones = $this->PrmPrestacion->find('all', array('conditions' => $condiciones));
		$this->set('json', json_encode($prestaciones));
		$this->render('/elements/json');
	}
}
?>
