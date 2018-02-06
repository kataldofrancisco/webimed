<?php
class UsuariosController extends AppController {

	var $name = 'Usuarios';
	var $layout = 'admin';
	var $helpers = array('Session');

	function admin_index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Usuario->create();
			$this->data['Usuario']['activo'] = true;
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash("El usuario ha sido añadido exitosamente");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash("No se ha podido añadir al usuario, intente nuevamente");
			}
		}
		$this->set('CfFinanciador', $this->Usuario->CfFinanciador->find('list'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash("Usuario no válido");
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->data['Usuario']['password'] == '') {
				unset($this->data['Usuario']['password']);
			}
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash("El usuario $id ha sido modificado exitosamente");
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash("No se ha podido modificar al usuario $id, intente nuevamente");
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $id);
			$this->set('id', $id);
		}
		$this->set('CfFinanciador', $this->Usuario->CfFinanciador->find('list'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash("Usuario no válido");
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash("El usuario $id ha sido eliminado!");
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash("El usuario $id ha sido eliminado!");
		$this->redirect(array('action' => 'index'));
	}
}
?>
