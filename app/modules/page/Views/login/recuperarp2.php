<style>
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

  a{
    color: var(--azul);
    font-weight: bolder;
  }
  .alert-contrasenia {
    display: none;
  }
  .bx-user{
    display: none;
  }
</style>
<div class="container">
	<?php echo $this->bannerlogin ?>
	<div class="row">
		<p class="txt-bienvenido"><span><i class="fa-regular fa-user"></i></span> Recuperación de contraseña</p>

		<form action="/page/login/cambiarclave" method="post" class="row">
			<input type="hidden" name="token" value="<?php echo $this->t ?>">
			<input type="hidden" name="codi" value="<?php echo $this->codi ?>">
			<input type="hidden" name="ncar" value="<?php echo $this->ncar ?>">

			<div align="center" class="caja_registro alto-login">
				<div class="col-lg-4 form-group">
					<div class="col-sm-12 col-md-12 margen_icono">
						<div class="row">
							<div class="col-md-12 text-left d-none">
								<h3 class="titulo-verde1">Documento de identificación</h3>
							</div>
							<div class="col-md-12"><input type="password" name="pass" id="client-password" required class="form-control texto_normal campo_login" placeholder="Nueva contraseña"></div>


							<div class="col-md-12"><input type="password" name="cpass" id="client-password2" required class="form-control texto_normal campo_login" placeholder="Repita la contraseña"></div>
						</div>
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

					<div class="col-md-12">
						<br>
						<button class="btn btn-primary enviar" type="submit">Cambiar</button>
					</div>
				</div>
			</div>


			<?php if ($this->error == "1") : ?>
				<div class="col-md-12"><br></div>
				<div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
			<?php endif ?>



		</form>
	</div>
	
<script>
  $(document).ready(function () {
    $("#client-password").on("keyup", function () {
      validar_clave($(this).val());
      comparar_claves();
    });
    $("#client-password2").on("keyup", function () {
      comparar_claves();
    });
    function comparar_claves() {
      let clave = $("#client-password").val(),
        clave2 = $("#client-password2").val();
      if (clave == clave2) {
        $("#alert-contrasenia2").hide();
      } else {
        $("#alert-contrasenia2").show();
      }
    }
    function validar_clave(contrasenna) {
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