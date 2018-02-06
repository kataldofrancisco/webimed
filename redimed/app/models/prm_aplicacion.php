<?php
class PrmAplicacion extends AppModel {
	var $name = 'PrmAplicacion';
	var $useTable = 'PrmAplicacion';
	var $primaryKey = 'CodAplicacion';
	var $displayField = 'Glosa';
	var $validate = array(
		'CodAplicacion' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el código de la aplicación'
			)
		),
		'Glosa' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar una glosa para la imagen'
			)
		),
		'Imagen' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el nombre de la imagen'
			)
		),
	);
}
?>
