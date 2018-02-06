<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title><?php echo $title_for_layout ?></title>
		<meta name="generator" content="Geany 0.19.1" />
		<?php echo $this->Html->charset(); ?>
		<?php echo $this->Html->meta('icon'); ?>
		<?php echo $this->Html->css(array('reset', 'admin', 'redmond/jquery-ui-1.8.9.custom', 'jquery_ui_bpre',)); ?>
		<?php echo $this->Javascript->link(array('general', 'jquery/jquery-1.5.min', 'jquery/jquery-ui-1.8.9.custom.min')); ?>
		<?php echo $scripts_for_layout; ?>
	</head>
	<body>
		<div id="contenedor">
			<div id="cabecera">
				<?php if ($configuracion != false) : ?>
					<?php echo $html->image($configuracion['imagen']); ?>
				<?php endif; ?>
				<div class="titulo"><h1>Buscador de Prestadores de Salud</h1><h2>Bono electrónico</h2></div>
				<div class="clear"></div>
			</div>
			<div id="menu">
				<?php
				$menu_principal = array(
					'menu' => array(
						'lugares' => array('index'),
						'prm_aplicaciones' => array('index'),
						'prm_comunas' => array('index'),
						'prm_grupos' => array('index'),
						'prestadores' => array('index'),
						'prm_servicios' => array('index'),
						'usuarios' => array('index')
					)
				);
				echo $this->element('menu_acciones', $menu_principal) ?>
				<div id="datos_sesion"><?php echo $this->element('control_sesion'); ?></div>
			</div>
			<div id="contenido">
				<?php echo $content_for_layout ?>
			</div>
			<div id="pie">
				<p>Avda. 11 de septiembre 1901 Piso 3, Santiago, Chile, Tel: 02-7149509 ; 02-7149510</p>
			</div>
		</div>
	</body>
</html>
