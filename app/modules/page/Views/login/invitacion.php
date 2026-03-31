<div class="container">

	<!-- 	<div class="titulo-contact">
		<br>
		<h2 class="contact">Enviar invitación</h2>
	</div> -->

	<div class="bannerlogin">

		<?php echo $this->bannersimple ?>
	</div>

</div>

<div class="container">
	<?php if ($_SESSION['kt_login_level'] != 5 and $_SESSION['kt_accion'] != "" and count($this->invitados) < 10) { ?>


		<?php if ($_GET['error'] == "1"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">Un invitado ya se encuentra registrado con este correo en la
				tienda.</div>
		<?php endif ?>
		<?php if ($_GET['error'] == "2"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-warning col-md-12 text-center">Este usuario ya había recibido una invitación previamente. La
				invitación se ha reenviado con éxito.</div>
		<?php endif ?>

		<div class="row">
			<h3 class="informacion-contacto"><i class="fa-solid fa-address-card"></i> Proceso para registrar un referido</h3>

			<div class="col-12 col-md-6 mb-4 order-2 order-md-1">
				<form method="post" action="/page/login/enviarinvitacion" class="col-md-12 form-contact shadow-sm px-0">
					<?php if ($_GET['enviado'] == 1 or $_GET['error'] == "false") { ?>
						<div class="alert alert-warning text-center">Invitación enviada</div>
					<?php } ?>
					<div align="center" class="caja_registro alto-login container  contenidocontacto ">

						<div class="col-sm-12 col-md-12">
							<div class="row">

								<div class="col-md-12"><label>Nombre del invitado</label><input type="text" name="nombre"
										class="form-control texto_normal campo_login" value="" placeholder="Andres" required>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-12">
							<div class="row">

								<div class="col-md-12"><label>Apellido del invitado</label><input type="text" name="apellido"
										class="form-control texto_normal campo_login" value="" placeholder="Perez" required>
								</div>
							</div>
						</div>
						<!-- 					<div class="col-sm-12 col-md-12">

						<div class="row">
							<div class="col-md-12 text-left">
								<h3 class="titulo-verde1">Documento de identificación del invitado *</h3>
							</div>
							<div class="col-md-12"><input type="text" name="cedula" class="form-control texto_normal campo_login" value="<?php echo $_GET['cedula']; ?>" placeholder=""></div>

						</div>

					</div>
							 -->

						<div class="col-sm-12 col-md-12">
							<div class="row">

								<div class="col-md-12"><label>Email del invitado</label><input type="email" name="correo" required
										class="form-control texto_normal campo_login" placeholder="andres@correo.com">
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-md-12">
							<div class="row">

								<div class="col-md-12"><label>Celular del invitado</label><input type="number" name="telefono" required
										class="form-control texto_normal campo_login" placeholder="3001234567">
								</div>
							</div>
						</div>
						<div class="col-md-12 d-flex justify-content-center pt-3">

							<button class="btn btn-primary enviar" type="submit">Enviar invitación</button>
						</div>
					</div>
				</form>

			</div>
			<div class="col-12 col-md-6 order-1 order-md-2">
				<div class="col-12 text-left">
					<b style="font-weight: bold; color: #2b5486;">Proceso para registrar un invitado a Nogal en casa</b>
					<ul style=" color: #818080;">
						<li>Diligenciar en el presente formulario con los datos de su referido. </li>
						<li>Luego usted y su referido recibirán un correo de notificación. All podrán encontrar un link de
							registro.</li>
						<li>El usuario referido debe diligenciar el formulario de registro con los siguientes campos: número
							de documento, nombre, teléfono y e-mail.</li>
						<li>Una vez habilitada la cuenta el usuario referido podrá ingresar al Nogal en casa.
						</li>
					</ul>
					<b style="font-weight: bold; color: #2b5486;">Para tener en cuenta:</b>
					<ul style=" color: #818080;">
						<li>Podrá referir o invitar hasta 10 personas.</li>
						<li>Los usuarios referidos tienen habilitadors los pagos a traves de la pasarela de pagos (tarjeta
							débito o crédito) y la opción de cargo a la acción se encuentra deshabilitada para ellos.</li>
					</ul>
				</div>
			</div>
		</div>




	<?php } ?>

</div>
<?php if (count($this->invitados) >= 10) { ?>
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">Estimado Socio, puede invitar hasta 5 personas por mes</div>
		</div>
	</div>
<?php } ?>


<?php if ($_GET['enviado'] == "1") { ?>
	<script type="text/javascript">
		Swal.fire({
			title: 'Invitación enviada',
			text: 'Se ha enviado la invitación a su referido',
			icon: 'success',
			confirmButtonText: 'Aceptar',
			confirmButtonColor: '#FD8126'
		})
	</script>
<?php } ?>