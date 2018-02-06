<div id="convenio_add">
	<div class="formulario">
		<?php echo $this->Form->create('CfConvenio', array('url' => array('controller' => 'convenios', 'action' => 'add'))); ?>
		<table>
			<caption id="error" class="ui-state-error oculto"></caption>
			<tbody>
			<thead>
			<th colspan="2">Agregar Convenio</th>
			</thead>
			</tbody>
			<tr>
				<td>RUT Prestador</td>
				<td class="borde">
					<?php echo $this->Form->input('RutPrestador', array('div' => false, 'label' => false));?>
					<?php echo $this->Html->image("magnifier.png", array("alt" => "listado Prestadores", "id" => "boton_listado_prestadores", "title" => "Buscar prestador", "class" => "pointer")); ?>
				</td>
			</tr>
			<tr>
				<td>Cod. Lugar</td><td class="borde"><?php echo $this->Form->input('CodLugar', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50')); ?></td>
			</tr>
			<tr>
				<td>Cod. Financiador</td><td class="borde"><?php echo $this->Form->input('CodFinanciador', array('type' => 'select', 'options' => $financiador, 'label' => false, 'div' => false)); ?></td>
			</tr>
			<tr>
				<td>Aplicaciones</td>
				<td class="borde"><?php echo $this->Form->input('PrmAplicacion.PrmAplicacion', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $prmAplicaciones, 'label' => false, 'div' => false, 'size' => '6')); ?></td>
			</tr>
			<tr>
				<td>Servicios</td>
				<td class="borde"><?php echo $this->Form->input('PrmServicio.PrmServicio', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $prmServicios, 'label' => false, 'div' => false, 'size' => '6')); ?></td>
			</tr>
			<tr class="borde">
				<td>Grupos</td>
				<td class="borde"><?php echo $this->Form->input('PrmGrupo.PrmGrupo', array('type' => 'select', 'multiple' => true, 'options' => $prmGrupos, 'label' => false, 'div' => false, 'size' => '6')); ?></td>
			</tr>
		</table>
		<?php
		echo $this->Html->image('ajax_loader.gif', array('id' => 'ajax_loader', 'class' => 'oculto'));
		echo $this->Form->button('Guardar', array('type' => 'button','id' => 'guardar_convenio'));
		echo $this->Form->end();
		?>
	</div>
</div>
<div id="listado_prestadores"></div>

<script type="text/javascript">
	var url_listado_prestadores = '<?php echo $this->Html->url(array('controller' => 'prestadores', 'action' => 'index')); ?>';
	$(function(){
		$("#CfConvenioCodLugar").attr('value',id_actual);
		$("#convenio_add").dialog({
			autoOpen: false,
			title: "Crear convenio",
			modal: true,
			position: ['center',50],
			height: 'auto',
			width: 580,
			closeOnEscape: true,
			resizable: false,
			draggable: true
		});
	});

	$("#boton_listado_prestadores").click(function(){
		$("#listado_prestadores").load(url_listado_prestadores + '/index/1');
		$("#listado_prestadores").dialog({
			autoOpen: true,
			title: "Prestadores",
			modal: true,
			position: ['center',20],
			height: 470,
			width: 460,
			closeOnEscape: true,
			resizable: false,
			draggable: true
		});
		$("#listado_prestadores").dialog('open');
		$("#listado_prestadores").dialog({
			autoOpen: false
		});
	});

	$("#CfConvenioRutPrestador").blur(function() {
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

	$("#guardar_convenio").click(function(e){
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('controller' => 'convenios', 'action' => 'add')); ?>',
			data: $("#CfConvenioAdminEditForm").serialize(),
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
				var respuesta = $.parseJSON(data);
				if (respuesta.estado == 0) {
					$("#ajax_loader").hide();
					$("#guardar_convenio").show();
					$("#convenio_add").dialog('destroy');
					window.location = '<?php echo $this->Html->url(array('controller' => 'lugares', 'action' => 'edit', $id)); ?>';
				} else {
					alert(respuesta.glosa);
				}
			}
		});
	});
</script>
