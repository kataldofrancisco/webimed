<?php
$menu_opciones_html = "";
if ($es_ajax) {
	$this->Paginator->options(array(
		'update' => '#content',
		'evalScripts' => true,
		'url' => $this->passedArgs
	));
} else {
	$menu_opciones = array(
		'menu' => array(
			'prestadores' => array('add')
		)
	);
	$menu_opciones_html =  $this->element('menu_acciones', $menu_opciones);
	$this->Paginator->options(array('url' => $this->passedArgs));
}
?>
<div id="content">
	<?php echo $menu_opciones_html;;?>
	<div class="listado">
		<?php echo $this->Session->flash(); ?>
		<table>
			<tbody>
			<thead>
			<th><?php echo $this->Paginator->sort('RutPrestador'); ?></th>
			<th><?php echo $this->Paginator->sort('NombrePrestador'); ?></th>
			<th>Acciones</th>
			</thead>
			<?php
			$i = 0;
			foreach ($prestadores as $prestador):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<?php $rut = $prestador['CfPrestador']['RutPrestador']; ?>
				<tr<?php echo $class;?>>
					<td><?php echo $prestador['CfPrestador']['RutPrestador']; ?>&nbsp;</td>
					<td><?php echo $prestador['CfPrestador']['NombrePrestador']; ?>&nbsp;</td>
					<td class="acciones">
					<?php
					if ($es_ajax) {
						echo $this->Html->image('add.png', array('class' => 'pointer', 'onclick' => 'copiarRut(\'' . $rut . '\')'));
					} else {
						echo $this->element('acciones', array('id' => $rut));
					}
					?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php echo $this->element('paginacion'); ?>

	<div id="filtros" class="formulario">
		<?php echo $this->Form->create('Filtro', array('url' => array('controller' => 'prestadores', 'action' => 'index')));?>
		<table>
			<tbody>
				<thead>
					<th colspan="3">Filtro de búsqueda</th>
				</thead>
				<tr>
					<td>Prestador</td><td><?php  echo $this->Form->input('texto', array('type' => 'text', 'div' => false, 'label' => false, 'value' => $texto));?></td>
					<td><?php echo $this->Form->button('Buscar', array('type' => 'submit', 'id' => 'boton_buscar_prestadores'));?></td>
				</tr>
			</tbody>
		</table>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<?php
if ($es_ajax) {
	echo $this->Js->writeBuffer();
}
?>
<script type="text/javascript">
function copiarRut(rut) {
	$("#CfConvenioRutPrestador").attr('value', rut);
	$("#listado_prestadores").dialog('close');
}

$("#FiltroAdminIndexForm").submit(function(e){
	e.preventDefault();
	$.ajax({
		type: 'post',
		<?php
		if($es_ajax) {
			?>
			url: '<?php echo $this->Html->url(array('controller' => 'prestadores', 'action' => 'index' , 1 ))?>',
			<?php
		}
		else {
			?>
			url: '<?php echo $this->Html->url(array('controller' => 'prestadores', 'action' => 'index' ))?>',
			<?php
		}
		?>
		data: $("#FiltroAdminIndexForm").serialize(),
		success: function(data) {
			$("#content").html(data);
		}
	})
});
</script>
