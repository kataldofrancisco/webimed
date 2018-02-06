<?php
class PrmComunasController extends AppController {

	var $name = 'PrmComunas';
	var $layout = 'admin';
	var $components = array('RequestHandler');

	function admin_index() {
		$this->PrmComuna->recursive = 0;
		$this->set('prmComunas', $this->paginate());
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PrmComuna->create();
			if ($this->PrmComuna->save($this->data)) {
				//$this->Session->setFlash(__('The prm comuna has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm comuna could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			//$this->Session->setFlash(__('Invalid prm comuna', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PrmComuna->save($this->data)) {
				//$this->Session->setFlash(__('The prm comuna has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				//$this->Session->setFlash(__('The prm comuna could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PrmComuna->read(null, $id);
            $this->set('id', $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			//$this->Session->setFlash(__('Invalid id for prm comuna', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PrmComuna->delete($id)) {
			//$this->Session->setFlash(__('Prm comuna deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		//$this->Session->setFlash(__('Prm comuna was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function cargar_comunas() {
		if (empty($this->params['form']['region'])) {
			return false;
		}
		$region = $this->params['form']['region'];
		$condiciones = array("PrmComuna.CodComuna Like '".$region."___'");
		$comunas = $this->PrmComuna->find('list', array('conditions' => $condiciones));
		$this->set('json', json_encode($comunas));
		$this->render('/elements/json');
	}
}
?>
