<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_comunas' => array('add')
		)
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="listado">
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('CodComuna');?></th>
			<th><?php echo $this->Paginator->sort('GlosaComuna');?></th>
			<th><?php echo $this->Paginator->sort('CodRegion');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($prmComunas as $prmComuna):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $prmComuna['PrmComuna']['CodComuna']; ?>&nbsp;</td>
		<td><?php echo $prmComuna['PrmComuna']['GlosaComuna']; ?>&nbsp;</td>
		<td><?php echo $prmComuna['PrmComuna']['CodRegion']; ?>&nbsp;</td>
                <td class="acciones">
                        <?php echo $this->element('acciones', array('id' => $prmComuna['PrmComuna']['CodComuna'])); ?>
                </td>
	</tr>
<?php endforeach; ?>
	</table>
	</div>
	<?php echo $this->element('paginacion'); ?>