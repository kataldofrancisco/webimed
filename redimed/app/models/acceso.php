<?php
class Acceso extends AppModel {
	var $name = 'Acceso';
	var $useTable = 'accesos';
	var $primaryKey = 'id';

	var $hasMany = array(
		'AccesoSistema' => array(
			'className' => 'AccesoSistema',
			'foreignKey' => 'acceso_id'
		)
	);
}
?>
