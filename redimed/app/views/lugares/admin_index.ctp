<?php
	$menu_opciones = array(
		'menu' => array(
			'lugares' => array('add')
		)
	);
	$this->Paginator->options(array('url' => $this->passedArgs));
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="listado">
	<?php echo $this->Session->flash(); ?>
	<table>
		<thead>
			<th><?php echo $this->Paginator->sort('CodLugar');?></th>
			<th><?php echo $this->Paginator->sort('Direccion');?></th>
			<th><?php echo $this->Paginator->sort('Nombre');?></th>
			<th><?php echo $this->Paginator->sort('Telefono');?></th>
			<th><?php echo $this->Paginator->sort('Operativo');?></th>
			<th><?php echo $this->Paginator->sort('CodComuna');?></th>
			<th>Acciones</th>
		</thead>
		<?php
		$i = 0;
		foreach ($lugares as $lugar):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $lugar['CfLugar']['CodLugar']; ?>&nbsp;</td>
			<td><?php echo $lugar['CfLugar']['Direccion']; ?>&nbsp;</td>
			<td><?php echo $lugar['CfLugar']['Nombre']; ?>&nbsp;</td>
			<td><?php echo $lugar['CfLugar']['Telefono']; ?>&nbsp;</td>
			<td><?php
			if($lugar['CfLugar']['Operativo'] == 1) {
				echo $this->Html->image('activo_s.png',array('title' => 'Operativo'));
			}
			else{
				echo $this->Html->image('activo_n.png',array('title' => 'NO operativo'));
			}
			?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($lugar['PrmComuna']['GlosaComuna'], array('controller' => 'prm_comunas', 'action' => 'view', $lugar['PrmComuna']['CodComuna'])); ?>
			</td>
			<td class="acciones">
				<?php echo $this->element('acciones', array('id' => $lugar['CfLugar']['CodLugar'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
</div>
<?php echo $this->element('paginacion'); ?>
<div class="formulario clear">
<?php echo $this->Form->create('Filtro', array('url' => array('controller' => 'lugares', 'action' => 'index')));?>
	<table>
		<tbody>
			<thead>
				<th colspan="3">Filtro de búsqueda</th>
			</thead>
			<tr>
				<td>&nbsp;</td><td><?php  echo $this->Form->input('texto', array('type' => 'text', 'div' => false, 'label' => false));?></td>
				<td><?php echo $this->Form->button('Buscar', array('type' => 'submit', 'id' => 'boton_buscar_lugares'));?></td>
			</tr>
		</tbody>
	</table>
<?php echo $this->Form->end(); ?>
</div>
