<?php

/**
 *
 */

class Page_carritoController extends Page_mainController
{

	public function indexAction()
	{
		// error_reporting(E_ALL);


		$this->setLayout("blanco");
		$productoModel = new Administracion_Model_DbTable_Productos();
		$carrito = $this->getCarrito();
		$acompanamientos = $this->getAcompanamientos();
		$terminos = $this->getTerminos();

		$data = [];
		foreach ($carrito as $id => $cantidad) {
			$data[$id] = [];
			$data[$id]['detalle'] = $productoModel->getById($id);
			$data[$id]['cantidad'] = (int) $cantidad;
			for ($i = 1; $i <= $cantidad; $i++) {
				$data[$id]['acomp1_' . $i] = $acompanamientos[$id]['acomp1_' . $i];
				$data[$id]['acomp2_' . $i] = $acompanamientos[$id]['acomp2_' . $i];
				$data[$id]['acomp3_' . $i] = $acompanamientos[$id]['acomp3_' . $i];
			}
			if ($terminos[$id]) {
				$data[$id]['termino'] = $terminos[$id]['termino'];
			}
		}
		$this->_view->carrito = $data;
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
		$acomp1 = $this->_getSanitizedParam("acomp1");
		$acomp2 = $this->_getSanitizedParam("acomp2");
		$acomp3 = $this->_getSanitizedParam("acomp3");
		$termino = $this->_getSanitizedParam("termino");
		$carrito = $this->getCarrito();
		$acompanamientos = $this->getAcompanamientos();
		$terminos = $this->getTerminos();

		if ($carrito[$id]) {
			//echo "entro";
			$carrito[$id] = $carrito[$id] + $cantidad;
		} else {
			$carrito[$id] = $cantidad;
		}
		$i = $carrito[$id];
		if ($acomp1 != "") {
			$acompanamientos[$id]['acomp1_' . $i] = $acomp1;
		}
		if ($acomp2 != "") {
			$acompanamientos[$id]['acomp2_' . $i] = $acomp2;
		}
		if ($acomp3 != "") {
			$acompanamientos[$id]['acomp3_' . $i] = $acomp3;
		}

		if ($termino != "") {
			$terminos[$id]['termino_' . $i] = $termino;
		}
		Session::getInstance()->set("carrito", $carrito);
		Session::getInstance()->set("acompanamientos", $acompanamientos);
		Session::getInstance()->set("terminos", $terminos);



		//log carrito
		$array['id'] = $id;
		$array['cantidad'] = $cantidad;
		$array['carrito'] = $carrito;
		$array['acompanamientos'] = $acompanamientos;
		$array['terminos'] = $terminos;
		$logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
		$data['log_cedula'] = $_SESSION['kt_cedula'];
		$data['log_detalle'] = "Agregar al carrito";
		$data['log_log'] = print_r($array, true);
		$data['log_fecha'] = date("Y-m-d H:i:s");
		$logcarritoModel->insert($data);




	}

	public function deleteitemAction()
	{
		error_reporting(E_ALL);

		$this->setLayout("blanco");
		$id = $this->_getSanitizedParam("producto");
		$carrito = $this->getCarrito();
		print_r($carrito);

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

}