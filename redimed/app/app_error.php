<?php
class AppError extends ErrorHandler {
	function conexionBaseDatos() {
		$this->controller->set('title_for_layout', 'Errores');
		$this->controller->layout = 'error';
		$this->_outputMessage('conexion_base_datos');
	}

	function error404() {
		$this->controller->set('title_for_layout', 'Errores');
		$this->controller->layout = 'error';
		$this->_outputMessage('error404');
	}

	function accesoDenegado() {
		$this->controller->set('title_for_layout', 'Errores');
		$this->controller->layout = 'error';
		$this->_outputMessage('acceso_denegado');
	}
}
?>
