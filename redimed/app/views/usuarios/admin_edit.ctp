<?php echo $this->Html->css('usuarios'); ?>
<?php
	$menu_opciones = array(
		'menu' => array(
			'usuarios' => array('add','delete')
			),
			'id_elemento' => $id
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
	<?php
	echo $this->Form->create('Usuario');
	echo $this->Form->input('id');
	?>
	<table>
		<caption id="error" class="ui-state-error oculto"></caption>
		<tbody>
		<thead>
		<th colspan="2">Modificar usuario</th>
		</thead>
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
			<td>Password</td><td><?php echo $this->Form->input('password', array('div' => false, 'label' => false, 'value' => '')); ?></td>
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
<script type="text/javascript">
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
