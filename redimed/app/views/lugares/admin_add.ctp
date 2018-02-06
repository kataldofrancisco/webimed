<?php $javascript->link(array('googlemap', $this->GoogleMap->url), false); ?>
<script type="text/javascript">
	var icono_url = "<?php echo $this->Html->url('/img/'); ?>";
	var mi_posicion_actual = "";
</script>
<?php
	$menu_opciones = array(
		'menu' => array(
			'lugares' => array()
			),
			'id_elemento' => null
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div id="contenedor">
	<div class="formulario">
		<?php echo $this->Form->create('CfLugar', array('url' => array('controller' => 'lugares', 'action' => 'add'))); ?>
		<table>
			<caption id="mensaje_error" class="oculto" ></caption>
			<tbody>
			<thead>
			<th colspan="2">Agregar lugar</th>
			</thead>
			</tbody>
			<tr>
				<td>Cod. Lugar</td><td><?php echo $this->Form->input('CodLugar', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50')); ?></td>
			</tr>
			<tr>
				<td>Nombre</td><td><?php echo $this->Form->input('Nombre', array('label' => false, 'div' => false, 'size' => '50')); ?></td>
			</tr>
			<tr>
				<td>Dirección</td><td><?php echo $this->Form->input('Direccion', array('type' => 'text', 'label' => false, 'div' => false, 'size' => '50')); ?></td>
			</tr>
			<tr>
				<td>Comuna</td><td><?php echo $this->Form->input('Comuna', array('label' => false, 'div' => false, 'id' => 'Comuna')); ?>
					<?php echo $this->Form->input('CodComuna', array('type' => 'hidden', 'id' => 'CodComuna'));?>
					<button type="button" id="buscar_coordenadas">Posicionar en el mapa</button>
				</td>
			</tr>
			<tr>
				<td>Teléfono</td><td><?php echo $this->Form->input('Telefono', array('label' => false, 'div' => false)); ?></td>
			</tr>
			<tr>
				<td>Web</td><td><?php echo $this->Form->input('Web', array('label' => false, 'div' => false)); ?></td>
			</tr>
			<tr>
				<td>Operativo</td><td><?php echo $this->Form->input('Operativo', array('label' => false, 'div' => false)); ?></td>
			</tr>
		</table>
		<?php
		echo $this->Form->input('Latitud', array('type' => 'hidden'));
		echo $this->Form->input('Longitud', array('type' => 'hidden'));
		echo $this->Form->button('Guardar', array('type' => 'button' , 'id' => 'Guardar'));
		?>
		<?php echo $this->Form->end(); ?>
</div>
<div class="mini_mapa">
<?php
	$default = array(
		'zoom' => 16,
		'latitud' => '-33.437856',
		'longitud' => '-70.650394'
	); ?>
	<?php echo $this->GoogleMap->miniMap($default, 'googlemap'); ?>
</div>
</div>
<script type="text/javascript">
	var comunas = '';
	var codigos = Array();
	var direccion = '';
	$(function(){
		<?php
		// Transformamos las comunas en array para Autocomplete
		$x = 0;
		foreach ($prmComunas as $id=>$label) {
			$comunas[$x]['id'] = $id;
			$comunas[$x++]['label'] = $label;
		}
		$comunas = json_encode($comunas);
		echo "comunas = '$comunas';\n";
		?>
		o_comunas = $.parseJSON(comunas);
		$("#Comuna").autocomplete({
			source: o_comunas,
			minChars: 0,
			autoFill: true,
			mustMatch: true,
			scrollHeight: 220,

			select: function(event, ui) {
				$("#CodComuna").attr('value',ui.item.id);
			}
		});
	});

	$("#buscar_coordenadas").click(function(){		
		direccion = $("#CfLugarDireccion").attr('value');
		if($("#Comuna").attr('value') == '') {
			$("#mensaje_error").html("<b>Atención:</b> Seleccione la comuna antes de posicionar el mapa");
			$("#mensaje_error").show();
			$("#mensaje_error").addClass("ui-state-error");
		}
		else {
			comuna = $("#Comuna").attr('value');
			direccion += ', ' + comuna+ ', Chile';
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				'address': direccion
			}, function(results, status) {
				var latiLong = "'"+results[0].geometry.location+"'";
				latiLong = latiLong.replace("'(","");
				latiLong = latiLong.replace(")'","");
				latiLong = latiLong.split(",");
				$("#CfLugarLatitud").attr('value',latiLong[0]);
				$("#CfLugarLongitud").attr('value',latiLong[1]);
				centrarDireccion(direccion , 'marca_azul.png');
				$("#mensaje_error").hide();
				$("#mensaje_error").removeClass("ui-state-error");
			});
		}
	});
	
	$("#Guardar").click(function(){
		if(($("#CfLugarLatitud").attr("value") == '') || ($("#CfLugarLongitud").attr("value") == '')) {
			$("#mensaje_error").html("<b>Atención:</b> Posicione la dirección en el mapa");
			$("#mensaje_error").show();
			$("#mensaje_error").addClass("ui-state-error");
		}
		else{
			$("#CfLugarAdminAddForm").submit();
		}
	});
</script>
