<?php
class PrmServiciosController extends AppController {

	var $name = 'PrmServicios';
	var $layout = 'admin';

	function admin_index() {
		$this->PrmServicio->recursive = 0;
		$this->set('prmServicios', $this->paginate());
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PrmServicio->create();
			if ($this->PrmServicio->save($this->data)) {
				//$this->Session->setFlash(__('The prm servicio has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm servicio could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid prm servicio', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrmServicio->save($this->data)) {
				//$this->Session->setFlash(__('The prm servicio has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm servicio could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrmServicio->read(null, $id);
                        $this->set('id', $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for prm servicio', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrmServicio->delete($id)) {
			//$this->Session->setFlash(__('Prm servicio deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->Session->setFlash(__('Prm servicio was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
