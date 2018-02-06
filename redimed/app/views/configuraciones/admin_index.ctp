<?php
	$menu_opciones = array(
		'menu' => array(
			'configuraciones' => array('add')
		)
	);
	echo $this->element('menu_acciones', $menu_opciones);
 ?>
<div class="listado">
	<h2><?php __('Configuraciones');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('cod_financiador');?></th>
			<th><?php echo $this->Paginator->sort('imagen');?></th>
			<th><?php echo $this->Paginator->sort('fondo1');?></th>
			<th><?php echo $this->Paginator->sort('fondo1_borde');?></th>
			<th><?php echo $this->Paginator->sort('fondo2');?></th>
			<th><?php echo $this->Paginator->sort('fondo2_over');?></th>
			<th><?php echo $this->Paginator->sort('fondo2_seleccionado');?></th>
			<th><?php echo $this->Paginator->sort('fondo3');?></th>
			<th><?php echo $this->Paginator->sort('fondo3_borde');?></th>
			<th><?php echo $this->Paginator->sort('link1');?></th>
			<th><?php echo $this->Paginator->sort('link1_over');?></th>
			<th><?php echo $this->Paginator->sort('link2');?></th>
			<th><?php echo $this->Paginator->sort('link2_over');?></th>
			<th><?php echo $this->Paginator->sort('titulo1');?></th>
			<th><?php echo $this->Paginator->sort('titulo2');?></th>
			<th><?php echo $this->Paginator->sort('titulo3');?></th>
			<th><?php echo $this->Paginator->sort('titulo_lugares');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($configuraciones as $configuracion):
		$class = null;

	?>
	<tr<?php echo $class;?>>
		<td><?php echo $configuracion['Configuracion']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($configuracion['CfFinanciador']['NombreFinanciador'], array('controller' => 'cf_financiadores', 'action' => 'view', $configuracion['CfFinanciador']['CodFinanciador'])); ?>
		</td>
		<td><?php echo $this->Html->image($configuracion['Configuracion']['imagen']); ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" . $configuracion['Configuracion']['fondo1'] . "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['fondo1_borde']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['fondo2']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['fondo2_over']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['fondo2_seleccionado']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['fondo3']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['fondo3_borde']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['link1']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['link1_over']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['link2']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['link2_over']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['titulo1']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['titulo2']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['titulo3']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td><?php echo "<p style='border: solid 1px #333;background-color:" .$configuracion['Configuracion']['titulo_lugares']. "'>&nbsp</p>"; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->element('acciones', array('id' => $configuracion['Configuracion']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
