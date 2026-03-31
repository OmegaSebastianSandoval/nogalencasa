<style type="text/css">
	body{
		display: none;
	}
</style>

<?php
function calcular_hora1($x){
	$aux = explode(":",$x);
	$hora = ((int)$aux[0]*1)-12;
	//$hora = $hora."pm";
	return $hora;
}

$festivos = new festivos();

if($_GET['prueba']=="1"){
	//echo "abril1: ".$festivos->esFestivo(1,4);
	//echo "<br>abril2: ".$festivos->esFestivo(2,4);
}

$es_festivo=0;
if($festivos->esFestivo(date("d"),date("m"))===true){
	$es_festivo=1;
}
?>

<?php
$hora = date("H:i:s");
$dia_semana = date("w");
$fecha = date("Y-m-d");
if($_GET['simular_hora']!=""){
	$hora = $_GET['simular_hora'];
}

//horario delivery
$online=0;
if($es_festivo==1 and $hora>$this->horario_festivo->horario_hora1 and $hora<=$this->horario_festivo->horario_hora2){
	$online=1;
}
foreach ($this->horarios as $key => $value) {
	if($value->horario_fecha==""){
		if($dia_semana==$value->horario_dia and $es_festivo==0 and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online=1;
		}
		if($dia_semana==$value->horario_dia and $es_festivo==1 and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online=1;
		}
	}else{
		if($fecha==$value->horario_fecha){
			$online=0;
		}
		if($fecha==$value->horario_fecha and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online=1;
		}
	}
}

//horario express
$online2=0;
if($es_festivo==1 and $hora>$this->horario_festivo2->horario_hora1 and $hora<=$this->horario_festivo2->horario_hora2){
	$online2=1;
}
foreach ($this->horarios2 as $key => $value) {
	if($value->horario_fecha==""){
		if($dia_semana==$value->horario_dia and $es_festivo==0 and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online2=1;
			$hora_express1 = $value->horario_hora1;
			$hora_express2 = $value->horario_hora2;
		}
		if($dia_semana==$value->horario_dia and $es_festivo==1 and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online2=1;
			$hora_express1 = $value->horario_hora1;
			$hora_express2 = $value->horario_hora2;
		}
	}else{
		if($fecha==$value->horario_fecha){
			$online2=0;
		}
		if($fecha==$value->horario_fecha and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online2=1;
			$hora_express1 = $value->horario_hora1;
			$hora_express2 = $value->horario_hora2;
		}
	}
}


//horario cafe
$online3=0;
if($es_festivo==1 and $hora>$this->horario_festivo3->horario_hora1 and $hora<=$this->horario_festivo3->horario_hora2){
	$online3=1;
}
foreach ($this->horarios3 as $key => $value) {
	if($value->horario_fecha==""){
		if($dia_semana==$value->horario_dia and $es_festivo==0 and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online3=1;
			$hora_cafe1 = $value->horario_hora1;
			$hora_cafe2 = $value->horario_hora2;
		}
		if($dia_semana==$value->horario_dia and $es_festivo==1 and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online3=1;
			$hora_cafe1 = $value->horario_hora1;
			$hora_cafe2 = $value->horario_hora2;
		}
	}else{
		if($fecha==$value->horario_fecha){
			$online3=0;
		}
		if($fecha==$value->horario_fecha and $hora>$value->horario_hora1 and $hora<=$value->horario_hora2){
			$online3=1;
			$hora_cafe1 = $value->horario_hora1;
			$hora_cafe2 = $value->horario_hora2;
		}
	}
}



?>
<style type="text/css">
.margen_express{
    margin-top: -10px;
    margin-bottom: -18px;
}
.ancho45{
	/* *max-width: 44%;
	max-width: 32%; */
}
.btn-azul{
	background: #0094A3;
	color: #FFFFFF;
	border-radius: 0px;
	padding: 0px 40px;
}
.margen_boton1{
	margin-top: 38px;
}
.margen_boton3{
	margin-top: 22px;
}
@media screen and (max-width:900px) {
	.ancho45{
		max-width: 100%;
	}
	.separador_vertical{
		display: none;
	}
	.margen_caja1{
		margin-left: 0px;
	}
}
</style>

<?php if($_GET['taberna_express']==""){ ?>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="titulo-principal contact text-center titulo-seleccione">Selecciona una opción</h2>
		</div>
		<div class="col-lg-12">
			<div class="row">

				<div class="col-lg-4 ancho45 margen_caja1">
					<div class="fondo_seleccion text-center" >
						<?php if($hora<"16:00:00" and $hora>="08:00:00" and $_GET['cerrado']=="" or $_GET['abierto']=="1" or 1==1){ ?>
							<div class="margen_express"><img src="/corte/logo_cafeparis.png"></div>
						<?php }else{ ?>
							<div class="margen_express"><img src="/corte/logo_cafeparis.png" style="filter: grayscale(100%);"></div>
						<?php } ?>
						<div class="texto_seleccion"><br>Menú para recoger en el Club o recibir a domicilio en dos horas</div><br>
						<div class="texto_seleccion2">Los pedidos realizados antes de la 4 p.m. podrán ser enviados o recogidos el mismo día en el horario de 8 a.m. a 4 p.m. Si el pedido se hace después de la 4 p.m. podrá ser enviado o recogido al día siguiente.</div>

						<?php if($online3==1 or 1==1){ ?>
							<div class="margen_boton3"><a href="https://cafeparis.clubelnogal.com/page/index"><button class="btn btn-azul">Ingresar</button></a></div>
						<?php }else{ ?>
							<?php //echo $this->carta[0]->contenido_descripcion; ?>
							<div class="margen_boton3"><a onclick="$('#boton_modal').click();"><button class="btn btn-deshabilitado">Ingresar</button></a></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-lg-1 text-center padding0 d-none1">
					<div class="separador_vertical"></div>
				</div>

				<?php
				//0 domingo
				//1 lunes
				//2 martes
				//3 miercoles
				//4 jueves
				//5 viernes
				//6 sabado
				?>
				<div class="col-lg-1 d-none"></div>

				<div class="col-lg-4 ancho45">
					<div class="fondo_seleccion text-center" style="min-height: 502px !important;">
						<?php if($online2==1){ ?>
							<div class="margen_express"><img src="/corte/Logo_Taberna_Express.png"></div>
						<?php }else{ ?>
							<div class="margen_express"><img src="/corte/Logo_Taberna_Express_Bl.png"></div>
						<?php } ?>

							<div class="mt-5">
								<?php echo $this->texto_express->contenido_descripcion; ?>
							</div>

						<?php if($online2==1){ ?>
							<?php if(strpos($_SERVER['HTTP_HOST'],"clubelnogal")!==false){ ?>
								<div class="margen_boton1" id="margen_boton1"><a href="https://express.clubelnogal.com/page/index"><button id="btn-ar" class="btn btn-verde" style="margin-bottom:10px; width: 223px;">Ingresar</button></a></div>
							<?php }else{ ?>
								<div class="margen_boton1" id="margen_boton1"><a href="https://express.omegasolucionesweb.com/page/index"><button id="btn-ar" class="btn btn-verde" style="margin-bottom:10px; width: 223px;">Ingresar</button></a></div>
							<?php } ?>
						<?php }else{ ?>
							<div class="texto_seleccion2"><?php echo $this->carta[0]->contenido_descripcion; ?></div>
							<div class="margen_boton1"><a onclick="$('#boton_modal').click();"><button class="btn btn-deshabilitado">Ingresar</button></a></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-lg-1 text-center padding0">
					<div class="separador_vertical" style="min-height: 502px !important;"></div>
				</div>

				<div class="col-lg-4 ancho45">
					<div class="fondo_seleccion text-center">
						<div><img src="/corte/logo_delivery.png"></div>
						<div class="mt-3">
							<?php echo $this->texto_delivery->contenido_descripcion; ?>
						</div>
						<?php if(strpos($_SERVER['HTTP_HOST'],"clubelnogal")!==false){ ?>
							<div class="margen_boton2"><a href="https://delivery.clubelnogal.com/page/index"><button id="btn-ar2"class="btn btn-cafe2">Ingresar</button></a></div>
						<?php }else{ ?>
							<div class="margen_boton2"><a href="https://delivery.omegasolucionesweb.com/page/index"><button id="btn-ar2"class="btn btn-cafe2">Ingresar</button></a></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Restaurante Express Cocina Nogal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php
      		$aux1 = explode(":",$hora_express1);
      		$aux2 = explode(":",$hora_express2);
      		$hora1 = $aux1[0];
      		$hora2 = calcular_hora1($aux2[0]);
      		if($hora1==""){
      			$hora1=10;
      		}
      		if($hora2=="" or $hora2<=0){
      			$hora2=6;
      		}
      	?>
      	<?php if($hora>=$hora_express2){ ?>
        	Apreciado socio, lo invitamos a realizar su pedido el día de mañana en el horario de <?php echo $hora1; ?> a.m. a <?php echo $hora2; ?> p.m. y disfrutar de nuestra carta.
    	<?php }else{ ?>
    		Apreciado socio, lo invitamos a realizar su pedido en el horario de <?php echo $hora1; ?> a.m. a <?php echo $hora2; ?> p.m. y disfrutar de nuestra carta.
    	<?php } ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


<div class="d-none">
	<?php //print_r($_SESSION); ?>
	<iframe src="https://express.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>&level=<?php echo $_SESSION['kt_login_level']; ?>&celular=<?php echo $_SESSION['kt_celular']; ?>&email=<?php echo $_SESSION['kt_correo']; ?>&a=<?php echo $_SESSION['kt_accion']; ?>&q=<?php echo $_SESSION['quien_accion']; ?>&nombre=<?php echo $_SESSION['kt_nombre']; ?>"></iframe>
	<iframe src="https://cafeparis.clubelnogal.com/page/login/loginauto/?cedula=<?php echo $_SESSION['kt_cedula']; ?>&level=<?php echo $_SESSION['kt_login_level']; ?>&celular=<?php echo $_SESSION['kt_celular']; ?>&email=<?php echo $_SESSION['kt_correo']; ?>&a=<?php echo $_SESSION['kt_accion']; ?>&q=<?php echo $_SESSION['quien_accion']; ?>&nombre=<?php echo $_SESSION['kt_nombre']; ?>"></iframe>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<?php if($_GET['taberna_express']=="1"){ ?>

<div align="center" class="p-5">Redireccionando...</div>

<?php
$anchor = explode("_",$_GET['anchor']);
?>

	<script type="text/javascript">
		function redireccion(){
			var anchor = '<?= $anchor[0]; ?>';
			var tab = '<?= $anchor[1]; ?>';
			window.location="https://express.clubelnogal.com/page/index/?tab="+tab+"#"+anchor;
		}
		setTimeout(redireccion,3000);
	</script>

<?php }else{ ?>

<script type="text/javascript">
		function redireccion(){
			window.location="/page/index";
		}
		setTimeout(redireccion,1000);
	</script>

<?php } ?>