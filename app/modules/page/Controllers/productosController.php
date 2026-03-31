<?php

/**
 *
 */

class Page_productosController extends Page_mainController
{

	public function indexAction()
	{
		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$productosModel = new Page_Model_DbTable_Productos();
		//$this->_view->informacion = $informacionModel->getList("","orden ASC")[0];

		$categoria = $this->_getSanitizedParam("categoria");

		if ($categoria) {
			$filters = "productos_categorias = $categoria";
			$order = "orden ASC";
			$list = $productosModel->getList($filters, $order);
			$amount = 12;
			$page = $this->_getSanitizedParam("page");
			if (!$page) {
				$start = 0;
				$page = 1;
			} else {
				$start = ($page - 1) * $amount;
			}
			$this->_view->totalpages = ceil(count($list) / $amount);
			$this->_view->page = $page;
			$this->_view->productos = $productosModel->getListPages($filters, $order, $start, $amount);
		} else {
			$filters = "";
			$order = "orden ASC";
			$list = $productosModel->getList($filters, $order);
			$amount = 12;
			$page = $this->_getSanitizedParam("page");
			if (!$page) {
				$start = 0;
				$page = 1;
			} else {
				$start = ($page - 1) * $amount;
			}
			$this->_view->totalpages = ceil(count($list) / $amount);
			$this->_view->page = $page;
			$this->_view->productos = $productosModel->getListPages($filters, $order, $start, $amount);
		}
		// $this->_view->lateral = $lateral;
	}
	public function detalleAction()
	{
		$lateral = $this->_view->getRoutPHP('modules/page/Views/partials/lateral.php');
		$this->_view->lateral = $lateral;
		$categoria = $this->_getSanitizedParam("categoria");
		$productosModel = new Page_Model_DbTable_Productos();
		$informacionModel = new Page_Model_DbTable_Informacion();
		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$favoritoModel = new Administracion_Model_DbTable_Productosfavoritos();
		$this->_view->informacion = $informacionModel->getList("", "orden ASC")[0];
		$id = $this->_getSanitizedParam("id");
		$categoria = $this->_getSanitizedParam("categoria");
		$producto = $productosModel->getById($id);
		$kt_cedula = $_SESSION['kt_cedula'];


		$producto->calificaciones = $calificacionModel->getList("calificacion_producto_producto = " . $producto->productos_id, "");
		$producto->favorito = $favoritoModel->getList("productos_favoritos_producto = '$producto->productos_id' AND productos_favoritos_usuario = '$kt_cedula' ", "")[0];



		$total = 0;
		foreach ($producto->calificaciones as $key2 => $value2) {
			$total += $value2->calificacion_producto_calificacion * 1;
			$producto->total = $this->redondearNumero($total / count($producto->calificaciones));
		}




		$this->_view->producto = $producto;
		if ((int) $producto->productos_cantidad == 0) {
			header("Location:/page/");
		}

		$categoria = $producto->productos_categorias;
		$subcategoria = $producto->productos_subcategoria;
		$this->_view->productosrelacionados = $this->_view->productos = $this->template->getRelacionados($categoria, $subcategoria, $id);

		$categoriaModel = new Page_Model_DbTable_Categorias();
		$this->_view->categoria = $categoriaModel->getById($producto->productos_categorias);
		$this->_view->subcategoria = $categoriaModel->getById($producto->productos_subcategoria);
	}
	public function relacionadosAction()
	{
		$this->setLayout('blanco');

		$productosModel = new Page_Model_DbTable_Productos();
		$informacionModel = new Page_Model_DbTable_Informacion();
		$this->_view->informacion = $informacionModel->getList("", "orden ASC")[0];
		$id = $this->_getSanitizedParam("producto");
		$categoria = $this->_getSanitizedParam("categoria");
		$producto = $productosModel->getById($id);
		$categoria = $producto->productos_categorias;
		$subcategoria = $producto->productos_subcategoria;
		$relacionados = $this->template->getRelacionados($categoria, $subcategoria, $id);
		$this->_view->productosrelacionados = $relacionados;

		$this->_view->productos = $relacionados;


		$productosModel = new Administracion_Model_DbTable_Productos();

		$f1 = "";
		if ($subcategoria != "") {
			$f1 = " AND productos_subcategoria='$subcategoria' ";
		}

		$this->_view->relacionados = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' AND productos_id!='$id' $f1 ", " productos_nombre ASC ");

	}


	public function acompanamientosAction()
	{

		$this->setLayout("blanco");
		$producto = $this->_getSanitizedParam("producto");
		$acompanamientoModel = new Administracion_Model_DbTable_Acompanamientos();
		$acompanamientos = array();
		for ($i = 1; $i <= 6; $i++) {
			$acompanamientos[$i] = $acompanamientoModel->getList(" acomp_tipo='$i' AND acomp_producto='$producto' ", " orden ASC ");
		}
		echo json_encode($acompanamientos);
	}
	public function terminosAction()
	{

		$this->setLayout("blanco");
		$producto = $this->_getSanitizedParam("producto");
		$terminosModel = new Administracion_Model_DbTable_Terminos();
		$terminos = $terminosModel->getList("termino_producto='$producto' ", " orden ASC ");

		echo json_encode($terminos);
	}

	public function destacadosAction()
	{


		$this->_view->bannerprincipal = $this->template->bannerprincipal(1);
		$lateral = $this->_view->getRoutPHP('modules/page/Views/partials/lateral.php');
		$this->_view->lateral = $lateral;
		$categoria = $this->_getSanitizedParam("categoria");
		$productosModel = new Page_Model_DbTable_Productos();
		$informacionModel = new Page_Model_DbTable_Informacion();
		$this->_view->informacion = $informacionModel->getList("", "orden ASC")[0];
		$filters = "productos_destacado = 1";
		$order = "orden ASC";
		$list = $productosModel->getList($filters, $order);
		$amount = 12;
		$page = $this->_getSanitizedParam("page");
		if (!$page) {
			$start = 0;
			$page = 1;
		} else {
			$start = ($page - 1) * $amount;
		}
		$this->_view->totalpages = ceil(count($list) / $amount);
		$this->_view->page = $page;
		$this->_view->productos = $productosModel->getListPages($filters, $order, $start, $amount);
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


}