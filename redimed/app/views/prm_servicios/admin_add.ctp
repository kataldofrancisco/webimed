<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_servicios' => array('add')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
<?php echo $this->Form->create('PrmServicio');?>
	<table>
		<tbody>
		<thead>
		<th colspan="2">Crear Servicio</th>
		</thead>
		</tbody>
		<tr>
			<td>Glosa Servicio</td><td><?php echo $this->Form->input('Glosa', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => false,)); ?></td>
		</tr>
	</table>
<?php echo $this->Form->end(__('Submit', true));?>
</div>