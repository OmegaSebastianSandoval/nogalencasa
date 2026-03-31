<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->config_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->config_id; ?>" />
			<?php } ?>
			<div class="row">

				<div class="col-12 col-lg-3 form-group opciones opcion1" style="display: grid;">
					<label for="config_opcional" class="control-label">opcional</label>


					<input type="checkbox" name="config_opcional" id="config_opcional" value="1" data-toggle="toggle"
						class="form-control" data-onstyle="success" <?php if ($this->getObjectVariable($this->content, 'config_opcional') == 1) {
							echo "checked";
						} ?> data-on="Si" data-off="No" data-offstyle="danger"></input>


					<div class="help-block with-errors"></div>
				</div>
			</div>
			<div class="row">

				<div class="col-12 col-lg-3 form-group">
					<label class="control-label">tipo de propina</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" id="config_tipo" name="config_tipo" onchange="filtrar_opciones();">
							<?php foreach ($this->list_config_tipo as $key => $value) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "config_tipo") == $key) {
									echo "selected";
								} ?>
									value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group opcion1 opciones">
					<label for="config_valor_minimo" class="control-label">valor m&iacute;nimo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" value="<?= $this->content->config_valor_minimo; ?>" name="config_valor_minimo"
							id="config_valor_minimo" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3 form-group opcion1 opciones">
					<label for="config_valor_maximo" class="control-label">valor m&aacute;ximo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" value="<?= $this->content->config_valor_maximo; ?>" name="config_valor_maximo"
							id="config_valor_maximo" class="form-control">
					</label>
					<div class="help-block with-errors opcion2 opciones"></div>
				</div>
				<div class="col-12 col-lg-3 form-group opcion3 opciones">
					<label for="config_porcentaje" class="control-label">porcentaje %</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" value="<?= $this->content->config_porcentaje; ?>" name="config_porcentaje"
							id="config_porcentaje" class="form-control">
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
	function filtrar_opciones () {
		$(".opciones").hide();
		var x = $("#config_tipo").val();
		if (x == 1) {
			$(".opcion1").show();
		}
		if (x == 2) {
			$(".opcion2").show();
		}
		if (x == 3) {
			$(".opcion3").show();
		}
	}
	filtrar_opciones();
</script>