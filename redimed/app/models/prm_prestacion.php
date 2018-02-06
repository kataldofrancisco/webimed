<?php
class PrmPrestacion extends AppModel {
	var $name = 'PrmPrestacion';
	var $useTable = 'PrmPrestacion';
	var $primaryKey = 'CodPrestacion';
	var $displayField = 'glosa';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'PrmGrupo' => array(
			'className' => 'PrmGrupo',
			'foreignKey' => 'CodGrupo',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>