<?php
class PrmComuna extends AppModel {
	var $name = 'PrmComuna';
	var $useTable = 'PrmComuna';
	var $primaryKey = 'CodComuna';
	var $displayField = 'GlosaComuna';
        var $validate = array(
		'CodComuna' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el codigo de la comuna'
			)
		),
		'GlosaComuna' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el nombre de la comuna'
			)
		),
	);
}
?>