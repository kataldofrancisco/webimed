<div class="configuraciones form">
<?php echo $this->Form->create('Configuracion');?>
	<fieldset>
 		<legend><?php __('Add Configuracion'); ?></legend>
	<?php
		echo $this->Form->input('cod_financiador');
		echo $this->Form->input('imagen');
		echo $this->Form->input('url_webservice');
		echo $this->Form->input('valorizar');
		echo $this->Form->input('fondo1');
		echo $this->Form->input('fondo1_borde');
		echo $this->Form->input('fondo2');
		echo $this->Form->input('fondo2_over');
		echo $this->Form->input('fondo2_seleccionado');
		echo $this->Form->input('fondo3');
		echo $this->Form->input('fondo3_borde');
		echo $this->Form->input('link1');
		echo $this->Form->input('link1_over');
		echo $this->Form->input('link2');
		echo $this->Form->input('link2_over');
		echo $this->Form->input('titulo1');
		echo $this->Form->input('titulo2');
		echo $this->Form->input('titulo3');
		echo $this->Form->input('titulo_lugares');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Configuraciones', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Cf Financiadores', true), array('controller' => 'cf_financiadores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cf Financiador', true), array('controller' => 'cf_financiadores', 'action' => 'add')); ?> </li>
	</ul>
</div>
