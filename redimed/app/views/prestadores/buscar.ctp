<?php $html->css('prestador', null, array('inline' => false)); ?>
<?php $javascript->link(array('googlemap', $this->GoogleMap->url, 'prestadores', 'jquery/jquery.scrollTo-min.js'), false); ?>
<?php
$mostrar_valorizacion_config = Configure::read('mostrar_valorizacion');
if (!$mostrar_valorizacion_config) {
	$ocultar_campos = " class='oculto'";
	$estado_boleano = 'false';
} else {
	$ocultar_campos = '';
	$estado_boleano = 'true';
}
$regiones = array(
	'' => '',
	'13' => 'Región Metropolitana de Santiago',
	'15' => 'Arica y Parinacota',
	'1' => 'Tarapacá',
	'2' => 'Antofagasta',
	'3' => 'Atacama',
	'4' => 'Coquimbo',
	'5' => 'Valparaíso',
	'6' => 'Región del Libertador Gral.Bernardo O\'Higgins',
	'7' => 'Región del Maule',
	'8' => 'Región del Biobío',
	'9' => 'Región de La Araucanía',
	'14' => 'Región de Los Ríos',
	'10' => 'Región de Los Lagos',
	'11' => 'Región Aisén del Gral.Carlos Ibáñez del Campo',
	'12' => 'Región de Magallanes y de la Antártica Chilena'
);
$comunas = array();
?>
<script type="text/javascript">
	var config_mostrar_valorizacion = <?php echo $estado_boleano;?>;
	var icono_url = "<?php echo $this->Html->url('/img/'); ?>";
	var obtener_lugares_url = "<?php echo $this->Html->url(array('controller' => 'prestadores', 'action' => 'obtenerLugares')) . '/' ?>";
	var markersArray = [];
	var markers_valorizados = [];
	var mi_posicion_actual = "";
	var lugar_seleccionado = "";
	var cod_financiador = "<?php echo $cod_financiador; ?>";
	var url_valorizar_prestadores = "<?php echo $this->Html->url(array('controller'=>'prestadores', 'action'=>'valorizar')); ?>";
	var limite_lugares_retornados = "<?php echo Configure::read('limite_lugares_retornados'); ?>";
	var desplegar_info_valorizacion = <?php echo $estado_boleano; ?>;
</script>
<div id="error" class="oculto ui-state-error"></div>
<div id="buscador">
	<form id="formulario_buscar" method="post">
		<?php echo $this->Form->input('filtros', array('type'=>'hidden', 'id'=>'input_filtros')); ?>
		<?php echo $this->Form->input('cod_financiador', array('type'=>'hidden', 'id'=>'cod_financiador', 'value'=>$cod_financiador)); ?>
		<?php echo $this->Form->input('zoom', array('type' => 'hidden', 'id' => 'zoom_level')); ?>
		<?php echo $this->Form->input('punto_centro_lat', array('type' => 'hidden', 'id' => 'punto_centro_lat')); ?>
		<?php echo $this->Form->input('punto_centro_lng', array('type' => 'hidden', 'id' => 'punto_centro_lng')); ?>
		<?php echo $this->Form->input('historico', array('type' => 'hidden', 'id' => 'input_historico', 'value' => 'no'));?>
	<table>
		<tbody>
			<tr>
				<td>Dirección</td>
				<td>: <input name="data[direccion]" id="mi_direccion" title="Ingrese una dirección para centrar en el mapa y buscar los prestadores cercanos" size="60"></td>
				<?php if ($cod_financiador == 0) :?>
				<td>Seguro</td>
				<td>: <?php echo $this->Form->input('cod_financiador', array('type' => 'select', 'options' => $financiadores, 'div' => false, 'label' => false)); ?></td>
				<?php endif; ?>
				<td class="boton"><?php echo $this->Form->submit('boton_buscar.png', array('id' => 'boton_buscar', 'div' => false)); ?></td>
			</tr>
			<tr>
				<td>Región</td>
				<td>: <?php echo $this->Form->input('region', array('type' => 'select', 'options' => $regiones, 'label' => false, 'div' => false, 'id' => 'cod_region', 'title' => 'Seleccione una región'));?></td>
				<td>Comuna</td>
				<td>: <?php echo $this->Form->input('comuna', array('type' => 'select', 'options' => $comunas, 'label' => false, 'div' => false, 'id' => 'cod_comuna', 'title' => 'Seleccione una comuna'));?></td>

			</tr>
			<tr>

			</tr>
			<tr<?php echo $ocultar_campos;?>>
				<td>Especialidad</td>
				<td>: <?php echo $this->Form->input('PrmGrupo_CodGrupo', array('type' => 'select', 'options' => $grupos, 'empty' => true, 'div' => false, 'label' => false, 'id'=>'cod_grupo', 'title' => 'Seleccione una especialidad')); ?></td>
				<td>RUT</td>
				<td>: <?php echo $this->Form->input('rut_beneficiario', array('div' => false, 'label' => false, 'value' => '12345678-9', 'title' => '12345678-9', 'id'=>'rut_beneficiario')); ?></td>

				<td>Prestacion</td>
				<td colspan="2" id="prestaciones">: <?php echo $this->Form->input('prestacion', array('div' => false, 'label' => false, 'value' => 'Escriba la prestación', 'title' => 'Escriba la prestación', 'size' => 60, 'id' => 'input_prestaciones', 'disabled' => true)); ?></td>
			</tr>
		</tbody>
	</table>
	</form>
</div>
<div id="paneles">
	<div class="panel_izquierdo oculto" id="panel_izquierdo">
		<div class="titulo"><span id="numero_lugares_encontrados">0</span> lugares encontrados</div>
		<div id="direcciones_googlemap">
			<?php if (empty($lugares)) : ?>
			<script type="text/javascript">imprimirSinLugares();</script>
			<?php endif; ?>
		</div>
	</div>
	<div class="panel_derecho full" id="panel_derecho">
		<?php echo $this->GoogleMap->map($default, 'googlemap'); ?>
		<?php if (!empty($lugares)) : ?>
			<?php echo $this->GoogleMap->addMarkers($lugares); ?>
		<?php endif; ?>
	</div>
	<div class="clear"></div>
</div>
<div id="debug"></div>
<div id="prestador_valores" class="oculto"><h2>Por favor ingrese su RUT para valorizar la prestación</h2></div>
<div id="demasiados_resultados" class="oculto">Con este acercamiento hay demasiados resultados, ac&eacute;rquese un poco m&aacute;s.</div>
<script type="text/javascript">
	var css_input = new Array('#000000', '#6F6F6F');
	var ajax_loader = '<?php echo $this->Html->image('ajax_loader.gif'); ?>';
	var url_prestaciones = '<?php echo $this->Html->url(array('controller' => 'prestaciones', 'action' => 'filtrar')); ?>';
	var datos_autocompletar = "";

	$("#boton_buscar").click(function(e) {
		e.preventDefault();
		switchPaneles();
		$("#input_historico").attr('value', 'si');
		direccion = '';
		if ($("#mi_direccion").attr('value') != '') {
			direccion += $("#mi_direccion").attr('value') + ', ';

		}
		if ($("#cod_comuna option:selected").attr('value') > 0) {
			direccion += $("#cod_comuna option:selected").html() + ', ';
		}
		if ($("#cod_region option:selected").attr('value') > 0) {
			direccion += $("#cod_region option:selected").html();
		}
		centrarDireccion(direccion, 'aqui.png');
		//cargarLugares(obtenerAreaMapa());
		return true;
	});

	$("#mi_direccion").keyup(function(e) {
		if (e.keyCode == '13') {
			switchPaneles();
			centrarDireccion($("#mi_direccion").attr('value'), 'aqui.png');
		}
	});

	/*$('input, textarea').live('focus', function() {
		if (this.title != '') {
			// si el input es igual al título de este le asignamos vacío
			if (this.value == this.title) {
				this.value = '';
				$(this).css({'color' : css_input[0]});
			}
		}
	}).live('blur', function() {
		// si el input está vacío le asignamos el título de este
		if (this.value == '') {
			this.value = this.title;
			$(this).css({'color' : css_input[1]});
		}
	});*/

	$("#rut_beneficiario").blur(function() {
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
		} else {
			$(this).removeClass('ui-state-error');
			$("#error").hide();
		}
	});

	$("#cod_grupo").change(function() {
		var grupo_id = $(this).attr('value');
		$("#input_prestaciones").attr('disabled', false);
		$("#input_prestaciones").attr('value','');
		$("#input_prestaciones").focus();
		$.ajax({
			type: 'post',
			url: url_prestaciones,
			data: {grupo: grupo_id},
			beforeSend: function() {
				$("#cargar").html(ajax_loader);
			},
			success: function(data) {
				if ($("#rut_beneficiario").attr('value') != $("#rut_beneficiario").attr('title')) {
					$("#input_prestaciones").attr('disabled', false);
				}
				var parse = '';
				var prestaciones = $.parseJSON(data);
				$.each(prestaciones, function(index, prestacion){
					parse += '[' + prestacion.PrmPrestacion.CodPrestacion + ']  ' +prestacion.PrmPrestacion.glosa + ';';
				});
				datos_autocompletar = parse.split(";");
				$("#input_prestaciones").autocomplete({
					source: datos_autocompletar,
					minLength: 3,
					delay: 0
				});
			}
		});
	});

	$("#cod_region").change(function(){
		var region_id = $(this).attr('value');
		$.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('controller' => 'prm_comunas', 'action' => 'cargar_comunas'));?>',
			data: {region: region_id},
			beforeSend: function() {
				$("#cargar").html(ajax_loader);
			},
			success: function(data){
				var comunas = $.parseJSON(data);
				var options = '';
				$.each(comunas, function(index, comuna){
					options += '<option value="' + index + '">' + comuna + '</option>';
				});
				$("#cod_comuna").html(options);
			}
		});
	});
</script>
