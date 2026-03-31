<!-- <div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<img src="/corte/banner_delivery.png" style="width: 100%;">
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-10 offset-lg-1 titulo-contact" style="margin-top: 20px;">
			<b style="font-weight: 600; font-size: 20px;">Nuevo sistema de autenticación</b>
			<p style="margin-top: 20px;">Queremos que tus compras más seguras, por eso a partir de este <b>mes de octubre</b> actualizaremos nuestro método de ingreso al servicio de delivery Club El Nogal y ahora podrás asignar una contraseña personal.</p>
		</div>
	</div>
</div>
 -->
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

	.btn-azul::after {
		all: unset;
	}

	.btn-naranja::after {
		content: "";
		display: block;
		border-bottom: 5px solid #898989;
		position: absolute;
		left: 0;
		right: -122px;
		width: 142px;
		text-align: center;
		margin: 13px auto 0 auto;
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


<!-- <div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<img src="/corte/banner_delivery.png" style="width: 100%;">
		</div>
	</div>
</div>
<a name="start" id="start"></a>
<div class="container">
	<div class="row">
		<div class="col-10 offset-lg-1 titulo-contact" style="margin-top: 20px;">
			<b style="font-weight: 600; font-size: 20px;">Nuevo sistema de autenticación</b>
			<p style="margin-top: 20px;">Queremos que tus compras más seguras, por eso a partir de este <b>mes de octubre</b> actualizaremos nuestro método de ingreso al servicio de delivery Club El Nogal y ahora podrás asignar una contraseña personal.</p>
		</div>
	</div>
</div>
 -->

<div class="container">


	<?php echo $this->bannersimple ?>

	<div class="row">
		<p class="txt-bienvenido"><span><i class="fa-regular fa-user"></i></span> ¡Bienvenido!</p>

		<div class="col-12 text-center">
			<a href="/page/login/index" class="btn btn-azul">Socio</a>
			<a href="/page/login/invitado" class="btn btn-naranja">Invitado</a>
		</div>
	</div>
	<form method="post" action="/page/login/logininvitado" class="col-md-12 ">
		<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

		<?php if ($_GET['registro'] == 1 or $_GET['error'] == "false") { ?>
			<div class="alert alert-warning text-center mt-3">Apreciado usuario, su registro se realizó de forma exitosa. por
				favor ingrese su información de acceso:</div>
		<?php } ?>

		<div align="center" class="caja_registro alto-login">
			<div class="col-md-12 col-lg-6 form-group">
				<div class="col-sm-12 col-md-12 margen_icono">
					<div class="row">

						<div class="col-md-12 text-left d-none">
							<h3 class="titulo-verde1">Documento de identificacin</h3>
						</div>

						<div class="col-md-12" style="margin-top: 20px">
							<span class="campo-login">Documento de identificaci&oacute;n</span>
							<input type="text" name="cedula" required class="form-control texto_normal campo_login"
								value="<?php echo $_GET['cedula']; ?>" placeholder="Identificación">
						</div>

					</div>
				</div>

				<?php if ($_GET['solicitar'] == "1") { ?>
					<div class="col-sm-12 col-md-12">
						<div class="row">
							<div class="col-md-12 text-left d-none">
								<h3 class="titulo-verde1">Contraseña</h3>
							</div>
							<span class="campo-login">Contrase&ntilde;a</span>
							<div class="col-md-12"><input type="password" name="clave" class="form-control texto_normal campo_login"
									value="" placeholder="Contraseña" required autocomplete="off"></div>
						</div>
					</div>
				<?php } ?>


				<div class="col-md-12">
					<button class="btn btn-primary enviar" type="submit">Ingresar</button>
				</div>
			</div>
		</div>


		<?php if ($_GET['error'] == "1"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
		<?php endif ?>
		<?php if ($_GET['error'] == "2"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
		<?php endif ?>
		<?php if ($_GET['error'] == "3"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">Contraseña incorrecta</div>
		<?php endif ?>
		<div class="col-md-12 text-center d-none1"><br><a href="/page/registro" class="enlace d-none">Crear
				cuenta</a> <span class="azul d-none">|</span> <a href="/page/login/recordar/" class="enlace d-none1">Recordar
				contraseña</a></div>

		<div class="col-md-12">
			<br>

		</div>
		<?php echo ($this->productosLogin) ?>
		<?php echo ($this->productosLoginResponsive) ?>


		<input type="hidden" name="taberna_express" value="<?= $_GET['taberna_express'] ?>">
		<input type="hidden" name="anchor" value="<?= $_GET['anchor'] ?>">

	</form>
</div>