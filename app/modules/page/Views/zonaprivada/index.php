<style type="text/css">

body{
    max-height: 400px;
    overflow: hidden;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-12 titulo-contact">
            <br><h2 class="contact">Login zona privada</h2>
        </div>
        <div class="col-12">
        	<br>
        	Consulte aquí la cartelera de postulantes virtual del Club El Nogal.
        </div>
    </div>
</div>

<div>
	<form method="post" action="/page/zonaprivada/login" class="col-md-12 ">
		<?php if($_GET['registro']==1){ ?>
			<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
		<?php } ?>
		<div align="center" class="caja_registro alto-login">
			<div class="col-md-12 col-lg-6 form-group">
				<div class="col-sm-12 col-md-12 margen_icono">
					<div class="row">
						<div class="col-md-12 text-left"><h3 class="titulo-verde1">Documento de identificación</h3></div>
						<div class="col-md-12"><input type="text" name="cedula" required class="form-control texto_normal campo_login" value="<?php echo $_GET['cedula']; ?>" placeholder=""></div>

					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<div class="row">
						<div class="col-md-12 text-left"><h3 class="titulo-verde1">Número de acción</h3></div>
						<div class="col-md-12"><input type="text" name="clave" required class="form-control texto_normal campo_login" value="" placeholder=""></div>
					</div>
				</div>


				<div class="col-md-12 text-center d-none"><br><a href="/page/registro" class="enlace d-none">Crear cuenta</a> <span class="azul d-none">|</span> <a href="/page/login/recordar/" class="enlace">¿Haz olvidado tu contraseña?</a></div>

				<div class="col-md-12">
					<br>
					<button class="btn btn-primary enviar" type="submit">Ingresar</button>
				</div>
			</div>
	  	</div>


		<?php if ($_GET['error']=="1"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
		<?php endif ?>
		<?php if ($_GET['error']=="2"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
		<?php endif ?>


	</form>
</div>