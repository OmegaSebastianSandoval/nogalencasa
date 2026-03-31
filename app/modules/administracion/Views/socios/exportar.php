<?php
$estados['']="Inactivo";
$estados['0']="Inactivo";
$estados['1']="Activo";

?>

<table width="100%" border="1">
	<tr>
		<td>Documento</td>
		<td>Tipo de documento</td>
		<td>Nombre</td>
		<td>No Accion</td>
		<td>Direccion</td>
		<td>Ciudad</td>
		<td>Correo</td>
		<td>Telefono</td>
		<td>Celular</td>
		<td>Estado</td>
	</tr>
	<?php foreach ($this->list as $key => $value): ?>
		<tr>
			<td><?php echo $value->socio_cedula; ?></td>
			<td><?php echo $value->socio_tipo_documento; ?></td>
			<td><?php echo $value->socio_nombre; ?></td>
			<td><?php echo $value->socio_carnet; ?></td>
			<td><?php echo $value->socio_direccion; ?></td>
			<td><?php echo $value->socio_ciudad; ?></td>
			<td><?php echo $value->socio_correo; ?></td>
			<td><?php echo $value->socio_telefono; ?></td>
			<td><?php echo $value->socio_celular; ?></td>
			<td><?php echo $estados[$value->socio_estado]; ?></td>
		</tr>
	<?php endforeach ?>
</table>