<?php

/**
 *
 */

class Page_compraController extends Page_mainController
{

  public function indexAction()
  {
    // error_reporting(E_ALL);
    $this->_view->error = $this->_getSanitizedParam('error');

    $ciudadesModel = new Page_Model_DbTable_Ciudad();
    $this->_view->ciudades = $ciudadesModel->getList("", "nombre ASC");
    $productoModel = new Page_Model_DbTable_Productos();
    $carrito = $this->getCarrito();
    $acompanamientos = $this->getAcompanamientos();
    $terminos = $this->getTerminos();
    // print_r($terminos);

    if ($this->_getSanitizedParam('prueba') == "1") {
      //print_r($acompanamientos);
      // print_r($terminos);

    }
    $data = [];
    foreach ($carrito as $id => $cantidad) {
      $data[$id] = [];
      $data[$id]['detalle'] = $productoModel->getById($id);
      $data[$id]['cantidad'] = (int) $cantidad;
      for ($i = 1; $i <= $cantidad; $i++) {
        $data[$id]['acomp1_' . $i] = $acompanamientos[$id]['acomp1_' . $i];
        $data[$id]['acomp2_' . $i] = $acompanamientos[$id]['acomp2_' . $i];
        $data[$id]['acomp3_' . $i] = $acompanamientos[$id]['acomp3_' . $i];

        $data[$id]['termino_' . $i] = $terminos[$id]['termino_' . $i];
      }
    }

    $this->_view->carrito = $data;
    $this->getLayout()->setData("ocultarcarrito", 1);

    $enviosModel = new Page_Model_DbTable_Envio();
    $this->_view->envios = $enviosModel->getList("", "");

    $portafoliosModel = new Page_Model_DbTable_Contenido();
    $this->_view->terminos = $portafoliosModel->getList(" contenido_seccion='10'", "")[0];

    //log carrito
    $carrito_data = $data;
    $data = array();
    $logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
    $data['log_cedula'] = $_SESSION['kt_cedula'];
    $data['log_detalle'] = "Comprar carrito";
    $data['log_log'] = print_r($carrito_data, true);
    $data['log_fecha'] = date("Y-m-d H:i:s");
    $logcarritoModel->insert($data);


    $kt_cedula = $_SESSION['kt_cedula'];
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $ultimo = $formularioModel->getList(" pedido_forma_envio='1' AND pedido_documento='$kt_cedula' ", " pedido_id DESC ")[0];
    $this->_view->ultimo = $ultimo;

    $configpropinasModel = new Administracion_Model_DbTable_Configpropinas();
    $config_propinas = $configpropinasModel->getById(1);
    $this->_view->config_propinas = $config_propinas;

    //print_r($config_propinas);

    $opcionespropinasModel = new Administracion_Model_DbTable_Propinasopciones();
    $opciones_propinas = $opcionespropinasModel->getList("", " orden ASC ");
    $this->_view->opciones_propinas = $opciones_propinas;

    //traer direcciones
    $direccionesModel = new Administracion_Model_DbTable_Direcciones();
    $this->_view->direcciones = $direccionesModel->getList(" direccion_usuario='$kt_cedula' ", " direccion_id DESC ");
  }

  public function getCarrito()
  {
    if (Session::getInstance()->get("carrito")) {
      return Session::getInstance()->get("carrito");
    } else {
      return [];
    }
  }

  public function getAcompanamientos()
  {
    if (Session::getInstance()->get("acompanamientos")) {
      return Session::getInstance()->get("acompanamientos");
    } else {
      return [];
    }
  }

  public function getTerminos()
  {
    if (Session::getInstance()->get("terminos")) {
      return Session::getInstance()->get("terminos");
    } else {
      return [];
    }
  }

  public function additemAction()
  {
    $this->setLayout("blanco");
    $id = $this->_getSanitizedParam("producto");
    $cantidad = $this->_getSanitizedParam("cantidad");
    $carrito = $this->getCarrito();
    if ($carrito[$id]) {
      //echo "entro";
      $carrito[$id] = $carrito[$id] + $cantidad;
    } else {
      $carrito[$id] = $cantidad;
    }
    Session::getInstance()->set("carrito", $carrito);

    //log carrito
    $array['id'] = $id;
    $array['cantidad'] = $cantidad;
    $array['carrito'] = $carrito;
    $logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
    $data['log_cedula'] = $_SESSION['kt_cedula'];
    $data['log_detalle'] = "Agregar al carrito";
    $data['log_log'] = print_r($array, true);
    $data['log_fecha'] = date("Y-m-d H:i:s");
    $logcarritoModel->insert($data);
  }

  public function deleteitemAction()
  {
    $this->setLayout("blanco");
    $id = $this->_getSanitizedParam("producto");
    $carrito = $this->getCarrito();
    if ($carrito[$id]) {
      unset($carrito[$id]);
    }
    Session::getInstance()->set("carrito", $carrito);

    //log carrito
    $array['id'] = $id;
    $array['carrito'] = $carrito;
    $logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
    $data['log_cedula'] = $_SESSION['kt_cedula'];
    $data['log_detalle'] = "Borrar del carrito";
    $data['log_log'] = print_r($array, true);
    $data['log_fecha'] = date("Y-m-d H:i:s");
    $logcarritoModel->insert($data);
  }

  public function changecantidadAction()
  {
    $this->setLayout("blanco");
    $id = $this->_getSanitizedParam("producto");
    $cantidad = $this->_getSanitizedParam("cantidad");
    $carrito = $this->getCarrito();
    if ($carrito[$id]) {
      $carrito[$id] = $cantidad;
    }
    Session::getInstance()->set("carrito", $carrito);

    //log carrito
    $array['id'] = $id;
    $array['cantidad'] = $cantidad;
    $array['carrito'] = $carrito;
    $logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
    $data['log_cedula'] = $_SESSION['kt_cedula'];
    $data['log_detalle'] = "Cambiar cantidad carrito";
    $data['log_log'] = print_r($array, true);
    $data['log_fecha'] = date("Y-m-d H:i:s");
    $logcarritoModel->insert($data);
  }

  private function getData($total)
  {
    $data = array();
    $data['pedido_tipodocumento'] = $this->_getSanitizedParam("pedido_tipodocumento");
    $data['pedido_documento'] = $this->_getSanitizedParam("pedido_documento");
    $data['pedido_nombre'] = $this->_getSanitizedParam("pedido_nombre");
    $data['pedido_apellido'] = $this->_getSanitizedParam("pedido_apellido");
    $data['pedido_correo'] = $this->_getSanitizedParam("pedido_correo");
    if ($this->_getSanitizedParam("pedido_telefono") == '') {
      $data['pedido_telefono'] = '0';
    } else {
      $data['pedido_telefono'] = $this->_getSanitizedParam("pedido_telefono");
    }
    $data['pedido_celular'] = $this->_getSanitizedParam("pedido_celular");
    $data['pedido_nomenclatura'] = $this->_getSanitizedParam("pedido_nomenclatura");
    $data['pedido_direccion'] = $this->_getSanitizedParam("pedido_direccion");
    $data['pedido_ciudad'] = $this->_getSanitizedParam("pedido_ciudad");
    $data['pedido_envio'] = $this->_getSanitizedParam("pedido_envio");
    $data['pedido_estado'] = $this->_getSanitizedParam("pedido_estado");
    $data['pedido_fecha'] = date("Y-m-d H:i:s");
    $data['pedido_valorpagar'] = $this->_getSanitizedParam("pedido_valorpagar1");

    $data['pedido_forma_envio'] = $this->_getSanitizedParam("pedido_forma_envio");
    $data['pedido_medio'] = $this->_getSanitizedParam("pedido_medio");

    $data['pedido_numero1'] = $this->_getSanitizedParam("numero1");
    $data['pedido_numero2'] = $this->_getSanitizedParam("numero2");
    $data['pedido_numero3'] = $this->_getSanitizedParam("numero3");
    $data['pedido_letra1'] = $this->_getSanitizedParam("letra1");
    $data['pedido_letra2'] = $this->_getSanitizedParam("letra2");
    $data['pedido_complemento'] = $this->_getSanitizedParam("complemento");
    $data['pedido_indicaciones'] = $this->_getSanitizedParam("indicaciones");
    $data['pedido_zona'] = $this->_getSanitizedParam("pedido_zona");
    $data['guardardireccion'] = $this->_getSanitizedParam("guardardireccion");


    $data['pedido_direccion'] = $data['pedido_nomenclatura'] . " " . $data['pedido_numero1'] . $data['pedido_letra1'] . " " . $data['pedido_numero2'] . $data['pedido_letra2'] . "-" . $data['pedido_numero3'] . " " . $data['pedido_complemento'];

    $data['pedido_propina'] = (int) $this->_getSanitizedParam("pedido_propina");

    $data['pedido_nombrefe'] = $this->_getSanitizedParam("pedido_nombrefe");
    $data['pedido_correofe'] = $this->_getSanitizedParam("pedido_correofe");
    $data['pedido_celularfe'] = $this->_getSanitizedParam("pedido_celularfe");

    $data['pedido_cuotas'] = $this->_getSanitizedParam("pedido_cuotas");



    return $data;
  }
  private function getDatadireccion()
  {
    $data = array();
    $data['direccion_usuario'] = $_SESSION['kt_cedula'];
    $data['direccion_nomenclatura'] = $this->_getSanitizedParam("pedido_nomenclatura");
    $data['direccion_numero1'] = $this->_getSanitizedParam("numero1");
    $data['direccion_letra1'] = $this->_getSanitizedParam("letra1");
    $data['direccion_numero2'] = $this->_getSanitizedParam("numero2");
    $data['direccion_letra2'] = $this->_getSanitizedParam("letra2");
    $data['direccion_numero3'] = $this->_getSanitizedParam("numero3");
    $data['direccion_complemento'] = $this->_getSanitizedParam("complemento");
    $data['direccion_indicaciones'] = $this->_getSanitizedParam("indicaciones");
    return $data;
  }
  public function enviarAction()
  {

    // error_reporting(E_ALL);

    $this->setLayout('blanco');
    $csrf = $this->_getSanitizedParam("csrf");
    $direccionesModel = new Administracion_Model_DbTable_Direcciones();
    if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
      $productos = $this->getProductos();
      $data = $this->getData($productos['total']);
      if ($data['guardardireccion'] == 'on') {
        $dataDirecciones = $this->getDatadireccion();
        //consultar si direccion existe
        $direccionExiste = $direccionesModel->getList("direccion_usuario='" . $dataDirecciones['direccion_usuario'] . "' AND direccion_nomenclatura='" . $dataDirecciones['direccion_nomenclatura'] . "' AND direccion_numero1='" . $dataDirecciones['direccion_numero1'] . "' AND direccion_letra1='" . $dataDirecciones['direccion_letra1'] . "' AND direccion_numero2='" . $dataDirecciones['direccion_numero2'] . "' AND direccion_letra2='" . $dataDirecciones['direccion_letra2'] . "' AND  direccion_numero3 ='" . $dataDirecciones['direccion_numero3'] . "' AND direccion_complemento='" . $dataDirecciones['direccion_complemento'] . "' AND direccion_indicaciones='" . $dataDirecciones['direccion_indicaciones'] . "' ", "")[0];

        if (!$direccionExiste) {
          $direccionesModel->insert($dataDirecciones);
        }
      }


      $formularioModel = new Page_Model_DbTable_Pedidos();
      if ($_SESSION['carrito_actual'] == "") {
        if ($this->verificarrepetido($data) == 0) {
          //print_r($data);
          $id = $formularioModel->insert($data);
          $_SESSION['carrito_actual'] = $id;
        } else {
          $id = $_SESSION['carrito_actual'];
        }
      } else {
        $id = $_SESSION['carrito_actual'];
      }

      $formularioModel->editField($id, "pedido_numero1", $data['pedido_numero1']);
      $formularioModel->editField($id, "pedido_numero2", $data['pedido_numero2']);
      $formularioModel->editField($id, "pedido_numero3", $data['pedido_numero3']);
      $formularioModel->editField($id, "pedido_letra1", $data['pedido_letra1']);
      $formularioModel->editField($id, "pedido_letra2", $data['pedido_letra2']);
      $formularioModel->editField($id, "pedido_complemento", $data['pedido_complemento']);
      $formularioModel->editField($id, "pedido_indicaciones", $data['pedido_indicaciones']);
      $formularioModel->editField($id, "pedido_medio", $data['pedido_medio']);
      $formularioModel->editField($id, "pedido_forma_envio", $data['pedido_forma_envio']);
      $formularioModel->editField($id, "pedido_zona", $data['pedido_zona']);

      $formularioModel->editField($id, "pedido_quien_accion", $_SESSION['quien_accion']);
      $formularioModel->editField($id, "pedido_propina", $data['pedido_propina']);
      $formularioModel->editField($id, "pedido_numeroaccion", $_SESSION['kt_accion']);
      $formularioModel->editField($id, "pedido_apellido", $data['pedido_apellido']);

      $formularioModel->editField($id, "ip", $_SERVER['REMOTE_ADDR']);

      if ($productos['total'] > 0) {
        $pedido1 = $formularioModel->getById($id);
        $total = ((int) $productos['total']) + ((int) $pedido1->pedido_envio) + ((int) $pedido1->pedido_propina);
        $formularioModel->editField($id, "pedido_valorpagar", $total);
      }

      $formulario2Model = new Administracion_Model_DbTable_Carrito();
      $idc = $formulario2Model->insert($data);


      if ($data['pedido_documento'] == "" or $data['pedido_nombre'] == "") {
        $error = 1;
        header("Location:/page/login/");
      }

      if ($error == 0) {

        $formularioproductoModel = new Administracion_Model_DbTable_Productoscarrito();
        $formularioproductoModel->vaciar($id);

        foreach ($productos as $key => $value) {
          $this->agregarProducto($value, $id);
        }
        $error = $this->verificarsaldos($id);
        error_log("errortest: " . $error);
        if ($error == 0) {
          if ($data['pedido_medio'] == "2") {
            $error = $this->descontarproductos($id);
            if ($error == 0) {
              $_SESSION['carrito'] = array();
              $_SESSION['carrito_actual'] = "";
              header("Location: /page/compra/generarpago/?id=" . $id);
            } else {
              $mail = new Core_Model_Sendingemail($this->_view);
              $mail->enviarError($id);
              header("Location: /page/compra/?error=1");
            }
          } else {
            $formularioModel->editField($id, "pedido_estado", "1");
            $formularioModel->editField($id, "pedido_estado_texto", "Aprobado");
            $formularioModel->editField($id, "pedido_estado_texto2", "El pago se encuentra aprobado");
            $_SESSION['carrito'] = array();
            $_SESSION['carrito_actual'] = "";
            header("Location: /page/compra/enviopedido/?id=" . $id);
          }
        } else {
          header("Location: /page/compra/?error=1");
        }
      } else {
        header("Location: /page/compra/?error=1");
      }
    }
  }

  public function verificarrepetido($data)
  {
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $documento = $data['pedido_documento'];
    $valor = $data['pedido_valorpagar'];
    $existe = $formularioModel->getList(" pedido_documento='$documento' AND pedido_valorpagar='$valor' ", " pedido_fecha DESC ");

    $hoy = date("Y-m-d H:i:s");
    $hoy10 = date("Y-m-d H:i:s", strtotime($hoy . " -10 seconds"));
    $id = $existe[0]->pedido_id;

    if (count($existe) > 0) {
      if ($existe[0]->pedido_fecha >= $hoy10) {
        $_SESSION['carrito_actual'] = $id;
        return 1;
      } else {
        return 0;
      }
    } else {
      return 0;
    }
  }

  public function enviopedidoAction()
  {
    $id = $this->_getSanitizedParam("id");
    $error = $this->descontarproductos($id);
    $mail = new Core_Model_Sendingemail($this->_view);
    $hoy = date("Y-m-d");
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $pedido = $formularioModel->getById($id);

    if ($error == 0) {
      //echo "entro1";
      if (strpos($pedido->pedido_fecha, $hoy) !== false) {
        //echo "entro2";
        $mail->enviarCompra($id);
      }
    } else {
      //echo "entro3";
      $formularioModel = new Page_Model_DbTable_Pedidos();
      $formularioModel->editField($id, "pedido_estado", "4");
      $formularioModel->editField($id, "pedido_estado_texto", "Fallido");
      $formularioModel->editField($id, "pedido_estado_texto2", "Inventario insuficiente");
      if (strpos($pedido->pedido_fecha, $hoy) !== false) {
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
      $saldo = (int) $producto->productos_cantidad - (int) $cantidad;
      if ($saldo < 0) {
        $error = 1;
      }
    }

    if ($error == 0) {
      foreach ($productoscarrito as $key => $productocarrito) {
        $producto_id = $productocarrito->id_productos;
        $cantidad = $productocarrito->cantidad;
        $producto = $productosModel->getById($producto_id);
        $saldo = (int) $producto->productos_cantidad - (int) $cantidad;
        $productosModel->editField($producto_id, "productos_cantidad", $saldo);

        $limite = (int) $producto->productos_limite_pedido;
        if ($saldo < $limite and $limite > 0) {
          $mail->envioLimite($producto_id);
        }
      }
    }

    return $error;
  }

  public function verificarsaldos($id)
  {

    $productoscarritoModel = new Page_Model_DbTable_Productoscarrito();
    $productosModel = new Page_Model_DbTable_Productos();
    $productoscarrito = $productoscarritoModel->getList(" id_carrito='$id' ", "");

    $error = 0;

    foreach ($productoscarrito as $key => $productocarrito) {
      $producto_id = $productocarrito->id_productos;
      $cantidad = $productocarrito->cantidad;
      $producto = $productosModel->getById($producto_id);
      $saldo = (int) $producto->productos_cantidad - (int) $cantidad;
      //generar error log a todo para debuguear
      error_log("Verificando saldo: Producto ID: $producto_id, Cantidad: $cantidad, Saldo: $saldo");
      if ($saldo < 0) {
        $error = 1;
      }
    }

    return $error;
  }

  private function getProductos()
  {
    $productoModel = new Administracion_Model_DbTable_Productos();
    $carrito = $this->getCarrito();
    $acompanamientos = $this->getAcompanamientos();
    $terminos = $this->getTerminos();

    $total = 0;
    $data = [];
    foreach ($carrito as $id => $cantidad) {
      $data[$id] = [];
      $data[$id]['detalle'] = $productoModel->getById($id);
      $data[$id]['cantidad'] = $cantidad;
      for ($i = 1; $i <= $cantidad; $i++) {
        $data[$id]['acomp1_' . $i] = $acompanamientos[$id]['acomp1_' . $i];
        $data[$id]['acomp2_' . $i] = $acompanamientos[$id]['acomp2_' . $i];
        $data[$id]['acomp3_' . $i] = $acompanamientos[$id]['acomp3_' . $i];
        $data[$id]['termino_' . $i] = $terminos[$id]['termino_' . $i];
      }
      // $data[$id]['termino'] = $terminos[$id]['termino'];
      $total = $total + ((int) $cantidad * (int) $data[$id]['detalle']->productos_precio);
    }
    $data['total'] = $total;
    return $data;
  }

  private function agregarProducto($producto, $id)
  {
    $data = [];
    $data['id_carrito'] = $id;
    $data['id_productos'] = $producto['detalle']->productos_id;
    $data['nombre'] = $producto['detalle']->productos_nombre;
    $data['nombre'] = str_replace("'", "\'", $data['nombre']);
    $data['cantidad'] = $producto['cantidad'];
    $data['imagen'] = $producto['detalle']->productos_imagen;
    $data['valor'] = $producto['detalle']->productos_precio;
    $data['valor_iva'] = $producto['detalle']->productos_precio;
    $formularioproductoModel = new Administracion_Model_DbTable_Productoscarrito();
    $id = $formularioproductoModel->insert($data);
    $carrito = $producto;
    $acompanamientos = "";
    $termino = '';
    for ($i = 1; $i <= $carrito['cantidad']; $i++) {
      if ($carrito['acomp1_' . $i] != "") {
        $acompanamientos .= "Acompañamientos item" . $i . "\n";
        $acompanamientos .= "- " . $carrito['acomp1_' . $i] . "\n";
        if ($carrito['acomp2_' . $i] != "") {
          $acompanamientos .= "- " . $carrito['acomp2_' . $i] . "\n";
        }
        if ($carrito['acomp3_' . $i] != "") {
          $acompanamientos .= "- " . $carrito['acomp3_' . $i] . "\n";
        }
      }
      if ($carrito['termino_' . $i] != "") {
        $termino .= "Término item" . $i . ": " . $carrito['termino_' . $i] . "\n";
      }
    }


    $formularioproductoModel->editField($id, "acompanamientos", $acompanamientos);
    $formularioproductoModel->editField($id, "termino", $termino);
  }

  public function generarpagoAction()
  {
    $formularioModel = new Page_Model_DbTable_Pedidos();
    $id = $this->_getSanitizedParam("id");
    $pedido = $formularioModel->getById($id);
    $this->_view->id = $id;
    $this->_view->pedido = $pedido;

    $placetopay = Payment_Placetopay::getInstance()->getPlacetopay();
    $placetopayData = Payment_Placetopay::getInstance()->getData();
    $reference = $id;
    $request = [
      "locale" => "es_CO",
      "buyer" => [
        "name" => $pedido->pedido_nombre,
        "surname" => $pedido->pedido_apellido,
        "email" => $pedido->pedido_correo,
        'document' => $pedido->pedido_documento,
        'mobile' => $pedido->pedido_telefono,
      ],
      'payment' => [
        'reference' => $reference,
        'description' => 'Pago Nogal Delivery Ref: ' . $id,
        'amount' => [
          'currency' => 'COP',
          'total' => $pedido->pedido_valorpagar,
        ],
      ],
      'expiration' => date('c', strtotime('+2 hour')),
      'returnUrl' => $placetopayData['returnUrl'] . '?reference=' . $reference,
      'ipAddress' => '127.0.0.1',
      'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
    ];
    //var_dump($request);
    $response = $placetopay->request($request);
    //var_dump($response);
    if ($response->isSuccessful()) {
      $request_id = $response->requestId();
      $formularioModel->editField($id, "request_id", $request_id);
      header('Location: ' . $response->processUrl());
    } else {
      // There was some error so check the message and log it
      $response->status()->message();
    }
  }

  public function calcularenvioAction()
  {

    header('Content-Type:application/json');
    $this->setLayout('blanco');

    $nomenclatura = $this->_getSanitizedParam("nomenclatura");
    $numero1 = $this->_getSanitizedParam("numero1");
    $numero2 = $this->_getSanitizedParam("numero2");
    $complemento = $this->_getSanitizedParam("complemento");

    if ($nomenclatura == "Calle" or $nomenclatura == "Avenida Calle" or $nomenclatura == "Diagonal") {
      $calle = $numero1;
      $carrera = $numero2;
    } else {
      $calle = $numero2;
      $carrera = $numero1;
    }

    $zonaModel = new Administracion_Model_DbTable_Zonas();
    $existe = $zonaModel->getList(" (('$calle' >= zona_calle_min AND '$calle' <= zona_calle_max) OR ('$calle' >= zona_calle_min2 AND '$calle' <= zona_calle_max2)) AND '$carrera' >= zona_cra_min AND '$carrera' <= zona_cra_max ", "");
    // $maximo = $zonaModel->getList("", " valor DESC ");

    $valor = $existe[0]->zona_valor;

    $error = 0;
    if (count($existe) == 0) {
      $error = 1;
    }

    if (strtolower($complemento) == "sur") {
      $error = 1;
    }

    $respuesta['valor'] = $valor;
    $respuesta['error'] = $error;
    $respuesta['zona_nombre'] = $existe[0]->zona_nombre;
    //$respuesta['consulta'] = "(('$calle' >= zona_calle_min AND '$calle' <= zona_calle_max) OR ('$calle' >= zona_calle_min2 AND '$calle' <= zona_calle_max2)) AND '$carrera' >= zona_cra_min AND '$carrera' <= zona_cra_max";
    echo json_encode($respuesta);
  }
  public function eliminardireccionAction()
  {


    header('Content-Type:application/json');
    $this->setLayout('blanco');
    $producto = $this->_getSanitizedParam("id");

    $kt_cedula = $_SESSION['kt_cedula'];




    $direccionesModal = new Administracion_Model_DbTable_Direcciones();
    $direccionesModal->deleteRegister($producto);

    echo json_encode($producto);
  }
}
