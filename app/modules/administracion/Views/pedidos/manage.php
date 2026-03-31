<style type="text/css">
	.acompanamientos {
		font-size: 12px;
		line-height: 14px;
	}

	.pedido-table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 20px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		border-radius: 8px;
		overflow: hidden;
		font-family: 'Arial', sans-serif;
	}

	.pedido-table th,
	.pedido-table td {
		padding: 12px 15px;
		text-align: left;
		border-bottom: 1px solid #e0e0e0;
	}

	.pedido-table th {
		background-color: #f8f9fa;
		font-weight: 600;
		color: #495057;
		text-transform: uppercase;
		font-size: 14px;
		letter-spacing: 0.5px;
	}

	.pedido-table td {
		color: #6c757d;
		font-size: 14px;
	}

	.pedido-table tr:nth-child(even) {
		background-color: #f8f9fa;
	}

	.pedido-table tr:hover {
		background-color: #e9ecef;
	}

	.pedido-table .text-center {
		text-align: center;
	}

	.pedido-table .text-right {
		text-align: right;
	}

	.pedido-table .total-row {
		background-color: #fff3cd;
		font-weight: bold;
	}

	.pedido-table .total-row td {
		border-top: 2px solid #ffc107;
	}
</style>

<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->pedido_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->pedido_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Tipo Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_tipodocumento">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_tipodocumento as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "pedido_tipodocumento") == $key) {
									echo "selected";
								} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_documento" class="control-label">Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_documento; ?>" name="pedido_documento"
							id="pedido_documento" class="form-control" readonly>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_nombre; ?>" name="pedido_nombre" id="pedido_nombre"
							class="form-control" readonly>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_correo" class="control-label">Correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_correo; ?>" name="pedido_correo" id="pedido_correo"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group d-none">
					<label for="pedido_telefono" class="control-label">Telefono</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_telefono; ?>" name="pedido_telefono"
							id="pedido_telefono" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_celular" class="control-label">Celular</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_celular; ?>" name="pedido_celular" id="pedido_celular"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="pedido_nomenclatura" value="<?php echo $this->content->pedido_nomenclatura ?>">

				<input type="hidden" name="pedido_ciudad" value="<?php echo $this->content->pedido_ciudad ?>">

				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Metodo de pago</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_medio">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_medio as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "pedido_medio") == $key) {
									echo "selected";
								} ?>
									value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Forma de envio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_forma_envio">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_forma_envio as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "pedido_forma_envio") == $key) {
									echo "selected";
								} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>



				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_fecha" class="control-label">Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_fecha; ?>" name="pedido_fecha" id="pedido_fecha"
							class="form-control" readonly>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_envio" class="control-label">Valor Envo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_envio; ?>" name="pedido_envio" id="pedido_envio"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="pedido_valorpagar" class="control-label">Valor total</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_valorpagar; ?>" name="pedido_valorpagar"
							id="pedido_valorpagar" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="pedido_zona" value="<?php echo $this->content->pedido_zona ?>">
				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Estado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_estado">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_pedido_estado as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "pedido_estado") == $key) {
									echo "selected";
								} ?>
									value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>


				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Tipo</label>
					<label class="input-group"><input type="text" class="form-control" value="<?php echo $this->tipo; ?>"
							readonly></label>
				</div>

				<?php if ($this->tipo == "INVITADO") { ?>
					<div class="col-12 col-lg-3 form-group">
						<label class="control-label">Socio que lo invitó</label>
						<label class="input-group"><input type="text" class="form-control"
								value="<?php echo $this->socio->socio_nombre; ?>" readonly></label>
					</div>
					<div class="col-12 col-lg-3 form-group">
						<label class="control-label">Documento del socio</label>
						<label class="input-group"><input type="text" class="form-control"
								value="<?php echo $this->socio->socio_cedula; ?>" readonly></label>
					</div>
				<?php } ?>

				<div class="col-12 col-lg-3 form-group d-none">
					<label for="pedido_estado_texto" class="control-label">Estado texto</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_estado_texto; ?>" name="pedido_estado_texto"
							id="pedido_estado_texto" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group d-none">
					<label for="pedido_estado_texto2" class="control-label">Estado texto2</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_estado_texto2; ?>" name="pedido_estado_texto2"
							id="pedido_estado_texto2" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group d-none">
					<label for="pedido_cus" class="control-label">Cus</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_cus; ?>" name="pedido_cus" id="pedido_cus"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group d-none">
					<label for="request_id" class="control-label">Request</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->request_id; ?>" name="request_id" id="request_id"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">IP</label>
					<label class="input-group"><input type="text" class="form-control" value="<?php echo $this->content->ip; ?>"
							readonly></label>
				</div>


				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Nombre para facturación electrónica</label>
					<label class="input-group"><input type="text" class="form-control"
							value="<?php echo $this->content->pedido_nombrefe; ?>" readonly></label>
				</div>

				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Correo para facturación electrónica</label>
					<label class="input-group"><input type="text" class="form-control"
							value="<?php echo $this->content->pedido_correofe; ?>" readonly></label>
				</div>

				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Celular para facturación electrónica</label>
					<label class="input-group"><input type="text" class="form-control"
							value="<?php echo $this->content->pedido_celularfe; ?>" readonly></label>
				</div>

				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Cuotas</label>
					<label class="input-group"><input type="text" class="form-control"
							value="<?php echo $this->content->pedido_cuotas; ?>" readonly></label>
				</div>
				<div class="col-lg-6 form-group">
					<label for="pedido_direccion" class="control-label">Direcci&oacute;n</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_direccion; ?>" name="pedido_direccion"
							id="pedido_direccion" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-lg-6 form-group">
					<label for="pedido_complemento" class="control-label">Complemento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_complemento; ?>" name="pedido_complemento"
							id="pedido_complemento" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-lg-6 form-group">
					<label for="pedido_indicaciones" class="control-label">Indicaciones</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->pedido_indicaciones; ?>" name="pedido_indicaciones"
							id="pedido_indicaciones" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
			</div>


			<div class="col-lg-12">
				<br>
				<h2>Pedido</h2>
				<table class="pedido-table">
					<tr>
						<th>Producto</th>
						<th></th>
						<th class="text-center">Cantidad</th>
						<th class="text-center">Categoria</th>
						<th class="text-right">Valor unitario</th>
						<th class="text-right">Valor total</th>
					</tr>
					<?php foreach ($this->productos as $producto): ?>
						<tr>
							<td><?php echo $producto->nombre; ?><br>
								<div class="acompanamientos"><?php echo str_replace("\n", "<br>", $producto->acompanamientos); ?></div>
								<div class="acompanamientos"><?php echo str_replace("\n", "<br>", $producto->termino); ?></div>
							</td>
							<td>
								<?php if ($producto->productoinfo->productos_imagen != "" and file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/" . $producto->productoinfo->productos_imagen) === true) { ?>
									<img src="/images/<?php echo $producto->productoinfo->productos_imagen; ?>" class="img-fluid" />
								<?php } else { ?>
									<img src="/corte/product.png" class="img-fluid" />
								<?php } ?>
							</td>
							<td class="text-center"><?php echo $producto->cantidad; ?></td>
							<td class="text-center">
								<?php echo $producto->categorianombre;
								if ($producto->subcategoriacategorianombre) {
									echo " > $producto->subcategoriacategorianombre";
								} ?>
							</td>
							<td class="text-right">$<?php echo number_format($producto->valor); ?></td>
							<td class="text-right">$<?php echo number_format((int) $producto->valor * (int) $producto->cantidad); ?>
							</td>
						</tr>
					<?php endforeach ?>
					<tr>
						<td colspan="5"><b>Costo envío</b></td>
						<td class="text-right">$<?php echo number_format((int) $this->content->pedido_envio); ?></td>
					</tr>
					<tr>
						<td colspan="5"><b>Propina</b></td>
						<td class="text-right">$<?php echo number_format((int) $this->content->pedido_propina); ?></td>
					</tr>
					<tr class="total-row">
						<td colspan="5"><b>Total</b></td>
						<td class="text-right">$<?php echo number_format($this->content->pedido_valorpagar); ?></td>
					</tr>
				</table>
			</div>

		</div>






		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>

<script type="text/javascript">
	<?php if ($_SESSION['kt_login_level'] == "4") { ?>
		function f1 () {
			$("input").prop("disabled", true);
			$("select").prop("disabled", true);
			$(".btn-guardar").hide();
		}
		setTimeout(f1(), 1000);
		setTimeout(f1(), 2000);
		setTimeout(f1(), 3000);
	<?php } ?>
</script>
<style>
	.img-fluid{
		max-width: 100px;
		height: auto;
	}
	input:read-only{
		background: #e9ecef !important;
	}
</style>