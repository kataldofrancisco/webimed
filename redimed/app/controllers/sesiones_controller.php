<?php
/**
 * Controlador de sesiones
 *
 * @author vzurita
 */
class SesionesController extends AppController {

	var $uses = array('Usuario', 'Acceso');

	function admin_login($controlador_origen = null, $accion_origen = null) {
		$usuario = false;
		if (!empty($this->data)) {
			$data = $this->data['Sesiones'];
			$rut = explode('-', $data['rut']);
			$data['rut'] = $rut[0];
			$usuario = $this->Usuario->autentificar($data);
			if ($usuario) {
				$this->Session->write('hash_sesion', Configure::read('hash_sesion'));
				$this->Session->write('usuario', $usuario);
				$origen = $this->Session->read('origen_llamado');

				$this->Acceso->save(
					array(
						'usuario_id' => $usuario['Usuario']['id'],
						'fecha_acceso' => date('Y-m-d H:i:s')
					)
				);

				$this->Session->write('acceso_id', $this->Acceso->id);

				if (!empty($origen)) {
					$this->Session->write('origen_llamado', '');
					$this->redirect($origen);
				}
				$this->redirect(array('admin' => true, 'controller' => 'usuarios', 'action' => 'index'));
			} else {
				$this->set('error_login', true);
			}
		}
	}

	function cerrar() {
		$this->Session->destroy();
		$this->redirect('/');
	}
}
?>
