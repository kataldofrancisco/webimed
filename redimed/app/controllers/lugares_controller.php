<?php

class LugaresController extends AppController {

	var $uses = array('CfLugar', 'Fonasa', 'GeoCoding', 'PrmAplicacion', 'PrmServicio', 'PrmGrupo', 'CfFinanciador');
	var $helpers = array('GoogleMap', 'Session');
	var $component = array('RequestHandler');
	var $layout = 'admin';

	function admin_index() {
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
		if (!empty($texto)) {
			$this->paginate['conditions'] = array(
				'CfLugar.Direccion LIKE \'%' . $texto . '%\' OR CfLugar.Nombre LIKE \'%' . $texto . '%\' OR CfLugar.CodLugar LIKE \'%' . $texto . '%\''
			);
		}
		$lugares = $this->paginate('CfLugar');
		$this->set(compact('lugares'));
	}

	function admin_add() {
		$googlemap = Configure::read('googlemap');

		$default = array(
			'zoom' => $googlemap['zoom'],
			'latitud' => $googlemap['latitud'],
			'longitud' => $googlemap['longitud']
		);

		if (!empty($this->data)) {
			$this->CfLugar->create();
			if ($this->CfLugar->save($this->data)) {
				$id = $this->CfLugar->id;
				$this->redirect(array('action' => 'edit', $id));
			} else {
				$this->Session->setFlash(__('The cf lugar could not be saved. Please, try again.', true));
			}
		}
		$prmComunas = $this->CfLugar->PrmComuna->find('list');
		$this->set(compact('prmComunas'));
	}

	function admin_edit($id = null) {
		$admin_imed = false;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cf lugar', true));
			$this->redirect(array('action' => 'index'));
		}
		$usuario = $this->Session->read('usuario');
		if (empty($usuario['Usuario']['CfFinanciador_CodFinanciador'])) {
			$admin_imed = true;
		}

		if (!empty($this->data)) {
			if ($admin_imed) {
				if ($this->CfLugar->save($this->data)) {
					$this->Session->setFlash("Lugar $id modificado exitosamente");
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash("No se ha podido modificar el lugar $id, intente nuevamente");
				}
			} else {
				$this->set('error', 'No puede modificar este lugar, permisos insuficientes');
			}
		}

		if (empty($this->data)) {
			$this->data = $this->CfLugar->read(null, $id);
		}
		$prmComunas = $this->CfLugar->PrmComuna->find('list');
		$prmAplicaciones = $this->PrmAplicacion->find('list');
		$prmServicios = $this->PrmServicio->find('list');
		$prmGrupos = $this->PrmGrupo->find('list');
		$usuario = $this->Session->read('usuario');
		$cod_financiador = $usuario['Usuario']['CfFinanciador_CodFinanciador'];
		$opciones = array();
		if (!empty($cod_financiador)) {
			$opciones = array('conditions' => array('CodFinanciador' => $cod_financiador));
		}
		$this->set('cod_financiador', $cod_financiador);
		$this->set(compact('prmComunas', 'prmAplicaciones', 'prmServicios', 'prmGrupos'));
		$this->set('lugar', $this->CfLugar->read(null, $id));
		$this->set('id', $id);
		$this->set('financiador', $this->CfFinanciador->find('list', $opciones));
		$this->set('admin_imed', $admin_imed);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash("Código de lugar no válido");
			$this->redirect(array('action' => 'index'));
		}
		if ($this->CfLugar->delete($id)) {
			$this->Session->setFlash("Lugar $id eliminado!");
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash("El lugar $id no se ha podido eliminar, compruebe que esté vacío");
		$this->redirect(array('action' => 'index'));
	}

	function admin_archivo() {
		Configure::write('debug', 0);
		App::import('Core', 'xml');
		if (!empty($this->data)) {
			if (is_uploaded_file($this->data['Archivo']['archivo']['tmp_name'])) {
				$file = fopen($this->data['Archivo']['archivo']['tmp_name'], "r");
				$primera = true;
				while (($linea = fgetcsv($file, 500, ';')) !== FALSE) {
					if ($primera) {
						$primera = false;
						continue;
					}
					$contenido[] = array(
						'CodLugar' => $linea[0],
						'Nombre' => $linea[1],
						'Direccion' => $linea[2],
						'Comuna' => $linea[3],
						'Telefono' => $linea[4],
						'Web' => $linea[5],
						'Operativo' => $linea[6]
					);
				}
				fclose($file);
				foreach ($contenido as $registro) {
					$direccion = $registro['Direccion'] . ', ' . $registro['Comuna'];
					$registro['Latitud'] = null;
					$registro['Longitud'] = null;
					if ($registro['Web'] == '#') {
						$registro['Web'] = null;
					}
					$salida[] = $registro;
				}
				$cantidad = count($salida);
				$retorno = $this->CfLugar->guardarLugares($salida);
				$this->set('estado', $retorno);
			} else {
				$this->Session->setFlash("No se ha cargado un archivo csv");
			}
		}
	}

}

?>
