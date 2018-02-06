<?php

class PrestadoresController extends appController {

	var $uses = array('CfLugar', 'CfPrestador', 'Fonasa', 'HistorialConsulta', 'PrmGrupo', 'CfFinanciador');
	var $helpers = array('GoogleMap', 'Js', 'Session');
	var $components = array('RequestHandler', 'PuntosCercanos');

	function beforeFilter() {
		parent::beforeFilter();
	}

	/**
	 * Búsqueda inicial de lugares en el mapa filtrados por financiador
	 * @param int $cod_financiador código del financiador
	 */
	function buscar($cod_financiador = null) {
		$googlemap = Configure::read('googlemap');

		$default = array(
			'zoom' => $googlemap['zoom'],
			'latitud' => $googlemap['latitud'],
			'longitud' => $googlemap['longitud']
		);
		$lugares = $this->CfLugar->buscarArea($googlemap['coordenadas'], $cod_financiador);
		$this->set('grupos', $this->PrmGrupo->find('list', array('order' => array('glosa asc'))));
		$this->set('lugares', $lugares);
		$this->set('default', $default);

		if ($cod_financiador != null) {
			$this->set('configuracion', $this->Configuracion->obtenerFinanciador($cod_financiador));
		} else {
			$cod_financiador = 0;
		}
		$financiadores = $this->CfFinanciador->find('list');
		$this->set('financiadores', $financiadores);
		$this->set('cod_financiador', $cod_financiador);
	}

	/**
	 * Obtiene array con los lugares dentro del area del mapa y según filtros enviados por POST
	 */
	function obtenerLugares() {

		$coordenadas = explode(';', $this->data['filtros']);
		$puntos = array(
			'inicio' => array($coordenadas[0], $coordenadas[1]),
			'fin' => array($coordenadas[2], $coordenadas[3])
		);

		$cod_financiador = $this->data['cod_financiador'];

		if ($cod_financiador == "0") {
			$cod_financiador = null;
		}
		$filtros = array(
			'grupo' => $this->data['PrmGrupo_CodGrupo']
		);
		$lugares = $this->CfLugar->buscarArea($puntos, $cod_financiador, $filtros);
		if (isset($this->data['prestacion'])) {
			if ($this->data['zoom'] > Configure::read('zoom_minimo_valorizar') && $this->data['rut_beneficiario'] != '12345678-9' && stristr($this->data['prestacion'], '[')) {
				$codigo_prestacion = null;
				$punto_centro = array($this->data['punto_centro_lat'],$this->data['punto_centro_lng']);
				$this->PuntosCercanos->buscaPtosCercanos($lugares, $punto_centro, Configure::read('puntos_cercanos'));

				if (isset($this->data['prestacion']) && stristr($this->data['prestacion'], '[')) {
					$codigo_tmp = explode(']', $this->data['prestacion']);
					$codigo = $codigo_tmp[0];
					$codigo = explode('[', $codigo);
					$codigo_prestacion = $codigo[1];
				}
				$this->__valorizarCercanos($lugares, $this->data['rut_beneficiario'], $codigo_prestacion);
			}
		}

		if ($lugares === false) {
			$lugares = array();
		}

		if (isset($this->data['prestacion']) && $this->data['historico'] == 'si') {
			if ($this->data['rut_beneficiario'] != '12345678-9' && stristr($this->data['prestacion'], '[')) {
				$this->HistorialConsulta->guardarHistorial($this->data);
			}
		}

		$this->set('json', json_encode($lugares));
		$this->render('/elements/json');
	}

	/**
	 * Valoriza la prestación en los distintos lugares con los datos enviados por POST
	 */
	function valorizar() {
		Configure::write('debug', 0);
		$data = $this->params['form'];
		if (isset($data['prestacion']) && stristr($data['prestacion'], '[')) {
			$codigo_tmp = explode(']', $data['prestacion']);
			$codigo = $codigo_tmp[0];
			$codigo = explode('[', $codigo);
			$codigo_prestacion = $codigo[1];
		}
		$rut_beneficiario = $data['rut_beneficiario'];
		$codigo_lugar = $data['codigo_lugar'];
		if (strstr($data['rut_convenio'], ';')) {
			$prestadores = explode(';', $data['rut_convenio']);
		} else {
			$prestadores[] = $data['rut_convenio'];
		}
		$x = 0;
		foreach ($prestadores as $prestador) {
			$registro_prestador = $this->CfPrestador->read(null, $prestador);
			$rut_convenio = $prestador;
			$valorizar[$x]['prestador']['nombre'] = $registro_prestador['CfPrestador']['NombrePrestador'];
			$valorizar[$x++]['datos'] = $this->Fonasa->valorizar($rut_beneficiario, $codigo_lugar, $rut_convenio, $codigo_prestacion);
		}
		$this->set('json', json_encode($valorizar));
		$this->render('/elements/json');
	}

	/**
	 * Valoriza la prestación para el beneficiario indicado en los lugares que se encuentran en el array $lugares
	 * @param array $lugares Lista de lugares a valorizar
	 * @param string $rut_beneficiario RUT del beneficiario
	 * @param string $cod_prestacion código de la prestación a valorizar
	 * @return mixed Array con valorizaciones o false en caso de error
	 */
	function __valorizarCercanos(&$lugares, $rut_beneficiario, $cod_prestacion) {
		if (empty($lugares) || empty($rut_beneficiario) || empty($cod_prestacion)) {
			return false;
		}
		$valorizados = array();
		for ($x = 0; $x < count($lugares); $x++) {
			$cod_lugar = $lugares[$x]['lugar']['CodLugar'];
			if (count($lugares[$x]['prestadores']) == 1 && $lugares[$x]['lugar']['cercano'] == true) {
				$rut_convenio = $lugares[$x]['prestadores'][0]['rut_prestador'];
				$valorizado = $this->Fonasa->valorizar($rut_beneficiario, $cod_lugar, $rut_convenio, $cod_prestacion);
				$lugares[$x]['lugar']['cercano'] = true;
				$lugares[$x]['prestadores'][0]['valorizacion'] = number_format($valorizado['Respuesta']['Copago'], 0, ',', '.');
			}
		}
		return true;
	}

	/**
	 * Administración (Backend)
	 */
	function admin_index($es_ajax = false) {
		$texto = '';
		if (!$this->params['isAjax']) {
			$this->layout = 'admin';
		}
		if (!isset($this->passedArgs['texto'])) {
			$this->passedArgs['texto'] = '';
		}
		if (!empty($this->data)) {
			$texto = $this->data['Filtro']['texto'];
		} else {
			$texto = $this->passedArgs['texto'];
		}
		$texto = addslashes($texto);
		$this->passedArgs['texto'] = $texto;
		$this->paginate['limit'] = 10;
		$condiciones = array("CfPrestador.NombrePrestador LIKE '%$texto%' OR CfPrestador.RutPrestador LIKE '%$texto%'");
		$opciones = $condiciones;
		$this->CfPrestador->recursive = 0;
		$this->set('prestadores', $this->paginate('CfPrestador', $opciones));
		$this->set('es_ajax', $es_ajax);
		$this->set('texto', $texto);
	}

	function admin_add() {
		$this->layout = 'admin';
		if (!empty($this->data)) {
			$this->CfPrestador->create();
			if ($this->CfPrestador->save($this->data)) {
				$this->Session->setFlash('Se ha guardado exitosamente el prestador');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Ha ocurrido un error guardando el prestador, por favor intente nuevamente');
			}
		}
	}

	function admin_edit($id = null) {
		$this->layout = 'admin';
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash('Identificador no válido');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CfPrestador->save($this->data)) {
				$this->Session->setFlash("Prestador $id modificado correctamente.");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash("Error al guardar prestador $id, por favor intente nuevamente");
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CfPrestador->read(null, $id);
			$this->set('id', $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash('Identificador no válido');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CfPrestador->delete($id)) {
			$this->Session->setFlash("El prestador $id ha sido eliminado.");
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash("No se podido eliminar el prestador $id, compruebe que no tenga elementos asociados");
		$this->redirect(array('action' => 'index'));
	}

	function admin_archivo() {
		if (is_uploaded_file($this->data['Archivo']['archivo']['tmp_name'])) {
			$file = fopen($this->data['Archivo']['archivo']['tmp_name'], "r");
			$primera = true;
			while (($linea = fgetcsv($file, 500, ';')) !== FALSE) {
				if ($primera) {
					$primera = false;
					continue;
				}
				$contenido[] = array(
					'RutPrestador' => ltrim($linea[0],'0'),
					'NombrePrestador' => $linea[1]
				);
			}
			fclose($file);
			$cantidad = count($contenido);
			foreach ($contenido as $registro) {
				if (!$this->CfPrestador->save($registro)) {
					CakeLog::write('prestadores', 'Error al crear: ' . $registro['RutPrestador']);
				}
				$this->CfPrestador->id = null;
			}
		}
	}

}
