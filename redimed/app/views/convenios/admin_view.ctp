<?php
$menu_opciones = array(
	'menu' => array(
		'convenios' => array('add', 'edit', 'delete')
	),
	'id_elemento' => $convenio['CfConvenio']['id']
);
echo $this->element('menu_acciones', $menu_opciones);
?>
<div id="ver">
	<dl>
		<dt>Cod. lugar</dt>
		<dd><?php echo $convenio['CfLugar']['CodLugar'];?></dd>
		<dt>Nombre lugar</dt>
		<dd><?php echo $convenio['CfLugar']['Nombre'];?></dd>
		<dt>Prestador</dt>
		<dd><?php echo $convenio['CfPrestador']['NombrePrestador']; ?></dd>
		<dt>Financiador</dt>
		<dd><?php echo $convenio['CfFinanciador']['NombreFinanciador']; ?></dd>
	</dl>
</div>
<div class="listado">
	<table>
		<tbody>
		<thead>
		<th>Servicios</th>
		</thead>
		<?php foreach ($convenio['PrmServicio'] as $servicio): ?>
		<tr>
			<td><?php echo $servicio['Glosa']; ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<table>
		<tbody>
		<thead>
		<th>Aplicaciones</th>
		</thead>
		<?php foreach ($convenio['PrmAplicacion'] as $aplicacion): ?>
		<tr>
			<td><?php echo $aplicacion['Glosa']; ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<table>
		<tbody>
		<thead>
		<th>Código</th>
		<th>Grupos</th>
		</thead>
		<?php foreach ($convenio['PrmGrupo'] as $grupo): ?>
		<tr>
			<td><?php echo $grupo['CodGrupo']; ?></td>
			<td><?php echo $grupo['Glosa']; ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
