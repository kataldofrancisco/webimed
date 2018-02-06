<?php
	$menu_opciones = array('menu' => array(
		'lugares' => array('index'),
		'convenios' => array('index'),
		'comunas' => array('index')));
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div id="contenedor">
	<div class="formulario">
		<?php echo $this->Form->create('CfConvenio', array('url' => array('controller' => 'convenios', 'action' => 'add'))); ?>
		<table>
			<tbody>
			<thead>
			<th colspan="2">Agregar lugar</th>
			</thead>
			</tbody>
			<tr>
				<td>Id</td><td><?php echo $this->Form->input('id', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50')); ?></td>
			</tr>
			<tr>
				<td>Rut Prestador</td><td><?php echo $this->Form->input('RutPrestador', array('label' => false, 'div' => false, 'size' => '50')); ?></td>
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