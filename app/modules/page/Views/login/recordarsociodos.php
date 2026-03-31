<style type="text/css">

body{
    max-height: 400px;
    overflow: hidden;
}
</style>


<div class="container">
    <div class="row">
        <div class="col-12 titulo-contact">
            <br><h2 class="contact">Recordar Contraseña</h2>
        </div>
    </div>
</div>

<div>
	<form method="post" action="/page/login/recordar2" class="col-md-12 ">
		<?php if($this->registro==1){ ?>
			<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
		<?php } ?>
		<div align="center" class="caja_registro alto-login">
			<div class="col-md-12 col-lg-12 form-group" style="min-height: 300px;">
				<br>
				<?php echo $this->mensaje; ?>
				<br><br>
				<div align="center"><a href="/page/login/"><button class="btn btn-primary" type="button">regresar</button></a></div>
			</div>
	  	</div>


		<?php if ($this->error=="1"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">El documento no es válido</div>
		<?php endif ?>
		<?php if ($this->error=="2"): ?>
			<div class="col-md-12"><br></div>
			<div class="alert alert-danger col-md-12 text-center">Usuario inactivo</div>
		<?php endif ?>


	</form>
</div>