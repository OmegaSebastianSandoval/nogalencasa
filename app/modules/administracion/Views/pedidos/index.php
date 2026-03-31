<style type="text/css">
	.table-striped tbody tr:nth-of-type(2n+1) {
		background-color: #eee;
	}

	.table-striped tbody tr:nth-of-type(2n) {
		background-color: #fff;
	}

	.table-striped tbody tr {
		font-size: 13px;
	}
</style>

<h1 class="titulo-principal"><i class="fas fa-cogs"></i> <?php echo $this->titlesection; ?></h1>
<div class="container-fluid">
	<form action="<?php echo $this->route; ?>" method="post">
		<div class="content-dashboard">
			<div class="row">
				<div class="col-lg-2">
					<label>Número pedido</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="pedido_id"
							value="<?php echo $this->getObjectVariable($this->filters, 'pedido_id') ?>"></input>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Documento</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="pedido_documento"
							value="<?php echo $this->getObjectVariable($this->filters, 'pedido_documento') ?>"></input>
					</label>
				</div>
				<div class="col-lg-4">
					<label>Nombre</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-azul "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="pedido_nombre"
							value="<?php echo $this->getObjectVariable($this->filters, 'pedido_nombre') ?>"></input>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Correo</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-cafe "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="pedido_correo"
							value="<?php echo $this->getObjectVariable($this->filters, 'pedido_correo') ?>"></input>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Metodo de pago</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-rosado "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_medio">
							<option value="">Todas</option>
							<?php foreach ($this->list_pedido_medio as $key => $value): ?>
									<option value="<?= $key; ?>" <?php if ($this->getObjectVariable($this->filters, 'pedido_medio') == $key) {
											echo "selected";
										} ?>><?= $value; ?></option>
							<?php endforeach ?>
						</select>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Forma de envio</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-morado "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_forma_envio">
							<option value="">Todas</option>
							<?php foreach ($this->list_pedido_forma_envio as $key => $value): ?>
									<option value="<?= $key; ?>" <?php if ($this->getObjectVariable($this->filters, 'pedido_forma_envio') == $key) {
											echo "selected";
										} ?>><?= $value; ?></option>
							<?php endforeach ?>
						</select>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Fecha</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-rojo-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="pedido_fecha"
							value="<?php echo $this->getObjectVariable($this->filters, 'pedido_fecha') ?>"></input>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Valor total</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-verde-claro "><i class="fas fa-pencil-alt"></i></span>
						</div>
						<input type="text" class="form-control" name="pedido_valorpagar"
							value="<?php echo $this->getObjectVariable($this->filters, 'pedido_valorpagar') ?>"></input>
					</label>
				</div>
				<div class="col-lg-2">
					<label>Estado</label>
					<label class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text input-icono fondo-azul-claro "><i class="far fa-list-alt"></i></span>
						</div>
						<select class="form-control" name="pedido_estado">
							<option value="">Todas</option>
							<?php foreach ($this->list_pedido_estado as $key => $value): ?>
									<option value="<?= $key; ?>" <?php if ($this->getObjectVariable($this->filters, 'pedido_estado') == $key) {
											echo "selected";
										} ?>><?= $value; ?></option>
							<?php endforeach ?>
						</select>
					</label>
				</div>
				<div class="col-lg-2">
					<label>&nbsp;</label>
					<button type="submit" class="btn btn-block btn-azul"> <i class="fas fa-filter"></i> Filtrar</button>
				</div>
				<div class="col-lg-2">
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
				<div class="col-lg-2 text-right">
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
				<div class="col-lg-2 d-none">
					<?php if (1 == 0) { ?>
							<div class="text-right"><a class="btn btn-sm btn-success" href="<?php echo $this->route . "\manage"; ?>"> <i
										class="fas fa-plus-square"></i> Crear Nuevo</a></div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="content-table">
			<table class=" table table-striped  table-hover table-administrator text-left" style="font-size: 13px;">
				<thead>
					<tr>
						<td>Número</td>
						<td>Tipo</td>
						<td>Documento</td>
						<td>Nombre</td>
						<td>Correo</td>
						<td>Metodo de pago</td>
						<td>Forma de envio</td>
						<td>Fecha</td>
						<td>Valor total</td>
						<td>Estado</td>
						<td width="100"></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->lists as $content) { ?>
							<?php $id = $content->pedido_id; ?>
							<tr>
								<td><?= $id; ?></td>
								<td>
									<?php
									if ($content->pedido_numeroaccion != "") {
										echo "SOCIO";
									} else {
										if ($content->pedido_quien_accion == "" or $content->pedido_quien_accion == "00000000") {
											echo "INVITADO NUX";
										} else {
											echo "INVITADO";
										}
									}
									?>
								</td>
								<td><?= $content->pedido_documento; ?></td>
								<td><?= $content->pedido_nombre; ?></td>
								<td><?= $content->pedido_correo; ?></td>
								<td><?= $this->list_pedido_medio[$content->pedido_medio]; ?>
								<td><?= $this->list_pedido_forma_envio[$content->pedido_forma_envio]; ?>
								<td><?= $content->pedido_fecha; ?></td>
								<td><?= number_format($content->pedido_valorpagar); ?></td>
								<td><?= $this->list_pedido_estado[$content->pedido_estado]; ?>
								<td class="text-right">
									<div>
										<?php if ($_SESSION['kt_login_level'] == "1" or $_SESSION['kt_login_level'] == "3") { ?>
												<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
													data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-pen-alt"></i></a>
												<span data-toggle="tooltip" data-placement="top" title="Eliminar"><a class="btn btn-rojo btn-sm"
														data-bs-toggle="modal" data-bs-target="#modal<?= $id ?>"><i class="fas fa-trash-alt"></i></a></span>
										<?php } ?>
										<?php if ($_SESSION['kt_login_level'] == "4") { ?>
												<a class="btn btn-azul btn-sm" href="<?php echo $this->route; ?>/manage?id=<?= $id ?>"
													data-toggle="tooltip" data-placement="top" title="Ver"><i class="fas fa-eye"></i></a>
										<?php } ?>
									</div>
									<!-- Modal -->
									<div class="modal fade text-left" id="modal<?= $id ?>" tabindex="-1" role="dialog"
										aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="">¿Esta seguro de eliminar este registro?</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
													<a class="btn btn-danger"
														href="<?php echo $this->route; ?>/delete?id=<?= $id ?>&csrf=<?= $this->csrf; ?><?php echo ''; ?>">Eliminar</a>
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