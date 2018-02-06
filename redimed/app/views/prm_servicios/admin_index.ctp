<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_servicios' => array('add')
		)
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="listado">
	<table>
	<thead>
			<th><?php echo $this->Paginator->sort('CodServicio');?></th>
			<th><?php echo $this->Paginator->sort('Glosa');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</thead>
	<?php
	$i = 0;
	foreach ($prmServicios as $prmServicio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $prmServicio['PrmServicio']['CodServicio']; ?>&nbsp;</td>
		<td><?php echo $prmServicio['PrmServicio']['Glosa']; ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->element('acciones', array('id' => $prmServicio['PrmServicio']['CodServicio'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php echo $this->element('paginacion'); ?>