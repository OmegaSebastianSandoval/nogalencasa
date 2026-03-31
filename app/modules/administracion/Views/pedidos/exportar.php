<?php

if ($this->excel == "") {
	function codificar($x)
	{
		return $x;
	}
} else {
	function codificar($x)
	{
		$x = utf8_decode($x);
		return $x;
	}
}


?>


<?php if ($this->excel == "") { ?>
	<form id="form1" name="form1" method="get" action="/administracion/pedidos/exportar/">
		<div class="d-flex align-items-center justify-content-between mb-3 p-3 bg-light rounded">
			<div class="row d-flex align-items-center w-100">
			
					<div class="col-12 col-lg-6 d-flex align-items-center gap-2">
					<label class="me-2 fw-bold">Rango de fechas:</label>
					<input type="date" name="fecha1" id="fecha1" value="<?php echo $this->fecha1; ?>" class="form-control me-2"
						style="width: auto;" />
					<span class="me-2">-</span>

					<input type="date" name="fecha2" id="fecha2" value="<?php echo $this->fecha2; ?>" class="form-control me-3"
						style="width: auto;" />
				</div>
				<div class="col-12 col-lg-2">
					<button name="filtro" type="submit" class="btn btn-primary btn-block me-2">Filtrar</button>
				</div>
				<div class="col-12 col-lg-2">
					<a href="/administracion/pedidos/exportar/" class="btn btn-block btn-secondary me-2">Limpiar</a>
				</div>
				<div class="col-12 col-lg-2">
					<a href="/administracion/pedidos/exportar/?fecha1=<?php echo $this->fecha1; ?>&fecha2=<?php echo $this->fecha2; ?>&excel=1"
						class="btn btn-success btn-block">Exportar</a>
				</div>





			</div>
		</div>
	</form>
<?php } ?>

<div class="container">
	<div style="max-height: 70vh; overflow-y: auto;">
		<table class="table table-striped table-hover table-sm" style="font-size: 12px;"
			border="<?php echo $this->excel != "" ? '1' : ''; ?>">
			<thead
				style="position: sticky; top: 0; background-color: white; z-index: 1; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
				<tr>
					<th># de pedido</th>
					<th>Fecha y hora de pedido</th>
					<th>Zona</th>
					<th># de accion</th>
					<th>Tipo de usuario</th>
					<th>Quien lo invitó</th>
					<th>Nombre de usuario</th>
					<th>Direccion</th>
					<th>Complemento</th>
					<th>Indicaciones</th>
					<th>Correo</th>
					<th>Contacto celular</th>
					<th>Metodo de envio</th>
					<th>Forma de pago</th>
					<th>Franquicia</th>
					<th>Estado de pago</th>
					<th>Categoria</th>
					<th>codigo producto</th>
					<th>nombre de producto</th>
					<th>cantidad</th>
					<th>valor total producto</th>
					<th>valor total pedido</th>
					<th>cuotas</th>
					<th>valor envio</th>
					<th>valor propina</th>
					<th>Nombre para facturacion electronica</th>
					<th>Correo para facturacion electronica</th>
					<th>Celular para facturacion electronica</th>
					<th>IP</th>

				</tr>
			</thead>
			<tbody>
				<?php foreach ($this->pedidos as $key => $pedido): ?>
					<?php $socio = $this->array_socios[$pedido->pedido_documento]; ?>
					<?php foreach ($pedido->productos as $key2 => $producto) { ?>
						<tr>
							<td><?php echo $pedido->pedido_id; ?></td>
							<td><?php echo $pedido->pedido_fecha; ?></td>
							<td><?php echo $pedido->pedido_zona; ?></td>
							<td><?php echo $socio->socio_carnet; ?></td>
							<td>
								<?php
								if ($socio->socio_carnet != "") {
									echo "SOCIO";
								} else {
									if ($pedido->pedido_quien_accion == "" or $pedido->pedido_quien_accion == "00000000") {
										echo "INVITADO NUX";
									} else {
										echo "INVITADO";
									}
								}
								?>
							</td>
							<td><?php echo $this->array_accion[$pedido->pedido_quien_accion]; ?></td>
							<td><?php echo codificar($pedido->pedido_nombre); ?></td>
							<td><?php echo $pedido->pedido_direccion; ?></td>
							<td><?php echo $pedido->pedido_complemento; ?></td>
							<td><?php echo $pedido->pedido_indicaciones; ?></td>
							<td><?php echo $pedido->pedido_correo; ?></td>
							<td><?php echo $pedido->pedido_celular; ?></td>
							<td><?php echo codificar($this->list_pedido_forma_envio[$pedido->pedido_forma_envio]); ?></td>
							<td><?php echo codificar($this->list_pedido_medio[$pedido->pedido_medio]); ?></td>
							<td><?php echo codificar($pedido->pedido_franquicia); ?></td>
							<td><?php echo $this->list_pedido_estado[$pedido->pedido_estado]; ?></td>
							<td><?php echo codificar($this->array_categorias[$producto->id_productos]); ?></td>
							<td><?php echo $this->array_codigos[$producto->id_productos]; ?></td>
							<td><?php echo codificar($producto->nombre); ?></td>
							<td><?php echo $producto->cantidad; ?></td>
							<td><?php echo (int) $producto->valor_iva * (int) $producto->cantidad; ?></td>
							<td><?php echo $pedido->pedido_valorpagar; ?></td>
							<td><?php echo $pedido->pedido_cuotas; ?></td>
							<td><?php echo $pedido->pedido_envio; ?></td>
							<td><?php echo $pedido->pedido_propina; ?></td>
							<td><?php echo $pedido->pedido_nombrefe; ?></td>
							<td><?php echo $pedido->pedido_correofe; ?></td>
							<td><?php echo $pedido->pedido_celularfe; ?></td>
							<td><?php echo $pedido->ip; ?></td>
						</tr>
					<?php } ?>
				<?php endforeach ?>

			</tbody>
		</table>
	</div>
</div>