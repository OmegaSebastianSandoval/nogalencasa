<div class="container alto"  style="padding-bottom: 30px;">	
<?php
	$ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
	$merchant_id = $_REQUEST['merchantId'];
	$referenceCode = $_REQUEST['referenceCode'];
	$TX_VALUE = $_REQUEST['TX_VALUE'];
	$New_value = number_format($TX_VALUE, 1, '.', '');
	$currency = $_REQUEST['currency'];
	$transactionState = $_REQUEST['transactionState'];
	$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
	$firmacreada = md5($firma_cadena);
	$firma = $_REQUEST['signature'];
	$reference_pol = $_REQUEST['reference_pol'];
	$cus = $_REQUEST['cus'];
	$extra1 = $_REQUEST['description'];
	$pseBank = $_REQUEST['pseBank'];
	$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
	$transactionId = $_REQUEST['transactionId'];
 
if ($_REQUEST['transactionState'] == 4 ) {
	$estadoTx = "Transacción aprobada";
}

else if ($_REQUEST['transactionState'] == 6 ) {
	$estadoTx = "Transacción rechazada";
}

else if ($_REQUEST['transactionState'] == 104 ) {
	$estadoTx = "Error";
}

else if ($_REQUEST['transactionState'] == 7 ) {
	$estadoTx = "Transacción pendiente";
}

else {
	$estadoTx=$_REQUEST['mensaje'];
}


if (strtoupper($firma) == strtoupper($firmacreada)) {?>
	<div align="center">
		<h1>
			RESUMEN TRANSACCIÓN
			
		</h1>
		<img src="/skins/page/images/raya.png" class="separador">
	</div>
	<div class="tablaprincipal">
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Estado de la transaccion</div>
			<div class="titulolinearespuesta"><?php echo $estadoTx; ?></div>
		</div>
		
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">ID de la transaccion</div>
			<div class="titulolinearespuesta"><?php echo $transactionId; ?></div>
		</div>
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Referencia de la venta</div>
			<div class="titulolinearespuesta"><?php echo $reference_pol; ?></div> 
		</div>
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Referencia de la transaccion</div>
			<div class="titulolinearespuesta"><?php echo $referenceCode; ?></div>
		</div>
		<div class="titulo_tabla1">
		<?php
		if($pseBank != null) {
		?>
			<div class="titulo_tabla1">
			<div class="titulolinearespuesta">cus </div>
			<div class="titulolinearespuesta"><?php echo $cus; ?> </div>
			</div>
			<div>
			<div class="titulolinearespuesta">Banco </div>
			<div class="titulolinearespuesta"><?php echo $pseBank; ?> </div>
			</div>
		<?php
		}
		?>
		</div>
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Valor total</div>
			<div class="titulolinearespuesta">$<?php echo number_format($TX_VALUE); ?></div>
		</div>
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Moneda</div>
			<div class="titulolinearespuesta"><?php echo $currency; ?></div>
		</div>
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Descripción</div>
			<div class="titulolinearespuesta"><?php echo ($extra1); ?></div>
		</div>
		<div class="titulo_tabla1">
			<div class="titulolinearespuesta">Entidad:</div>
			<div class="titulolinearespuesta"><?php echo ($lapPaymentMethod); ?></div>
		</div>
	</div>

<?php
}
else
{
?>
	<h1 class="titulos">Error validando firma digital.</h1>
<?php
}
?>
</div>