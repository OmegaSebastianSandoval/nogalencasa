<?php 

/**
* 
*/
class Page_Model_Template_Template
{

    protected $_view;

    function __construct($view)
    {
        $this->_view = $view;
    }


	public function getContentseccion($seccion){
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$contenidos = [];
		$rescontenidos = $contenidoModel->getList("contenido_seccion = '$seccion' AND contenido_padre = '0' ","orden ASC");
		foreach ($rescontenidos as $key => $contenido) {
			$contenidos[$key] = [];
			$contenidos[$key]['detalle'] = $contenido;
			$padre = $contenido->contenido_id;
			$hijos = $contenidoModel->getList("contenido_padre = '$padre' ","orden ASC");
			foreach ($hijos as $key2 => $hijo) {
				$padre = $hijo->contenido_id;
				$contenidos[$key]['hijos'][$key2] = [];
				$contenidos[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $contenidoModel->getList("contenido_padre = '$padre' ","orden ASC");
				if($nietos){
					$contenidos[$key]['hijos'][$key2]['hijos'] = $nietos;
				}
			}
		}
		$this->_view->contenidos = $contenidos;
		/*echo "<pre>";
		print_r($contenidos);
		echo "</pre>";*/
		return $this->_view->getRoutPHP("modules/page/Views/template/contenedor.php");
	}
	public function getContentid($id){
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$contenidos = [];
		$rescontenidos = $contenidoModel->getList("contenido_padre = '$id' ","orden ASC");
		foreach ($rescontenidos as $key => $contenido) {
			$contenidos[$key] = [];
			$contenidos[$key]['detalle'] = $contenido;
			$padre = $contenido->contenido_id;
			$hijos = $contenidoModel->getList("contenido_padre = '$padre' ","orden ASC");
			foreach ($hijos as $key2 => $hijo) {
				$padre = $hijo->contenido_id;
				$contenidos[$key]['hijos'][$key2] = [];
				$contenidos[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $contenidoModel->getList("contenido_padre = '$padre' ","orden ASC");
				if($nietos){
					$contenidos[$key]['hijos'][$key2]['hijos'] = $nietos;
				}
			}
		}
		$this->_view->contenidos = $contenidos;
		/*echo "<pre>";
		print_r($contenidos);
		echo "</pre>";*/
		return $this->_view->getRoutPHP("modules/page/Views/template/contenedor.php");
	}
	public function getProductos($buscar){
		$productosModel = new Administracion_Model_DbTable_Productos();
		$f1="";
		if($buscar!=""){
			$f1=" AND ( productos_nombre LIKE '%$buscar%' OR HTML_UnEncode(productos_nombre) LIKE '%$buscar%'  OR productos_descripcion LIKE '%$buscar%' ) ";
		}
		//$this->_view->productosdestacados = $productosModel->getList('productos_destacado = "0"','orden ASC');
		$this->_view->productosdestacados = $productos = $productosModel->getListCategorias(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') $f1 "," categorias.orden ASC, categorias_padre*1 ASC, productos_imagen ='' ASC, rand() ");

		$amount=20;
		$total = count($productos);
		$paginas = ceil($total/$amount);

		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}

		$this->_view->productosdestacados = $productosModel->getListCategoriasPages(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') $f1 "," categorias.orden ASC, categorias_padre*1 ASC, productos_imagen ='' ASC, rand() ",$start,$amount);

		$this->_view->register_number = count($productos);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productos)/$amount);
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productos.php");
	}




	public function getProductosf($categoria,$subcategoria){
		$productosModel = new Administracion_Model_DbTable_Productos();

		$f1="";
		if($subcategoria!=""){
			$f1=" AND productos_subcategoria='$subcategoria' ";
		}

		$this->_view->productosdestacados = $productos = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' $f1 "," productos_imagen ='' ASC, rand() ");


		$amount=20;
		$total = count($productos);
		$paginas = ceil($total/$amount);

		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
		   	$page = Session::getInstance()->get($this->namepageactual);
		   	$start = ($page - 1) * $amount;
		} else if(!$page){
			$start = 0;
		   	$page=1;
			Session::getInstance()->set($this->namepageactual,$page);
		} else {
			Session::getInstance()->set($this->namepageactual,$page);
		   	$start = ($page - 1) * $amount;
		}

		$this->_view->productosdestacados = $productosModel->getListPages(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' $f1 "," productos_imagen ='' ASC, rand() ",$start,$amount);

		$this->_view->register_number = count($productos);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productos)/$amount);
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productos.php");
	}


	public function getRelacionados($categoria,$subcategoria,$id){
		$productosModel = new Administracion_Model_DbTable_Productos();

		$f1="";
		if($subcategoria!=""){
			$f1=" AND productos_subcategoria='$subcategoria' ";
		}

		$this->_view->productosdestacados = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' AND productos_id!='$id' $f1 "," productos_nombre ASC ");
		return $this->_view->getRoutPHP("modules/page/Views/template/productos.php");
	}

	public function bannerprincipal($seccion){
		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' AND publicidad_estado='1' "," rand() ");

		return $this->_view->getRoutPHP("modules/page/Views/template/bannerprincipal.php");
	}
	public function bannersimple($seccion){
		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' ","orden ASC");

		return $this->_view->getRoutPHP("modules/page/Views/template/bannersimple.php");
	}
}