<div class="prmPrestaciones index">
	<h2><?php __('Prm Prestaciones');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('CodPrestacion');?></th>
			<th><?php echo $this->Paginator->sort('glosa');?></th>
			<th><?php echo $this->Paginator->sort('CodGrupo');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($prmPrestaciones as $prmPrestacion):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $prmPrestacion['PrmPrestacion']['CodPrestacion']; ?>&nbsp;</td>
		<td><?php echo $prmPrestacion['PrmPrestacion']['glosa']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($prmPrestacion['PrmGrupo']['Glosa'], array('controller' => 'prm_grupos', 'action' => 'view', $prmPrestacion['PrmGrupo']['CodGrupo'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $prmPrestacion['PrmPrestacion']['CodPrestacion'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $prmPrestacion['PrmPrestacion']['CodPrestacion'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $prmPrestacion['PrmPrestacion']['CodPrestacion']), null, sprintf(__('Are you sure you want to delete # %s?', true), $prmPrestacion['PrmPrestacion']['CodPrestacion'])); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Prm Prestacion', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Prm Grupos', true), array('controller' => 'prm_grupos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prm Grupo', true), array('controller' => 'prm_grupos', 'action' => 'add')); ?> </li>
	</ul>
</div>