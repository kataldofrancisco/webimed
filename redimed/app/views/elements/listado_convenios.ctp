<div class="elemento">
	<h1>Listado Convenios</h1>
	<div id='menu_especifico'><div><?php echo $html->image("add.png", array("alt" => "Crear nuevo convenio", "id" => "boton_nuevo_convenio")); ?> Crear nuevo convenio</div></div>
	<div class="listado">
		<?php if (!empty($lugar['CfConvenio'])): ?>

			<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th>Fecha creaci&oacute;n</th>
					<th>Activo</th>
					<th>Rut Prestador</th>
					<th>Cod. Lugar</th>
					<th>Cod. Financiador</th>
					<th class="actions">Acciones</th>
				</tr>
			<?php
			$i = 0;
			foreach ($lugar['CfConvenio'] as $cfConvenio):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
				if (empty($cod_financiador) || $cfConvenio['CodFinanciador'] == $cod_financiador):
			?>
				<tr<?php echo $class; ?>>
					<td><?php echo $cfConvenio['FechaCreacion']; ?></td>
					<td><?php echo $cfConvenio['Activo']; ?></td>
					<td><?php echo $cfConvenio['RutPrestador']; ?></td>
					<td><?php echo $cfConvenio['CodLugar']; ?></td>
					<td><?php echo $cfConvenio['CodFinanciador']; ?></td>
					<td class="actions">
						<?php $ver = $this->Html->image('application.png', array('title' => 'Ver'));?>
						<?php $borrar = $this->Html->image('application_delete.png', array('title' => 'Borrar'));?>
						<?php $editar = $this->Html->image('edit.png', array('title' => 'Editar'));?>
						<?php $url = $this->Html->url(array('controller' => 'convenios', 'action' => 'edit', $cfConvenio['id'])); ?>
						<?php echo $this->Html->link($ver, array('controller' => 'convenios', 'action' => 'view', $cfConvenio['id']),array('escape' => false)); ?>
						<?php echo $this->Html->link($editar, '#',array('escape' => false, 'onclick' => 'javascript:editar(\''. $url .'\')')); ?>
						<?php echo $this->Html->link($borrar, array('controller' => 'convenios', 'action' => 'delete', $cfConvenio['id']), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $cfConvenio['id'])); ?>
					</td>
				</tr>
				<?php endif; ?>
			<?php endforeach; ?>
			</table>
		<?php endif; ?>
	</div>
</div>
<?php $codigoLugar = $this->Form->input('CodLugar'); ?>
<?php echo $this->element('convenio_add'); ?>
<?php echo $this->element('convenio_edit'); ?>
<script type="text/javascript">
	$("#boton_nuevo_convenio").click( function(){
		$('#convenio_add').dialog('open');
	});
<?php if (!empty($lugar['CfConvenio'])): ?>
	function editar(url){
		$('#convenio_edit').dialog('open');
		$('#convenio_edit').load(url);
	}
<?php endif; ?>
</script>
