<?php

class CfLugar extends AppModel {

	var $name = 'CfLugar';
	var $useTable = 'CfLugar';
	var $primaryKey = 'CodLugar';
	var $displayField = 'Nombre';
	var $validate = array(
		'CodLugar' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el codigo de lugar'
			)
		),
		'Nombre' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar el nombre del lugar'
			)
		),
		'CodComuna' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar la comuna del lugar'
			)
		),
		'Direccion' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe ingresar la dirección del lugar'
			)
		),
		'Longitud' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe presionar el boton "posicionar en el mapa" lugar'
			)
		),
		'Latitud' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true,
				'message' => 'Debe presionar el boton "posicionar en el mapa" lugar'
			)
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'PrmComuna' => array(
			'className' => 'PrmComuna',
			'foreignKey' => 'CodComuna',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'CfConvenio' => array(
			'className' => 'CfConvenio',
			'foreignKey' => 'CodLugar',
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

	/**
	 * Busca los lugares que se encuentran dentro del área delimitada por los pares de coordenadas recibidas
	 * Ejemplo:
	 * array(
	 * 	'inicio'=>array(-33.424604,-70.602005),
	 * 	'fin'=>array(-33.404684,-70.572095)
	 * )
	 *
	 * @param array $puntos arreglo de pares de coordenadas inicio(latitud,longitud), fin(latitud,longitud)
	 * @return mixed$lugares array con resultados o falso
	 * */
	function buscarArea($puntos = array(), $cod_financiador = null, $filtros = array()) {

		if (empty($puntos)) {
			return false;
		}
		$codigo_grupo = null;

		$lat1 = $puntos['inicio'][0];
		$long1 = $puntos['inicio'][1];
		$lat2 = $puntos['fin'][0];
		$long2 = $puntos['fin'][1];

		if (!empty($filtros)) {
			if (isset($filtros['grupo']) && $filtros['grupo'] > 0) {
				$codigo_grupo = $filtros['grupo'];
			}
		}
		$fields = array('CfLugar.CodLugar', 'CfLugar.latitud', 'CfLugar.longitud', 'CfLugar.nombre', 'CfLugar.direccion',
			'CfLugar.telefono', 'CfLugar.operativo', 'CfLugar.web',
			'Convenio.activo', 'Prestador.nombreprestador', 'Prestador.rutprestador');

		$joins = array(
			array('table' => 'CfConvenio',
				'alias' => 'Convenio',
				'type' => 'LEFT',
				'conditions' => array('Convenio.CodLugar = CfLugar.CodLugar')
			),
			array(
				'table' => 'CfPrestador',
				'alias' => 'Prestador',
				'type' => 'LEFT',
				'conditions' => array('Prestador.RutPrestador = Convenio.RutPrestador')
			),
		);

		$conditions = array(
			"CfLugar.latitud >" => $lat1,
			"CfLugar.latitud <" => $lat2,
			"CfLugar.longitud >" => $long1,
			"CfLugar.longitud <" => $long2
		);
		if (Configure::read('mostrar_lugares_inactivos') === false) {
			$conditions['CfLugar.Operativo'] = 1;
		}


		if (isset($codigo_grupo)) {
			$joins[] = array(
				'table' => 'convenios_grupos',
				'alias' => 'convenios_grupos',
				'type' => 'LEFT',
				'conditions' => array('Convenio.id = convenios_grupos.CfConvenio_id')
			);
			$joins[] = array(
				'table' => 'PrmGrupo',
				'alias' => 'Grupo',
				'type' => 'LEFT',
				'conditions' => array('convenios_grupos.PrmGrupo_CodGrupo = Grupo.CodGrupo')
			);
			$conditions[] = array('Grupo.CodGrupo' => $codigo_grupo);
		}

		if ($cod_financiador != null) {
			$conditions['Convenio.CodFinanciador'] = $cod_financiador;
		}

		$this->recursive = -1;

		$resultados = $this->find('all', array('joins' => $joins, 'fields' => $fields, 'conditions' => $conditions));

		if (empty($resultados)) {
			return false;
		}

		foreach ($resultados as $lugar) {
			$lugares[$lugar['CfLugar']['CodLugar']]['lugar'] = $lugar['CfLugar'];
			$lugares[$lugar['CfLugar']['CodLugar']]['prestadores'][] = array('nombre' => $lugar['Prestador']['nombreprestador'], 'rut_prestador' => $lugar['Prestador']['rutprestador']);
		}

		$limite_lugares_retornados = Configure::read('limite_lugares_retornados');
		$nro_lugares_retornados = 0;
		$lugares_retornados = array();
		foreach ($lugares as $lugar) {
			if ($nro_lugares_retornados >= $limite_lugares_retornados) {
				break;
			}
			$lugares_retornados[] = $lugar;
			$nro_lugares_retornados++;
		}
		return $lugares_retornados;
	}

	/**
	 * Guarda una lista de lugares y actualiza el campo Comuna con el código de la comuna
	 * @param Array $lugares
	 * @return boolean  true si éxito, false si fallo
	 */
	function guardarLugares($lugares) {
		App::import('model', 'prm_comuna');
		$Comuna = new PrmComuna();
		$errores = array();
		foreach ($lugares as $lugar) {
			$txt_comuna = mysql_real_escape_string(trim($lugar['Comuna']));
			$comuna = $Comuna->find('first', array('conditions' => array("PrmComuna.GlosaComuna LIKE '%$txt_comuna%'")));
			$lugar['CodComuna'] = $comuna['PrmComuna']['CodComuna'];
			$data[] = $lugar;
		}
		$lugares_total = 0;
		$lugares_todos = count($data);
		foreach ($data as $datum) {
			if ($this->save($datum, false)) {
				$lugares_total++;
			} else {
				CakeLog::write('debug', 'No se ha guardado ' . $datum['CodLugar']);
				$errores[] = $datum;
			}
			$this->id = null;
		}
		if (count($errores) > 0) {
			$retorno = array('Estado' => 1, 'Datos' => $errores);
		} else {
			$retorno = array('Estado' => 0);
		}
		return $retorno;
	}

}

?>
