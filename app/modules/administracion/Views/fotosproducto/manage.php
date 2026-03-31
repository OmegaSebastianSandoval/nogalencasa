<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->fotos_productos_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->fotos_productos_id; ?>" />
			<?php }?>
			<div class="row">
		<div class="col-12 form-group " style="display: grid;">
			<label   class="control-label">Activar</label>
				<input type="checkbox" name="fotos_productos_estado" value="1" class="form-control switch-form " <?php if ($this->getObjectVariable($this->content, 'fotos_productos_estado') == 1) { echo "checked";} ?>   ></input>
				<div class="help-block with-errors"></div>
		</div>
				<div class="col-12 form-group">
					<label for="fotos_productos_imagen" >Imagen</label>
					<input type="file" name="fotos_productos_imagen" id="fotos_productos_imagen" class="form-control  file-image" data-buttonName="btn-primary" accept="image/gif, image/jpg, image/jpeg, image/png"  >
					<div class="help-block with-errors"></div>
					<?php if($this->content->fotos_productos_imagen) { ?>
						<div id="imagen_fotos_productos_imagen">
							<img src="/images/<?= $this->content->fotos_productos_imagen; ?>"  class="img-thumbnail thumbnail-administrator" />
							<div><button class="btn btn-danger btn-sm" type="button" onclick="eliminarImagen('fotos_productos_imagen','<?php echo $this->route."/deleteimage"; ?>')"><i class="glyphicon glyphicon-remove" ></i> Eliminar Imagen</button></div>
						</div>
					<?php } ?>
				</div>
				<input type="hidden" name="fotos_productos_producto"  value="<?php if($this->content->fotos_productos_producto){ echo $this->content->fotos_productos_producto; } else { echo $this->producto; } ?>">
				<div class="col-12 form-group" style="display: none;">
					<label for="fotos_productos_nombre"  class="control-label">fotos_productos_nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->fotos_productos_nombre; ?>" name="fotos_productos_nombre" id="fotos_productos_nombre" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group" style="display: none;">
					<label for="fotos_productos_descripcion" class="form-label" >fotos_productos_descripcion</label>
					<textarea name="fotos_productos_descripcion" id="fotos_productos_descripcion"   class="form-control tinyeditor" rows="10"   ><?= $this->content->fotos_productos_descripcion; ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?producto=<?php if($this->content->fotos_productos_producto){ echo $this->content->fotos_productos_producto; } else { echo $this->producto; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>