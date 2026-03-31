<?php

/**
 *
 */

class Page_zonaprivadaController extends Page_mainController
{

	public function indexAction()
	{
		$this->_view->registro = $this->_getSanitizedParam('registro');
		$this->_view->cedula = $this->_getSanitizedParam('cedula');
		$this->_view->error = $this->_getSanitizedParam('error');

		$this->getLayout()->setData("ocultarcarrito", 1);
		$header = $this->_view->getRoutPHP('modules/page/Views/partials/headerzona.php');
		$this->getLayout()->setData("header", $header);
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footerzona.php');
		$this->getLayout()->setData("footer", $footer);

	}



	public function loginAction()
	{

		$this->setLayout('blanco');

		$user = $this->_getSanitizedParam("cedula");
		$password = $this->_getSanitizedParam("clave");
		$password = str_pad($password, 8, "0", STR_PAD_LEFT);

		$socioModel = new Administracion_Model_DbTable_Socios();
		$socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' ", "");
		if (count($socio) > 0) {
			Session::getInstance()->set("kt_cedula", $user);
			header("Location:/page/zonaprivada/interna/");
		} else {
			$error = 1;
			$socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' ")[0];
			if ($socio->socio_estado == "0") {
				$error = 2;
			}
			header("Location:/page/zonaprivada/?cedula=" . $user . "&error=" . $error);
		}
		exit;


	}


	public function internaAction()
	{

		$this->getLayout()->setData("ocultarcarrito", 1);
		$header = $this->_view->getRoutPHP('modules/page/Views/partials/headerzona.php');
		$this->getLayout()->setData("header", $header);
		$footer = $this->_view->getRoutPHP('modules/page/Views/partials/footerzona.php');
		$this->getLayout()->setData("footer", $footer);

	}


	public function logoutAction()
	{
		$this->setLayout('blanco');
		//LOG
		$data['log_tipo'] = "LOGOUT";
		$logModel = new Administracion_Model_DbTable_Log();
		$logModel->insert($data);

		Session::getInstance()->set("kt_login_id", "");
		Session::getInstance()->set("kt_login_level", "");
		Session::getInstance()->set("kt_login_user", "");
		Session::getInstance()->set("kt_login_name", "");
		header('Location: /page/zonaprivada');
		exit;
	}

}