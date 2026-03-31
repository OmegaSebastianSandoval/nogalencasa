<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->termino_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->termino_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-12 form-group">
					<label for="termino_nombre"  class="control-label">Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-verde " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->termino_nombre; ?>" name="termino_nombre" id="termino_nombre" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group d-none">
					<label for="termino_tipo"  class="control-label">Tipo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->termino_tipo; ?>" name="termino_tipo" id="termino_tipo" class="form-control"   >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="termino_producto"  value="<?php if($this->content->termino_producto){ echo $this->content->termino_producto; } else { echo $this->termino_producto; } ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?termino_producto=<?php if($this->content->termino_producto){ echo $this->content->termino_producto; } else { echo $this->termino_producto; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>