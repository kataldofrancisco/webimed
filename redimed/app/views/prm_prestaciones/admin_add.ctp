<div class="prmPrestaciones form">
<?php echo $this->Form->create('PrmPrestacion');?>
	<fieldset>
 		<legend><?php __('Admin Add Prm Prestacion'); ?></legend>
	<?php
		echo $this->Form->input('glosa');
		echo $this->Form->input('CodGrupo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Prm Prestaciones', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Prm Grupos', true), array('controller' => 'prm_grupos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prm Grupo', true), array('controller' => 'prm_grupos', 'action' => 'add')); ?> </li>
	</ul>
</div>