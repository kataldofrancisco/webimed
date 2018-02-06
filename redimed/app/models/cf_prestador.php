<?php
class CfPrestador extends AppModel {
	var $name = 'CfPrestador';
	var $useTable = 'CfPrestador';
	var $primaryKey = 'RutPrestador';
	var $displayField = 'NombrePrestador';
	var $validate = array(
		'RutPrestador' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el rut del prestador'
			)
		),
		'NombrePrestador' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el nombre del prestador'
			)
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'CfConvenio' => array(
			'className' => 'CfConvenio',
			'foreignKey' => 'RutPrestador',
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
