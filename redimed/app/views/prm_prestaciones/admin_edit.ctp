<div class="prmPrestaciones form">
<?php echo $this->Form->create('PrmPrestacion');?>
	<fieldset>
 		<legend><?php __('Admin Edit Prm Prestacion'); ?></legend>
	<?php
		echo $this->Form->input('CodPrestacion');
		echo $this->Form->input('glosa');
		echo $this->Form->input('CodGrupo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PrmPrestacion.CodPrestacion')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PrmPrestacion.CodPrestacion'))); ?></li>
		<li><?php echo $this->Html->link(__('List Prm Prestaciones', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Prm Grupos', true), array('controller' => 'prm_grupos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prm Grupo', true), array('controller' => 'prm_grupos', 'action' => 'add')); ?> </li>
	</ul>
</div>