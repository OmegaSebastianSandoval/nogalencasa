<?php
$formas = array("","Envío a domicilio","Para recoger en el Club");
$metodos = array("","Cargo a la acción","Pago en línea");
?>

<div style="background:#FFFFFF; padding:20px;" align="left">
    <div style="display:inline-block; width:900px; padding:20px;">
    	<h2>Información del comprador</h2>
        <div style="width: 49%;"><b>Tipo de Documento</b></div>
        <div style="width: 49%;"><?php echo $this->inscripcion->pedido_tipodocumento; ?></div>
        <div style="width: 49%;"><b>Documento</b></div>
        <div style="width: 49%;"><?php echo $this->inscripcion->pedido_documento; ?></div>
        <div style="width: 49%;"><b>Nombre</b></div>
        <div style="width: 49%;"><?php echo $this->inscripcion->pedido_nombre; ?></div>
        <div style="width: 49%;"><b>Correo</b></div>
        <div style="width: 49%;"><?php echo $this->inscripcion->pedido_correo; ?></div>
        <div style="width: 49%;"><b>Celular</b></div>
        <div style="width: 49%;"><?php echo $this->inscripcion->pedido_celular; ?></div>

		<br>
        <h2>Información de envío</h2>
        <div style="width: 49%;"><b>Forma de envío</b></div>
        <div style="width: 49%;"><?php echo $formas[$this->inscripcion->pedido_forma_envio]; ?></div>

		<br>
        <h2>Información de pago</h2>
        <div style="width: 49%;"><b>Metodo de pago</b></div>
        <div style="width: 49%;"><?php echo $metodos[$this->inscripcion->pedido_medio]; ?></div>
        <?php if($this->inscripcion->pedido_medio=="2"){ ?>
	        <div style="width: 49%;"><b>Estado del pago</b></div>
	        <div style="width: 49%;"><?php echo $this->inscripcion->pedido_estado_texto2; ?></div>
        <?php } ?>


		<br>
        <h2>Pedido</h2>
        <div>
        	<table width="100%" cellpadding="5" cellspacing="0" border="1">
        		<tr>
        			<th>Producto</th>
                        <th align="center">Cantidad</th>
                        <th align="right">Valor unitario</th>
                        <th align="right">Valor total</th>
        		</tr>
        		<?php foreach ($this->productos as $producto): ?>
	        		<tr>
	        			<td><?php echo $producto->nombre; ?></td>
                            <td align="center"><?php echo $producto->cantidad; ?></td>
                            <td align="right">$<?php echo number_format($producto->valor); ?></td>
                            <td align="right">$<?php echo number_format($producto->valor*$producto->cantidad); ?></td>
	        		</tr>
        		<?php endforeach ?>
					<tr>
						<td colspan="3"><b>Costo envío</b></td>
						<td align="right">$<?php echo number_format($this->inscripcion->pedido_envio); ?></td>
					</tr>
					<tr>
						<td colspan="3"><b>Total</b></td>
						<td align="right">$<?php echo number_format($this->inscripcion->pedido_valorpagar); ?></td>
					</tr>
        	</table>
        </div>


       <br>
       <div style="font-size:20px; color:#000; font-family:Arial;">Tu pedido se ha generado con el número:</div><br>
        <div style="font-size:30px; color:#000; font-family:Arial;"><?php echo str_pad($this->inscripcion->pedido_id, 10, "0", STR_PAD_LEFT); ?></div>
        <br>
        <div style="font-size:16px; color:#000; font-family:Arial;">Pronto nos pondremos en contacto contigo</div>
    </div>
</div>