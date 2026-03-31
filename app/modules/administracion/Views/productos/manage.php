<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform; ?>"
		data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->productos_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->productos_id; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-12 col-lg-3  form-group d-grid" style="height: 70px;">
					<label for="productos_nuevo" class="control-label">Nuevo</label>
					<input type="checkbox" name="productos_nuevo" id="productos_nuevo" value="1" data-toggle="toggle"
						class="form-control" data-onstyle="success" <?php if ($this->getObjectVariable($this->content, 'productos_nuevo') == 1) {
							echo "checked";
						} ?> data-on="Activado" data-off="Desactivado"
						data-offstyle="danger"></input>
					<div class="help-block with-errors"></div>
				</div>
				
				<div class="col-12 col-lg-3 form-group">
					<label for="productos_nombre" class="control-label">nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_nombre; ?>" name="productos_nombre"
							id="productos_nombre" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="productos_codigo" class="control-label">código</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_codigo; ?>" name="productos_codigo"
							id="productos_codigo" class="form-control" required>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 col-lg-3 form-group">
					<label for="productos_imagen">imagen</label>
					<input type="file" name="productos_imagen" id="productos_imagen" class="form-control  file-image"
						data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png">
					<div class="help-block with-errors"></div>
					<?php if ($this->content->productos_imagen) { ?>
						<div id="imagen_productos_imagen">
							<img src="/images/<?= $this->content->productos_imagen; ?>" class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button"
									onclick="eliminarImagen('productos_imagen','<?php echo $this->route . "/deleteimage"; ?>')"><i
										class="glyphicon glyphicon-remove"></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<div class="col-6 form-group d-none">
					<label for="productos_destacado" class="control-label">destacado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_destacado; ?>" name="productos_destacado"
							id="productos_destacado" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label for="productos_precio" class="control-label">precio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_precio; ?>" name="productos_precio"
							id="productos_precio" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<!--<div class="col-6 form-group d-none">-->
				<!--	<label for="productos_nuevo"  class="control-label">nuevo</label>-->
				<!--	<label class="input-group">-->
				<!--		<div class="input-group-prepend">-->
				<!--			<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>-->
				<!--		</div>-->
				<!--		<input type="text" value="<?= $this->content->productos_nuevo; ?>" name="productos_nuevo" id="productos_nuevo" class="form-control"   >-->
				<!--	</label>-->
				<!--	<div class="help-block with-errors"></div>-->
				<!--</div>-->
				<div class="col-12 col-lg-3  form-group">
					<label for="productos_cantidad" class="control-label">cantidad</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->productos_cantidad; ?>" name="productos_cantidad"
							id="productos_cantidad" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 col-lg-3  form-group">
					<label class="control-label">categoria</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="productos_categorias" id="productos_categorias"
							onchange="filtrar_subcategorias()">
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_productos_categorias as $key => $categoria) { ?>
								<option <?php if ($this->getObjectVariable($this->content, "productos_categorias") == $key) {
									echo "selected";
								} ?> value="<?php echo $key; ?>" /> <?= $categoria; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 col-lg-3  form-group">
					<label class="control-label">subcategoria</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-morado "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="productos_subcategoria" id="productos_subcategoria">
							<option value="">Seleccione...</option>
							<?php if (1 == 0) { ?>
								<?php foreach ($this->list_productos_subcategorias as $key => $categoria) { ?>
									<option <?php if ($this->getObjectVariable($this->content, "productos_subcategoria") == $key) {
										echo "selected";
									} ?> value="<?php echo $key; ?>" /> <?= $categoria; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 col-lg-3 form-group">
					<label for="productos_cantidad_minima" class="control-label">cantidad mínima en inventario</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" value="<?= $this->content->productos_cantidad_minima; ?>"
							name="productos_cantidad_minima" id="productos_cantidad_minima" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>

				<div class="col-12 col-lg-4 form-group">
					<label for="productos_limite_pedido" class="control-label">limitar la cantidad de unidades por pedido</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="number" value="<?= $this->content->productos_limite_pedido; ?>" name="productos_limite_pedido"
							id="productos_limite_pedido" class="form-control">
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="productos_descripcion" class="form-label">descripción</label>
					<textarea name="productos_descripcion" id="productos_descripcion" class="form-control tinyeditor"
						rows="10"><?= $this->content->productos_descripcion; ?></textarea>
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
	function filtrar_subcategorias () {
		var categoria = $("#productos_categorias").val();
		var seleccionado = '<?php echo $this->content->productos_subcategoria; ?>';
		$.post("/administracion/productos/filtrarcategorias", { "categoria": categoria, "seleccionado": seleccionado }, function (res) {
			$("#productos_subcategoria").html(res.valores);
		});
	}

	filtrar_subcategorias();
</script>

<script type="text/javascript">
	<?php if ($_SESSION['kt_login_level'] == "4") { ?>
		function f1 () {
			$(".file-image").removeClass("file-image");
			$(".tinyeditor").removeClass("tinyeditor");
			$("input").prop("disabled", true);
			$("select").prop("disabled", true);
			$("textarea").prop("disabled", true);
			$(".btn-guardar").hide();
			$(".file-image").hide();
		}
		setTimeout(f1(), 1000);
		setTimeout(f1(), 2000);
		setTimeout(f1(), 3000);
	<?php } ?>
</script>