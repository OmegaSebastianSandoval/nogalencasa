<?php

/**
 *
 */

class Page_mainController extends Controllers_Abstract
{

	public $template;

	public function init()
	{
		/* Session::getInstance()->set('ncar','');

			
				Session::getInstance()->set("socio", ''); */
		$this->setLayout('page_page');
		$this->_view->botonactivo = $this->botonactivo;

		$this->template = new Page_Model_Template_Template($this->_view);
		$infopageModel = new Page_Model_DbTable_Informacion();
		$this->_view->infopage = $infopageModel->getById(1);

		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categoriaActiva = $this->_getSanitizedParam('categoria');
		$this->_view->subcategoriaActiva = $this->_getSanitizedParam('subcategoria');
		$this->_view->pageParam = $this->_getSanitizedParam('page');
		$this->_view->simular_hora = $this->_getSanitizedParam('simular_hora');
		$this->_view->cerrado = $this->_getSanitizedParam('cerrado');
		$this->_view->abierto = $this->_getSanitizedParam('abierto');

		$hoy = date("H:i:s");
		//$hoy = "16:00:00";
		$f1 = "";
		$f2 = "";
		$dia_semana = date("w");
		$fecha = date("Y-m-d");

		$festivos = new festivos();
		$es_festivo = 0;
		if ($festivos->esFestivo(date("d"), date("m")) === true) {
			$es_festivo = 1;
		}
		$hora = date("H:i:s");

		$horarioModel = new Administracion_Model_DbTable_Horarios();
		$this->_view->horarios = $horarios = $horarioModel->getList("", "");
		$this->_view->horario_festivo = $horario_festivo = $horarioModel->getList(" horario_dia='99' ", "")[0];

		$horarioexpressModel = new Administracion_Model_DbTable_Horariosexpress();
		$this->_view->horarios2 = $horarioexpressModel->getList("", "");
		$this->_view->horario_festivo2 = $horarioexpressModel->getList(" horario_dia='99' ", "")[0];


		// echo "es festivo: ".$es_festivo." - dia semana: ".$dia_semana." - hora: ".$hora;
		//horario delivery
		$online = 0;
		if ($es_festivo == 1 and $hora > $horario_festivo->horario_hora1 and $hora <= $horario_festivo->horario_hora2) {
			$online = 1;
		}
		foreach ($horarios as $key => $value) {
			if ($value->horario_fecha == "") {
				if ($dia_semana == $value->horario_dia and $es_festivo == 0 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {

					$online = 1;
				}
				if ($dia_semana == $value->horario_dia and $es_festivo == 1 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
					$online = 1;
				}
			} else {
				if ($fecha == $value->horario_fecha) {
					$online = 0;
				}
				if ($fecha == $value->horario_fecha and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
					$online = 1;
				}
			}
		}


		if ($this->_getSanitizedParam('online') == 1) {
			$online = 1;
			//$_SESSION['online'] = 1;
		}
		if ($_SESSION['online'] == 1) {
			//	$online = 1;
		}
		if ($online == 1) {
			$f1 = "";
			$f2 = "";
		} else {
			$f1 = " AND 1=0 ";
			$f2 = " AND 1=0 ";
		}

		$this->_view->online = $online;
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$this->_view->contenidoFooter1 = $contenidoModel->getById(20);
		$this->_view->contenidoFooter2 = $contenidoModel->getById(21);



		$this->_view->footer = $contenidoModel->getList(" contenido_seccion='16' AND contenido_tipo='5' ", "");

		$this->_view->comprar = $this->template->getContentseccion(2);

		$this->_view->seguridadSanitaria = $this->template->getContentseccion(12);


		$this->_view->terminosCondiciones = $this->template->getContentseccion(10);
		$this->_view->tratamientoDatos = $this->template->getContentseccion(11);

		$this->_view->comoComprar = $contenidoModel->getList(" contenido_padre = '28' AND contenido_seccion = '2'", "");
		$this->_view->preguntasFrecuentes = $this->template->getContentseccion(20);


		$this->_view->categorias = $categoriasModel->getList("", "orden ASC");
		$this->getLayout()->setData("metadescription", $this->_view->infopage->info_pagina_descripcion);
		$this->getLayout()->setData("metakeywords", $this->_view->infopage->info_pagina_tags);
		$this->getLayout()->setData("info_pagina_scripts", $this->_view->infopage->info_pagina_scripts);

		$header = $this->_view->getRoutPHP('modules/page/Views/partials/header.php');
		$this->getLayout()->setData("header", $header);
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footer.php');
		$this->getLayout()->setData("footer", $footer);
		$this->usuario();

		/* if($_SESSION['kt_cedula']=="" and strpos($_SERVER['REQUEST_URI'],"/login")===FALSE and strpos($_SERVER['REQUEST_URI'],"/zonaprivada")===FALSE and strpos($_SERVER['REQUEST_URI'],"/page/registro")===FALSE and strpos($_SERVER['REQUEST_URI'],"/page/index/enviarbackup")===FALSE){ */
		if ($_SESSION['kt_cedula'] == "" and strpos($_SERVER['REQUEST_URI'], "/login") === FALSE and strpos($_SERVER['REQUEST_URI'], "/zonaprivada") === FALSE and strpos($_SERVER['REQUEST_URI'], "/page/registro") === FALSE and strpos($_SERVER['REQUEST_URI'], "/page/index/enviarbackup") === FALSE) {
			header("Location:/page/login/");
		} else {
			$kt_cedula = Session::getInstance()->get('ncar');
			$socio = Session::getInstance()->get('socio');

			$this->_view->socio = $socio;
		}

		if ($online == 0 and strpos($_SERVER['REQUEST_URI'], "/login") === FALSE and strpos($_SERVER['REQUEST_URI'], "/enviarbackup") === FALSE) {

			header("Location:/page/login/logout");
		}
	}


	public function usuario()
	{
		$userModel = new Core_Model_DbTable_User();
		$user = $userModel->getById(Session::getInstance()->get("kt_login_id"));
		if ($user->user_id == 1) {
			$this->editarpage = 1;
		}
	}

	public function get_data($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	public function generarToken()
	{
		$loginServiceUrl = 'https://ev.clubelnogal.com/tokens/querys/consultar_token.php';

		// Datos a enviar al servicio externo
		$postData = http_build_query([
			'inputUsername' => 'webnogal', //tken que recibe de la base de
			'inputPassword' => 'nogal2023*'
		]);

		$ch = curl_init($loginServiceUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		$response = json_decode($response);

		if (curl_errno($ch)) {
			echo 'Error cURL: ' . curl_error($ch);
			exit;
		}

		curl_close($ch);

		// return $response;
		return $response->token;
	}
	public function consultarSocio()
	{

		// $codi = Session::getInstance()->get('codi');
		$ncar = Session::getInstance()->get('ncar');

		$loginServiceUrl = 'https://ev.clubelnogal.com/ConsultaAsociados/querys/buscarUsuario.php';

		// Datos a enviar al servicio externo
		$postData = http_build_query([
			'token' => $this->generarToken(), //tken que recibe de la base de
			// 'codi' => $codi,
			'ncar' => $ncar
		]);

		$ch = curl_init($loginServiceUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		$response = json_decode($response);

		if (curl_errno($ch)) {
			echo 'Error cURL: ' . curl_error($ch);
			exit;
		}

		curl_close($ch);

		return $response;
	}
}
