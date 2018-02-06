<?php
class Usuario extends AppModel {
	var $name = 'Usuario';
	var $displayField = 'rut';

	var $belongsTo = array(
		'CfFinanciador' => array(
			'className' => 'CfFinanciador',
			'foreignKey' => 'CfFinanciador_CodFinanciador'
		)
	);

	var $hasMany = array(
		'Acceso' => array(
			'className' => 'Acceso',
			'foreignKey' => 'usuario_id'
		)
	);

	function beforeSave() {
		if (isset($this->data['Usuario']['password'])) {
			$this->data['Usuario']['password'] = md5($this->data['Usuario']['password']);
		}
		return true;
	}

	function beforeFind($queryData) {
		$queryData['conditions']['Usuario.deleted'] = 0;
		return $queryData;
	}

	function beforeDelete() {
		$data['Usuario']['id'] = $this->id;
		$data['Usuario']['deleted'] = 1;
		$this->save($data);
		return false;
	}

	function autentificar($datos_login) {
		if (!isset($datos_login)) {
			return false;
		}
		$condiciones = array(
			'Usuario.rut' => $datos_login['rut'],
			'Usuario.password' => md5($datos_login['password']),
			'Usuario.activo' => 1
		);
		$usuario = $this->find('first', array('conditions' => $condiciones));
		if (!empty($usuario)) {
			return $usuario;
		}
		return false;
	}
}
?>
