	<?php
	$admin_imed = false;
	if (!isset($usuario_activo['Usuario']['CfFinanciador_CodFinanciador'])) {
		$admin_imed = true;
	}

	$opciones_principales = null;
	$opciones_especificas = null;
	foreach($menu as $elemento => $items) {
		foreach($items as $accion) {
			$mensaje = "";
			$menu_activo = "";
			if ($accion == 'index') {
				if ( $elemento == $controlador_activo ) {
					$menu_activo = "id='menuh_activo'";
				}
				if ($admin_imed || $elemento == 'lugares') {
					$opciones_principales .= "<li $menu_activo>".$this->Html->link(str_replace( "prm_" , "" , $elemento ) , array('controller' => $elemento , 'action' => $accion), null)."</li>";
				}
			}
			else {
				$label_elemento = str_replace( "prm_" , "" , $elemento );
				if ($accion == 'delete') {
					$texto = $html->link('Borrar '.$label_elemento, array('controller' => $elemento , 'action' => $accion , $id_elemento), null,"Esta seguro que desea eliminar el #'.$id_elemento.'");
					$img_menu = $html->image("$accion.png" , array("alt" => $texto, 'url' => array('controller' => $elemento , 'action' => $accion , $id_elemento) , 'onclick'=>'return confirm("Esta seguro que desea eliminar el #'.$id_elemento.'")'));
				}
				if ($accion == 'edit') {
					$texto = $html->link('Editar '.$label_elemento, array('controller' => $elemento , 'action' => $accion , $id_elemento));
					$img_menu = $html->image("$accion.png" , array("alt" => $texto, 'url' => array('controller' => $elemento , 'action' => $accion , $id_elemento)));
				}
				if ($accion == 'add') {
					$texto = $html->link('Crear '.$label_elemento, array('controller' => $elemento , 'action' => $accion));
					$img_menu = $html->image("$accion.png" , array("alt" => $texto, 'url' => array('controller' => $elemento , 'action' => $accion , null)));
				}
				$opciones_especificas .= "<div>".$img_menu." ".$texto."</div>";
			}
		}
	}
	if ( $opciones_principales ) {
		echo "<div id='menuh'><ul>$opciones_principales</ul></div>";
	}
	else {
		echo "<div id='menu_especifico'>$opciones_especificas </div>";
	}
?>
