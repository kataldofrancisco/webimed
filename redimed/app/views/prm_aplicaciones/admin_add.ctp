<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_aplicaciones' => array('add')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
<?php echo $this->Form->create('PrmAplicacion');?>
	<table>
		<tbody>
		<thead>
		<th colspan="2">Crear Aplicación</th>
		</thead>
		</tbody>
		<tr>
			<td>Cod. Aplicacion</td><td><?php echo $this->Form->input('CodAplicacion', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled'=> false,)); ?></td>
		</tr>
		<tr>
			<td>Glosa</td><td><?php echo $this->Form->input('Glosa', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => false,)); ?></td>
		</tr>
		<tr>
			<td>Imagen</td><td><?php echo $this->Form->input('Imagen', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => false,)); ?></td>
		</tr>
	</table>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

