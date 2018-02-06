<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_grupos' => array('add')
		)
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="listado">
	<?php echo $this->Session->flash(); ?>
	<table>
	<thead>
			<th><?php echo $this->Paginator->sort('CodGrupo');?></th>
			<th><?php echo $this->Paginator->sort('Glosa');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</thead>
	<?php
	$i = 0;
	foreach ($prmGrupos as $prmGrupo):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $prmGrupo['PrmGrupo']['CodGrupo']; ?>&nbsp;</td>
		<td><?php echo $prmGrupo['PrmGrupo']['Glosa']; ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->element('acciones', array('id' => $prmGrupo['PrmGrupo']['CodGrupo'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php echo $this->element('paginacion'); ?>
