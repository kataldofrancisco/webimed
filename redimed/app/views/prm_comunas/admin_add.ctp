<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_comunas' => array('add')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
<?php echo $this->Form->create('PrmComuna');?>
	<table>
		<tbody>
		<thead>
		<th colspan="2">Crear Comuna</th>
		</thead>
		</tbody>
		<tr>
			<td>Cod. Comuna</td><td><?php echo $this->Form->input('CodComuna', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled'=> false,)); ?></td>
		</tr>
		<tr>
			<td>Glosa Comuna</td><td><?php echo $this->Form->input('GlosaComuna', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => false,)); ?></td>
		</tr>
		<tr>
			<td>Cod. Región</td><td><?php echo $this->Form->input('CodRegion', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => false,)); ?></td>
		</tr>
	</table>
<?php echo $this->Form->end(__('Submit', true));?>
</div>