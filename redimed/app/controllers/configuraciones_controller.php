<?php
class ConfiguracionesController extends AppController {

	var $name = 'Configuraciones';
	var $layout = 'admin';

	function admin_index() {
		$this->Configuracion->recursive = 0;
		$this->set('configuraciones', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->redirect(array('action' => 'index'));
		}
		$this->set('configuracion', $this->Configuracion->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Configuracion->create();
			if ($this->Configuracion->save($this->data)) {
				$this->redirect(array('action' => 'index'));
			} else {
				////$this->Session->setFlash(__('The configuracion could not be saved. Please, try again.', true));
			}
		}
		$cfFinanciadores = $this->Configuracion->CfFinanciador->find('list');
		$this->set(compact('cfFinanciadores'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid configuracion', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Configuracion->save($this->data)) {
				//$this->Session->setFlash(__('The configuracion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The configuracion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Configuracion->read(null, $id);
		}
		$cfFinanciadores = $this->Configuracion->CfFinanciador->find('list');
		$this->set(compact('cfFinanciadores'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for configuracion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Configuracion->delete($id)) {
			//$this->Session->setFlash(__('Configuracion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->Session->setFlash(__('Configuracion was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
