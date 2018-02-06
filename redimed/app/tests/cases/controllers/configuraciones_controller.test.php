<?php
/* Configuraciones Test cases generated on: 2011-01-17 17:01:30 : 1295296950*/
App::import('Controller', 'Configuraciones');

class TestConfiguracionesController extends ConfiguracionesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ConfiguracionesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.configuracion', 'app.cf_financiador', 'app.cf_convenio', 'app.cf_lugar', 'app.prm_comuna', 'app.cf_prestador', 'app.prm_servicio', 'app.convenios_servicio', 'app.prm_aplicacion', 'app.aplicaciones_convenio', 'app.prm_grupo', 'app.prm_prestacion', 'app.convenios_grupo');

	function startTest() {
		$this->Configuraciones =& new TestConfiguracionesController();
		$this->Configuraciones->constructClasses();
	}

	function endTest() {
		unset($this->Configuraciones);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>