<style type="text/css">
.pass-wrapper{
	text-align: left;
}
</style>
<style type="text/css">

body{
    *max-height: 400px;
    *overflow: hidden;
}

.enviar{
	background: #69E4A7;
	border: 1px solid #000000;
	border-radius: 15px;
	min-width: 200px;
}

.btn-cafe{
	background: #69E4A7;
}

.campo_login{
	border: 1px solid #000000;
	margin-bottom: 10px;
	border-radius: 15px;
	text-indent: 20px;
	height: 45px;
}

.caja-items{
	visibility: hidden;
}
.carrito{
	visibility: hidden;
}

.titulo-contact{
	color:  #000000;
}

footer .derechos {
	background: #69E4A7;
}

.modal-header {
  background-color: #69E4A7;
}
</style>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="/components/password-strength-meter/src/password.js"></script>
<link rel="stylesheet" href="/components/password-strength-meter/src/password.css">


<div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<img src="/corte/banner_delivery.png" style="width: 100%;">
		</div>
	</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 titulo-contact d-none">
            <br><h2 class="contact">Actualizar contraseña</h2>
        </div>
        <div class="col-12 text-center" style="color:#000000;"><br><br>Estimado socio. Estamos cambiando pensando en su seguridad.<br>Por favor asigne una contraseña segura.<br><br></div>
    </div>
</div>

<div>
	<form method="post" action="/page/login/guardarclave" class="col-md-12 ">
		<?php if($this->registro==1){ ?>
			<div class="alert alert-warning">Apreciado socio, su registro se realizó de forma exitosa. por favor ingrese su información de acceso:</div>
		<?php } ?>
		<div align="center" class="caja_registro alto-login">
			<div class="col-lg-4 form-group">

				<div class="col-sm-12 col-md-12 margen_icono">
					<div class="row">
						<div class="col-md-12 text-left d-none"><h3 class="titulo-verde1"># Identificación</h3></div>
						<div class="col-md-12"><input type="text" class="form-control texto_normal campo_login" value="<?= $this->cedula; ?>" readonly placeholder="# Identificación" autocomplete="off"></div>

					</div>
				</div>


				<div class="col-sm-12 col-md-12 margen_icono">
					<div class="row">
						<div class="col-md-12 text-left d-none"><h3 class="titulo-verde1">Nueva contraseña</h3></div>
						<div class="col-md-12"><input type="password" id="password" name="clave1" required class="form-control texto_normal campo_login" value="" placeholder="Nueva contraseña" autocomplete="off"></div>

					</div>
				</div>
				<div class="col-sm-12 col-md-12">
					<div class="row">
						<div class="col-md-12 text-left d-none"><h3 class="titulo-verde1">Confirmar contraseña</h3></div>
						<div class="col-md-12"><input type="password" id="password2" name="clave2" required class="form-control texto_normal campo_login" value="" placeholder="Confirmar contraseña" autocomplete="off" onchange="comparar();" onkeyup="comparar();"></div>
					</div>
				</div>

				<div class="col-md-12">
					<br>
					<button class="btn btn-primary enviar" id="actualizar" type="submit" style="display: none;">Actualizar</button>
					<div id="error_clave" class="mt-2" style="display: none;">
						<div class="alert alert-warning col-md-12 text-center">Tu contraseña debe ser intermedia o fuerte. <div align="left"><small>- Usa mayusculas o minusculas<br>- Combina Letras y números<br>-Agrega caracteres especiales como *.$#!</small></div></div>
					</div>

					<div id="error_clave2" class="mt-2" style="display: none;">
						<div class="alert alert-warning col-md-12 text-center">Las contraseñas no coinciden</div>
					</div>

				</div>
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

		<input type="hidden" id="score1" value="0">
		<input type="hidden" name="invitado" value="<?= $this->invitado; ?>">

	</form>
</div>



<script type="text/javascript">
$('#password').password({
  enterPass: 'Digita tu contraseña',
  shortPass: 'La contraseña es muy corta',
  containsField: 'La contraseña no puede contener tu nombre de usuario',
  steps: {
    // Easily change the steps' expected score here
    13: 'Contraseña insegura',
    33: 'Contraseña debil; Trata de combinar letras y números',
    67: 'Contraseña intermedia; Trata de usar caracteres especiales',
    94: 'Contraseña fuerte',
  },
  showPercent: true,
  showText: true, // shows the text tips
  animate: true, // whether or not to animate the progress bar on input blur/focus
  animateSpeed: 'fast', // the above animation speed
  field: false, // select the match field (selector or jQuery instance) for better password checks
  fieldPartialMatch: true, // whether to check for partials in field
  minimumLength: 4, // minimum password length (below this threshold, the score is 0)
  useColorBarImage: true, // use the (old) colorbar image
  customColorBarRGB: {
    red: [0, 240],
    green: [0, 240],
    blue: 10,
  } // set custom rgb color ranges for colorbar.
});


$('#password').on('password.score', (e, score) => {
	$("#score1").val(score);
	if(score>=67){
		//$("#actualizar").show();
		$("#error_clave").hide();
	}else{
		$("#actualizar").hide();
		$("#error_clave").show();
	}
	comparar();
});

function comparar(){
	var c1 = $("#password").val();
	var c2 = $("#password2").val();
	var score1 = $("#score1").val();
	if(c1!="" && c1!=c2){
		$("#error_clave2").show();
		$("#actualizar").hide();
	}else{
		$("#error_clave2").hide();
		if(score1>=67){
			$("#actualizar").show();
		}
	}
}

</script>