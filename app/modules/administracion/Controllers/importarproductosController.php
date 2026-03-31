<?php

/**
 * Controlador de Importarcedulas que permite la  creacion, edicion  y eliminacion de los importar cedulas del Sistema
 */
class Administracion_importarproductosController extends Administracion_mainController
{
	public $botonpanel = 9;

	/**
	 * $mainModel  instancia del modelo de  base de datos importar cedulas
	 * @var modeloContenidos
	 */
	public $mainModel;

	/**
	 * $route  url del controlador base
	 * @var string
	 */
	protected $route;

	/**
	 * $pages cantidad de registros a mostrar por pagina]
	 * @var integer
	 */
	protected $pages;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_importarcedulas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador importarcedulas .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Importarproductos();
		$this->namefilter = "parametersfilterimportarcedulas";
		$this->route = "/administracion/importarproductos";
		$this->namepages = "pages_importarcedulas";
		$this->namepageactual = "page_actual_importarcedulas";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  importar cedulas con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de importar productos";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
		$list = $this->mainModel->getList($filters, $order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
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
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list) / $amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters, $order, $start, $amount);
		$this->_view->csrf_section = $this->_csrf_section;
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  importar cedulas  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_importarcedulas_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->archivo_id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar importar productos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear importar productos";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear importar productos";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un importar cedulas  y redirecciona al listado de importar cedulas.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$uploadDocument = new Core_Model_Upload_Document();
			if ($_FILES['archivo_productos']['name'] != '') {
				$data['archivo_productos'] = $uploadDocument->upload("archivo_productos");
			}
			$id = $this->mainModel->insert($data);

			$data['archivo_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR IMPORTAR PRODUCTOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un importar cedulas  y redirecciona al listado de importar cedulas.
	 *
	 * @return void.
	 */
	public function updateAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->archivo_id) {
				$data = $this->getData();
				$uploadDocument = new Core_Model_Upload_Document();
				if ($_FILES['archivo_productos']['name'] != '') {
					if ($content->archivo_productos) {
						$uploadDocument->delete($content->archivo_productos);
					}
					$data['archivo_productos'] = $uploadDocument->upload("archivo_productos");
				} else {
					$data['archivo_productos'] = $content->archivo_productos;
				}
				$this->mainModel->update($data, $id);
			}
			$data['archivo_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR IMPORTAR PRODUCTOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		//header('Location: '.$this->route.''.'');
		header('Location: ' . $this->route . '/carga/');
	}


	public function cargaAction()
	{
		$this->setLayout('blanco');

		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 600000000);
		$id = 1;
		$content = $this->mainModel->getById($id);
		$archivo = $content->archivo_productos;
		$this->getLayout()->setTitle("Importar productos");

		/* 	//leer archivo
						   ini_set('memory_limit', '-1');
						   ini_set('max_execution_time', 300); */
		$inputFileName = FILE_PATH . '/' . $archivo;
		/* $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
					   $infoexel = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true); */
		$objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		$infoexel = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$productosModel = new Administracion_Model_DbTable_Productos();
		$categoriaModel = new Administracion_Model_DbTable_Categorias();
		$fotosProductosModel = new Administracion_Model_DbTable_Fotosproducto();

		$i = 0;
		$hoy = date("Y-m-d H:i:s");

		foreach ($infoexel as $fila) {
			if ($fila['A'] === '') {
				continue;
			}

			$i++;
			if ($fila['A'] != '') {
				error_log("Fila: {$fila['A']} fila{$i}");
			}
			if ($i > 1) {

				$categoria = $fila['G'];
				$categoria = trim($categoria);

				if ($categoria != '') {

					$existe_categoria = $categoriaModel->getList(" categorias_nombre='$categoria' AND categorias_padre='0' ", "");
					if (count($existe_categoria) > 0) {
						$categoria_id = $existe_categoria[0]->categorias_id;
					} else {
						$data['categorias_nombre'] = $categoria;
						$data['categorias_descripcion'] = "";
						$data['categorias_padre'] = 0;
						$data['categorias_imagen'] = $fila['L'];
						$categoria_id = $categoriaModel->insert($data);
						$categoriaModel->editField($categoria_id, "orden", $categoria_id);
					}
				}

				$data = [];
				$subcategoria = $fila['H'];
				$subcategoria = trim($subcategoria);
				$subcategoria = str_replace("'", "\'", $subcategoria);

				if ($subcategoria != '') {
					$existe_categoria2 = $categoriaModel->getList(" categorias_nombre='$subcategoria' AND categorias_padre='$categoria_id' ", "");
					if (count($existe_categoria2) > 0) {
						$subcategoria_id = $existe_categoria2[0]->categorias_id;
					} else {
						$data['categorias_nombre'] = $subcategoria;
						$data['categorias_descripcion'] = "";
						$data['categorias_padre'] = $categoria_id;
						$subcategoria_id = $categoriaModel->insert($data);
						$categoriaModel->editField($subcategoria_id, "orden", $subcategoria_id);
					}
				}

				$subcategoriados = $fila['I'];
				$subcategoriados = trim($subcategoriados);
				if ($subcategoriados != '') {

					$existe_categoria3 = $categoriaModel->getList(" categorias_nombre='$subcategoriados' AND categorias_padre='$subcategoria_id' ", "");
					if (count($existe_categoria3) > 0) {
						$subcategoriados_id = $existe_categoria3[0]->categorias_id;
					} else {
						$data['categorias_nombre'] = $subcategoriados;
						$data['categorias_descripcion'] = "";
						$data['categorias_padre'] = $subcategoria_id;
						$subcategoriados_id = $categoriaModel->insert($data);
						$categoriaModel->editField($subcategoriados_id, "orden", $subcategoriados_id);
					}
				}


				$productos_codigo = $data['productos_codigo'] = $fila['A'];
				$productos_nombre = $data['productos_nombre'] = $this->limpiar($fila['C']);
				$productos_descripcion = $data['productos_descripcion'] = $this->limpiar($fila['D']);
				$productos_imagen = $data['productos_imagen'] = $fila['B'];
				$productos_destacado = $data['productos_destacado'] = 0;
				$productos_precio = $data['productos_precio'] = $fila['E'];

				$productos_imagen1 = $data['productos_imagen1'] = $fila['M'];
				$productos_imagen2 = $data['productos_imagen2'] = $fila['N'];
				$productos_imagen3 = $data['productos_imagen3'] = $fila['O'];
				$productos_nuevo = $data['productos_nuevo'] = $fila['P'] ?? 0;

				$productos_precio = str_replace(" ", "", $productos_precio);
				$productos_precio = str_replace("$", "", $productos_precio);
				$productos_precio = str_replace(",", "", $productos_precio);
				$data['productos_precio'] = $productos_precio;

				//$productos_nuevo = $data['productos_nuevo'] = 0;
				$productos_cantidad = $data['productos_cantidad'] = $fila['F'];
				$productos_categorias = $data['productos_categorias'] = $categoria_id;
				$productos_subcategoria = $data['productos_subcategoria'] = $subcategoria_id;
				$productos_subcategoriados = $data['productos_subcategoriados'] = $subcategoriados_id;

				$existe = $productosModel->getList(" productos_codigo='$productos_codigo' ", "");

				$productos_cantidad_minima = $data['productos_cantidad_minima'] = $fila['J'];
				$productos_limite_pedido = $data['productos_limite_pedido'] = $fila['K'];

				if (count($existe) == 0) {
					if ($data['productos_codigo'] != "") {
						$productos_id = $productosModel->insert($data);
						$productosModel->editField($productos_id, "orden", $productos_id);
						if ($productos_imagen1) {
							echo $productos_imagen1;
							echo "fotos_productos_producto='$productos_id' AND fotos_productos_imagen='$productos_imagen1'";
							$fotos = $fotosProductosModel->getList("fotos_productos_producto='$productos_id' AND fotos_productos_imagen='$productos_imagen1'", "");
							if (count($fotos) == 0) {
								$data2['fotos_productos_producto'] = $productos_id;
								$data2['fotos_productos_imagen'] = $productos_imagen1;
								$data2['fotos_productos_nombre'] = $productos_nombre;

								$fotosProductosModel->insert($data2);
							}
						}
						if ($productos_imagen2) {
							$fotos = $fotosProductosModel->getList("fotos_productos_producto='$productos_id' AND fotos_productos_imagen='$productos_imagen2'", "");
							if (count($fotos) == 0) {
								$data2['fotos_productos_producto'] = $productos_id;
								$data2['fotos_productos_imagen'] = $productos_imagen2;
								$data2['fotos_productos_nombre'] = $productos_nombre;
								$fotosProductosModel->insert($data2);
							}
						}
						if ($productos_imagen3) {
							$fotos = $fotosProductosModel->getList("fotos_productos_producto='$productos_id' AND fotos_productos_imagen='$productos_imagen3'", "");
							if (count($fotos) == 0) {
								$data2['fotos_productos_producto'] = $productos_id;
								$data2['fotos_productos_imagen'] = $productos_imagen3;
								$data2['fotos_productos_nombre'] = $productos_nombre;
								$fotosProductosModel->insert($data2);
							}
						}
					}
				} else {
					$producto = $existe[0];
					$productos_id = $producto->productos_id;
					if ($productos_nombre != "" and $productos_nombre != $producto->productos_nombre) {
						$productosModel->editField($productos_id, "productos_nombre", $productos_nombre);
					}
					if ($productos_descripcion != "" and $productos_descripcion != $producto->productos_descripcion) {
						$productosModel->editField($productos_id, "productos_descripcion", $productos_descripcion);
					}
					if ($productos_imagen != "" and $productos_imagen != $producto->productos_imagen) {
						$productosModel->editField($productos_id, "productos_imagen", $productos_imagen);
					}
					if ($productos_precio != "" and $productos_precio != $producto->productos_precio) {
						$productosModel->editField($productos_id, "productos_precio", $productos_precio);
					}
					if ($productos_cantidad != $producto->productos_cantidad) {
						$productosModel->editField($productos_id, "productos_cantidad", $productos_cantidad);
					}
					if ($productos_categorias != "" and $productos_categorias != $producto->productos_categorias) {
						$productosModel->editField($productos_id, "productos_categorias", $productos_categorias);
					}
					if ($productos_subcategoria != "" and $productos_subcategoria != $producto->productos_subcategoria) {
						$productosModel->editField($productos_id, "productos_subcategoria", $productos_subcategoria);
					}
					if ($productos_subcategoriados != "" and $productos_subcategoriados != $producto->$productos_subcategoriados) {
						$productosModel->editField($productos_id, "productos_subcategoriados", $productos_subcategoriados);
					}
					if ($productos_cantidad_minima != "" and $productos_cantidad_minima != $producto->productos_cantidad_minima) {

						$productosModel->editField($productos_id, "productos_cantidad_minima", $productos_cantidad_minima);
					}
					if ($productos_limite_pedido != "" and $productos_limite_pedido != $producto->productos_limite_pedido) {
						$productosModel->editField($productos_id, "productos_limite_pedido", $productos_limite_pedido);
					}
					if ($productos_nuevo != "" and $productos_nuevo != $producto->productos_nuevo) {
						$productosModel->editField($productos_id, "productos_nuevo", $productos_nuevo);
					}
				}
			}
		}

		header("Location:/administracion/importarproductos/manage/?id=1&cargado=1&i= $i");
	}

	public function carga2Action()
	{
		$id = 1;
		$content = $this->mainModel->getById($id);
		$archivo = $content->archivo_productos;
		$this->getLayout()->setTitle("Importar productos");

		//leer archivo
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 300);
		$inputFileName = FILE_PATH . '/' . $archivo;
		/* $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
					   $infoexel = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true); */
		$objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		$infoexel = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$productosModel = new Administracion_Model_DbTable_Productos();
		$categoriaModel = new Administracion_Model_DbTable_Categorias();
		$i = 0;
		$hoy = date("Y-m-d H:i:s");

		foreach ($infoexel as $fila) {
			$i++;

			if ($i > 1) {

				$categoria = $fila['G'];
				$categoria = trim($categoria);

				$existe_categoria = $categoriaModel->getList(" categorias_nombre='$categoria' AND categorias_padre='0' ", "");
				if (count($existe_categoria) > 0) {
					$categoria_id = $existe_categoria[0]->categorias_id;
				} else {
					$data['categorias_nombre'] = $categoria;
					$data['categorias_descripcion'] = "";
					$data['categorias_padre'] = 0;
					$categoria_id = $categoriaModel->insert($data);
					$categoriaModel->editField($categoria_id, "orden", $categoria_id);
				}

				$subcategoria = $fila['H'];
				$subcategoria = trim($subcategoria);
				$existe_categoria2 = $categoriaModel->getList(" categorias_nombre='$subcategoria' AND categorias_padre='$categoria_id' ", "");
				if (count($existe_categoria2) > 0) {
					$subcategoria_id = $existe_categoria2[0]->categorias_id;
				} else {
					$data['categorias_nombre'] = $subcategoria;
					$data['categorias_descripcion'] = "";
					$data['categorias_padre'] = $categoria_id;
					$subcategoria_id = $categoriaModel->insert($data);
					$categoriaModel->editField($subcategoria_id, "orden", $subcategoria_id);
				}

				$productos_codigo = $data['productos_codigo'] = $fila['A'];
				$productos_nombre = $data['productos_nombre'] = $fila['C'];
				$productos_descripcion = $data['productos_descripcion'] = $fila['D'];
				$productos_imagen = $data['productos_imagen'] = $fila['B'];
				$productos_destacado = $data['productos_destacado'] = 0;
				$productos_precio = $data['productos_precio'] = $fila['E'];

				$productos_precio = str_replace(" ", "", $productos_precio);
				$productos_precio = str_replace("$", "", $productos_precio);
				$productos_precio = str_replace(",", "", $productos_precio);
				$data['productos_precio'] = $productos_precio;

				$productos_nuevo = $data['productos_nuevo'] = 0;
				$productos_cantidad = $data['productos_cantidad'] = $fila['F'];
				$productos_categorias = $data['productos_categorias'] = $categoria_id;
				$productos_subcategoria = $data['productos_subcategoria'] = $subcategoria_id;
				$existe = $productosModel->getList(" productos_codigo='$productos_codigo' ", "");
				if (count($existe) == 0) {
				} else {
					$producto = $existe[0];
					$productos_id = $producto->productos_id;
					if ($productos_cantidad != $producto->productos_inicial) {
						$productosModel->editField($productos_id, "productos_inicial", $productos_cantidad);
					}
				}
			}
		}
	}

	public function cuadrarAction()
	{
		$productosModel = new Administracion_Model_DbTable_Productos();
		$pedidosModel = new Page_Model_DbTable_Pedidos();
		$productoscarritoModel = new Page_Model_DbTable_Productoscarrito();

		$pedidos = $pedidosModel->getList(" pedido_estado='1' ", "");
		$totales = [];
		foreach ($pedidos as $key => $pedido) {
			$pedido_id = $pedido->pedido_id;
			$productoscarrito = $productoscarritoModel->getList(" id_carrito='$pedido_id' ", "");
			foreach ($productoscarrito as $key2 => $producto1) {
				$totales[$producto1->id_productos] += $producto1->cantidad;
			}
		}

		foreach ($totales as $key => $value) {
			$productos_id = $key;
			$cantidad = $value;
			$producto = $productosModel->getById($productos_id);
			$inicial = $producto->productos_inicial;
			$saldo = $inicial - $cantidad;
			if ($inicial != "" and $inicial > 0) {
				$productosModel->editField($productos_id, "productos_cantidad", $saldo);
				echo "productos_id: " . $productos_id . " inicial:" . $inicial . " cantidad:" . $cantidad . " saldo:" . $saldo . "<br>";
			}
		}
	}

	/**
	 * Recibe un identificador  y elimina un importar cedulas  y redirecciona al listado de importar cedulas.
	 *
	 * @return void.
	 */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf) {
			$id = $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadDocument = new Core_Model_Upload_Document();
					if (isset($content->archivo_productos) && $content->archivo_productos != '') {
						$uploadDocument->delete($content->archivo_productos);
					}
					$this->mainModel->deleteRegister($id);
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR IMPORTAR PRODUCTOS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '' . '');
	}

	public function importarfotosAction() {}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Importarcedulas.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['archivo_puntos'] = '';
		$data['archivo_productos'] = "";
		$data['archivo_cedulas'] = '';
		return $data;
	}
	/**
	 * Genera la consulta con los filtros de este controlador.
	 *
	 * @return array cadena con los filtros que se van a asignar a la base de datos
	 */
	protected function getFilter()
	{
		$filtros = " 1 = 1 ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
			if ($filters->archivo_productos != '') {
				$filtros = $filtros . " AND archivo_productos LIKE '%" . $filters->archivo_productos . "%'";
			}
		}
		return $filtros;
	}

	/**
	 * Recibe y asigna los filtros de este controlador
	 *
	 * @return void
	 */
	protected function filters()
	{
		if ($this->getRequest()->isPost() == true) {
			Session::getInstance()->set($this->namepageactual, 1);
			$parramsfilter = array();
			$parramsfilter['archivo_productos'] = $this->_getSanitizedParam("archivo_productos");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
	function limpiar($cadena)
	{
		$cadena = str_replace('"', '', $cadena);
		$cadena = str_replace("'", '', $cadena);

		return $cadena;
	}
}
