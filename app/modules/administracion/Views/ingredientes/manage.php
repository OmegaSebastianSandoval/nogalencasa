<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->ingrediente_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->ingrediente_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-2 form-group d-grid" style="height: 70px;">
					<label class="control-label">Activo(Si, No)</label>
					<input type="checkbox" name="ingrediente_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'ingrediente_estado') == 1) {
						echo "checked";
					} ?>></input>
				</div>
			

				<div class="col-4 form-group">
					<label for="ingrediente_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingrediente_nombre; ?>" name="ingrediente_nombre"
							id="ingrediente_nombre" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 form-group">
					<label for="ingrediente_precio" class="control-label">Precio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->ingrediente_precio; ?>" name="ingrediente_precio"
							id="ingrediente_precio" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-3 form-group">
					<label for="ingrediente_imagen">Imagen</label>
					<input type="file" name="ingrediente_imagen" id="ingrediente_imagen" class="form-control  file-image"
						data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->ingrediente_imagen) { ?>
						<div id="imagen_ingrediente_imagen">
							<img src="/images/<?= $this->content->ingrediente_imagen; ?>"
								class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('ingrediente_imagen','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>

				<input type="hidden" name="ingrediente_producto" value="<?php if ($this->content->ingrediente_producto) {
					echo $this->content->ingrediente_producto;
				} else {
					echo $this->ingrediente_producto;
				} ?>">

				<div class="col-12 form-group">
					<label for="ingrediente_descripcion" class="form-label">Descripción</label>
					<textarea name="ingrediente_descripcion" id="ingrediente_descripcion" class="form-control tinyeditor"
						rows="10"><?= $this->content->ingrediente_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?ingrediente_producto=<?php if ($this->content->ingrediente_producto) {
					 echo $this->content->ingrediente_producto;
				 } else {
					 echo $this->ingrediente_producto;
				 } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>