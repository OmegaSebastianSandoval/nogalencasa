<style>
	.caja-items {
		visibility: hidden;
	}

	.carrito {
		visibility: hidden;
	}

	.disabled a {
		pointer-events: none;
	}

	.carousel-item img,
	.carousel-item {
		height: auto !important;
	}

	.btn-pass i {
		transition: transform 300ms ease-in-out;
	}

	.btn-pass:hover {
		border-color: transparent;
		color: var(--naranja);
	}

	.btn-pass:hover i,
	.btn-pass.activo i {
		transform: scale(1.2);
		color: var(--naranja);

	}

	.campo-login {
		color: var(--azuloscuro);
		font-weight: 500;
		text-align: start;
		width: 100%;
		display: block;
		margin-top: 10px;
	}
</style>
<div class="container">
	<?php echo $this->bannerlogin ?>
	<?php if ($this->online == 1) { ?>
		<div class="row">
			<p class="txt-bienvenido"><span><i class="fa-regular fa-user"></i></span> ¡Bienvenido!</p>

			<div class="col-12 text-center">
				<a href="/page/login/index" class="btn btn-azul">Socio</a>
				<a href="/page/login/invitado" class="btn btn-naranja">Invitado</a>
			</div>
		</div>
		<form method="post" action="/page/login/index" class="form-login col-md-12 ">
			<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

			<?php if ($_GET['registro'] == 1) { ?>
				<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su
					información de acceso:</div>
			<?php } ?>

			<div align="center" class="caja_registro alto-login">
				<div class="col-md-12 col-lg-6 form-group">
					<?php if ($_GET['success'] == 'ok') { ?>
						<div class="alert alert-success">Su contraseña fue cambiada con exito.</div>
					<?php } ?>
					<div class="col-sm-12 col-md-12 margen_icono">
						<div class="row">

							<div class="col-md-12">

								<span class="campo-login">N&uacute;mero de Acci&oacute;n</span>

								<input type="text" name="cedula" required class="form-control texto_normal campo_login"
									value="<?php echo $_GET['cedula']; ?>"
									placeholder="Ingrese aquí su n&uacute;mero de Acción (8 dígitos)">
							</div>

						</div>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="row">

							<span class="campo-login">Contrase&ntilde;a</span>

							<div class="col-md-12  position-relative d-flex">
								<input type="password" name="clave" required class="form-control texto_normal campo_login mb-0" value=""
									placeholder="Ingrese aquí su contraseña">
								<span class="btn-pass btn position-absolute end-0 h-100 d-flex align-items-center me-3"> <i
										class="fa-solid fa-eye"></i></span>
							</div>
						</div>
					</div>



					<div class="col-md-12">
						<br>
						<button class="btn btn-primary enviar" type="submit">Ingresar</button>
					</div>

					<?php if ($_GET['error'] == "1"): ?>
						<div class="col-md-12"><br></div>
						<div class="alert alert-danger col-md-12 text-center">La identificación no es válida o la contrase&ntilde;a es
							incorrecta</div>
					<?php endif ?>
					<?php if ($_GET['error'] == "2"): ?>
						<div class="col-md-12"><br></div>
						<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
					<?php endif ?>
					<?php if ($_GET['error'] == "3"): ?>
						<div class="col-md-12"><br></div>
						<div class="alert alert-danger col-md-12 text-center">Usted ya tiene una contraseña segura asignada. Por
							favor
							no utilice su número de acción para ingresar</div>
					<?php endif ?>
					<div class="col-md-12 text-center d-none1"><br><a href="/page/registro" class="enlace d-none">Crear
							cuenta</a> <span class="azul d-none">|</span> <a href="/page/login/recordarsocio/" class="enlace">Asignar o
							recordar contraseña</a></div>

				</div>

				<?php echo ($this->productosLogin) ?>
				<?php echo ($this->productosLoginResponsive) ?>

			</div>



			<input type="hidden" name="taberna_express" value="<?= $_GET['taberna_express'] ?>">
			<input type="hidden" name="anchor" value="<?= $_GET['anchor'] ?>">

		</form>
	<?php } else { ?>
		<div class="alert alert-warning my-4 text-center" role="alert">
			En este momento nuestro equipo se encuentra fuera del horario de servicio
		</div>
	<?php } ?>

	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
		aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">

				<div class="modal-body">

					<div class="alert alert-warning">
						<p>Apreciado socio,</p>

						<p>Con motivo del cierre temporal del Club por los trabajos de mantenimiento, este servicio no estará
							disponible del 23 de diciembre de 2024 al 14 de enero de 2025. Atenderemos nuevamente sus solicitudes a
							partir del miércoles 15 de enero.</p>

						<p> Gracias por su comprensión.</p>
					</div>

				</div>

			</div>
		</div>
	</div>

	<div style="display:none">
		<form method="post" action="/page/login/index" class="form-login col-md-12 ">
			<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

			<?php if ($_GET['registro'] == 1) { ?>
				<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su
					información de acceso:</div>
			<?php } ?>

			<div align="center" class="caja_registro alto-login">
				<div class="col-md-12 col-lg-6 form-group">
					<?php if ($_GET['success'] == 'ok') { ?>
						<div class="alert alert-success">Su contraseña fue cambiada con exito.</div>
					<?php } ?>
					<div class="col-sm-12 col-md-12 margen_icono">
						<div class="row">
							<div class="col-md-12"><input type="text" name="cedula" required
									class="form-control texto_normal campo_login" value="<?php echo $_GET['cedula']; ?>"
									placeholder="Ingrese aquí su nmero de Acción (8 dgitos)"></div>

						</div>
					</div>
					<div class="col-sm-12 col-md-12">
						<div class="row">
							<div class="col-md-12  position-relative d-flex">
								<input type="password" name="clave" required class="form-control texto_normal campo_login mb-0" value=""
									placeholder="Ingrese aquí su contraseña">
								<span class="btn-pass btn position-absolute end-0 h-100 d-flex align-items-center me-3"> <i
										class="fa-solid fa-eye"></i></span>
							</div>
						</div>
					</div>



					<div class="col-md-12">
						<br>
						<button class="btn btn-primary enviar" type="submit">Ingresar</button>
					</div>

					<?php if ($_GET['error'] == "1"): ?>
						<div class="col-md-12"><br></div>
						<div class="alert alert-danger col-md-12 text-center">La identificación no es válida o la contrase&ntilde;a es
							incorrecta</div>
					<?php endif ?>
					<?php if ($_GET['error'] == "2"): ?>
						<div class="col-md-12"><br></div>
						<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
					<?php endif ?>
					<?php if ($_GET['error'] == "3"): ?>
						<div class="col-md-12"><br></div>
						<div class="alert alert-danger col-md-12 text-center">Usted ya tiene una contraseña segura asignada. Por
							favor
							no utilice su número de acción para ingresar</div>
					<?php endif ?>
					<div class="col-md-12 text-center d-none1"><br><a href="/page/registro" class="enlace d-none">Crear
							cuenta</a> <span class="azul d-none">|</span> <a href="/page/login/recordarsocio/" class="enlace">Asignar
							o recordar contraseña</a></div>

				</div>

				<?php echo ($this->productosLogin) ?>
				<?php echo ($this->productosLoginResponsive) ?>

			</div>



			<input type="hidden" name="taberna_express" value="<?= $_GET['taberna_express'] ?>">
			<input type="hidden" name="anchor" value="<?= $_GET['anchor'] ?>">

		</form>
	</div>
</div>


<?php if ($_GET['mensaje'] != "") { ?>

	<!-- <script src="/components/jquery/dist/jquery.min.js"></script> -->
	<script src="/components/jquery/jquery-3.6.0.min.js"></script>

	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary d-none" id="boton_modal_mensaje" data-toggle="modal"
		data-target="#exampleModal_mensaje">
		Launch demo modal
	</button>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal_mensaje" tabindex="-1" role="dialog"
		aria-labelledby="exampleModal_mensajeLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModal_expressLabel"></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

				</div>
				<div class="modal-body">

					<?php if ($_GET['mensaje'] == "1") { ?>
						Estimado socio,<br><br>
					<?php } ?>
					<?php if ($_GET['mensaje'] == "2") { ?>
						Estimado invitado,<br><br>
					<?php } ?>

					Hemos actualizado nuestro método de ingreso para hacer sus compras<br>ms seguras.<br><br>

					<span style="font-weight: 600;">Le hemos enviado un mensaje a su correo electrónico registrado en el
						Club,<br>por favor ingrese y asigne una nueva contraseña a su cuenta.</span> <br><br>

					Si no recibe nuestro mensaje o su correo electrónico no se encuentra actualizado en nuestras bases de
					datos lo invitamos a comunicarse con la oficina de atención al socio:
					601 3267700 ext. 3954 en nuestros horarios de lunes a viernes de 8 a.m. a <br>6 p.m.


				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>


	<script type="text/javascript">
		$(document).ready(function () {

			$('#exampleModal_mensaje').modal('show');
		})
	</script>

<?php } ?>
<script>
	document.addEventListener("DOMContentLoaded", function () {
		const modalElement = document.getElementById('staticBackdrop');
		const bootstrapModal = new bootstrap.Modal(modalElement);

		// Obtén la fecha actual
		const currentDate = new Date();
		const startDate = new Date('2024-12-23'); // Inicio del rango
		const endDate = new Date('2025-01-14'); // Fin del rango

		// Comprueba si la fecha actual está dentro del rango
		if (currentDate >= startDate && currentDate <= endDate) {
			bootstrapModal.show(); // Muestra el modal
		}
	});
</script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const passwordInput = document.querySelector('input[name="clave"]');
		const toggleButton = document.querySelector('.btn-pass');
		const toggleIcon = toggleButton.querySelector('i');

		toggleButton.addEventListener('click', () => {
			const isPassword = passwordInput.type === 'password';
			passwordInput.type = isPassword ? 'text' : 'password';
			toggleIcon.classList.toggle('fa-eye');

			toggleButton.classList.toggle('activo');


			toggleIcon.classList.toggle('fa-eye-slash');
		});
	});
</script>
<?php if ($_GET['prueba'] == "" and date("Y-m-d H:i:s") < "2024-06-25 00:00:00") { ?>
	<style>
		.construccion {
			position: absolute;
			top: 0;
			left: calc(50% - 325px);
			z-index: 100;
			opacity: 1;
		}

		.fondo_negro {
			background: rgba(0, 0, 0, 0.7);
			width: 100%;
			height: 1200px;
			position: absolute;
			top: 0;
			z-index: 99;
		}

		body {
			overflow: hidden;
		}

		@media only screen and (max-width: 600px) {
			.construccion {
				left: 0;
				width: 100%;
			}
		}
	</style>

	<div class="fondo_negro"></div>
	<img src="/corte2/Nogal_En_Casa_Expectativa.jpg" width="650" style="max-width:100%" class="construccion" />
<?php } ?>

<?php //echo date("Y-m-d H:i:s"); ?>