<?php
class CfFinanciador extends AppModel {
	var $name = 'CfFinanciador';
	var $useTable = 'CfFinanciador';
	var $primaryKey = 'CodFinanciador';
	var $displayField = 'NombreFinanciador';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'CfConvenio' => array(
			'className' => 'CfConvenio',
			'foreignKey' => 'CodFinanciador',
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