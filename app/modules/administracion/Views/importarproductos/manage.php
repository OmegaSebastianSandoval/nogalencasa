<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form class="text-left" enctype="multipart/form-data" method="post" action="<?php echo $this->routeform;?>" data-toggle="validator">
		<div class="content-dashboard">
			<input type="hidden" name="csrf" id="csrf" value="<?php echo $this->csrf ?>">
			<input type="hidden" name="csrf_section" id="csrf_section" value="<?php echo $this->csrf_section ?>">
			<?php if ($this->content->archivo_id) { ?>
				<input type="hidden" name="id" id="id" value="<?= $this->content->archivo_id; ?>" />
			<?php }?>
			<div class="row">
				<input type="hidden" name="archivo_puntos"  value="<?php echo $this->content->archivo_puntos ?>">
			<div class="col-4 form-group d-non
			">
					<label for="contenido_archivo_prueba">Archivo de ejemplo</label>

					<a class="btn btn-success btn-block" href="/skins/page/files/archivonogalencasa.xlsx" download>
						Descargar archivo de ejemplo
					</a>
					<div class="help-block with-errors"></div>
				</div>
				<div class="col-12 form-group">
					<label for="archivo_productos" >archivo productos</label>
					<input type="file" name="archivo_productos" id="archivo_productos" class="form-control  file-document" data-buttonName="btn-primary" onchange="validardocumento('archivo_productos');" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >
					<div class="help-block with-errors"></div>
				</div>
				<input type="hidden" name="archivo_cedulas"  value="<?php echo $this->content->archivo_cedulas ?>">
			</div>
		</div>
		<div class="botones-acciones">
			<button class="btn btn-guardar" type="submit">Guardar</button>
			<a href="<?php echo $this->route; ?>" class="btn btn-cancelar d-none">Cancelar</a>
		</div>
	</form>
</div>