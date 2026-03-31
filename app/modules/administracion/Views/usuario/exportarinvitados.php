<table width="100%" border="1">
	<tr>
		<td>Fecha</td>
		<td>Documento invitado</td>
		<td>Nombre invitado</td>
		<td>Email invitado</td>
		<td>Documento socio</td>
		<td>Nombre socio</td>
	</tr>
	<?php foreach ($this->invitados as $key => $value): ?>
		<tr>
			<td><?php echo $value->user_date; ?></td>
			<td><?php echo $value->user_user; ?></td>
			<td><?php echo $value->user_names; ?></td>
			<td><?php echo $value->user_email; ?></td>
			<td><?php echo $value->socio_cedula; ?></td>
			<td><?php echo $value->socio_nombre; ?></td>
		</tr>
	<?php endforeach ?>
</table>