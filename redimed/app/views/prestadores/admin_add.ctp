<?php
	$menu_opciones = array(
		'menu' => array(
			'prestadores' => array('add')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
	<?php echo $this->Form->create('CfPrestador', array('url' => array('controller' => 'prestadores', 'action' => 'add')));?>
	<table>
		<caption id="error" class="ui-state-error oculto"></caption>
		<tbody>
		<thead>
			<th colspan="2">Nuevo prestador</th>
		</thead>
		<tr>
			<td>Rut</td><td><?php echo $this->Form->input('RutPrestador', array('type' => 'text', 'div' => false, 'label' => false));?></td>
		</tr>
		<tr>
			<td>Nombre</td><td><?php echo $this->Form->input('NombrePrestador', array('div' => false, 'label' => false));?></td>
		</tr>
		</tbody>
	</table>
	<?php echo $this->Form->end('Guardar'); ?>
</div>
<script type="text/javascript">
$("#CfPrestadorRutPrestador").blur(function() {
		valido = 0;
		rut  = $(this).attr('value');
		if (rut == '12345678-9') {
			$(this).removeClass('ui-state-error');
			$("#error").hide();
			return true;
		}
		rut = formatoRut(rut);
		$(this).attr('value', rut);
		rut_v = rut.split('-');
		if (!validarRUT(rut_v[0], rut_v[1])) {
			$(this).addClass('ui-state-error');
			$("#error").html('<strong>Atención: </strong>RUT no válido');
			$("#error").show();
			$(this).focus();
		} else {
			$(this).removeClass('ui-state-error');
			$("#error").hide();
		}
	});
</script>
