<?php
/* Configuracion Fixture generated on: 2011-01-17 17:01:23 : 1295296883 */
class ConfiguracionFixture extends CakeTestFixture {
	var $name = 'Configuracion';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 5, 'key' => 'primary'),
		'cod_financiador' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'imagen' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'url_webservice' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'valorizar' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1),
		'fondo1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fondo1_borde' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fondo2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fondo2_over' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fondo2_seleccionado' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fondo3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'fondo3_borde' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'link1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'link1_over' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'link2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'link2_over' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'titulo1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'titulo2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'titulo3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'cod_financiador' => 1,
			'imagen' => 'Lorem ipsum dolor sit amet',
			'url_webservice' => 'Lorem ipsum dolor sit amet',
			'valorizar' => 1,
			'fondo1' => 'Lorem',
			'fondo1_borde' => 'Lorem',
			'fondo2' => 'Lorem',
			'fondo2_over' => 'Lorem',
			'fondo2_seleccionado' => 'Lorem',
			'fondo3' => 'Lorem',
			'fondo3_borde' => 'Lorem',
			'link1' => 'Lorem',
			'link1_over' => 'Lorem',
			'link2' => 'Lorem',
			'link2_over' => 'Lorem',
			'titulo1' => 'Lorem',
			'titulo2' => 'Lorem',
			'titulo3' => 'Lorem'
		),
	);
}
?>