<div id="convenio_edit">
	<div class="formulario">
		<?php echo $this->Form->create('CfConvenio', array('url' => array('controller' => 'convenios', 'action' => 'edit'), 'id' => 'edit_form')); ?>
		<?php echo $this->Form->input('id')?>
		<table>
			<tbody>
			<thead>
			<th colspan="2">Editar Convenio</th>
			</thead>
			</tbody>
			<tr>
				<td>RUT Prestador</td>
				<td class="borde">
					<?php echo $this->Form->input('RutPrestador', array('div' => false, 'label' => false));?>
				</td>
			</tr>
			<tr>
				<td>Cod. Lugar</td><td class="borde"><?php echo $this->Form->input('CodLugar', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50')); ?></td>
			</tr>
			<tr>
				<td>Cod. Financiador</td><td class="borde"><?php echo $this->Form->input('CodFinanciador', array('label' => false, 'div' => false)); ?></td>
			</tr>
			<tr>
				<td>Aplicaciones</td>
				<td class="borde"><?php echo $this->Form->input('PrmAplicacion.PrmAplicacion', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $prmAplicaciones,  'label' => false, 'div' => false, 'size' => '6')); ?></td>
			</tr>
			<tr>
				<td>Servicios</td>
				<td class="borde"><?php echo $this->Form->input('PrmServicio.PrmServicio', array('type' => 'select', 'multiple' => 'checkbox',  'options' => $prmServicios, 'label' => false, 'div' => false, 'size' => '6')); ?></td>
			</tr>
			<tr class="borde">
				<td>Grupos</td>
				<td class="borde"><?php echo $this->Form->input('PrmGrupo.PrmGrupo', array('type' => 'select', 'multiple' => true, 'options' => $prmGrupos,  'label' => false, 'div' => false, 'size' => '6')); ?></td>
			</tr>
		</table>
		<?php
		echo $this->Html->image('ajax_loader.gif', array('id' => 'ajax_loader', 'class' => 'oculto'));
		echo $this->Form->button('Guardar', array('type' => 'button','id' => 'editar_convenio'));
		echo $this->Form->end();
		?>
	</div>
</div>
<div id="listado_prestadores"></div>

<script type="text/javascript">
	var url_listado_prestadores = '<?php echo $this->Html->url(array('controller' => 'prestadores', 'action' => 'index')); ?>';
	$(function(){
		$("#CfConvenioCodLugar").attr('value',id_actual);
		$("#convenio_edit").dialog({
			autoOpen: false,
			title: "Modificar convenio",
			modal: true,
			position: ['center',50],
			height: 'auto',
			width: 580,
			closeOnEscape: true,
			resizable: false,
			draggable: true
		});
	});

	$("#CfConvenioRutPrestador").blur(function() {
		valido = 0;
		rut  = $(this).attr('value');
		rut = formatoRut(rut);
		$(this).attr('value', rut);
	});

	$("#editar_convenio").click(function(e){
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('controller' => 'convenios', 'action' => 'edit')); ?>',
			data: $("#edit_form").serialize(),
			beforeSend: function(){
				$("#ajax_loader").show();
				$("#guardar_convenio").hide();
			},
			error: function(XMLHttpRequest, textStatus){
				alert(textStatus);
				$("#ajax_loader").hide();
				$("#guardar_convenio").show();
			},
			success: function(data) {
				$("#ajax_loader").hide();
				$("#guardar_convenio").show();
				$("#convenio_edit").dialog('close');
			}
		});
	});
</script>
