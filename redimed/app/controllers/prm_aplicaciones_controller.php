<?php
class PrmAplicacionesController extends AppController {

	var $name = 'PrmAplicaciones';
	var $layout = 'admin';


	function admin_index() {
		$this->PrmAplicacion->recursive = 0;
		$this->set('prmAplicaciones', $this->paginate());
	}


	function admin_add() {
		if (!empty($this->data)) {
			$this->PrmAplicacion->create();
			if ($this->PrmAplicacion->save($this->data)) {
				//$this->Session->setFlash(__('The prm aplicacion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm aplicacion could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid prm aplicacion', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrmAplicacion->save($this->data)) {
				//$this->Session->setFlash(__('The prm aplicacion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm aplicacion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrmAplicacion->read(null, $id);
			$this->set('id', $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for prm aplicacion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrmAplicacion->delete($id)) {
			//$this->Session->setFlash(__('Prm aplicacion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->Session->setFlash(__('Prm aplicacion was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
