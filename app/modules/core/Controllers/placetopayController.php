<?php

/**
 *
 */

class Core_placetopayController extends Controllers_Abstract
{

  public function responseAction()
  {
    //error_reporting(1);
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
    $id = $this->_getSanitizedParam("reference");
    $registro = $formularioModel->getById($id);
    $response = $placetopay->query($registro->request_id);

    // There was some error with the connection so check the message
    //print_r($response->status()->message() . "\n");


    //print_r($response->payment()[0]->paymentMethodName() . " " . $response->payment()[0]->issuerName());



    //print_r($response->status()->message() . "\n");
    if ($response && $response->isSuccessful()) {

      /* echo "<pre>";
            print_r($response);
            echo "</pre>";
 */
      //echo $response->payment[0]->authorization();
      //   In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
      if ($response->status()->isApproved()) {
        $formularioModel->editField($id, "pedido_estado", '1');
        $formularioModel->editField($id, "pedido_estado_texto", 'Aprobado');
        $formularioModel->editField($id, "pedido_estado_texto2", "El pago ha sido aprobado exitosamente");
        $formularioModel->editField($id, "pedido_cus", $response->payment()[0]->authorization());
        $formularioModel->editField($id, "pedido_franquicia", $response->payment()[0]->paymentMethodName() . " " . $response->payment()[0]->issuerName());
        $this->enviarCompra1($id);
        header("Location: /page/respuesta?id=" . $id);
      } else if (($response->payment()[0] && $response->payment()[0]->status()->status() == 'PENDING') or $response->status()->status() == 'PENDING') {
        $formularioModel->editField($id, "pedido_estado", '2');
        $formularioModel->editField($id, "pedido_estado_texto", 'Pendiente');
        $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra pendiente");
        if ($response->payment()[0]) {
          $cus = $response->payment()[0]->authorization();
          $formularioModel->editField($id, "pedido_franquicia", $response->payment()[0]->paymentMethodName() . " " . $response->payment()[0]->issuerName());
        } else {
          $cus = '';
        }
        $formularioModel->editField($id, "pedido_cus", $cus);
        header("Location: /page/respuesta?id=" . $id);
      } else if (($response->payment()[0] && $response->payment()[0]->status()->status() == 'FAILED')) {
        $formularioModel->editField($id, "pedido_estado", '4');
        $formularioModel->editField($id, "pedido_estado_texto", 'Fallido');
        $formularioModel->editField($id, "pedido_estado_texto2", "La petición ha sido cancelada por el usuario");
        if ($response->payment()[0]) {
          $cus = $response->payment()[0]->authorization();
          $formularioModel->editField($id, "pedido_franquicia", $response->payment()[0]->paymentMethodName() . " " . $response->payment()[0]->issuerName());
        } else {
          $cus = '';
        }
        $formularioModel->editField($id, "pedido_cus", $cus);
        if ($registro->pedido_fecha >= "2020-04-21 12:24:00") {
          $this->agregarproductos($id);
        }
        header("Location: /page/respuesta?id=" . $id);
      } else {
        $formularioModel->editField($id, "pedido_estado", '3');
        $formularioModel->editField($id, "pedido_estado_texto", 'Rechazada');
        $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra rechazado");
        if ($response->payment()[0]) {
          $cus = $response->payment()[0]->authorization();
          $formularioModel->editField($id, "pedido_franquicia", $response->payment()[0]->paymentMethodName() . " " . $response->payment()[0]->issuerName());
        } else {
          $cus = '';
        }
        $formularioModel->editField($id, "pedido_cus", $cus);
        if ($registro->pedido_fecha >= "2020-04-21 12:24:00") {
          $this->agregarproductos($id);
        }
        header("Location: /page/respuesta?id=" . $id);
      }
    } else {
      // There was some error with the connection so check the message
      //print_r($response->status()->message() . "\n");
      header("Location: /page/respuesta?error=1");
    }
  }

  //solo consulta
  public function response2Action()
  {
    error_reporting(1);
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
    $id = $this->_getSanitizedParam("reference");
    $registro = $formularioModel->getById($id);
    $response = $placetopay->query($registro->request_id);
    if ($response->isSuccessful()) {
      echo "<pre>";
      print_r($response);
      //echo $response->payment[0]->authorization();
      // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
      if ($response->status()->isApproved()) {
        $formularioModel->editField($id, "pedido_estado", '1');
        $formularioModel->editField($id, "pedido_estado_texto", 'Aprobado');
        $formularioModel->editField($id, "pedido_estado_texto2", "El pago ha sido aprobado exitosamente");
        $formularioModel->editField($id, "pedido_cus", $response->payment[0]->authorization());
        $formularioModel->editField($id, "pedido_franquicia", $response->payment[0]->paymentMethodName() . " " . $response->payment[0]->issuerName());
      } else if (($response->payment[0] && $response->payment[0]->status()->status() == 'PENDING') or $response->status()->status() == 'PENDING') {
        echo "entro pendiente";
        print_r($response->payment[0]);
        echo $response->status()->reason();
        $formularioModel->editField($id, "pedido_estado", '2');
        $formularioModel->editField($id, "pedido_estado_texto", 'Pendiente');
        $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra pendiente");
        if ($response->payment[0]) {
          $cus = $response->payment[0]->authorization();
          $formularioModel->editField($id, "pedido_franquicia", $response->payment[0]->franchise() . " " . $response->payment[0]->franchiseName());
        } else {
          $cus = '';
        }
        $formularioModel->editField($id, "pedido_cus", $cus);
      } else if (($response->payment[0] && $response->payment[0]->status()->status() == 'FAILED')) {
        $formularioModel->editField($id, "pedido_estado", '4');
        $formularioModel->editField($id, "pedido_estado_texto", 'Fallido');
        $formularioModel->editField($id, "pedido_estado_texto2", "La petición ha sido cancelada por el usuario");
        if ($response->payment[0]) {
          $cus = $response->payment[0]->authorization();
        } else {
          $cus = '';
        }
        $formularioModel->editField($id, "pedido_cus", $cus);
      } else {
        $formularioModel->editField($id, "pedido_estado", '3');
        $formularioModel->editField($id, "pedido_estado_texto", 'Rechazada');
        $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra rechazado");
        if ($response->payment[0]) {
          $cus = $response->payment[0]->authorization();
        } else {
          $cus = '';
        }
        $formularioModel->editField($id, "pedido_cus", $cus);
      }
    } else {
      // There was some error with the connection so check the message
      print_r($response->status()->message() . "\n");
      //header("Location: /page/respuesta?error=1");
    }
  }

  public function notificationAction()
  {
    $formularioModel = new Page_Model_DbTable_Pedidos();
    //error_reporting(1);
    header('Access-Control-Allow-Origin: *');
    $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
    try {
      $notification = $placetopay->readNotification();
      /*echo "<pre>";
            print_r($notification);*/
      $notification->isValidNotification();
      if ($notification->isValidNotification() == true) {
        if ($notification->isApproved()) {
          $id = $notification->reference();
          $formularioModel->editField($id, "pedido_estado", '1');
          $formularioModel->editField($id, "pedido_estado_texto", 'Aprobado');
          $formularioModel->editField($id, "pedido_estado_texto2", "El pago ha sido aprobado exitosamente");
          $this->enviarCompra1($id);
          //echo "aprobacion";
        } else {
          $id = $notification->reference();
          $formularioModel->editField($id, "pedido_estado", '3');
          $formularioModel->editField($id, "pedido_estado_texto", 'Rechazada');
          $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra rechazado ddd");
          //echo "rechazo";
        }
      } else {
        //echo "no hay comunicacion con placetopay";
      }
    } catch (Exception $e) {
      var_dump($e->getMessage());
    }
  }

  public function sondaAction()
  {
    error_reporting(1);
    $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $logModel = new Administracion_Model_DbTable_Log();

    $logData = array();
    $logData['log_log'] = "Iniciando sondaAction - Revisión automática de pagos pendientes";
    $logData['log_tipo'] = 'PLACETOPAY SONDA - INICIO';
    $logModel->insert($logData);

    $fechaHoy = date("Y-m-d") . " 00:00:00";
    $inscripciones = $formularioModel->getList(
      " pedido_medio = '2' AND pedido_estado='2' AND request_id IS NOT NULL AND pedido_fecha >= '$fechaHoy'",
      ""
    );

    $totalPedidos = count($inscripciones);
    $procesados = 0;
    $actualizados = 0;
    $errores = 0;

    $logData['log_log'] = "Se encontraron $totalPedidos pedidos pendientes para revisar";
    $logData['log_tipo'] = 'PLACETOPAY SONDA - TOTAL ENCONTRADOS';
    $logModel->insert($logData);

    echo "<!DOCTYPE html>
    <html>
    <head>
      <title>Sonda PlaceToPay - Pedidos</title>
      <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        h2 { color: #333; }
        .resumen { background: #fff; padding: 15px; border-radius: 5px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .pedido { border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #fff; border-radius: 5px; }
        .aprobado { border-left: 4px solid #28a745; }
        .pendiente { border-left: 4px solid #ffc107; }
        .fallido { border-left: 4px solid #dc3545; }
        .rechazado { border-left: 4px solid #6c757d; }
        .expirado { border-left: 4px solid #e83e8c; }
        .estado { font-weight: bold; padding: 3px 8px; border-radius: 3px; display: inline-block; }
        .estado.aprobado { background: #d4edda; color: #155724; }
        .estado.pendiente { background: #fff3cd; color: #856404; }
        .estado.fallido { background: #f8d7da; color: #721c24; }
        .estado.rechazado { background: #e2e3e5; color: #383d41; }
        .estado.expirado { background: #f8d7da; color: #721c24; }
        .info { color: #666; font-size: 0.9em; }
        .actualizacion { color: #28a745; font-weight: bold; }
      </style>
    </head>
    <body>
      <h2>🔍 Revisión Automática de Pagos Pendientes - PlaceToPay</h2>
      <div class='resumen'>
        <strong>Pedidos encontrados:</strong> $totalPedidos<br>
        <strong>Fecha límite:</strong> $fechaHoy
      </div>
      <hr>
    ";

    foreach ($inscripciones as $key => $inscripcion) {
      $id = $inscripcion->pedido_id;
      $estadoAnterior = $inscripcion->pedido_estado;

      $logData['pedido_id'] = $id;
      $logData['log_log'] = "Consultando estado de pedido ID: $id, Request ID: " . $inscripcion->request_id;
      $logData['log_tipo'] = 'PLACETOPAY SONDA - CONSULTANDO';
      $logModel->insert($logData);

      echo "<div class='pedido'>";
      echo "<strong>Pedido ID: $id</strong> - Estado anterior: <span class='estado'>" . ($estadoAnterior == '1' ? 'Aprobado' : ($estadoAnterior == '2' ? 'Pendiente' : ($estadoAnterior == '4' ? 'Fallido' : ($estadoAnterior == '5' ? 'Expirado' : 'Rechazado')))) . "</span><br>";

      try {
        $response = $placetopay->query($inscripcion->request_id);

        if ($response && $response->isSuccessful()) {
          $procesados++;

          $payment = $response->payment()[0] ?? null;
          $authorization = $payment ? ($payment->authorization() ?? '') : '';
          $franquicia = '';

          if ($payment) {
            $paymentMethod = $payment->paymentMethodName() ?? '';
            $issuer = $payment->issuerName() ?? '';
            $franquicia = trim($paymentMethod . ' ' . $issuer);
          }

          $estadoPlacetopay = $response->status()->status();

          $logData['log_log'] = "Respuesta PlaceToPay para pedido $id - Estado: $estadoPlacetopay, Auth: $authorization, Franquicia: $franquicia";
          $logData['log_tipo'] = 'PLACETOPAY SONDA - RESPUESTA';
          $logModel->insert($logData);

          echo "<span class='info'>Estado PlaceToPay: <strong>$estadoPlacetopay</strong></span><br>";
          echo "<span class='info'>Autorización: $authorization</span><br>";
          echo "<span class='info'>Franquicia: $franquicia</span><br>";

          if ($response->status()->isApproved()) {
            if ($estadoAnterior != '1') {
              $formularioModel->editField($id, "pedido_estado", '1');
              $formularioModel->editField($id, "pedido_estado_texto", 'Aprobado');
              $formularioModel->editField($id, "pedido_estado_texto2", "El pago ha sido aprobado exitosamente");
              $formularioModel->editField($id, "pedido_cus", $authorization);
              $formularioModel->editField($id, "pedido_franquicia", $franquicia);
              $actualizados++;
               $this->enviarCompra1($id);
              $logData['log_log'] = "SONDA: Pago APROBADO - Estado cambiado de $estadoAnterior a 1. Auth: $authorization";
              $logData['log_tipo'] = 'PLACETOPAY SONDA - PAGO APROBADO';
              $logModel->insert($logData);

              echo "<span class='actualizacion'>ACTUALIZADO A APROBADO</span><br>";
            } else {
              echo "<span style='color: blue;'>Ya estaba aprobado</span><br>";
            }
          } else if ($payment && $payment->status()->status() == 'PENDING') {
            $formularioModel->editField($id, "pedido_estado", '2');
            $formularioModel->editField($id, "pedido_estado_texto", 'Pendiente');
            $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra pendiente");
            if ($payment) {
              $cus = $payment->authorization();
              $formularioModel->editField($id, "pedido_franquicia", $franquicia);
            } else {
              $cus = '';
            }
            $formularioModel->editField($id, "pedido_cus", $cus);

            $logData['log_log'] = "SONDA: Pago sigue PENDIENTE - No se actualiza (estado: $estadoAnterior)";
            $logData['log_tipo'] = 'PLACETOPAY SONDA - SIGUE PENDIENTE';
            $logModel->insert($logData);

            echo "<span style='color: orange;'> Sigue pendiente</span><br>";
          } else if ($payment && $payment->status()->status() == 'FAILED') {
            if ($estadoAnterior != '4') {
              $formularioModel->editField($id, "pedido_estado", '4');
              $formularioModel->editField($id, "pedido_estado_texto", 'Fallido');
              $formularioModel->editField($id, "pedido_estado_texto2", "La petición ha sido cancelada por el usuario");
              if ($payment) {
                $cus = $payment->authorization();
                $formularioModel->editField($id, "pedido_franquicia", $franquicia);
              } else {
                $cus = '';
              }
              $formularioModel->editField($id, "pedido_cus", $cus);
              if ($inscripcion->pedido_fecha >= "2020-04-21 12:24:00") {
                 $this->agregarproductos($id);
              }
              $actualizados++;

              $logData['log_log'] = "SONDA: Pago FALLIDO - Estado cambiado de $estadoAnterior a 4. Auth: $authorization";
              $logData['log_tipo'] = 'PLACETOPAY SONDA - PAGO FALLIDO';
              $logModel->insert($logData);

              echo "<span style='color: red;'> ACTUALIZADO A FALLIDO</span><br>";
            } else {
              echo "<span style='color: blue;'> Ya estaba fallido</span><br>";
            }
          } else if ($response->status()->status() == 'REJECTED') {
            if ($estadoAnterior != '5') {
              $formularioModel->editField($id, "pedido_estado", '5');
              $formularioModel->editField($id, "pedido_estado_texto", 'Expirado');
              $formularioModel->editField($id, "pedido_estado_texto2", $response->status()->message());
              if ($payment) {
                $formularioModel->editField($id, "pedido_cus", $payment->authorization());
              }
              if ($inscripcion->pedido_fecha >= "2020-04-21 12:24:00") {
                 $this->agregarproductos($id);
              }
              $actualizados++;

              $logData['log_log'] = "SONDA: Pago EXPIRADO - Estado cambiado de $estadoAnterior a 5. Mensaje: " . $response->status()->message();
              $logData['log_tipo'] = 'PLACETOPAY SONDA - PAGO EXPIRADO';
              $logModel->insert($logData);

              echo "<span style='color: #e83e8c;'>ACTUALIZADO A EXPIRADO</span><br>";
            } else {
              echo "<span style='color: blue;'> Ya estaba expirado</span><br>";
            }
          } else {
            if ($estadoAnterior != '3') {
              $formularioModel->editField($id, "pedido_estado", '3');
              $formularioModel->editField($id, "pedido_estado_texto", 'Rechazada');
              $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra rechazado");
              if ($payment) {
                $formularioModel->editField($id, "pedido_cus", $payment->authorization());
              }
              if ($inscripcion->pedido_fecha >= "2020-04-21 12:24:00") {
                 $this->agregarproductos($id);
              }
              $actualizados++;

              $logData['log_log'] = "SONDA: Pago RECHAZADO - Estado cambiado de $estadoAnterior a 3. Auth: $authorization";
              $logData['log_tipo'] = 'PLACETOPAY SONDA - PAGO RECHAZADO';
              $logModel->insert($logData);

              echo "<span style='color: red;'>ACTUALIZADO A RECHAZADO</span><br>";
            } else {
              echo "<span style='color: blue;'> Ya estaba rechazado</span><br>";
            }
          }
        } else {
          $errores++;

          $logData['log_log'] = "Error consultando PlaceToPay para pedido $id: " . ($response ? $response->status()->message() : 'Sin respuesta');
          $logData['log_tipo'] = 'PLACETOPAY SONDA - ERROR CONSULTA';
          $logModel->insert($logData);

          echo "<span style='color: red;'> Error consultando PlaceToPay</span><br>";
        }
      } catch (Exception $e) {
        $errores++;

        $logData['log_log'] = "Excepción consultando pedido $id: " . $e->getMessage();
        $logData['log_tipo'] = 'PLACETOPAY SONDA - EXCEPCION';
        $logModel->insert($logData);

        echo "<span style='color: red;'> Error: " . $e->getMessage() . "</span><br>";
      }

      echo "</div>";

      usleep(500000);
    }

    echo "
      <hr>
      <div class='resumen'>
        <h3>📊 Resumen Final</h3>
        <strong>Total pedidos:</strong> $totalPedidos<br>
        <strong>Procesados:</strong> $procesados<br>
        <strong>Actualizados:</strong> $actualizados<br>
        <strong>Errores:</strong> $errores
      </div>
    </body>
    </html>
    ";

    $logData['log_log'] = "Finalizado - Total: $totalPedidos, Procesados: $procesados, Actualizados: $actualizados, Errores: $errores";
    $logData['log_tipo'] = 'PLACETOPAY SONDA - FINALIZADO';
    $logModel->insert($logData);
  }
  public function sonda2Action()
  {
    error_reporting(1);
    $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $inscripciones = $formularioModel->getList(" pedido_medio = '2' AND pedido_estado='2' AND request_id IS NOT NULL  AND pedido_fecha >= '2024-09-05 15:00:00'", "");
    foreach ($inscripciones as $key => $inscripcion) {
      $id = $inscripcion->pedido_id;
      $response = $placetopay->query($inscripcion->request_id);
      if ($response->isSuccessful()) {
        //echo "<pre>";
        echo "<br>id:" . $id . "<br>";
        print_r($response->status());
        //echo $response->payment[0]->authorization();
        // In order to use the functions please refer to the Dnetix\Redirection\Message\RedirectInformation class
        if ($response->status()->isApproved()) {
          $formularioModel->editField($id, "pedido_estado", '1');
          $formularioModel->editField($id, "pedido_estado_texto", 'Aprobado');
          $formularioModel->editField($id, "pedido_estado_texto2", "El pago ha sido aprobado exitosamente");
          $formularioModel->editField($id, "pedido_cus", $response->payment[0]->authorization());
          $formularioModel->editField($id, "pedido_franquicia", $response->payment[0]->paymentMethodName() . " " . $response->payment[0]->issuerName());
          $this->enviarCompra1($id);
        } else if (($response->payment[0] && $response->payment[0]->status()->status() == 'PENDING') or $response->status()->status() == 'PENDING') {
          $formularioModel->editField($id, "pedido_estado", '2');
          $formularioModel->editField($id, "pedido_estado_texto", 'Pendiente');
          $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra pendiente");
          if ($response->payment[0]) {
            $cus = $response->payment[0]->authorization();
            $formularioModel->editField($id, "pedido_franquicia", $response->payment[0]->paymentMethodName() . " " . $response->payment[0]->issuerName());
          } else {
            $cus = '';
          }
          $formularioModel->editField($id, "pedido_cus", $cus);
        } else if ($response->payment[0] && $response->payment[0]->status()->status() == 'FAILED') {
          $formularioModel->editField($id, "pedido_estado", '4');
          $formularioModel->editField($id, "pedido_estado_texto", 'Fallido');
          $formularioModel->editField($id, "pedido_estado_texto2", "La petición ha sido cancelada por el usuario");
          if ($response->payment[0]) {
            $cus = $response->payment[0]->authorization();
            $formularioModel->editField($id, "pedido_franquicia", $response->payment[0]->paymentMethodName() . " " . $response->payment[0]->issuerName());
          } else {
            $cus = '';
          }
          $formularioModel->editField($id, "pedido_cus", $cus);
          if ($inscripcion->pedido_fecha >= "2020-04-21 12:24:00") {
            $this->agregarproductos($id);
          }
        } else {
          $formularioModel->editField($id, "pedido_estado", '3');
          $formularioModel->editField($id, "pedido_estado_texto", 'Rechazada');
          $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra rechazado");
          if ($response->payment[0]) {
            $formularioModel->editField($id, "pedido_cus", $response->payment[0]->authorization());
          }
          if ($inscripcion->pedido_fecha >= "2020-04-21 12:24:00") {
            $this->agregarproductos($id);
          }
        }
      } else {
        //print_r($response->status()->message() . "\n");
      }
    }
  }
  public function pruebaenvioAction()
  {
    //$this->enviarCompra1(4);
  }

  public function enviarCompra1($id)
  {
    $mail = new Core_Model_Sendingemail($this->_view);
    $error = 0;

    $formularioModel = new Page_Model_DbTable_Pedidos();
    $pedido = $formularioModel->getById($id);
    if ($pedido->pedido_fecha <= "2020-04-21 12:24:00") {
      $error = $this->descontarproductos($id);
    }
    if ($error == 0) {
      if ($pedido->pedido_fecha >= date("Y-m-d") . " 00:00:00") {
        $mail->enviarCompra($id);
      }
    } else {
        if ($pedido->pedido_fecha >= date("Y-m-d") . " 00:00:00") {
        $mail->enviarError($id);
        }
    }
  }


  public function descontarproductos($id)
  {
    $mail = new Core_Model_Sendingemail($this->_view);

    $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
    $productosModel = new Page_Model_DbTable_Productos();
    $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ", "");

    $error = 0;

    foreach ($productoscarrito as $key => $productocarrito) {
      $producto_id = $productocarrito->id_productos;
      $cantidad = $productocarrito->cantidad;
      $producto = $productosModel->getById($producto_id);
      $saldo = $producto->productos_cantidad * 1 - $cantidad * 1;
      if ($saldo < 0) {
        $error = 1;
      }
    }

    if ($error == 0) {
      foreach ($productoscarrito as $key => $productocarrito) {
        $producto_id = $productocarrito->id_productos;
        $cantidad = $productocarrito->cantidad;
        $producto = $productosModel->getById($producto_id);
        $saldo = $producto->productos_cantidad * 1 - $cantidad * 1;
        $productosModel->editField($producto_id, "productos_cantidad", $saldo);

        $limite = $producto->productos_limite_pedido * 1;
        if ($saldo < $limite and $limite > 0) {
          $mail->envioLimite($producto_id);
        }
      }
    }

    return $error;
  }



  public function agregarproductos($id)
  {
    $mail = new Core_Model_Sendingemail($this->_view);

    $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
    $productosModel = new Page_Model_DbTable_Productos();
    $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ", "");

    $error = 0;

    foreach ($productoscarrito as $key => $productocarrito) {
      $producto_id = $productocarrito->id_productos;
      $cantidad = $productocarrito->cantidad;
      $producto = $productosModel->getById($producto_id);
      $saldo = $producto->productos_cantidad * 1 + $cantidad * 1;
      $productosModel->editField($producto_id, "productos_cantidad", $saldo);
    }

    return $error;
  }

  public function agregarproductos2Action()
  {
    $id = $this->_getSanitizedParam("id");
    $mail = new Core_Model_Sendingemail($this->_view);

    $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
    $productosModel = new Page_Model_DbTable_Productos();
    $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ", "");

    $error = 0;

    foreach ($productoscarrito as $key => $productocarrito) {
      $producto_id = $productocarrito->id_productos;
      $cantidad = $productocarrito->cantidad;
      $producto = $productosModel->getById($producto_id);
      $saldo = $producto->productos_cantidad * 1 + $cantidad * 1;
      $productosModel->editField($producto_id, "productos_cantidad", $saldo);
      echo "producto" . $producto_id . " saldo:" . $saldo . "<br>";
    }

    return $error;
  }
}
