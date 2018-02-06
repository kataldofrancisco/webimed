<?php
$editar = $this->Html->image('application_edit.png',array('title' => 'Editar'));
$borrar = $this->Html->image('delete.png',array('title' => 'Borrar'));
echo $this->Html->link($editar, array('action' => 'edit', $id),array('escape'=>false));
echo $this->Html->link($borrar, array('action' => 'delete', $id),array('escape'=>false), sprintf('¿Está seguro de eliminar este registro?'));
?>
