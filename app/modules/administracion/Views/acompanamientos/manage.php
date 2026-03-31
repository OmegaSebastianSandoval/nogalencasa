<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->acomp_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->acomp_id; ?>" />
			<?php }?>
			<div class="row">
				<div class="col-12 form-group">
					<label for="acomp_nombre"  class="control-label">nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-azul-claro " ><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" value="<?= $this->content->acomp_nombre; ?>" name="acomp_nombre" id="acomp_nombre" class="form-control"  required >
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label class="control-label">tipo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono  fondo-rosado " ><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="acomp_tipo"  required >
							<option value="">Seleccione...</option>
							<?php foreach ($this->list_acomp_tipo AS $key => $value ){?>
								<option <?php if($this->getObjectVariable($this->content,"acomp_tipo") == $key ){ echo "selected"; }?> value="<?php echo $key; ?>" /> <?= $value; ?></option>
							<?php } ?>
						</select>
					</label>
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="acomp_producto"  value="<?php if($this->content->acomp_producto){ echo $this->content->acomp_producto; } else { echo $this->producto; } ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>?producto=<?php if($this->content->acomp_producto){ echo $this->content->acomp_producto; } else { echo $this->producto; } ?>" class="btn btn-cancelar">Cancelar</a>
		</div>
	</form>
</div>