<?php
/* Configuracion Test cases generated on: 2011-01-17 17:01:23 : 1295296883*/
App::import('Model', 'Configuracion');

class ConfiguracionTestCase extends CakeTestCase {
	var $fixtures = array('app.configuracion', 'app.cf_financiador', 'app.cf_convenio', 'app.cf_lugar', 'app.prm_comuna', 'app.cf_prestador', 'app.prm_servicio', 'app.convenios_servicio', 'app.prm_aplicacion', 'app.aplicaciones_convenio', 'app.prm_grupo', 'app.prm_prestacion', 'app.convenios_grupo');

	function startTest() {
		$this->Configuracion =& ClassRegistry::init('Configuracion');
	}

	function endTest() {
		unset($this->Configuracion);
		ClassRegistry::flush();
	}

}
?>