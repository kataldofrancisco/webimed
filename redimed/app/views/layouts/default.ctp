<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
		<title>Buscador de Prestadores :: <?php echo $title_for_layout; ?></title>
		<?php echo $this->Html->charset(); ?>
		<?php echo $this->Html->meta('icon'); ?>
		<?php echo $this->Html->css(array('reset', 'general', 'redmond/jquery-ui-1.8.7.custom', 'jquery_ui_bpre')); ?>
		<?php echo $this->Javascript->link(array('general', 'jquery/jquery-1.4.4.min', 'jquery/jquery-ui-1.8.7.custom.min')); ?>
		<?php echo $scripts_for_layout; ?>
		<?php if ($configuracion != false) : ?>
		<style>
			div#contenedor div#cabecera div.titulo h1 {
				color: <?php echo $configuracion['titulo1']; ?>;
			}
			div#buscador {
				background-color: <?php echo $configuracion['fondo1']; ?>;
				border: solid 1px <?php echo $configuracion['fondo1_borde']; ?>;
			}
			div#paneles div.panel_izquierdo {
				border: 1px solid <?php echo $configuracion['fondo1_borde']; ?>;
			}
			div#paneles div.panel_izquierdo div.titulo {
				background-color: <?php echo $configuracion['titulo_lugares']; ?>;
				color: <?php echo $configuracion['color_titulo_lugares']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar {
				background-color: <?php echo $configuracion['fondo2']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar:hover {
				background-color: <?php echo $configuracion['fondo2_over']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.altrow {
				background-color: <?php echo $configuracion['fondo2_over']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar_seleccionado {
				background-color: <?php echo $configuracion['fondo2_seleccionado']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar_seleccionado:hover {
				background-color: <?php echo $configuracion['fondo2_seleccionado']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar div.lugar_descripcion h1 {
				color: <?php echo $configuracion['titulo2']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar div.lugar_descripcion h2 {
				color: <?php echo $configuracion['titulo2']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar div.lugar_descripcion a.desplegar_prestadores {
				color: <?php echo $configuracion['link1']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar div.lugar_descripcion a.desplegar_prestadores:hover {
				color: <?php echo $configuracion['link1_over']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar_seleccionado div.lugar_descripcion h1 {
				color: <?php echo $configuracion['titulo1_activo']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar_seleccionado div.lugar_descripcion h2 {
				color: <?php echo $configuracion['titulo2_activo']; ?>;
			}
			div#paneles div.panel_izquierdo div#direcciones_googlemap div.lugar_seleccionado div.lugar_descripcion {
				color: <?php echo $configuracion['link_activo']; ?>;
			}
			div#paneles div.panel_derecho {
				border: 1px solid <?php echo $configuracion['fondo1_borde']; ?>;
			}
			div.globo_info h1 {
				color: <?php echo $configuracion['titulo2']; ?>;
			}
			div.globo_info h2 {
				color: <?php echo $configuracion['titulo3']; ?>;
			}
			div.globo_info ul {
				color: <?php echo $configuracion['titulo2']; ?>;
			}
			div#demasiados_resultados {
				background-color: <?php echo $configuracion['fondo3']; ?>;
				border: 1px solid <?php echo $configuracion['fondo3_borde']; ?>;
			}
		</style>
		<?php endif; ?>
	</head>
	<body>
		<div id="contenedor">
			<div id="cabecera">
				<?php if ($configuracion != false) : ?>
					<?php echo $html->image($configuracion['imagen']); ?>
				<?php endif; ?>
				<div class="titulo"><?php echo $this->Html->image('leyenda.png'); ?></div>
				<div class="clear"></div>
			</div>
			<div id="cuerpo">
				<?php echo $content_for_layout; ?>
			</div>
			<div id="pie">
				<?php //echo $this->Html->image('powered.png', array('class' => 'powered')); ?>
			</div>
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>
