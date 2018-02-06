<?php
class AccesoSistema extends AppModel {
	var $name = 'AccesoSistema';
	var $useTable = 'accesos_sistema';
	var $primaryKey = 'id';

	var $belongsTo = array(
		'Acceso' => array(
			'className' => 'Acceso',
			'foreignKey' => 'id'
		)
	);
}
?>
