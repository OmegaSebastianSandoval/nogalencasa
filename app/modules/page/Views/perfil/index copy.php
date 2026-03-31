<style type="text/css">
	.acompanamientos {
		font-size: 12px;
		line-height: 14px;
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
</style>
<div class="container contenedor-perfil pt-3">

	<span>
		<h3 class="informacion-contacto mb-4 mt-3 d-flex gap-2 align-items-center titulo-icon "><i class="fa-solid fa-address-card"></i>Mi perfil, <?php echo $_SESSION['kt_nombre'] ?> </h3>
	</span>

	<div class="contenedor-tabs d-flex align-items-start">
		<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

			<!-- HISTORIAL -->
			<button class="nav-link active" id="v-pills-historial-tab" data-bs-toggle="pill"
				data-bs-target="#v-pills-historial" type="button" role="tab" aria-controls="v-pills-historial"
				aria-selected="false"><i class="fa-solid fa-clock-rotate-left"></i> Historial</button>

			<!-- DIRECCIONES -->
			<button class="nav-link" id="v-pills-direcciones-tab" data-bs-toggle="pill" data-bs-target="#v-pills-direcciones"
				type="button" role="tab" aria-controls="v-pills-direcciones" aria-selected="false"><i class="fa-solid fa-location-dot"></i> Direcciones</button>

			<!-- CAMBIO DE CONTRASEÑA -->
			<button class="nav-link" id="v-pills-cambio-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cambio"
				type="button" role="tab" aria-controls="v-pills-cambio" aria-selected="false"><i class="fa-solid fa-lock"></i> Cambio de
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
						<span class="direcciones-guardadas"><i class="fa-solid fa-clock-rotate-left"></i>Historial de
							pedidos</span>


						<table width="100%" class="tabla-historial" style="font-size: 14px;">
							<thead class="cabecera_tabla">
								<tr>
									<td>N&uacute;mero</td>
									<!--<td>Documento</td>-->
									<!--<td>Nombre</td>-->
									<!-- <td>Correo</td> -->
									<td>Direcci&oacute;n</td>

									<td>M&eacute;todo de pago</td>
									<td>Forma de env&iacute;o</td>
									<td>Fecha</td>
									<td>Valor total</td>
									<td>Estado</td>
									<td width="210">Acciones</td>

								</tr>
							</thead>
							<tbody>
								<?php foreach ($this->pedidos as $content) { ?>
									<?php $this->content = $content; ?>
									<?php $id = $content->pedido_id; ?>
									<tr>
										<td data-label="N&uacute;mero"><?= $id; ?></td>
										<!--<td data-label="Documento"><?= $content->pedido_documento; ?></td>-->
										<!--<td data-label="Nombre"><?= $content->pedido_nombre; ?></td>-->
										<!-- <td  data-label="Correo"><?= $content->pedido_correo; ?></td> -->

										<td data-label="Direcci&oacute;n"><?= $content->pedido_direccion; ?></td>
										<td data-label="M&eacute;todo de pago">
											<?= $this->list_pedido_medio[$content->pedido_medio]; ?>
										<td data-label="Forma de env&iacute;o">
											<?= $this->list_pedido_forma_envio[$content->pedido_forma_envio]; ?>
										<td data-label="Fecha"><?= $content->pedido_fecha; ?></td>
										<td data-label="Valor total"><?= number_format($content->pedido_valorpagar); ?></td>
										<td data-label="Estado"><?= $content->pedido_estado_texto; ?>
										<td data-label="Acciones" class="">
											<div class="d-block d-lg-flex gap-4">


												<!-- Button trigger modal -->
												<button type="button" class="btn btn-outline-primary btn-sm boton_azul" data-bs-toggle="modal"
													data-bs-target="#exampleModal<?php echo $id ?>">
													Detalle
												</button>

												<!-- Modal -->
												<div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1"
													aria-labelledby="exampleModal<?php echo $id ?>Label" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg">
														<div class="modal-content" style=" border: none;
	background-color: transparent;">
															<div class="modal-header">



																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
																	style="filter: invert(1);"></button>

															</div>
															<div class="modal-body" style=" border: none;
	background-color: #FFF;">
																<h1 class="modal-title fs-5" id="exampleModalLabel">Pedido
																	#<?= $id ?></h1>
																<table width="100%" class="tabla-historial">
																	<thead class="cabecera_tabla">
																		<tr>
																			<td>Producto</td>
																			<td>
																				Cantidad
																			</td>
																			<td>
																				Valor unitario
																			</td>
																			<td>
																				Valor total
																			</td>
																		</tr>
																	</thead>
																	<tbody>

																		<?php foreach ($content->productos as $producto): ?>
																			<tr>
																				<td data-label="Producto"><?php echo $producto->nombre; ?>

																					<div class="acompanamientos">
																						<?php echo str_replace("\n", "<br>", $producto->acompanamientos); ?>
																					</div>
																					<div class="acompanamientos">
																						<?php echo str_replace("\n", "<br>", $producto->termino); ?>
																					</div>
																				</td>
																				<td data-label="Cantidad" align="center"><?php echo $producto->cantidad; ?>
																				</td>
																				<td data-label="Valor unitario" align="center">
																					$<?php echo number_format($producto->valor); ?></td>
																				<td data-label="Valor total" align="center">
																					$<?php echo number_format($producto->valor * $producto->cantidad); ?>
																				</td>
																			</tr>
																		<?php endforeach ?>
																		<tr style="border-top:1px solid #dedede">
																			<td colspan="3"><b>Costo env&iacute;o</b></td>
																			<td class="fw-bold">
																				$<?php echo number_format($this->content->pedido_envio * 1); ?>
																			</td>
																		</tr>
																		<tr style="border-top:1px solid #dedede">
																			<td colspan="3"><b>Propina</b></td>
																			<td class="fw-bold">
																				$<?php echo number_format($this->content->pedido_propina * 1); ?>
																			</td>
																		</tr>
																		<tr style="border-top:1px solid #dedede">
																			<td colspan="3"><b>Total</b></td>
																			<td class="fw-bold">
																				$<?php echo number_format($this->content->pedido_valorpagar); ?>
																			</td>
																		</tr>
																	</tbody>

																</table>
															</div>
															<div class="modal-footer d-none">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

															</div>
														</div>
													</div>
												</div>


												<!-- <a class="btn btn-naranja-sm btn-sm"
													href="/page/perfil/generarpedido/?pedido=<?php echo $id ?>">Pedir de
													nuevo</a> -->

												<!-- Button trigger modal -->
												<button type="button" class="btn btn-naranja-sm btn-sm" data-bs-toggle="modal"
													data-bs-target="#modalPerdird<?php echo $id ?>">
													Pedir de
													nuevo
												</button>

												<!-- Modal -->
												<div class="modal fade" id="modalPerdird<?php echo $id ?>" tabindex="-1"
													aria-labelledby="modalPerdird<?php echo $id ?>Label" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-lg">
														<div class="modal-content" style=" border: none;
	background-color: transparent;">
															<div class="modal-header">



																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
																	style="filter: invert(1);"></button>

															</div>
															<div class="modal-body" style=" border: none;
	background-color: #FFF;">
																<h1 class="modal-title fs-5" id="exampleModalLabel">Pedido
																	#<?= $id ?></h1>
																<form action="/page/perfil/generardenuevo" method="post">
																	<table width="100%" class="tabla-historial">
																		<tr class="cabecera_tabla">
																			<th>Productos</th>
																		</tr>
																		<?php foreach ($content->productos as $index => $producto): ?>
																			<?php for ($i = 0; $i < $producto->cantidad; $i++): ?>
																				<tr>
																					<td>
																						<?php echo $producto->nombre; ?>
																						<input type="hidden"
																							name="productos[<?php echo $index; ?>][<?php echo $i; ?>][nombre]"
																							value="<?php echo $producto->nombre; ?>">
																						<input type="hidden" name="productos[<?php echo $index; ?>][<?php echo $i; ?>][id]"
																							value="<?php echo $producto->id_productos; ?>">

																						<div
																							class="acompanamientos contenedor-acompanamientos d-flex gap-4 justify-content-center">
																							<?php for ($j = 1; $j <= 6; $j++) { ?>
																								<?php if (count($producto->acompanamientos2[$j]) > 0) { ?>
																									<div class="mt-1 mb-2">
																										Acompa&ntilde;amiento <?php echo $j; ?>:
																										<select
																											name="productos[<?php echo $index; ?>][<?php echo $i; ?>][acompanamientos][<?php echo $j; ?>]"
																											class="form-select" required>
																											<?php foreach ($producto->acompanamientos2[$j] as $acompanamiento): ?>
																												<option value="<?php echo $acompanamiento->acomp_nombre; ?>">
																													<?php echo $acompanamiento->acomp_nombre; ?></option>
																											<?php endforeach ?>
																										</select>
																									</div>
																								<?php } ?>
																							<?php } ?>

																							<?php if (count($producto->terminos) > 0) { ?>
																								<div class="mt-1 mb-2">
																									Término:
																									<select name="productos[<?php echo $index; ?>][<?php echo $i; ?>][termino]"
																										class="form-select">
																										<option value="">Seleccione...</option>
																										<?php foreach ($producto->terminos as $termino): ?>
																											<option value="<?php echo $termino->termino_nombre; ?>">
																												<?php echo $termino->termino_nombre; ?></option>
																										<?php endforeach ?>
																									</select>
																								</div>
																							<?php } ?>
																						</div>
																					</td>
																				</tr>
																			<?php endfor; ?>
																		<?php endforeach; ?>
																		<tr>
																			<td>
																				<button class="btn btn-naranja-sm btn-sm" type="submit">Pedir de nuevo</button>
																			</td>
																		</tr>
																	</table>
																</form>



															</div>
															<div class="modal-footer d-none">
																<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

															</div>
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


				<?php } else { ?>
					<div class="alert alert-warning text-center" role="alert">
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
					<div class="content-direcciones">
						<?php foreach ($this->direcciones as $direccion) { ?>
							<div>

								<span class="" data-id="<?php echo $direccion->direccion_id; ?>" data-bs-toggle="modal"
									data-bs-target="#borrarDireccion<?php echo $direccion->direccion_id; ?>"><i
										class="fa-solid fa-trash"></i></span>



								<!-- Modal -->
								<div class="modal fade" id="borrarDireccion<?php echo $direccion->direccion_id; ?>" tabindex="-1"
									aria-labelledby="borrarDireccionLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered ">
										<div class="modal-content">
											<div class="modal-header">
												<h1 class="modal-title fs-5" id="borrarDireccionLabel">Borrar
													direcci&oacute;n</h1>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												¿Seguro que desea eliminar esta direcci&oacute;n?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
												<button type="button" class="btn btn-danger eliminar-direccion" data-bs-dismiss="modal"
													data-id="<?php echo $direccion->direccion_id; ?>">Eliminar</button>
											</div>
										</div>
									</div>
								</div>

								<p class="direccion" data-id="<?php echo $direccion->direccion_id; ?>"
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

						<?php } ?>


					</div>
				</div>
				<div class="direcciones">
					<span class="direcciones-guardadas"><i
							class="fa-regular fa-circle-user"></i><?php echo $_SESSION['kt_nombre']; ?></span>

				</div>

				<form action="/page/perfil/guardardireccion">
					<div class="row">

						<div class="col-lg-2 form-group div_direccion">
							<label for="">Nomenclatura</label>
							<select name="pedido_nomenclatura" id="pedido_nomenclatura" class="form-control form-control-sm" required>
								<option value="">Seleccione...</option>
								<option value="Avenida Calle">Avenida Calle</option>
								<option value="Avenida Carrera">Avenida Carrera</option>
								<option value="Calle">Calle</option>
								<option value="Carrera">Carrera</option>
								<option value="Diagonal">Diagonal</option>
								<option value="Transversal">Transversal</option>
							</select>
							<div class="ejemplo">Ej: Carrera</div>
						</div>
						<div class="col-lg-10 form-group div_direccion">
							<label for="">Direcci&oacute;n</label>
							<div class="row">
								<div class="col-lg-2">
									<input type="number" class="form-control form-control-sm" name="numero1" id="numero1"
										placeholder="número" min="0" value="" required>
									<div class="ejemplo">7</div>
								</div>
								<div class="col-lg-2">
									<input type="text" class="form-control form-control-sm" name="letra1" id="letra1" placeholder="letra"
										value="">
									<div class="ejemplo">A</div>
								</div>
								<div class="col-lg-1 col-lg-05 text-center">
									#
								</div>
								<div class="col-lg-2">
									<input type="number" class="form-control form-control-sm" name="numero2" id="numero2"
										placeholder="número" min="0" value="" required>
									<div class="ejemplo">78</div>
								</div>
								<div class="col-lg-2">
									<input type="text" class="form-control form-control-sm" name="letra2" id="letra2" placeholder="letra"
										value="">
									<div class="ejemplo">B</div>
								</div>
								<div class="col-lg-1 col-lg-05 text-center">
									-
								</div>
								<div class="col-lg-2">
									<input type="number" class="form-control form-control-sm" name="numero3" id="numero3" min="0"
										placeholder="nmero" value="" required>
									<div class="ejemplo">96</div>
								</div>
								<div class="col-lg-4">
									<textarea name="complemento" id="complemento" class="form-control form-control-sm"
										placeholder="complemento"></textarea>
									<div class="ejemplo">Apartamento, casa, piso, interior, otros.</div>
								</div>
								<div class="col-lg-7">
									<textarea name="indicaciones" id="indicaciones" class="form-control form-control-sm"
										placeholder="indicaciones"></textarea>
									<div class="ejemplo">Indicaciones adicionales para llegar al domicilio</div>
								</div>


								<div class="col-lg-11 d-flex justify-content-end">
									<button class="btn btn-primary">Guardar</button>
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