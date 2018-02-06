<?php

/**
 * Description of puntos_cercanos
 *
 * @author jborquez
 */
class PuntosCercanosComponent extends Object {
	

	function buscaPtosCercanos(&$lugares, $punto_centro, $cantidad) {
		$distancias = array();
		$x1 = $punto_centro[0];
		$y1 = $punto_centro[1];
		
		for ($x = 0; $x < count($lugares); $x++) {
			$x2 = $lugares[$x]['lugar']['latitud'];
			$y2 = $lugares[$x]['lugar']['longitud'];
			$lugares[$x]['lugar']['distancia'] = sqrt(pow($x1 - $x2, 2) + pow($y1 - $y2, 2));
			$lugares[$x]['lugar']['cercania'] = count($lugares);
			$lugares[$x]['lugar']['cercano'] = false;
		}

		for ($x = 0; $x < count($lugares); $x++) {
			for ($y = 0; $y < count($lugares); $y++) {
				if($lugares[$x]['lugar']['distancia']<$lugares[$y]['lugar']['distancia']) {
					$lugares[$x]['lugar']['cercania']--;
				}
			}
		}

		for ($x = 0; $x < count($lugares); $x++) {
			if($lugares[$x]['lugar']['cercania'] <= $cantidad) {
				$lugares[$x]['lugar']['cercano'] = true;
			}
		}

		//return $distancias;
	}

	/**
	 * Ordena un array multidimensional
	 * @param array $toOrderArray el array a ordenar
	 * @param string $field el campo por el cual ordenar
	 * @param bool $inverse orden del ordenamiento por defecto no inverso
	 * @return array array ordenado
	 */
	function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false) {
		$position = array();
		$newRow = array();
		foreach ($toOrderArray as $key => $row) {
			$position[$key] = $row[$field];
			$newRow[$key] = $row;
		}
		if ($inverse) {
			arsort($position);
		} else {
			asort($position);
		}
		$returnArray = array();
		foreach ($position as $key => $pos) {
			$returnArray[] = $newRow[$key];
		}
		return $returnArray;
	}

}

?>
