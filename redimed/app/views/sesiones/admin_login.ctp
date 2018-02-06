<div class="formulario centrar">
	<?php
	if (isset($error_login)):
	?>
	<div class="ui-state-error">Datos incorrectos</div>
	<?php endif;?>
	<?php echo $this->Form->create('Sesiones'); ?>
	<table>
		<tbody>
		<thead>
			<th colspan="2">Ingreso al sistema</th>
		</thead>
		<tr>
			<td>RUT</td><td><?php echo $this->Form->input('rut', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td>Password</td><td><?php echo $this->Form->input('password', array('div' => false, 'label' => false)); ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $this->Form->submit('Entrar'); ?></td>
		</tr>
		</tbody>

	</table>
</div>
<?php echo $this->Form->end();?>
<script type="text/javascript">
$("#SesionesRut").blur(function() {
		valido = 0;
		rut  = $(this).attr('value');
		rut = formatoRut(rut);
		$(this).attr('value', rut);
	});
</script>