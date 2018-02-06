<?php
class PrmGruposController extends AppController {

	var $helpers = array('Session');
	var $name = 'PrmGrupos';
	var $layout = 'admin';

	function admin_index() {
		$this->PrmGrupo->recursive = 0;
		$this->set('prmGrupos', $this->paginate());
	}


	function admin_add() {
		if (!empty($this->data)) {
			$this->PrmGrupo->create();
			if ($this->PrmGrupo->save($this->data)) {
				$this->Session->setFlash('El grupo ha sido agregado correctamente.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('El grupo no se ha podido guardar correctamente, por favor intente nuevamente.');
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid prm grupo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrmGrupo->save($this->data)) {
				$this->Session->setFlash("El grupo $id ha sido modificado correctamente.");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash("El grupo $id no se ha podido modificar, por favor intente nuevamente");
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrmGrupo->read(null, $id);
                        $this->set('id', $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for prm grupo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrmGrupo->delete($id)) {
			$this->Session->setFlash("El grupo $id ha sido eliminado.");
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash("El grupo $id no se ha podido eliminar, compruebe que no tenga elementos asociados");
		$this->redirect(array('action' => 'index'));
	}
}
?>
