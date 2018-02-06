<?php $javascript->link(array('googlemap', $this->GoogleMap->url), false); ?>
<script type="text/javascript">
	var icono_url = "<?php echo $this->Html->url('/img/'); ?>";
	var mi_posicion_actual = "";
	var comunas = Array();
	var direccion = '';
	var id_actual = '<?php echo $id; ?>';
<?php
	foreach ($prmComunas as $id_comuna => $valor) {
		echo "comunas[$id_comuna] = '$valor';\n";
	}
?>
	$(function(){
		$("#buscar_coordenadas").click(function(){

			direccion = $("#CfLugarDireccion").attr('value');
			id = $("#CfLugarCodComuna").attr('value');
			direccion += ', ' + comunas[id] + ' chile';
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				'address': direccion
			}, function(results, status) {
				var latiLong = "'"+results[0].geometry.location+"'";
				console.log(latiLong);
				latiLong = latiLong.replace("'(","");
				latiLong = latiLong.replace(")'","");
				latiLong = latiLong.split(",");
				$("#CfLugarLatitud").attr('value',latiLong[0]);
				$("#CfLugarLongitud").attr('value',latiLong[1]);
				centrarDireccion(direccion , 'marca_azul.png');
			});
		});
	});

</script>
<?php
	$menu_opciones = array(
		'menu' => array(
			'lugares' => array('add','delete')
			),
		'id_elemento' => $lugar['CfLugar']['CodLugar']
	);
	echo $this->element('menu_acciones', $menu_opciones) ?>
<div class="formulario">
	<?php echo $this->Form->create('CfLugar', array('url' => array('controller' => 'lugares', 'action' => 'edit'))); ?>
	<table>
		<?php if (isset($error)) :?>
		<caption id="mensaje_error" class="ui-state-error" ><?php echo $error;?></caption>
		<?php endif; ?>
		<tbody>
		<thead>
		<th colspan="2">Editar Lugar</th>
		</thead>
		</tbody>
		<?php echo $this->Form->input('CodLugar');?>
		<?php
			echo $this->Form->input('Latitud', array('type' => 'hidden'));
			echo $this->Form->input('Longitud', array('type' => 'hidden'));
		?>
		<tr>
			<td>Cod. Lugar</td><td><?php echo $id;?></td>
		</tr>
		<tr>
			<td>Nombre</td><td><?php echo $this->Form->input('Nombre', array('label' => false, 'div' => false, 'size' => '50')); ?></td>
		</tr>
		<tr>
			<td>Dirección</td><td><?php echo $this->Form->input('Direccion', array('label' => false, 'div' => false, 'size' => '50', 'type' => 'text')); ?></td>
		</tr>
		<tr>
			<td>Comuna</td>
			<td><?php echo $this->Form->input('CodComuna', array('type' => 'select', 'options' => $prmComunas, 'label' => false, 'div' => false)); ?>
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
		if ($admin_imed) {
			echo $this->Form->end('Guardar');
		} else {
			echo $this->Form->end();
		}
	?>
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
<div>
	<?php echo $this->element('listado_convenios') ?>
</div>
<script type="text/javascript">
	var calle = $("#CfLugarDireccion").attr('value');
	var direccion_ini = calle + ', ' + comunas[$("#CfLugarCodComuna").attr('value')];
	centrarDireccion( direccion_ini , 'marca_azul.png');
</script>

