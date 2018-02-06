<?php
class CfConvenio extends AppModel {
	var $name = 'CfConvenio';
	var $useTable = 'CfConvenio';
	var $primaryKey = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'CfFinanciador' => array(
			'className' => 'CfFinanciador',
			'foreignKey' => 'CodFinanciador',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CfLugar' => array(
			'className' => 'CfLugar',
			'foreignKey' => 'CodLugar',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CfPrestador' => array(
			'className' => 'CfPrestador',
			'foreignKey' => 'RutPrestador',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'PrmServicio' => array(
			'className' => 'PrmServicio',
			'joinTable' => 'convenios_servicios',
			'foreignKey' => 'convenio_id',
			'associationForeignKey' => 'CodServicio',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'PrmAplicacion' => array(
			'className' => 'PrmAplicacion',
			'joinTable' => 'aplicaciones_convenios',
			'foreignKey' => 'convenio_id',
			'associationForeignKey' => 'CodAplicacion',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'PrmGrupo' => array(
			'className' => 'PrmGrupo',
			'joinTable' => 'convenios_grupos',
			'foreignKey' => 'CfConvenio_id',
			'associationForeignKey' => 'PrmGrupo_CodGrupo'
		)
	);

	/*var $hasMany = array(
		'ConvenioGrupoPrestacion' => array(
			'className' => 'ConvenioGrupoPrestacion',
			'foreignKey' => 'CfConvenio_id'
		)
	);*/

}
?>
