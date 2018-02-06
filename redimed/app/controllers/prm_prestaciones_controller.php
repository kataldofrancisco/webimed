<?php
class PrmPrestacionesController extends AppController {

	var $name = 'PrmPrestaciones';
	var $layout = 'admin';

	function admin_index() {
		$this->PrmPrestacion->recursive = 0;
		$this->set('prmPrestaciones', $this->paginate());
	}


	function admin_add() {
		if (!empty($this->data)) {
			$this->PrmPrestacion->create();
			if ($this->PrmPrestacion->save($this->data)) {
				//$this->Session->setFlash(__('The prm prestacion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm prestacion could not be saved. Please, try again.', true));
			}
		}
		$prmGrupos = $this->PrmPrestacion->PrmGrupo->find('list');
		$this->set(compact('prmGrupos'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid prm prestacion', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrmPrestacion->save($this->data)) {
				//$this->Session->setFlash(__('The prm prestacion has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm prestacion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrmPrestacion->read(null, $id);
		}
		$prmGrupos = $this->PrmPrestacion->PrmGrupo->find('list');
		$this->set(compact('prmGrupos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for prm prestacion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrmPrestacion->delete($id)) {
			//$this->Session->setFlash(__('Prm prestacion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->Session->setFlash(__('Prm prestacion was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
