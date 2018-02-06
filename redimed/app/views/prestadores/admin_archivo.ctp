<?php
$menu_opciones = array(
	'menu' => array(
		'prestadores' => array()
	),
	'id_elemento' => null
);
echo $this->element('menu_acciones', $menu_opciones);
?>
<div id="carga_archivos">
	<?php echo $this->Session->flash(); ?>
	<div class="formulario" id="formulario_prestadores">
		<?php echo $this->Form->create('Archivo', array('url' => array('controller' => 'prestadores', 'action' => 'archivo'), 'enctype' => 'multipart/form-data', 'id' => 'FormAgregarPrestadores')); ?>
		<table>
			<tbody>
			<thead>
			<th colspan="2">Carga de prestadores</th>
			</thead>
			<tr>
				<td>Archivo</td><td><?php echo $this->Form->input('archivo', array('type' => 'file', 'div' => false, 'label' => false, 'id' => 'archivo_prestadores')); ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $this->Form->button('Cargar'); ?></td>
			</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>

	<?php if (isset($estado) && $estado['Estado'] > 0): ?>
			<div class="tabla">
				<h3>Se han producido errores al guardar los siguientes datos:</h3>
				<table>
			<?php foreach ($estado['Datos'] as $dato): ?>
				<tr>
				<?php
				foreach ($dato as $reg) {
					if (is_array($reg)) {
						foreach ($reg as $r) {
							echo "<td>$r</td>";
						}
					} else {
						echo "<td>$reg</td>";
					}
				}
				?>
			</tr>
			<?php endforeach; ?>
			</table>
		</div>
	<?php endif; ?>
</div>
<script type="text/javascript">
	$('#archivo_prestadores').change(function(){
		nombre = $(this).attr('value');
		partes = nombre.split('.');
		largo = partes.length;
		if (partes[largo -1] != 'csv') {
			alert('Formato de archivo incorrecto');
			$(this).attr('value', '');
		}
	});
</script>
