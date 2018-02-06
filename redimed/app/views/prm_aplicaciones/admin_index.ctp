<?php
	$menu_opciones = array(
		'menu' => array(
			'prm_aplicaciones' => array('add')
		)
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="listado">
	<table>
	<thead>
			<th><?php echo $this->Paginator->sort('CodAplicacion');?></th>
			<th><?php echo $this->Paginator->sort('Glosa');?></th>
			<th><?php echo $this->Paginator->sort('Imagen');?></th>
			<th class="acciones">Acciones</th>
	</thead>
	<?php
	$i = 0;
	foreach ($prmAplicaciones as $prmAplicacion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $prmAplicacion['PrmAplicacion']['CodAplicacion']; ?>&nbsp;</td>
		<td><?php echo $prmAplicacion['PrmAplicacion']['Glosa']; ?>&nbsp;</td>
		<td><?php 
		if (is_file(APP.WEBROOT_DIR.DS."img".DS.$prmAplicacion['PrmAplicacion']['Imagen'])){
			echo $this->Html->image($prmAplicacion['PrmAplicacion']['Imagen'],array('title' => $prmAplicacion['PrmAplicacion']['Imagen'])); 
		} 
		else {
			echo "no se encontró imagen asociada";
		}
		?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->element('acciones', array('id' => $prmAplicacion['PrmAplicacion']['CodAplicacion'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<?php echo $this->element('paginacion'); ?>
