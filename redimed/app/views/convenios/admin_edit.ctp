<?php
	$menu_opciones = array('menu' => array(
		'lugares' => array('index'),
		'convenios' => array('index','view','add','edit','delete'),
		'comunas' => array('index'),
		'id_elemento' => $convenio['CfConvenio']['CodLugar']));
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
	<?php echo $this->Form->create('CfConvenio', array('url' => array('controller' => 'convenios', 'action' => 'add'))); ?>
	<table>
		<tbody>
		<thead>
		<th colspan="2"><?php __('Edit Cf Convenio'); ?></th>
		</thead>
		</tbody>
		<tr>
			<td>Cod. Lugar</td><td><?php echo $this->Form->input('id', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50', 'disabled' => true,)); ?></td>
		</tr>
		<tr>
			<td>Nombre</td><td><?php echo $this->Form->input('RutPrestador', array('label' => false, 'div' => false, 'size' => '50')); ?></td>
		</tr>
		<tr>
			<td>Cod. Lugar</td><td><?php echo $this->Form->input('CodLugar', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50')); ?></td>
		</tr>
		<tr>
			<td>Cod. Financiador</td><td><?php echo $this->Form->input('CodFinanciador', array('label' => false, 'div' => false)); ?></td>
		</tr>
	</table>
	<?php echo $this->Form->end('Guardar'); ?>
</div>



