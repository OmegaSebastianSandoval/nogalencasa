<?php

/**
 *
 */

class Page_indexController extends Page_mainController
{
	protected $botonactivo;

	public function init()
	{

		$favoritos = $this->_getSanitizedParam('favoritos');
		$favoritos ? $this->botonactivo = 3 : $this->botonactivo = 1;


		parent::init();
	}

	public function indexAction()
	{

$productosModel = new Administracion_Model_DbTable_Productos();

		$productos = $productosModel->getList(" productos_imagen != '' ", "orden ASC");
		
		//print_r($productos);
		foreach ($productos as $key => $value) {

			$nombreImagen = $value->productos_imagen;
			$nombreImagenNuevo = $nombreImagen.'.jpg';
			

		//	$productosModel->editField($value->productos_id, 'productos_imagen', $nombreImagenNuevo);
		}
		/* $socio = $this->consultarSocio();
		print_r($socio); */
		$this->_view->bannerprincipal = $this->template->bannerprincipal('1');
		// error_reporting(E_ALL);


		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->contenidohome = $contenidoModel->getList("contenido_seccion = '1' AND contenido_padre != '0' ", "orden ASC");
		$catgoria = $this->_getSanitizedParam('categoria');
		$subcategoria = $this->_getSanitizedParam('subcategoria');
		$buscar = $this->_getSanitizedParam('buscar');
		$favoritos = $this->_getSanitizedParam('favoritos');
		$this->_view->filter = $filter = $this->_getSanitizedParam('filter');


		$this->botonactivo = 1;



		if ($buscar) {

			$this->_view->productos = $this->template->getProductos($buscar);
		} elseif ($catgoria != "") {
			$this->_view->productos = $this->template->getProductosNew($catgoria, $subcategoria);
		} elseif ($filter != "") {
			$this->_view->productos = $this->template->getProductosFilter($filter);
		} elseif ($favoritos == 1) {
			$this->botonactivo = 3;
		
			$this->_view->productos = $this->template->getProductosFav();
		} else {
			//TRAER PRODUCTOS NUEVOS
			$this->_view->productos = $this->template->getProductosf("", "", "",1);

		}
		/* if ($catgoria != "") {
												$this->_view->productos = $this->template->getProductosf($catgoria,$subcategoria);
											}elseif ($catgoria == "") {
												$this->_view->productos = $this->template->getProductos($buscar);
											} */

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' ", " orden ASC ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}
		$this->_view->categorias2 = $categorias;
		$this->_view->categorias = $categorias;

		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$popup = $publicidadModel->getList("publicidad_seccion='101' AND publicidad_estado=1", "")[0];
		// Controlar popup: mostrar solo una vez por sesión
		if ($popup->publicidad_visualizacion == 1) {
			if (isset($_SESSION['popup_shown'])) {
				$popup = null;
			} else {
				$_SESSION['popup_shown'] = true;
			}
		}
		$this->_view->popup = $popup;
	}

	public function seleccionarAction()
	{
		//error_reporting(E_ALL);

		//print_r($_SESSION);


		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");

		$this->_view->texto_delivery = $contenidoModel->getList("contenido_seccion = '14' AND contenido_estado='1' ", "orden ASC")[0];
		$this->_view->texto_express = $contenidoModel->getList("contenido_seccion = '15' AND contenido_estado='1' ", "orden ASC")[0];

		$horarioModel = new Administracion_Model_DbTable_Horarios();
		$this->_view->horarios = $horarioModel->getList("", "");
		$this->_view->horario_festivo = $horarioModel->getList(" horario_dia='99' ", "")[0];

		$horarioexpressModel = new Administracion_Model_DbTable_Horariosexpress();
		$this->_view->horarios2 = $horarioexpressModel->getList("", "");
		$this->_view->horario_festivo2 = $horarioexpressModel->getList(" horario_dia='99' ", "")[0];

		$horariocafeModel = new Administracion_Model_DbTable_Horarioscafe();
		$this->_view->horarios3 = $horariocafeModel->getList("", "");
		$this->_view->horario_festivo3 = $horariocafeModel->getList(" horario_dia='99' ", "")[0];

	}

	public function seleccionar2Action()
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->carta = $contenidoModel->getList("contenido_seccion = '13' AND contenido_estado='1' ", "orden ASC");
	}

	public function enviarbackupAction()
	{

		$this->setLayout("blanco");
		$hoy = date("Y-m-d");
		$emailModel = new Core_Model_Mail();
		$asunto = "Backup nogal en casa " . $hoy;

		$content = "Backup nogal en casa " . $hoy;

		// $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
		$emailModel->getMail()->addBCC("desarrollo8@omegawebsystems.com");
		// $emailModel->getMail()->addAddress("glozano@clubelnogal.com");

		$archivo = "nogalencasa_db.sql.zip";
		$emailModel->getMail()->AddAttachment($_SERVER['DOCUMENT_ROOT'] . "/" . $archivo, "" . $archivo);

		$emailModel->getMail()->Subject = $asunto;
		$emailModel->getMail()->msgHTML($content);
		$emailModel->getMail()->AltBody = $content;
		$emailModel->getMail()->SMTPDebug = 0;
		$emailModel->sed();
		//echo $emailModel->getMail()->ErrorInfo;
		
		//header("HTTP/1.1 200 OK");
	}

	public function redondearNumero($numero)
	{
		$parteDecimal = $numero - floor($numero);

		if ($parteDecimal >= 0.3 && $parteDecimal <= 0.7) {
			return floor($numero) + 0.5;
		} elseif ($parteDecimal > 0.7) {
			return ceil($numero);
		} else {
			return floor($numero);
		}
	}

	public function calificarAction()
	{
		// error_reporting(E_ALL);
		ini_set("display_errors", 0);
		header('Content-Type:application/json');
		$this->setLayout('blanco');
		$calificacion = $this->_getSanitizedParam("calificacion");
		$producto = $this->_getSanitizedParam("producto");
		$kt_cedula = $_SESSION['kt_cedula'];

		$data = [];
		$data["calificacion_producto_producto"] = $producto;
		$data["calificacion_producto_usuario"] = $kt_cedula;
		$data["calificacion_producto_calificacion"] = $calificacion;


		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$getcalificacion = $calificacionModel->getList(" calificacion_producto_producto='$producto' AND calificacion_producto_usuario='$kt_cedula' ", "");

		$existe = 0;

		if (count($getcalificacion) > 0) {
			$existe = 1;
		}
		if ($existe == 0) {
			$id = $calificacionModel->insert($data);
		}
		if ($existe == 1) {

			$calificacionModel->editField($getcalificacion[0]->calificacion_producto_id, "calificacion_producto_calificacion", $calificacion);
		}


		$respuesta['id'] = $id;
		$respuesta['existe'] = $existe;
		$respuesta['producto'] = $producto;

		$respuesta['calificacion'] = $calificacion;


		echo json_encode($respuesta);
	}

	public function favAction()
	{


		header('Content-Type:application/json');
		$this->setLayout('blanco');
		$producto = $this->_getSanitizedParam("producto");

		$kt_cedula = $_SESSION['kt_cedula'];

		$data = [];
		$data["productos_favoritos_producto"] = $producto;
		$data["productos_favoritos_usuario"] = $kt_cedula;



		$favoritoModel = new Administracion_Model_DbTable_Productosfavoritos();
		$favorito = $favoritoModel->getList(" productos_favoritos_producto='$producto' AND productos_favoritos_usuario='$kt_cedula' ", "");

		$existe = 0;

		if (count($favorito) > 0) {
			$existe = 1;
		}
		if ($existe == 0) {
			$id = $favoritoModel->insert($data);
		}
		if ($existe == 1) {
			$favoritoModel->deleteRegister($favorito[0]->productos_favoritos_id);
		}


		// $respuesta['id'] = $id; 
		$respuesta['existe'] = $existe;
		// $respuesta['producto'] = $favorito;



		echo json_encode($respuesta);
	}

	public function traerfotosAction()
	{


		header('Content-Type:application/json');
		$this->setLayout('blanco');
		$producto = $this->_getSanitizedParam("producto");





		$fotoproductosModel = new Administracion_Model_DbTable_Fotosproducto();
		$fotosproducto = $fotoproductosModel->getList(" fotos_productos_producto='$producto'", "");


		echo json_encode($fotosproducto);
	}
	 public function pruebaenvioAction()
  {
    $this->setLayout('blanco');
    $emailModel = new Core_Model_Mail();
    $asunto = "PRUEBA DE ENVIO -  - NOGAL";
    $tabla = "<table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Relación</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Juan Pérez</td>
          <td>30</td>
          <td>Amigo</td>
        </tr>
        <tr>
          <td>María López</td>
          <td>25</td>
          <td>Hermana</td>
        </tr>
      </tbody>
    </table>";

    $content = $tabla;

    $bccs = [
      "desarrollo8@omegawebsystems.com",
    ];

    $emailModel->getMail()->Subject = $asunto;
    $emailModel->getMail()->msgHTML($content);
    $emailModel->getMail()->AltBody = $content;
    $emailModel->getMail()->SMTPDebug = 1;

    foreach ($bccs as $bcc) {
      $emailModel->getMail()->addBCC($bcc);
    }
    //$emailModel->getMail()->addAddress($email);

    // Intentar enviar
    $enviado = $emailModel->sed();
    if (!$enviado) {
      // Si falla, reintentar con Gmail
      $mail = $emailModel->getMail();
      // Reconfigurar
      $mail->isSMTP();
      $mail->SMTPDebug = 2;
      $mail->SMTPSecure = "tls";
      $mail->Host = "smtp.gmail.com'";
      $mail->Port = 587;
      $mail->SMTPAuth = true;
      $mail->Username = "deliveryclubelnogal@gmail.com";
      $mail->Password = "igijajtcfiayccjs";
      $mail->setFrom("deliveryclubelnogal@gmail.com", "Nogal en casa");
      // Limpiar destinatarios y volver a agregarlos
      $mail->clearAddresses();
      $mail->clearBCCs();
      foreach ($bccs as $bcc) {
        $mail->addBCC($bcc);
      }
      //$mail->addAddress($email);
      $mail->Subject = $asunto;
      $mail->msgHTML($content);
      $mail->AltBody = $content;
      $enviado = $mail->send();
    }
    echo $emailModel->getMail()->ErrorInfo;
  }

}