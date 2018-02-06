<div><?php
echo $this->Form->create('Archivo', array('url' => array('controller' => 'lugares', 'action' => 'archivo'), 'enctype' => 'multipart/form-data'));
echo $this->Form->input('archivo', array('type' => 'file'));
echo $this->Form->end('cargar');
?>
	<?php if ($resultado == true): ?>
		<h1>Lugares agregados exitosamente</h1>
	<?php endif; ?>
</div>
