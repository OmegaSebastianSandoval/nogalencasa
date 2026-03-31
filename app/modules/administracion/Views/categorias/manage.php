<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->categorias_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->categorias_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 col-lg-8 form-group">
					<label for="categorias_nombre" class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->categorias_nombre; ?>" name="categorias_nombre"
							id="categorias_nombre" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-4 form-group">
					<label for="categorias_imagen">imagen</label>
					<input type="file" name="categorias_imagen" id="categorias_imagen" class="form-control  file-image"
						data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->categorias_imagen) { ?>
						<div id="imagen_categorias_imagen">
							<img src="/images/<?= $this->content->categorias_imagen; ?>"
								class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('categorias_imagen','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 form-group">
					<label for="categorias_descripcion" class="form-label">Descripcion</label>
					<textarea name="categorias_descripcion" id="categorias_descripcion" class="form-control tinyeditor"
						rows="10"><?= $this->content->categorias_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>


				<input type="hidden" name="padre" value="<?php echo $_GET['padre']; ?>">
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
			$(".tinyeditor").removeClass("tinyeditor");
			$("input").prop("disabled", true);
			$("select").prop("disabled", true);
			$("textarea").prop("disabled", true);
			$(".btn-guardar").hide();
		}
		setTimeout(f1(), 1000);
		setTimeout(f1(), 2000);
		setTimeout(f1(), 3000);
	<?php } ?>
</script>