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
			<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">

			<?php if ($_GET['registro'] == 1) { ?>
				<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
			<?php } ?>
			<div align="center" class="caja_registro alto-login">
				<div class="col-md-12 col-lg-12 form-group" style="min-height: 300px;">
					<br>
					
					<div class="alert alert-warning w-100 text-center" role="alert">
                	    <?php echo $this->mensaje; ?>
                    </div>
				
					<br><br>
					<div align="center"><a href="/page/login/invitado"><button class="btn btn-primary enviar" type="button">Regresar</button></a></div>
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

</div>