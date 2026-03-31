<style type="text/css">
	.acompanamientos {
		font-size: 12px;
		line-height: 14px;
		text-align: start;
		color: var(--grisoscuro);
	}

	body {
		height: 100dvh
	}

	body.swal2-height-auto {
		height: 100vh !important;
		/* height: 100% !important; */

	}

	.alert-contrasenia {
		display: none;
	}

	/* Compact modal styles */
	.modal-compact {

		background-color: transparent !important;
	}

	.modal-body-compact {
		border: none !important;
		background-color: #FFF !important;
		padding: 1rem !important;
	}

	.modal-header-compact {
		padding: 20px 0 !important;
	}

	.modal-footer-compact {
		padding: 0.5rem !important;
	}

	.tabla-historial-compact {
		margin: 0 !important;
		font-size: 14px !important;
		border-collapse: collapse !important;
	}

	.tabla-historial-compact th,
	.tabla-historial-compact td {
		padding: 0.5rem 0.5rem !important;
		border: 1px solid #ddd !important;
	}

	.btn-compact {
		padding: 0.25rem 0.5rem !important;
		font-size: 0.875rem !important;
	}

	.contenedor-acompanamientos-compact {
		gap: 1rem !important;
		flex-wrap: wrap !important;
	}

	.contenedor-acompanamientos-compact>div {
		min-width: 150px !important;
		flex: 1 1 auto !important;
	}
</style>
<div class="container contenedor-perfil pt-3">

	<span>
		<h3 class="informacion-contacto mb-4 mt-3 d-flex gap-2 align-items-center titulo-icon "><i
				class="fa-solid fa-address-card"></i>Mi perfil, <?php echo $_SESSION['kt_nombre'] ?> </h3>
	</span>

	<div class="contenedor-tabs d-flex align-items-start">
		<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

			<!-- HISTORIAL -->
			<button class="nav-link active" id="v-pills-historial-tab" data-bs-toggle="pill"
				data-bs-target="#v-pills-historial" type="button" role="tab" aria-controls="v-pills-historial"
				aria-selected="false"><i class="fa-solid fa-clock-rotate-left"></i> Historial</button>

			<!-- DIRECCIONES -->
			<button class="nav-link" id="v-pills-direcciones-tab" data-bs-toggle="pill" data-bs-target="#v-pills-direcciones"
				type="button" role="tab" aria-controls="v-pills-direcciones" aria-selected="false"><i
					class="fa-solid fa-location-dot"></i> Direcciones</button>

			<!-- CAMBIO DE CONTRASEÑA -->
			<button class="nav-link" id="v-pills-cambio-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cambio"
				type="button" role="tab" aria-controls="v-pills-cambio" aria-selected="false"><i class="fa-solid fa-lock"></i>
				Cambio de
				contrase&ntilde;a</button>

		</div>
		<div class="tab-content" id="v-pills-tabContent">
			<!-- <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">...</div>
			<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">...</div>
			<div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">...</div> -->

			<!-- HISTORIAL -->
			<div class="tab-pane fade show active" id="v-pills-historial" role="tabpanel"
				aria-labelledby="v-pills-historial-tab" tabindex="0">


				<?php if (count($this->pedidos) > 0) { ?>
					<div class="direcciones">
						<span class="direcciones-guardadas"><i class="fa-solid fa-clock-rotate-left"></i>Historial de pedidos</span>

						<div class="row g-3">
							<?php foreach ($this->pedidos as $content) { ?>
								<?php $this->content = $content; ?>
								<?php $id = $content->pedido_id; ?>
								<div class="col-12">
									<div class="card shadow-sm border-0">
										<div class="card-header bg-light border-0">
											<div class="d-flex justify-content-between align-items-center">
												<h6 class="mb-0 text-primary">Pedido #<?= $id ?> - <?= $content->pedido_fecha ?></h6>
												<span
													class="badge bg-<?= $content->pedido_estado_texto == 'Aprobado' ? 'success' : 'warning' ?> fs-7">
													<?= $content->pedido_estado_texto ?>
												</span>
											</div>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-6">
													<p class="mb-1"><strong class="text-muted">Dirección:</strong>
														<?= $content->pedido_direccion ?></p>
													<p class="mb-1"><strong class="text-muted">Método de
															pago:</strong> <?= $this->list_pedido_medio[$content->pedido_medio] ?></p>
												</div>
												<div class="col-md-6">
													<p class="mb-1"><strong class="text-muted">Forma de envío:</strong>
														<?= $this->list_pedido_forma_envio[$content->pedido_forma_envio] ?></p>
													<p class="mb-1"><strong class="text-muted">Valor
															total:</strong> $<?= number_format($content->pedido_valorpagar) ?></p>
												</div>
											</div>
											<div class="d-flex gap-2 mt-3 justify-content-end">
												<button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
													data-bs-target="#exampleModal<?= $id ?>">
													<i class="fa-solid fa-eye me-1"></i>Detalle
												</button>
												<button class="btn btn-naranja-sm btn-sm" data-bs-toggle="modal"
													data-bs-target="#modalPerdird<?= $id ?>">
													<i class="fa-solid fa-redo me-1"></i>Pedir de nuevo
												</button>
											</div>
										</div>
									</div>
								</div>

								<!-- Modal Detalle -->
								<div class="modal fade" id="exampleModal<?= $id ?>" tabindex="-1"
									aria-labelledby="exampleModal<?= $id ?>Label" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg">
										<div class="modal-content modal-compact" style="border: none; background-color: transparent;">
											<div class="modal-header modal-header-compact">
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
													style="filter: invert(1);"></button>
											</div>
											<div class="modal-body modal-body-compact" style="border: none; background-color: #FFF;">
												<h1 class="modal-title fs-5 mb-2" id="exampleModalLabel">Pedido #<?= $id ?></h1>
												<table width="100%" class="tabla-historial tabla-historial-compact">
													<thead class="cabecera_tabla">
														<tr>
															<td>Producto</td>
															<td>Cantidad</td>
															<td>Valor unitario</td>
															<td>Valor total</td>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($content->productos as $producto): ?>
															<tr>
																<td data-label="Producto">
																	<span class="producto-nombre">
																		<?php echo $producto->nombre; ?>
																	</span>
																	<div class="acompanamientos">
																		<?php echo str_replace("\n", "<br>", $producto->acompanamientos); ?>
																	</div>
																	<div class="acompanamientos">
																		<?php echo str_replace("\n", "<br>", $producto->termino); ?>
																	</div>
																</td>
																<td data-label="Cantidad" align="center"><?php echo $producto->cantidad; ?></td>
																<td data-label="Valor unitario" align="center">$<?php echo number_format($producto->valor); ?>
																</td>
																<td data-label="Valor total" align="center">
																	$<?php echo number_format($producto->valor * $producto->cantidad); ?></td>
															</tr>
														<?php endforeach ?>
														<tr style="border-top:1px solid #dedede">
															<td colspan="3" class="text-end costo-info"><b>Costo envío</b></td>
															<td class="fw-bold costo">$<?php echo number_format($this->content->pedido_envio * 1); ?></td>
														</tr>
														<tr style="border-top:1px solid #dedede">
															<td colspan="3" class="text-end propina-info"><b>Propina</b></td>
															<td class="fw-bold propina">$<?php echo number_format($this->content->pedido_propina * 1); ?>
															</td>
														</tr>
														<tr style="border-top:1px solid #dedede">
															<td colspan="3" class="text-end total-info"><b>Total</b></td>
															<td class="fw-bold total">$<?php echo number_format($this->content->pedido_valorpagar); ?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="modal-footer modal-footer-compact d-none">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>
								</div>

								<!-- Modal Pedir de nuevo -->
								<div class="modal fade" id="modalPerdird<?= $id ?>" tabindex="-1"
									aria-labelledby="modalPerdird<?= $id ?>Label" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered modal-lg">
										<div class="modal-content modal-compact" style="border: none; background-color: transparent;">
											<div class="modal-header modal-header-compact">
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
													style="filter: invert(1);"></button>
											</div>
											<div class="modal-body modal-body-compact" style="border: none; background-color: #FFF;">
												<h5 class="modal-title mb-3 text-primary	">Pedido #<?= $id ?> - Pedir de nuevo</h5>
												<form action="/page/perfil/generardenuevo" method="post">
													<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

													<?php foreach ($content->productos as $index => $producto): ?>
														<div class="card mb-3 border-light">
															<div class="card-header bg-light">
																<h6 class="mb-0"><?php echo $producto->nombre; ?> <small class="text-muted">(Cantidad:
																		<?php echo $producto->cantidad; ?>)</small></h6>
															</div>
															<div class="card-body">
																<?php for ($i = 0; $i < $producto->cantidad; $i++): ?>
																	<div class="border-bottom pb-3 mb-3" style="border-color: #e9ecef !important;">
																		<h6 class="text-primary">Unidad <?php echo $i + 1; ?></h6>
																		<div class="row g-2">
																			<?php for ($j = 1; $j <= 6; $j++) { ?>
																				<?php if (count($producto->acompanamientos2[$j]) > 0) { ?>
																					<div class="col-md-6">
																						<label class="form-label fw-semibold">Acompañamiento <?php echo $j; ?>:</label>
																						<select
																							name="productos[<?php echo $index; ?>][<?php echo $i; ?>][acompanamientos][<?php echo $j; ?>]"
																							class="form-select" required>
																							<?php foreach ($producto->acompanamientos2[$j] as $acompanamiento): ?>
																								<option value="<?php echo $acompanamiento->acomp_nombre; ?>">
																									<?php echo $acompanamiento->acomp_nombre; ?>
																								</option>
																							<?php endforeach ?>
																						</select>
																					</div>
																				<?php } ?>
																			<?php } ?>
																			<?php if (count($producto->terminos) > 0) { ?>
																				<div class="col-md-6">
																					<label class="form-label fw-semibold">Término:</label>
																					<select name="productos[<?php echo $index; ?>][<?php echo $i; ?>][termino]"
																						class="form-select">
																						<option value="">Seleccione...</option>
																						<?php foreach ($producto->terminos as $termino): ?>
																							<option value="<?php echo $termino->termino_nombre; ?>">
																								<?php echo $termino->termino_nombre; ?>
																							</option>
																						<?php endforeach ?>
																					</select>
																				</div>
																			<?php } ?>
																		</div>
																		<input type="hidden" name="productos[<?php echo $index; ?>][<?php echo $i; ?>][nombre]"
																			value="<?php echo $producto->nombre; ?>">
																		<input type="hidden" name="productos[<?php echo $index; ?>][<?php echo $i; ?>][id]"
																			value="<?php echo $producto->id_productos; ?>">
																	</div>
																<?php endfor; ?>
															</div>
														</div>
													<?php endforeach; ?>
													<div class="text-end">
														<button class="btn btn-naranja-sm px-4" type="submit">
															<i class="fa-solid fa-redo me-2"></i>Pedir de nuevo
														</button>
													</div>
												</form>
											</div>
											<div class="modal-footer d-none">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>


				<?php } else { ?>
					<div class="alert alert-warning text-center m-0" role="alert">
						No tiene pedidos
					</div>
				<?php } ?>
			</div>
			<!-- DIRECCIONES -->
			<div class="tab-pane fade" id="v-pills-direcciones" role="tabpanel" aria-labelledby="v-pills-direcciones-tab"
				tabindex="0">
				<div class="direcciones">
					<span class="direcciones-guardadas"><i class="fa-solid fa-location-dot"></i>Sus direcciones
						guardadas</span>
					<div class="content-direcciones py-2">
						<?php if (count($this->direcciones) == 0) { ?>
							<div class="alert alert-warning text-center m-0" role="alert">
								No tiene direcciones guardadas
							</div>
						<?php } ?>
						<?php foreach ($this->direcciones as $direccion) { ?>
							<div class="card mb-3 border-0">
								<div class="card-body p-2 shadow-sm">
									<div class="d-flex justify-content-between align-items-center">
										<div class="flex-grow-1">
											<p class="direccion mb-0" data-id="<?php echo $direccion->direccion_id; ?>"
												data-numero1="<?php echo $direccion->direccion_numero1; ?>"
												data-letra1="<?php echo $direccion->direccion_letra1; ?>"
												data-numero2="<?php echo $direccion->direccion_numero2; ?>"
												data-letra2="<?php echo $direccion->direccion_letra2; ?>"
												data-numero3="<?php echo $direccion->direccion_numero3; ?>"
												data-complemento="<?php echo $direccion->direccion_complemento; ?>"
												data-nomenclatura="<?php echo $direccion->direccion_nomenclatura; ?>"
												data-indicaciones="<?php echo $direccion->direccion_indicaciones; ?>">
												<?php echo $direccion->direccion_nomenclatura . " " . $direccion->direccion_numero1 . " " . $direccion->direccion_letra1 . " " . $direccion->direccion_numero2 . " " . $direccion->direccion_letra2 . " " . $direccion->direccion_numero3 . " " . $direccion->direccion_complemento; ?>
											</p>
										</div>
										<button class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal"
											data-bs-target="#borrarDireccion<?php echo $direccion->direccion_id; ?>">
											<i class="fa-solid fa-trash"></i>
										</button>
									</div>
								</div>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="borrarDireccion<?php echo $direccion->direccion_id; ?>" tabindex="-1"
								aria-labelledby="borrarDireccionLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h1 class="modal-title fs-5" id="borrarDireccionLabel">Borrar dirección</h1>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											¿Seguro que desea eliminar esta dirección?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
											<button type="button" class="btn btn-danger eliminar-direccion" data-bs-dismiss="modal"
												data-id="<?php echo $direccion->direccion_id; ?>">Eliminar</button>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>


					</div>
				</div>

				<form action="/page/perfil/guardardireccion">
					<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

					<div class="card border-0">
						<div class="card-body">
							<div class="row mb-2">
								<div class="col-md-4">
									<label for="pedido_nomenclatura" class="form-label">Nomenclatura</label>
									<select name="pedido_nomenclatura" id="pedido_nomenclatura" class="form-select" required>
										<option value="">Seleccione...</option>
										<option value="Avenida Calle">Avenida Calle</option>
										<option value="Avenida Carrera">Avenida Carrera</option>
										<option value="Calle">Calle</option>
										<option value="Carrera">Carrera</option>
										<option value="Diagonal">Diagonal</option>
										<option value="Transversal">Transversal</option>
									</select>
									<div class="form-text">Ej: Carrera</div>
								</div>
								<div class="col-md-8">
									<label class="form-label">Dirección</label>
									<div class="input-group">
										<input type="number" class="form-control" name="numero1" id="numero1" placeholder="número" min="0"
											required>
										<input type="text" class="form-control" name="letra1" id="letra1" placeholder="letra">
										<span class="input-group-text">#</span>
										<input type="number" class="form-control" name="numero2" id="numero2" placeholder="número" min="0"
											required>
										<input type="text" class="form-control" name="letra2" id="letra2" placeholder="letra">
										<span class="input-group-text">-</span>
										<input type="number" class="form-control" name="numero3" id="numero3" placeholder="número" min="0"
											required>
									</div>
									<div class="form-text">Ej: 7 A # 78 B - 96</div>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-md-6">
									<label for="complemento" class="form-label">Complemento</label>
									<textarea name="complemento" id="complemento" class="form-control" placeholder="complemento"
										rows="2"></textarea>
									<div class="form-text">Apartamento, casa, piso, interior, otros.</div>
								</div>
								<div class="col-md-6">
									<label for="indicaciones" class="form-label">Indicaciones</label>
									<textarea name="indicaciones" id="indicaciones" class="form-control" placeholder="indicaciones"
										rows="2"></textarea>
									<div class="form-text">Indicaciones adicionales para llegar al domicilio</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 d-flex justify-content-end">
									<button class="btn-carrito px-2">Guardar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>



			<!-- CAMBIO DE CONTRASEÑA -->
			<div class="tab-pane fade" id="v-pills-cambio" role="tabpanel" aria-labelledby="v-pills-cambio-tab" tabindex="0">
				<div class="direcciones">
					<span class="direcciones-guardadas"><i class="fa-solid fa-lock"></i>Cambio de contrase&ntilde;a</span>
					<?php if ($this->nivel == 5) { ?>

						<form action="/page/perfil/cambiarinvitado" id="form-recuperar" method="post"
							class="my-2 my-md-5 form-recuperar">
							<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

							<?php if (!$this->err && !$this->succ) { ?>
								<div class="alert alert-primary " role="alert">
									Para mantener la seguridad de tu cuenta, puedes cambiar tu contraseña. Asegúrate de que tu nueva
									contraseña sea segura y fácil de recordar.
								</div>
							<?php } ?>

							<?php if ($this->err && !$this->succ) { ?>
								<div class="alert alert-danger" role="alert">
									Lo sentimos hubo un error al momento de procesar la solicitud.
								</div>
							<?php } ?>

							<?php if (!$this->err && $this->succ) { ?>
								<div class="alert alert-success" role="alert">
									Contraseña cambiada exitosamente.
								</div>
							<?php } ?>
							<div class="row">

								<div class="col-12 col-md-4">
									<input type="password" name="pass-act" required class="form-control texto_normal campo_login"
										placeholder="Contrase&ntilde;a actual">
								</div>
								<div class="col-12 col-md-4">
									<input type="password" name="pass-new" required class="form-control texto_normal campo_login"
										id="client-password" placeholder="Confirmar contrase&ntilde;a nueva">
								</div>
								<div class="col-12 col-md-4">
									<input type="password" name="re-pass" required class="form-control texto_normal campo_login"
										id="client-password2" placeholder="Contrase&ntilde;a actual">
								</div>

								<div class="col-12 my-2 alert-contrasenia" id="alert-contrasenia2">
									<div class="alert alert-danger" role="alert">
										Las contraseñas no son iguales.
									</div>
								</div>
								<div class="col-12 my-2 alert-contrasenia" id="alert-contrasenia">
									<div class="alert alert-danger text-start" role="alert">
										La contraseña debe incluir al menos
										<ul class="pl-4">
											<li>8 caracteres</li>
											<li>Una minuscula</li>
											<li>Una Mayuscula</li>
											<li>Un Numero</li>
										</ul>
									</div>
								</div>


							</div>
							<button class="btn btn-azul">Cambiar</button>
						</form>
					<?php } else { ?>
						<form action="/page/perfil/cambio" method="post" class="my-2 my-md-5 form-recuperar">
							<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

							<?php if (!$this->err && !$this->succ) { ?>
								<div class="alert alert-primary" role="alert">
									Para mantener la seguridad de tu cuenta, puedes solicitar un cambio de contraseña. Asegúrate de que tu
									nueva contraseña sea segura y fácil de recordar.
								</div>
							<?php } ?>

							<?php if ($this->err && !$this->succ) { ?>
								<div class="alert alert-danger text-center" role="alert">
									Lo sentimos hubo un error al momento de procesar la solicitud.
								</div>
							<?php } ?>

							<?php if (!$this->err && $this->succ) { ?>
								<div class="alert alert-success text-center" role="alert">
									Se ha enviado un correo para recuperar su contraseña.
								</div>
							<?php } ?>



							<div class="row d-none">

								<div class="col-12 col-md-6"><input type="text" name="cedula" required
										class="form-control texto_normal campo_login" value="<?php echo $this->cedula; ?>"
										placeholder="Identificación"></div>


								<div class="col-12 col-md-6"><input type="text" name="ncar" required
										class="form-control texto_normal campo_login" value="<?php echo $this->accion; ?>"
										placeholder="Número de carnet"></div>
							</div>
							<button class="btn btn-azul">Solicitar</button>
						</form>
					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>

<?php if ($this->desarrollo == 1) { ?>
	<style>
		header {
			/* display: none; */
		}
	</style>
<?php } ?>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		const tabs = document.querySelectorAll('[data-bs-toggle="pill"]');




		// Función para activar la pestaña basada en el hash de la URL
		function activateTabFromHash () {
			const hash = window.location.hash;
			if (hash) {
				const targetTab = document.querySelector(hash + '[data-bs-toggle="pill"]');
				if (targetTab) {
					const tab = new bootstrap.Tab(targetTab);
					tab.show();

				}
			}
		}

		// Activar la pestaña correcta al cargar la página
		activateTabFromHash();

		// Re-activar la pestaña correcta cuando se cambia el hash de la URL
		window.addEventListener('hashchange', activateTabFromHash);
	});
</script>


<script>
	$(document).ajaxStart(function () {
		$(".loader-bx").addClass("show");
	});

	$(document).ajaxStop(function () {
		$(".loader-bx").removeClass("show");
	});
	$(document).ready(function () {




		$("#client-password").on("keyup", function () {
			validar_clave($(this).val());
			comparar_claves();
		});
		$("#client-password2").on("keyup", function () {
			comparar_claves();
		});

		function comparar_claves () {
			let clave = $("#client-password").val(),
				clave2 = $("#client-password2").val();
			if (clave == clave2) {
				$("#alert-contrasenia2").hide();
			} else {
				$("#alert-contrasenia2").show();
			}
		}

		function validar_clave (contrasenna) {
			var mayuscula = false;
			var minuscula = false;
			var numero = false;
			var count = false;

			for (var i = 0; i < contrasenna.length; i++) {
				if (contrasenna.charCodeAt(i) >= 65 && contrasenna.charCodeAt(i) <= 90) {
					mayuscula = true;
				} else if (
					contrasenna.charCodeAt(i) >= 97 &&
					contrasenna.charCodeAt(i) <= 122
				) {
					minuscula = true;
				} else if (
					contrasenna.charCodeAt(i) >= 48 &&
					contrasenna.charCodeAt(i) <= 57
				) {
					numero = true;
				}
			}
			if (mayuscula == true && minuscula == true && numero == true) {
				if (contrasenna.length > 8) {
					$("#alert-contrasenia").hide();
				} else {
					$("#alert-contrasenia").show();
				}
			} else {
				$("#alert-contrasenia").show();
			}
		}
	});
</script>