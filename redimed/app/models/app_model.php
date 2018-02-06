<?php
class AppModel extends Model {

	function obtenerErrorQuery($formato = 'string') {
		$db = $this->getDataSource();
		switch ($formato) {
			case 'array':
				return array(
					'error_query' => $db->lastError(),
					'datos'       => $this->data
				);
				break;
			case 'string':
				return print_r($db->lastError(), true);
				break;
		}
	}
}
?>
