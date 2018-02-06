<?php
	$menu_opciones = array(
		'menu' => array(
			'prestadores' => array('add','delete')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
	<?php echo $this->Form->create('CfPrestador', array('url' => array('controller' => 'prestadores', 'action' => 'edit')));?>
	<?php echo $this->Form->input('RutPrestador'); ?>
	<table>
		<caption id="error" class="ui-state-error oculto"></caption>
		<tbody>
		<thead>
			<th colspan="2">Modificar prestador</th>
		</thead>
		<tr>
			<td>Rut</td><td><?php echo $this->Form->input('Rut', array('type' => 'text', 'div' => false, 'label' => false, 'disabled' => true, 'value' => $id));?></td>
		</tr>
		<tr>
			<td>Nombre</td><td><?php echo $this->Form->input('NombrePrestador', array('div' => false, 'label' => false));?></td>
		</tr>
		</tbody>
	</table>
	<?php echo $this->Form->end('Guardar'); ?>
</div>
