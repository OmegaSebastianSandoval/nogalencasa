<?php
$formas = array("", "Envo a domicilio", "Para recoger en el Club");
$metodos = array("", "Cargo a la acción", "Pago en lnea");
?>

<div style="background-color:#f4f4f4; padding:30px 20px; font-family:Arial, Helvetica, sans-serif;">
  <div style="max-width:600px; margin:0 auto; background-color:#ffffff; border-radius:8px; box-shadow:0 2px 4px rgba(0,0,0,0.1); overflow:hidden;">

    <!-- Header -->
    <div style="background-color:#2C5483; padding:30px 20px; text-align:center;">
      <h1 style="color:#ffffff; margin:0; font-size:28px; font-weight:bold;">Confirmación de pedido</h1>
    </div>

    <!-- Content -->
    <div style="padding:30px 25px;">

      <!-- Informacin del comprador -->
      <div style="margin-bottom:30px;">
        <h2 style="color:#2C5483; font-size:20px; margin:0 0 15px 0; padding-bottom:8px; border-bottom:2px solid #2C5483;">Información del comprador</h2>
        <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
          <tr>
            <td style="color:#666; font-size:14px; padding:8px 0; width:40%;"><b>Tipo de documento:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_tipodocumento; ?></td>
          </tr>
          <tr style="background-color:#f9f9f9;">
            <td style="color:#666; font-size:14px; padding:8px 0;"><b>Documento:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_documento; ?></td>
          </tr>
          <tr>
            <td style="color:#666; font-size:14px; padding:8px 0;"><b>Nombre:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_nombre . " " . $this->inscripcion->pedido_apellido; ?></td>
          </tr>
          <tr style="background-color:#f9f9f9;">
            <td style="color:#666; font-size:14px; padding:8px 0;"><b>Correo:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_correo; ?></td>
          </tr>
          <tr>
            <td style="color:#666; font-size:14px; padding:8px 0;"><b>Celular:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_celular; ?></td>
          </tr>
        </table>
      </div>

      <!-- Información de envío -->
      <div style="margin-bottom:30px;">
        <h2 style="color:#2C5483; font-size:20px; margin:0 0 15px 0; padding-bottom:8px; border-bottom:2px solid #2C5483;">Información de envío</h2>
        <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
          <tr>
            <td style="color:#666; font-size:14px; padding:8px 0; width:40%;"><b>Forma de envío:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $formas[$this->inscripcion->pedido_forma_envio]; ?></td>
          </tr>
          <?php if ($this->inscripcion->pedido_cuotas >= 1) { ?>
            <tr style="background-color:#f9f9f9;">
              <td style="color:#666; font-size:14px; padding:8px 0;"><b>Número de cuotas:</b></td>
              <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_cuotas; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <!-- Información de pago -->
      <div style="margin-bottom:30px;">
        <h2 style="color:#2C5483; font-size:20px; margin:0 0 15px 0; padding-bottom:8px; border-bottom:2px solid #2C5483;">Información de pago</h2>
        <table width="100%" cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
          <tr>
            <td style="color:#666; font-size:14px; padding:8px 0; width:40%;"><b>Método de pago:</b></td>
            <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $metodos[$this->inscripcion->pedido_medio]; ?></td>
          </tr>
          <?php if ($this->inscripcion->pedido_medio == "2") { ?>
            <tr style="background-color:#f9f9f9;">
              <td style="color:#666; font-size:14px; padding:8px 0;"><b>Estado del pago:</b></td>
              <td style="color:#333; font-size:14px; padding:8px 0;"><?php echo $this->inscripcion->pedido_estado_texto2; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <!-- Pedido -->
      <div style="margin-bottom:30px;">
        <h2 style="color:#2C5483; font-size:20px; margin:0 0 15px 0; padding-bottom:8px; border-bottom:2px solid #2C5483;">Detalle del pedido</h2>
        <table width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse; border:1px solid #ddd;">
          <thead>
            <tr style="background-color:#2C5483;">
              <th style="color:#ffffff; font-size:14px; text-align:left; padding:12px; border:1px solid #2C5483;">Producto</th>
              <th style="color:#ffffff; font-size:14px; text-align:center; padding:12px; border:1px solid #2C5483;">Cantidad</th>
              <th style="color:#ffffff; font-size:14px; text-align:right; padding:12px; border:1px solid #2C5483;">Valor unitario</th>
              <th style="color:#ffffff; font-size:14px; text-align:right; padding:12px; border:1px solid #2C5483;">Valor total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($this->productos as $producto): ?>
              <tr style="background-color:#ffffff;">
                <td style="color:#333; font-size:14px; padding:10px; border:1px solid #ddd;"><?php echo $producto->nombre; ?></td>
                <td style="color:#333; font-size:14px; text-align:center; padding:10px; border:1px solid #ddd;"><?php echo $producto->cantidad; ?></td>
                <td style="color:#333; font-size:14px; text-align:right; padding:10px; border:1px solid #ddd;">$<?php echo number_format($producto->valor); ?></td>
                <td style="color:#333; font-size:14px; text-align:right; padding:10px; border:1px solid #ddd;">$<?php echo number_format($producto->valor * $producto->cantidad); ?></td>
              </tr>
            <?php endforeach ?>
            <tr style="background-color:#f9f9f9;">
              <td colspan="3" style="color:#666; font-size:14px; font-weight:bold; padding:10px; border:1px solid #ddd;">Costo de envío</td>
              <td style="color:#333; font-size:14px; text-align:right; padding:10px; border:1px solid #ddd;">$<?php echo number_format($this->inscripcion->pedido_envio); ?></td>
            </tr>
            <?php if ($this->inscripcion->pedido_propina != "") { ?>
              <tr style="background-color:#f9f9f9;">
                <td colspan="3" style="color:#666; font-size:14px; font-weight:bold; padding:10px; border:1px solid #ddd;">Propina</td>
                <td style="color:#333; font-size:14px; text-align:right; padding:10px; border:1px solid #ddd;">$<?php echo number_format($this->inscripcion->pedido_propina); ?></td>
              </tr>
            <?php } ?>
            <tr style="background-color:#2C5483;">
              <td colspan="3" style="color:#ffffff; font-size:16px; font-weight:bold; padding:12px; border:1px solid #2C5483;">Total</td>
              <td style="color:#ffffff; font-size:16px; font-weight:bold; text-align:right; padding:12px; border:1px solid #2C5483;">$<?php echo number_format($this->inscripcion->pedido_valorpagar); ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Número de pedido -->
      <div style="background-color:#ffe5d3; padding:20px; border-radius:6px; text-align:center; margin-top:30px;">
        <p style="color:#666; font-size:16px; margin:0 0 10px 0;">Tu pedido se ha generado con el número:</p>
        <p style="color:#2C5483; font-size:32px; font-weight:bold; margin:0; letter-spacing:2px;"><?php echo str_pad($this->inscripcion->pedido_id, 10, "0", STR_PAD_LEFT); ?></p>
      </div>

    </div>

    <!-- Footer -->
    <!-- <div style="background-color:#f4f4f4; padding:20px; text-align:center; border-top:1px solid #ddd;">
      <p style="color:#999; font-size:12px; margin:0;">Gracias por tu compra. Si tienes alguna pregunta, no dudes en contactarnos.</p>
    </div> -->

  </div>
</div>