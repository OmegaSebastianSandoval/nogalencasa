<?php
/**
 * Controlador de Fotosproducto que permite la  creacion, edicion  y eliminacion de los fotos producto del Sistema
 */
class Administracion_fotosproductoController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos fotos producto
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
	protected $_csrf_section = "administracion_fotosproducto";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador fotosproducto .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Fotosproducto();
		$this->namefilter = "parametersfilterfotosproducto";
		$this->route = "/administracion/fotosproducto";
		$this->namepages = "pages_fotosproducto";
		$this->namepageactual = "page_actual_fotosproducto";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  fotos producto con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de fotos producto";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
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
		$lists = $this->mainModel->getListPages($filters, $order, $start, $amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$productosModel = new Administracion_Model_DbTable_Productos();
		$this->_view->producto = $this->_getSanitizedParam("producto");
		foreach ($lists as $key => $value) {
			$value->producto = $productosModel->getById($value->fotos_productos_producto)->productos_nombre;
		}
		$this->_view->lists = $lists;
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  fotos producto  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_fotosproducto_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->producto = $this->_getSanitizedParam("producto");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->fotos_productos_id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar fotos producto";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear fotos producto";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear fotos producto";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un fotos producto  y redirecciona al listado de fotos producto.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$uploadImage = new Core_Model_Upload_Image();
			if ($_FILES['fotos_productos_imagen']['name'] != '') {
				$data['fotos_productos_imagen'] = $uploadImage->upload("fotos_productos_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id, $id);
			$data['fotos_productos_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR FOTOS PRODUCTO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$producto = $this->_getSanitizedParam("fotos_productos_producto");
		header('Location: ' . $this->route . '?producto=' . $producto . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un fotos producto  y redirecciona al listado de fotos producto.
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
			if ($content->fotos_productos_id) {
				$data = $this->getData();
				$uploadImage = new Core_Model_Upload_Image();
				if ($_FILES['fotos_productos_imagen']['name'] != '') {
					if ($content->fotos_productos_imagen) {
						$uploadImage->delete($content->fotos_productos_imagen);
					}
					$data['fotos_productos_imagen'] = $uploadImage->upload("fotos_productos_imagen");
				} else {
					$data['fotos_productos_imagen'] = $content->fotos_productos_imagen;
				}
				$this->mainModel->update($data, $id);
			}
			$data['fotos_productos_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR FOTOS PRODUCTO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$producto = $this->_getSanitizedParam("fotos_productos_producto");
		header('Location: ' . $this->route . '?producto=' . $producto . '');
	}

	/**
	 * Recibe un identificador  y elimina un fotos producto  y redirecciona al listado de fotos producto.
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
					$uploadImage = new Core_Model_Upload_Image();
					if (isset($content->fotos_productos_imagen) && $content->fotos_productos_imagen != '') {
						$uploadImage->delete($content->fotos_productos_imagen);
					}
					$this->mainModel->deleteRegister($id);
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR FOTOS PRODUCTO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		$producto = $this->_getSanitizedParam("producto");
		header('Location: ' . $this->route . '?producto=' . $producto . '');
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Fotosproducto.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['fotos_productos_estado'] = $this->_getSanitizedParam("fotos_productos_estado");
		$data['fotos_productos_imagen'] = "";
		$data['fotos_productos_producto'] = $this->_getSanitizedParamHtml("fotos_productos_producto");
		$data['fotos_productos_nombre'] = $this->_getSanitizedParam("fotos_productos_nombre");
		$data['fotos_productos_descripcion'] = $this->_getSanitizedParamHtml("fotos_productos_descripcion");
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
		$producto = $this->_getSanitizedParam("producto");
		$filtros = $filtros . " AND fotos_productos_producto = '$producto' ";
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
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
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}