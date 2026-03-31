<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->zona_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->zona_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 col-lg-3  form-group">
					<label class="control-label">Activa</label><br>
					<input type="checkbox" name="zona_activa" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'zona_activa') == 1) {
						echo "checked";
					} ?>></input>
					<div class="help-block with-errors"></div>
				</div>
			</div>

			<div class="row">

				<div class="ccol-12 col-lg-3 form-group">
					<label for="zona_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_nombre; ?>" name="zona_nombre" id="zona_nombre"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="zona_calle_min" class="control-label">Calle min</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_calle_min; ?>" name="zona_calle_min" id="zona_calle_min"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="zona_calle_max" class="control-label">Calle max</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_calle_max; ?>" name="zona_calle_max" id="zona_calle_max"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>


				<div class="col-12 col-lg-3  form-group">
					<label for="zona_calle_min2" class="control-label">Calle min2</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_calle_min2; ?>" name="zona_calle_min2"
							id="zona_calle_min2" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="zona_calle_max2" class="control-label">Calle max2</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_calle_max2; ?>" name="zona_calle_max2"
							id="zona_calle_max2" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 col-lg-3  form-group">
					<label for="zona_cra_min" class="control-label">Carrera min</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_cra_min; ?>" name="zona_cra_min" id="zona_cra_min"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="zona_cra_max" class="control-label">Carrera max</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_cra_max; ?>" name="zona_cra_max" id="zona_cra_max"
							class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="zona_valor" class="control-label">Valor</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->zona_valor; ?>" name="zona_valor" id="zona_valor"
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