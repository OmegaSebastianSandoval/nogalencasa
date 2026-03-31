<style type="text/css">
	.caja-items {
		visibility: hidden;
	}

	.carrito {
		visibility: hidden;
	}

	.carousel-item img,
	.carousel-item {
		height: auto !important;
	}
</style>


<div class="container">
	<?php echo $this->bannersimple ?>
	<div class="row">
		<p class="txt-bienvenido"><span><i class="fa-regular fa-user"></i></span> Recuperación de contraseña</p>
		<form method="post" action="/page/login/recordar2" class="col-md-12 ">
			<?php if ($this->registro == 1) { ?>
				<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
			<?php } ?>
			<div align="center" class="caja_registro alto-login">
				<div class="col-md-12 col-lg-6 form-group">
					<div class="col-sm-12 col-md-12 margen_icono">
						<div class="row">
							<div class="col-md-12 text-left d-none">
								<h3 class="titulo-verde1">Documento de identificación</h3>
							</div>
							<div class="col-md-12"><input type="text" name="cedula" required class="form-control texto_normal campo_login" value="<?php echo $this->cedula; ?>" placeholder="Documento de identificaci&oacute;n"></div>
 <input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">
						</div>
					</div>

					<div class="col-md-12">
						<br>
						<button class="btn btn-primary enviar" type="submit">Validar</button>
					</div>
				</div>
			</div>


			<?php if ($this->error == "1") : ?>
				<div class="col-md-12"><br></div>
				<div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
			<?php endif ?>
			<?php if ($this->error == "2") : ?>
				<div class="col-md-12"><br></div>
				<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
			<?php endif ?>


		</form>
	</div>
</div>