<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_comunas' => array('add','delete')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
<?php echo $this->Form->create('PrmComuna');?>
	<table>
		<tbody>
		<thead>
		<th colspan="2">Editar Comuna</th>
		</thead>
		</tbody>
		<?php echo $this->Form->input('CodComuna'); ?>
		<tr>
			<td>Cod. Comuna</td><td><?php echo $this->Form->input('Codigo', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => true, 'value' => $id,)); ?></td>
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