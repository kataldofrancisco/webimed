<?php echo $this->Html->css('usuarios'); ?>
<?php
$menu_opciones = array(
	'menu' => array(
		'usuarios' => array('add')
	)
);
echo $this->element('menu_acciones', $menu_opciones);
$estado[0] = $this->Html->image('activo_n.png',array('title' => 'Inactivo'));
$estado[1] = $this->Html->image('activo_s.png',array('title' => 'Activo'));
?>
<div class="listado">
	<?php echo $this->Session->flash(); ?>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('rut');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('apellidos');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('activo');?></th>
			<th><?php echo $this->Paginator->sort('Creado', 'modified');?></th>
			<th><?php echo $this->Paginator->sort('Modificado', 'created');?></th>
			<th><?php echo $this->Paginator->sort('Financiador', 'CodFinanciador');?></th>
			<th class="acciones">Acciones</th>
	</tr>
	<?php
	$i = 0;
	foreach($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr <?php echo $class;?>>
	<td><?php echo $usuario['Usuario']['id']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['rut']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['nombre']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['apellidos']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
		<td><?php echo $estado[$usuario['Usuario']['activo']]; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['created']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['modified']; ?>&nbsp;</td>
		<td><?php echo $usuario['CfFinanciador']['NombreFinanciador']; ?>&nbsp;</td>
		<td class="acciones">
			<?php echo $this->element('acciones', array('id'=>$usuario['Usuario']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div id="filtros">
	<?php echo $this->element('paginacion'); ?>
</div>
