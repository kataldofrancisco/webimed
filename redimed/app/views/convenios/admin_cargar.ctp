<?php
$menu_opciones = array(
	'menu' => array(
		'convenios' => array()
	),
	'id_elemento' => null
);
echo $this->element('menu_acciones', $menu_opciones);
?>
<div id="carga_archivos">
	<?php echo $this->Session->flash(); ?>
	<div class="formulario" id="formulario_convenios">
		<?php echo $this->Form->create('Archivo', array('url' => array('controller' => 'convenios', 'action' => 'cargar'), 'enctype' => 'multipart/form-data', 'id' => 'FormAgregarConvenios')); ?>
		<table>
			<tbody>
			<thead>
			<th colspan="2">Carga de convenios</th>
			</thead>
			<tr>
				<td>Archivo</td><td><?php echo $this->Form->input('archivo', array('type' => 'file', 'div' => false, 'label' => false, 'id' => 'archivo_convenios')); ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $this->Form->button('Cargar'); ?></td>
			</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<script type="text/javascript">
	$('#archivo_convenios').change(function(){
		nombre = $(this).attr('value');
		partes = nombre.split('.');
		largo = partes.length;
		if (partes[largo -1] != 'csv') {
			alert('Formato de archivo incorrecto');
			$(this).attr('value', '');
		}
	});
</script>
