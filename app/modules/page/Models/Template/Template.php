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


	public function getContentseccion($seccion)
	{
		//  error_reporting(E_ALL);
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$contenidos = [];
		$rescontenidos = $contenidoModel->getList("contenido_estado='1' AND contenido_seccion = '$seccion' AND contenido_padre = '0' ", "orden ASC");
		foreach ($rescontenidos as $key => $contenido) {

			$contenidos[$key] = [];
			$contenidos[$key]['detalle'] = $contenido;
			$padre = $contenido->contenido_id;
			$hijos = $contenidoModel->getList("contenido_estado='1' AND contenido_padre = '$padre' ", "orden ASC");

			foreach ($hijos as $key2 => $hijo) {

				$padre = $hijo->contenido_id;
				$contenidos[$key]['hijos'][$key2] = [];
				$contenidos[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $contenidoModel->getList("contenido_padre = '$padre' ", "orden ASC");
				if ($nietos) {
					$contenidos[$key]['hijos'][$key2]['hijos'] = $nietos;
				}
			}
		}
		$this->_view->contenidos = $contenidos;

		return $this->_view->getRoutPHP("modules/page/Views/template/contenedor.php");
	}
	public function getContentid($id)
	{
		$contenidoModel = new Page_Model_DbTable_Contenido();
		$contenidos = [];
		$rescontenidos = $contenidoModel->getList("contenido_padre = '$id' ", "orden ASC");
		foreach ($rescontenidos as $key => $contenido) {
			$contenidos[$key] = [];
			$contenidos[$key]['detalle'] = $contenido;
			$padre = $contenido->contenido_id;
			$hijos = $contenidoModel->getList("contenido_padre = '$padre' ", "orden ASC");
			foreach ($hijos as $key2 => $hijo) {
				$padre = $hijo->contenido_id;
				$contenidos[$key]['hijos'][$key2] = [];
				$contenidos[$key]['hijos'][$key2]['detalle'] = $hijo;
				$nietos = $contenidoModel->getList("contenido_padre = '$padre' ", "orden ASC");
				if ($nietos) {
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
	public function getProductos($buscar)
	{
		//error_reporting(E_ALL);
		$productosModel = new Administracion_Model_DbTable_Productos();
		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$favoritosModel = new Administracion_Model_DbTable_Productosfavoritos();



		$f1 = "";
		if ($buscar != "") {
			$f1 = " AND ( productos_nombre LIKE '%$buscar%'  OR productos_descripcion LIKE '%$buscar%' ) ";
		}
		//$this->_view->productosdestacados = $productosModel->getList('productos_destacado = "0"','orden ASC');
		$this->_view->productosdestacados = $productos = $productosModel->getListCategorias(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') $f1 ", " categorias.orden ASC, categorias_padre*1 ASC, productos_imagen ='' ASC ");

		$amount = 20;
		$total = count($productos);
		$paginas = ceil($total / $amount);

		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}

		$productosdestacados = $productosModel->getListCategoriasPages(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') $f1 ", " categorias.orden ASC, categorias_padre*1 ASC, productos_imagen ='' ASC ", $start, $amount);

		// shuffle($productosdestacados);
		$kt_cedula = $_SESSION['kt_cedula'];

		foreach ($productosdestacados as $key => $producto) {
			$producto->calificaciones = $calificacionModel->getList("calificacion_producto_producto = " . $producto->productos_id, "");
			$producto->favorito = $favoritosModel->getList("productos_favoritos_producto = '$producto->productos_id' AND productos_favoritos_usuario = '$kt_cedula' ", "")[0];


		}
		foreach ($productosdestacados as $key => $producto) {
			$total = 0;
			foreach ($producto->calificaciones as $key2 => $value2) {
				$total += $value2->calificacion_producto_calificacion * 1;
				$producto->total = $this->redondearNumero($total / count($producto->calificaciones));
			}

		}


		$this->_view->productosdestacados = $productosdestacados;
		//traer categorias
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' ", " orden ASC ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}
		$this->_view->categorias2 = $categorias;
		$this->_view->register_number = count($productos);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productos) / $amount);
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productosnew.php");
	}





	public function getProductosf($categoria, $subcategoria, $favorita = "", $nuevo = "")
	{



		$productosModel = new Administracion_Model_DbTable_Productos();
		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$favoritoModel = new Administracion_Model_DbTable_Productosfavoritos();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();

		$f1 = "";
		if ($subcategoria != "") {
			$f1 = " AND productos_precio > 0  AND productos_subcategoria='$subcategoria' ";
		}
		if ($favorita) {
			//  echo $favorita;

			$catFavorita = $categoriasModel->getList("categorias_nombre='$favorita'")[0];
			// print_r($catFavorita->categorias_id);
			$productos = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$catFavorita->categorias_id' $f1 ", " productos_imagen ='' ASC ");
			$categoria = $catFavorita->categorias_id;
		} else {
			$productos = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' $f1 ", " productos_imagen ='' ASC ");
		}


		$amount = 20;
		$total = count($productos);
		$paginas = ceil($total / $amount);



		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}

if($nuevo ==1){
    $productosdestacados = $productosModel->getListPages(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_nuevo = 1 $f1 ", " productos_imagen ='' ASC ", $start, $amount);
}else{
 		$productosdestacados = $productosModel->getListPages(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' $f1 ", " productos_imagen ='' ASC ", $start, $amount);
   
}
		
		
		shuffle($productosdestacados);
		$kt_cedula = $_SESSION['kt_cedula'];

		foreach ($productosdestacados as $key => $producto) {
			$producto->calificaciones = $calificacionModel->getList("calificacion_producto_producto = " . $producto->productos_id, "");
			$producto->favorito = $favoritoModel->getList("productos_favoritos_producto = '$producto->productos_id' AND productos_favoritos_usuario = '$kt_cedula' ", "")[0];

		}
		foreach ($productosdestacados as $key => $producto) {
			$total = 0;
			foreach ($producto->calificaciones as $key2 => $value2) {
				$total += $value2->calificacion_producto_calificacion * 1;
				$producto->total = $this->redondearNumero($total / count($producto->calificaciones));
			}

		}


		$this->_view->productosdestacados = $productosdestacados;

		// print_r($productos);

		//SI ES LA CATEGORIA FAVORITA SE MANDA UNA BANDERA PARA MOSTRAR LA ETIQUETA DE NUEVO
		($favorita && $favorita != '' || $nuevo ==1) ? $this->_view->cat = true : false;
		// print_r($categoria);

		$this->_view->register_number = count($productos);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productos) / $amount);

		// echo $this->_view->totalpages;
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productos.php");
	}


	public function getProductosNew($categoria, $subcategoria)
	{
		//   error_reporting(E_ALL);


		$productosModel = new Administracion_Model_DbTable_Productos();
		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$favoritoModel = new Administracion_Model_DbTable_Productosfavoritos();

		$f1 = "";
		if ($subcategoria != "") {
			$f1 = " AND productos_subcategoria='$subcategoria' ";
		}

		$productos = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' $f1 ", " productos_imagen ='' ASC ");

		$amount = 20;
		$total = count($productos);
		$paginas = ceil($total / $amount);



		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}

		$productosdestacados = $productosModel->getListPages(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' $f1 ", " productos_imagen ='' ASC ", $start, $amount);
		shuffle($productosdestacados);
		$kt_cedula = $_SESSION['kt_cedula'];

		foreach ($productosdestacados as $key => $producto) {
			$producto->calificaciones = $calificacionModel->getList("calificacion_producto_producto = " . $producto->productos_id, "");
			$producto->favorito = $favoritoModel->getList("productos_favoritos_producto = '$producto->productos_id' AND productos_favoritos_usuario = '$kt_cedula' ", "")[0];

		}
		foreach ($productosdestacados as $key => $producto) {
			$total = 0;
			foreach ($producto->calificaciones as $key2 => $value2) {
				$total += $value2->calificacion_producto_calificacion * 1;
				$producto->total = $this->redondearNumero($total / count($producto->calificaciones));
			}

		}


		$this->_view->productosdestacados = $productosdestacados;

		// print_r($productos);

		//SI ES LA CATEGORIA FAVORITA SE MANDA UNA BANDERA PARA MOSTRAR LA ETIQUETA DE NUEVO
		($categoria === '40') ? $this->_view->cat = true : false;
		// print_r($categoria);

		//traer categorias
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' ", " orden ASC ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;

			foreach ($hijos as $key2 => $value2) {
				$nietos = $categoriasModel->getList(" categorias_padre='$value2->categorias_id' ", " orden ASC ");
				$value2->nietos = $nietos;

			}


		}
		/* foreach ($categorias as $key => $value) {
				
						
						foreach ($value->hijos as $key2 => $value2) {
							$nietos = $categoriasModel->getList(" categorias_padre='$value2->categorias_id' ", " orden ASC ");
							$value2->nietos = $nietos;
						
						}


					} */
		/* foreach ($rescontenidos as $key => $contenido) {

						  $contenidos[$key] = [];
						  $contenidos[$key]['detalle'] = $contenido; */

		$this->_view->categorias2 = $categorias;

		$this->_view->register_number = count($productos);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productos) / $amount);

		// echo $this->_view->totalpages;
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productosnew.php");
	}

	public function getProductosFav()
	{
		// error_reporting(E_ALL);


		$productosModel = new Administracion_Model_DbTable_Productos();
		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$favoritoModel = new Administracion_Model_DbTable_Productosfavoritos();

		$kt_cedula = $_SESSION['kt_cedula'];

		$favoritos = $favoritoModel->getList("productos_favoritos_usuario = '$kt_cedula'", "");

		// Extraer el valor del ndice 'productos_favoritos_producto'
// Extraer el valor del índice 'productos_favoritos_producto' y unirlos por comas
		$productos_favoritos_producto_string = implode(',', array_map(function ($item) {
			return $item->productos_favoritos_producto;
		}, $favoritos));


		$amount = 20;




		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}
		if ($productos_favoritos_producto_string && $productos_favoritos_producto_string != '') {

			$productosdestacados = $productosModel->getListPages(" producto_activo='1' AND productos_id in($productos_favoritos_producto_string) AND (productos_cantidad>0 AND productos_cantidad!='')  ", "", $start, $amount);
			shuffle($productosdestacados);

			// print_r($productosdestacados);

			$total = count($productosdestacados);
			$paginas = ceil($total / $amount);
			foreach ($productosdestacados as $key => $producto) {
				$producto->calificaciones = $calificacionModel->getList("calificacion_producto_producto = " . $producto->productos_id, "");
				$producto->favorito = $favoritoModel->getList("productos_favoritos_producto = '$producto->productos_id' AND productos_favoritos_usuario = '$kt_cedula' ", "")[0];

			}
			foreach ($productosdestacados as $key => $producto) {
				$total = 0;
				foreach ($producto->calificaciones as $key2 => $value2) {
					$total += $value2->calificacion_producto_calificacion * 1;
					$producto->total = $this->redondearNumero($total / count($producto->calificaciones));
				}

			}


			$this->_view->productosdestacados = $productosdestacados;

		} else {
			$this->_view->productosdestacados = $productosdestacados = [];
			$this->_view->sinproductos = 1;

		}


		//traer categorias
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' ", " orden ASC ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}
		$this->_view->categorias2 = $categorias;

		$this->_view->register_number = count($productosdestacados);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productosdestacados) / $amount);

		// echo $this->_view->totalpages;
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productosnew.php");
		/* 	$this->_view->register_number = count($productos);
								 $this->_view->pages = $this->pages;
								 $this->_view->totalpages = ceil(count($productos) / $amount);

								 // echo $this->_view->totalpages;
								 $this->_view->page = $page;

								 return $this->_view->getRoutPHP("modules/page/Views/template/productosnew.php"); */
	}

	public function getProductosFilter($filter)
	{
		// error_reporting(E_ALL);


		$productosModel = new Administracion_Model_DbTable_Productos();
		$calificacionModel = new Administracion_Model_DbTable_Calificacionproductos();
		$favoritoModel = new Administracion_Model_DbTable_Productosfavoritos();


		$amount = 20;


		$order = "";
		if ($filter == "OrderByPriceDesc") {
			$order = " CAST(productos_precio AS DECIMAL) ASC  ";
		}
		if ($filter == "OrderByPriceAsc") {

			$order = " CAST(productos_precio AS DECIMAL) DESC ";
		}
		if ($filter == "OrderByRecent") {
			$order = " orden DESC ";
		}
		$kt_cedula = $_SESSION['kt_cedula'];





		$page = $_GET["page"];
		if (!$page && Session::getInstance()->get($this->namepageactual)) {
			$page = Session::getInstance()->get($this->namepageactual);
			$start = ($page - 1) * $amount;
		} else if (!$page) {
			$start = 0;
			$page = 1;
			Session::getInstance()->set($this->namepageactual, $page);
		} else {
			Session::getInstance()->set($this->namepageactual, $page);
			$start = ($page - 1) * $amount;
		}

		if ($filter == "OrderByFav") {

			$productos = $productosModel->getListCalificacion("producto_activo='1'  AND (productos_cantidad>0 AND productos_cantidad!='')");

			$total = count($productos);
			$productosdestacados = $productosModel->getListPagesCalificacion("producto_activo='1'  AND (productos_cantidad>0 AND productos_cantidad!='')", $start, $amount);
			// print_r($productosdestacados);
		} else {

			$productos = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') ", $order);


			$productosdestacados = $productosModel->getListPages(" producto_activo='1'  AND (productos_cantidad>0 AND productos_cantidad!='')  ", $order, $start, $amount);
			$total = count($productos);
			// print_r($productosdestacados);
		}

		//  print_r($productosdestacados);


		$paginas = ceil($total / $amount);
		foreach ($productosdestacados as $key => $producto) {
			$producto->calificaciones = $calificacionModel->getList("calificacion_producto_producto = " . $producto->productos_id, "");
			$producto->favorito = $favoritoModel->getList("productos_favoritos_producto = '$producto->productos_id' AND productos_favoritos_usuario = '$kt_cedula' ", "")[0];

		}
		foreach ($productosdestacados as $key => $producto) {
			$total = 0;
			foreach ($producto->calificaciones as $key2 => $value2) {
				$total += $value2->calificacion_producto_calificacion * 1;
				$producto->total = $this->redondearNumero($total / count($producto->calificaciones));
			}

		}


		$this->_view->productosdestacados = $productosdestacados;




		//traer categorias
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$this->_view->categorias = $categorias = $categoriasModel->getList(" categorias_padre='0' ", " orden ASC ");
		foreach ($categorias as $key => $value) {
			$padre = $value->categorias_id;
			$hijos = $categoriasModel->getList(" categorias_padre='$padre' ", " orden ASC ");
			$value->hijos = $hijos;
		}
		$this->_view->categorias2 = $categorias;

		/* 	$this->_view->register_number = count($productosdestacados);
								  $this->_view->pages = $this->pages;
								  $this->_view->totalpages = ceil(count($productosdestacados) / $amount);

								   echo $this->_view->totalpages;
								  $this->_view->page = $page;

								  return $this->_view->getRoutPHP("modules/page/Views/template/productosnew.php"); */
		$this->_view->register_number = count($productos);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($productos) / $amount);

		// echo $this->_view->totalpages;
		$this->_view->page = $page;

		return $this->_view->getRoutPHP("modules/page/Views/template/productosnew.php");
	}

	public function getRelacionados($categoria, $subcategoria, $id)
	{
		$productosModel = new Administracion_Model_DbTable_Productos();

		$f1 = "";
		if ($subcategoria != "") {
			$f1 = " AND productos_subcategoria='$subcategoria' ";
		}

		$this->_view->productosdestacados = $productosModel->getList(" producto_activo='1' AND (productos_cantidad>0 AND productos_cantidad!='') AND productos_categorias = '$categoria' AND productos_id!='$id' $f1 ", " productos_nombre ASC ");
		return $this->_view->getRoutPHP("modules/page/Views/template/productos.php");
	}

	public function bannerprincipal($seccion)
	{


		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' AND publicidad_estado='1' ", " rand()");
		//  print_r($this->_view->banners); 

		return $this->_view->getRoutPHP("modules/page/Views/template/bannerprincipal.php");
	}
	public function bannersimple($seccion)
	{
		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' ", "orden ASC");

		return $this->_view->getRoutPHP("modules/page/Views/template/bannersimple.php");
	}
	public function bannerlogin($seccion)
	{
		$this->_view->seccionbanner = $seccion;
		$publicidadModel = new Page_Model_DbTable_Publicidad();
		$this->_view->banners = $publicidadModel->getList("publicidad_seccion = '$seccion' ", "orden ASC");

		return $this->_view->getRoutPHP("modules/page/Views/template/bannerlogin.php");
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