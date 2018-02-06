<?php
function _array_clean($val) {
		if ($val>0) {
			return true;
		}
		return false;
	}
class ConveniosController extends AppController {
	/**
	 * @property CfConvenio $CfConvenio
	 * @property PrmAplicacion $PrmAplicacion
	 * @property PrmServicio $PrmServicio
	 * @property PrmGrupo $PrmGrupo
	 * @property Fonasa $Fonasa
	 */

	var $uses = array('CfConvenio', 'PrmAplicacion', 'PrmServicio', 'PrmGrupo', 'Fonasa');
	var $component = array('RequestHandler');
	var $helpers = array('Session');
	var $layout = 'admin';

	function admin_index() {
		$convenios = $this->paginate('CfConvenio');
		$this->set(compact('convenios'));
	}

	function admin_view($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid cf convenio', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('convenio', $this->CfConvenio->read(null, $id));
	}

	function admin_add() {
		$this->layout = 'ajax';
		$this->autorender = false;
		$this->data['CfConvenio']['FechaCreacion'] = date('Y-m-d H:i:s');
		if ($this->CfConvenio->saveAll($this->data)) {
			$retorno = array('estado' => 0, 'glosa' => 'OK');
		}
		$retorno = array('estado' => 0, 'glosa' => 'Error al guardar registro');
		$this->set('json', json_encode($retorno));
		$this->render('/elements/json');
	}

	function admin_edit($id = null) {
		$this->layout = 'ajax';
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid cf convenio', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CfConvenio->save($this->data)) {
				//$this->Session->setFlash(__('The cf convenio has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The cf convenio could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CfConvenio->read(null, $id);
		}
		$prmAplicaciones = $this->PrmAplicacion->find('list');
		$prmServicios = $this->PrmServicio->find('list');
		$prmGrupos = $this->PrmGrupo->find('list');
		$this->set(compact('prmComunas', 'prmAplicaciones', 'prmServicios', 'prmGrupos'));
		$this->set('convenio', $this->CfConvenio->read(null, $id));
		$this->render('/elements/convenio_edit');
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for cf convenio', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->CfConvenio->delete($id)) {
			//$this->Session->setFlash(__('Cf convenio deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->Session->setFlash(__('Cf convenio was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_archivo() {
		Configure::write('debug', 0);
		set_time_limit(0);
		if (!empty($this->data)) {
			if (is_uploaded_file($this->data['Archivo']['archivo']['tmp_name'])) {
				$file = fopen($this->data['Archivo']['archivo']['tmp_name'], "r");
				$primera = true;
				while (($linea = fgetcsv($file, 300, ';')) !== FALSE) {
					if ($primera) {
						$primera = false;
						continue;
					}
					$financiador = explode('-', $linea[1]);
					foreach ($financiador as $cod_financiador) {
						if (empty($cod_financiador)) {
							continue;
						}
						$linea_log[] = implode(';', $linea);
						$contenido[] = array(
							'CfConvenio' => array(
								'FechaCreacion' => date('Y-m-d H:i:s'),
								'CodLugar' => $linea[0],
								'CodFinanciador' => $cod_financiador,
								'RutPrestador' => ltrim($linea[2],'0'),
								'Activo' => 1,
							),
							'PrmGrupo' => array('PrmGrupo' => array_filter(explode('-', $linea[3]))),
							'PrmAplicacion' => array('PrmAplicacion' => array_filter(explode('-', $linea[4]))),
							'PrmServicio' => array('PrmServicio' => array_filter(explode('-', $linea[5])))
						);
					}
				}
				fclose($file);
				$cantidad = count($contenido);
				$i = -1;
				foreach ($contenido as $registro) {
					$i ++;
					$opciones = array(
						'conditions' => array(
							'CfConvenio.RutPrestador' => $registro['CfConvenio']['RutPrestador'],
							'CfConvenio.CodLugar' => $registro['CfConvenio']['CodLugar'],
							'CfConvenio.CodFinanciador' => $registro['CfConvenio']['CodFinanciador']
						)
					);
					$this->CfConvenio->recursive = -1;
					$existe = $this->CfConvenio->find('count', $opciones);
					if ($existe > 0) {
						continue;
					}
					if (!$this->CfConvenio->save($registro)) {
						CakeLog::write('convenios', $this->CfConvenio->obtenerErrorQuery());
						CakeLog::write('errores_carga','Error cargando registro :' . $linea_log[$i]);
						$errores[] = $registro;
					}
					$this->CfConvenio->id = null;
				}
				if (count($errores) > 0) {
					$retorno = array('Estado' => 1, 'Datos' => $errores);
				} else {
					$retorno = array('Estado' => 0);
				}
				$this->set('estado', $retorno);
			} else {
				$this->Session->setFlash("No se ha cargado un archivo csv");
			}
		}
		$this->render('/lugares/admin_archivo');
	}

	function admin_cargar() {
		set_time_limit(0);
		if (!empty($this->data)) {
			if (is_uploaded_file($this->data['Archivo']['archivo']['tmp_name'])) {
				$file = fopen($this->data['Archivo']['archivo']['tmp_name'], "r");
				$primera_linea = true;
				while (($linea = fgetcsv($file, 300, ';')) !== FALSE) {
					if ($primera_linea) {
						$primera_linea = false;
						continue;
					}
					$contenido[] = array(
						'RutConvenio' => ltrim($linea[0],'0'),
						'CodLugar' => $linea[1],
						'Grupo' => $linea[2]
					);
				}
				fclose($file);
				$total = count($contenido);
				foreach ($contenido as $convenio) {
					$convenios[$convenio['RutConvenio'].$convenio['CodLugar']][] = $convenio;
				}
				$this->CfConvenio->recursive = -1;
				$exito = 0;
				foreach ($convenios as $registro) {
					$condicion = array(
						'CfConvenio.RutPrestador' => $registro[0]['RutConvenio'],
						'CfConvenio.CodLugar' => $registro[0]['CodLugar']
					);
					$tupla_convenio = $this->CfConvenio->find('first', array('conditions' => $condicion));
					if (!empty($tupla_convenio)) {
						$id_convenio = $tupla_convenio['CfConvenio']['id'];
						$i = 0;
						$data = array();
						$cont_registros = 0;
						foreach ($registro as $reg) {
							$data[$i++] = $reg['Grupo'];
							$cont_registros ++;
						}
						$grabar = array(
							'CfConvenio' => $tupla_convenio['CfConvenio'],
							'PrmGrupo' => array('PrmGrupo' => $data)
						);
						if (!$this->CfConvenio->saveAll($grabar)) {
							CakeLog::write('convenios', $this->CfConvenio->obtenerErrorQuery());
						} else {
							$exito = $exito + $cont_registros;
						}
					} else {
						CakeLog::write('convenios', 'No existe RutPrestador->'.$registro[0]['RutConvenio'].' CodLugar->'.$registro[0]['CodLugar']);
					}
				}
				$this->Session->setFlash("Datos guardados exitosamente ($exito de $total)");

			} else {
				$this->Session->setFlash("No se ha cargado un archivo csv");
			}
		}
	}

}

?>
