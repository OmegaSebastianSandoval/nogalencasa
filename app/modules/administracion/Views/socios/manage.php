<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->socio_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->socio_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 col-lg-3 form-group d-grid" style="height: 70px;">
					<label class="control-label">Activo</label>
					<input type="checkbox" name="socio_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'socio_estado') == 1) {
						echo "checked";
					} ?>></input>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_cedula" class="control-label">Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_cedula; ?>" name="socio_cedula" id="socio_cedula"
							class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">Tipo documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="socio_tipo_documento">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_socio_tipo_documento as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "socio_tipo_documento") == $key) {
									echo "selected";
								} ?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_nombre; ?>" name="socio_nombre" id="socio_nombre"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_carnet" class="control-label">Carnet</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_carnet; ?>" name="socio_carnet" id="socio_carnet"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_direccion" class="control-label">Direcci&oacute;n</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_direccion; ?>" name="socio_direccion"
							id="socio_direccion" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_ciudad" class="control-label">Ciudad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_ciudad; ?>" name="socio_ciudad" id="socio_ciudad"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_correo" class="control-label">Correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_correo; ?>" name="socio_correo" id="socio_correo"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_telefono" class="control-label">T&eacute;lefono</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_telefono; ?>" name="socio_telefono" id="socio_telefono"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group">
					<label for="socio_celular" class="control-label">Celular</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->socio_celular; ?>" name="socio_celular" id="socio_celular"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

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