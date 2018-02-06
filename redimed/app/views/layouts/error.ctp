<!DOCTYPE html>
<html>
	<head>
		<title>Buscador de Prestadores :: <?php echo $title_for_layout; ?></title>
		<?php echo $this->Html->charset(); ?>
		<?php	echo $this->Html->meta('icon'); ?>
		<?php echo $this->Html->css(array('reset', 'error')); ?>
		<?php echo $scripts_for_layout; ?>
	</head>
	<body>
		<div id="contenedor">
			<div id="cabecera">
			</div>
			<div id="cuerpo">
				<div class="logo_imed">
					<?php echo $html->image('logo_imed.png'); ?>
				</div>
				<?php echo $content_for_layout; ?>
			</div>
			<div id="pie">
			</div>
		</div>
	</body>
</html>
