<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_grupos' => array('add','delete')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
<?php echo $this->Form->create('PrmGrupo');?>
	<table>
		<tbody>
		<thead>
		<th colspan="2">Editar Aplicación</th>
		</thead>
		</tbody>
		<?php echo $this->Form->input('CodGrupo'); ?>
		<tr>
			<td>Cod. Grupo</td><td><?php echo $this->Form->input('Codigo', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '2','maxlength' => '2', 'disabled' => true, 'value' => $id,)); ?></td>
		</tr>
		<tr>
			<td>Glosa</td><td><?php echo $this->Form->input('Glosa', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => false,)); ?></td>
		</tr>
	</table>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
