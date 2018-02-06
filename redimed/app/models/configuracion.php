<?php
class Configuracion extends AppModel {
	var $name = 'Configuracion';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'CfFinanciador' => array(
			'className' => 'CfFinanciador',
			'foreignKey' => 'cod_financiador',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function obtenerFinanciador($cod_financiador = null) {
		if (empty($cod_financiador)) {
			$configuracion = $this->find('all', array('conditions' => array('cod_financiador IS NULL')));
			$configuracion = current($configuracion);
		} else {
			$configuracion = $this->findByCodFinanciador($cod_financiador);
		}

		if (!empty($configuracion)) {
			return $configuracion['Configuracion'];
		} else {
			return false;
		}
	}
}
?>
