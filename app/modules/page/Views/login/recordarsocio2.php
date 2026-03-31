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
</style>
<div class="container">
	<?php echo $this->bannerlogin ?>
	<div class="row">
		<p class="txt-bienvenido"><span><i class="fa-regular fa-user"></i></span> Recuperación de contraseña</p>

		<form method="post" action="/page/login/recordar2" class="col-md-12 ">
			<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

			<?php if ($_GET['registro'] == 1) { ?>
				<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
			<?php } ?>
			<div align="center" class="caja_registro alto-login">
				<div class="col-lg-8 offset-lg-1 form-group" style="min-height: 300px;">
					<br>
					<?php //echo $this->mensaje; 
					?>

					Hemos enviado un mensaje de recuperación de contraseña a su correo electrónico registrado, lo invitamos a ingresar y registrar una nueva contraseña. <br><br>

					Si no recibe nuestro mensaje o su correo electrónico no se encuentra actualizado en nuestras bases de datos lo invitamos a comunicarse con la oficina de atención al socio: <br>
					601 3267700 ext. 3954<br>
					en nuestros horarios de lunes a viernes de 8 a.m. a 6 p.m.


					<br><br>
					<div align="center">
					
					<a href="/page/login/" class="btn btn-primary enviar" type="submit">Regresar</a>

				
				</div>
				</div>
			</div>


			<?php if ($_GET['error'] == "1") : ?>
				<div class="col-md-12"><br></div>
				<div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
			<?php endif ?>
			<?php if ($_GET['error'] == "2") : ?>
				<div class="col-md-12"><br></div>
				<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
			<?php endif ?>


		</form>
	</div>