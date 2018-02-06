<?php
class PrmGrupo extends AppModel {
	var $name = 'PrmGrupo';
	var $useTable = 'PrmGrupo';
	var $primaryKey = 'CodGrupo';
	var $displayField = 'Glosa';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'PrmPrestacion' => array(
			'className' => 'PrmPrestacion',
			'foreignKey' => 'CodGrupo',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>