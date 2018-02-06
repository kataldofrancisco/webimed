<?php

if ($sesion_iniciada == true) {
	$nombre_usuario = $usuario_activo['Usuario']['nombre'] . " " . $usuario_activo['Usuario']['apellidos'];
	$id = $usuario_activo['Usuario']['id'];
	echo $this->Html->link($nombre_usuario, array('controller' => 'usuarios', 'action' => 'edit', $id));
	echo " | ";
	echo $this->Html->link('Cerrar sesión', array('admin' => false, 'controller' => 'sesiones', 'action' => 'cerrar'), null, '¿Está seguro de cerrar su sesión?');
}
?>