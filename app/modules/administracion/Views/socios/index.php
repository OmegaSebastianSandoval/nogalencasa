<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route; ?>" method="post">
		<div class="content-dashboard">
			
			<div class="row">
				<div class="col-3">
					<label>Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="socio_cedula"
							value="<?php echo $this->getObjectVariable($this->filters, 'socio_cedula') ?>"></input>
					</label>
				</div>
				<div class="col-3 d-none">
					<label>Tipo documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-azul "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="socio_tipo_documento">
							<option value="">Todas</option>
							<?php foreach ($this->list_socio_tipo_documento as $key => $value): ?>
								<option value="<?= $key; ?>" <?php if ($this->getObjectVariable($this->filters, 'socio_tipo_documento') == $key) {
										echo "selected";
									} ?>><?= $value; ?></option>
							<?php endforeach ?>
						</select>
					</label>
				</div>
				<div class="col-3">
					<label>Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-morado "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="socio_nombre"
							value="<?php echo $this->getObjectVariable($this->filters, 'socio_nombre') ?>"></input>
					</label>
				</div>
				<div class="col-2">
					<label>Carnet</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="socio_carnet"
							value="<?php echo $this->getObjectVariable($this->filters, 'socio_carnet') ?>"></input>
					</label>
				</div>
				<div class="col-3 d-none">
					<label>Correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-azul-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="socio_correo"
							value="<?php echo $this->getObjectVariable($this->filters, 'socio_correo') ?>"></input>
					</label>
				</div>
				<div class="col-3 d-none">
					<label>Celular</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="socio_celular"
							value="<?php echo $this->getObjectVariable($this->filters, 'socio_celular') ?>"></input>
					</label>
				</div>
				<div class="col-3 d-none">
					<label>Activo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="socio_estado"
							value="<?php echo $this->getObjectVariable($this->filters, 'socio_estado') ?>"></input>
					</label>
				</div>
				<div class="col-2">
					<label>&nbsp;</label>
					<button type="submit" class="btn btn-block btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
				</div>
				<div class="col-2">
					<label>&nbsp;</label>
					<a class="btn btn-block btn-azul-claro " href="<?php echo $this->route; ?>?cleanfilter=1"> <i
							class="fas fa-eraser"></i> Limpiar Filtro</a>
				</div>
			</div>
		</div>
	</form>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			$min = $this->page - 10;
			$max = $this->page + 10;
			if ($this->totalpages > 1) {
				if ($this->page != 1) {
					echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
				}
				for ($i = 1; $i <= $this->totalpages; $i++) {
					if ($this->page == $i) {
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					} else {
						if ($i >= $min and $i <= $max) {
							echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
						}
					}
				}
				if ($this->page != $this->totalpages) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
				}
			}
			?>
		</ul>
	</div>
	<div class="content-dashboard">
		<div class="franja-paginas">
			<div class="row">
				<div class="col-5">
					<div class="titulo-registro">Se encontraron <?php echo $this->register_number; ?> Registros</div>
				</div>
				<div class="col-3 text-right">
					<div class="texto-paginas">Registros por pagina:</div>
				</div>
				<div class="col-1">
					<select class="form-control form-control-sm selectpagination">
						<option value="20" <?php if ($this->pages == 20) {
							echo 'selected';
						} ?>>20</option>
						<option value="30" <?php if ($this->pages == 30) {
							echo 'selected';
						} ?>>30</option>
						<option value="50" <?php if ($this->pages == 50) {
							echo 'selected';
						} ?>>50</option>
						<option value="100" <?php if ($this->pages == 100) {
							echo 'selected';
						} ?>>100</option>
					</select>
				</div>
				<div class="col-3">
					<?php if ($_SESSION['kt_login_level'] == "1" or $_SESSION['kt_login_level'] == "3") { ?>
						<div class="text-right"><a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage"; ?>"> <i
									class="fas fa-plus-square"></i> Crear Nuevo</a></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="content-table">
			<table class=" table table-striped  table-hover table-administrator text-left">
				<thead>
					<tr>
						<td>Documento</td>
						<td>Tipo documento</td>
						<td>Nombre</td>
						<td>Carnet</td>
						<td>Correo</td>
						<td>Celular</td>
						<td>Activo</td>
						<td width="100"></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
						<?php $id = $content->socio_id; ?>
						<tr>
							<td><?= $content->socio_cedula; ?></td>
							<td><?= $this->list_socio_tipo_documento[$content->socio_tipo_documento]; ?>
							<td><?= $content->socio_nombre; ?></td>
							<td><?= $content->socio_carnet; ?></td>
							<td><?= $content->socio_correo; ?></td>
							<td><?= $content->socio_celular; ?></td>
							<td><?= $content->socio_estado; ?></td>
							<td class="text-right">
								<div>
									<?php if ($_SESSION['kt_login_level'] == "1" or $_SESSION['kt_login_level'] == "3") { ?>
										<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
											data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
										<span data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
											<a class="btn btn-rojo btn-sm" data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>">
												<i class="fas fa-trash-alt"></i>
											</a>
										</span>
									<?php } ?>
									<?php if ($_SESSION['kt_login_level'] == "4") { ?>
										<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
											data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
									<?php } ?>
								</div>
								<!-- Modal -->
								<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" aria-labelledby="myModalLabel"
									aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												¿Está seguro de eliminar este registro?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
												<a class="btn btn-danger"
													href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?>">Eliminar</a>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<input type="hidden" id="csrf" value="<?php echo $this->csrf ?>"><input type="hidden" id="page-route"
			value="<?php echo $this->route; ?>/changepage">
	</div>
	<div align="center">
		<ul class="pagination justify-content-center">
			<?php
			$url = $this->route;
			$min = $this->page - 10;
			$max = $this->page + 10;
			if ($this->totalpages > 1) {
				if ($this->page != 1) {
					echo '<li class="page-item" ><a class="page-link"  href="' . $url . '?page=' . ($this->page - 1) . '"> &laquo; Anterior </a></li>';
				}
				for ($i = 1; $i <= $this->totalpages; $i++) {
					if ($this->page == $i) {
						echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
					} else {
						if ($i >= $min and $i <= $max) {
							echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . '">' . $i . '</a></li>  ';
						}
					}
				}
				if ($this->page != $this->totalpages) {
					echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . '">Siguiente &raquo;</a></li>';
				}
			}
			?>
		</ul>
	</div>
</div>