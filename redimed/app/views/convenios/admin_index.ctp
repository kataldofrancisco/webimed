<?php
	$menu_opciones = array('menu' => array(
		'convenios' => array('add')));
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="listado">
	<h2>Convenios</h2>
	<table>
	<thead>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('RutPrestador');?></th>
			<th><?php echo $this->Paginator->sort('CfConvenio');?></th>
			<th><?php echo $this->Paginator->sort('CodFinanciador');?></th>
			<th class="acciones">Acciones</th>
	</thead>
	<?php
	$i = 0;
	foreach ($convenios as $convenio):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $convenio['CfConvenio']['id']; ?>&nbsp;</td>
		<td><?php echo $convenio['CfConvenio']['RutPrestador']; ?>&nbsp;</td>
		<td><?php echo $convenio['CfConvenio']['CodLugar']; ?>&nbsp;</td>
		<td><?php echo $convenio['CfConvenio']['CodFinanciador']; ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $convenio['CfConvenio']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $convenio['CfConvenio']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $convenio['CfConvenio']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $convenio['CfConvenio']['id'])); ?>
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
		<?php echo $this->Paginator->first('|<< ', array(), null, array('class'=>'disabled'));?>
		<?php echo $this->Paginator->prev('<< Previo', array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next('Siguiente >>', array(), null, array('class' => 'disabled'));?>
 <?php echo $this->Paginator->last(' >>|', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
