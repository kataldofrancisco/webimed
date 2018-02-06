<?php echo $this->Html->css('usuarios'); ?>
<?php
	$menu_opciones = array(
		'menu' => array(
			'usuarios' => array('add')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
	<?php echo $this->Form->create('Usuario'); ?>
	<table>
		<caption id="error" class="ui-state-error oculto"></caption>
		<tbody>
		<thead>
		<th colspan="2">Crear usuario</th>
		</thead>
		<tr>
			<td>RUT</td><td><?php echo $this->Form->input('rut', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>Nombre</td><td><?php echo $this->Form->input('nombre', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>Apellidos</td><td><?php echo $this->Form->input('apellidos', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>e-mail</td><td><?php echo $this->Form->input('email', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>Password</td><td><?php echo $this->Form->input('password', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>Financiador</td><td><?php echo $this->Form->input('CfFinanciador_CodFinanciador', array('type' => 'select', 'options' => $CfFinanciador, 'empty' => true, 'div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>Activo</td><td><?php echo $this->Form->input('activo', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td colspan="2" class="submit"><?php echo $this->Form->submit('Guardar'); ?></td>
		</tr>
		</tbody>
	</table>
<?php $this->Form->end(); ?>
</div>
<script>
	$("#UsuarioRut").blur(function() {
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

	$("#UsuarioEmail").blur(function(){
		email = $(this).attr('value');
		if (validarEmail(email)) {
			$(this).removeClass('ui-state-error');
			$("#error").hide();
			return true;
		} else {
			$(this).addClass('ui-state-error');
			$("#error").html('<strong>Atención: </strong>e-mail no válido');
			$("#error").show();
			$(this).focus();
		}
	});
</script>
