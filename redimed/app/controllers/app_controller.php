<?php

class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Javascript', 'Js' => array('Jquery'), 'Paginator');
	var $uses = array('Configuracion', 'Acceso');

	function beforeFilter() {
		header('Cache-Control: no-cache, must-revalidate'); // Evitar guardado en cache del cliente HTTP/1.1
		header('Pragma: no-cache'); // Evitar guardado en cache del cliente HTTP/1.0
		header('Cache-control: private');

		$controlador_activo = $this->params['controller'];
		$this->set('controlador_activo' , $controlador_activo);

		//seteamos el usuario activo
		$usuario_activo = $this->Session->read('usuario');
		$this->set('usuario_activo', $usuario_activo);

		// Verifica que la Base de datos esté disponible
		$this->_verificarConexionBaseDatos();
		$this->set('configuracion', $this->Configuracion->obtenerFinanciador());

		if (!$this->_verificaPermisos()) {
			$this->cakeError('accesoDenegado');
			exit;
		}

		if ($this->_verificarSesion()) {
			return true;
		} else {
			$origen = array(
				'controller' => $this->params['controller'],
				'action' => $this->params['action']
			);
			$this->Session->write('origen_llamado', $origen);
			$this->redirect(array('controller' => 'sesiones', 'action' => 'login'));
		}
	}

	/**
	 * Verifica que la base de datos esté disponible
	 * @return bool
	 */
	function _verificarConexionBaseDatos() {
		if (!class_exists('ConnectionManager')) {
			require LIBS . 'model' . DS . 'connection_manager.php';
		}
		$db = ConnectionManager::getInstance();
		@$connected = $db->getDataSource('default');

		if (!$connected->isConnected()) {
			$this->cakeError('conexionBaseDatos');
			exit;
		}
		return true;
	}

	function _verificarSesion() {
		if (!isset($this->params['admin'])) {
			return true;
		}

		if ($this->params['controller'] == 'sesiones') {
			return true;
		}

		$hash_sesion = $this->Session->read('hash_sesion');

		if ($hash_sesion == Configure::read('hash_sesion') && !empty($hash_sesion)) {
			$this->set('sesion_iniciada', true);

			$this->Acceso->AccesoSistema->save(
				array(
					'acceso_id' => $this->Session->read('acceso_id'),
					'evento' => $this->params['url']['url'],
					'fecha_acceso' => date('Y-m-d H:i:s'),
				)
			);

			return true;
		}

		return false;
	}

	function _verificaPermisos() {
		if (!isset($this->params['admin'])) {
			return true;
		}
		$usuario = $this->Session->read('usuario');
		if (empty($usuario['Usuario']['CfFinanciador_CodFinanciador'])) {
			return true;
		}
		$controlador = $this->params['controller'];
		$accion = $this->params['action'];
		$pass = $this->params['pass'];
		$permitidos = array(
			'lugares' => array('admin_index', 'admin_add', 'admin_edit'),
			'convenios' => array('admin_add', 'admin_edit', 'admin_delete'),
			'prestadores' => array('admin_index')
		);
		if ($controlador == 'usuarios' && $accion == 'admin_edit' && $pass[0] == $usuario['Usuario']['id']) {
			return true;
		}
		if (array_key_exists($controlador, $permitidos)) {
			if (in_array($accion, $permitidos[$controlador])) {
				return true;
			}
		}
		return false;
	}
}
