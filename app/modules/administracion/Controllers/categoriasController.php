<?php
/**
 * Controlador de Categorias que permite la  creacion, edicion  y eliminacion de los Categorias del Sistema
 */
class Administracion_categoriasController extends Administracion_mainController
{
    
    	public $botonpanel = 5;

	/**
	 * $mainModel  instancia del modelo de  base de datos Categorias
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
	protected $_csrf_section = "administracion_categorias";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador categorias .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Categorias();
		$this->namefilter = "parametersfiltercategorias";
		$this->route = "/administracion/categorias";
		$this->namepages = "pages_categorias";
		$this->namepageactual = "page_actual_categorias";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  Categorias con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de Categorias";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
		$list = $this->mainModel->getList($filters, $order);
		// print_r($filters);
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
		$lists= $this->mainModel->getListPages($filters, $order, $start, $amount);
		$productosModel = new Administracion_Model_DbTable_Productos();
		foreach($lists as $key => $value)
		{
			$value->subs = $productosModel->getList("productos_subcategoriados = '$value->categorias_id'","");
		}
		$this->_view->lists = $lists;
		
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->padre = $this->_getSanitizedParam("padre");
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  Categoria  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_view->padre = $this->_getSanitizedParam("padre");
		$this->_csrf_section = "manage_categorias_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->categorias_id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Categoria";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Categoria";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Categoria";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
	 * Inserta la informacion de un Categoria  y redirecciona al listado de Categorias.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();

			if($_FILES['categorias_imagen']['name'] != ''){
				$data['categorias_imagen'] = $uploadImage->upload("categorias_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id, $id);
			$data['categorias_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR CATEGORIA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: ' . $this->route . '?padre=' . $data['categorias_padre'] . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un Categoria  y redirecciona al listado de Categorias.
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
			if ($content->categorias_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['categorias_imagen']['name'] != ''){
					if($content->categorias_imagen){
						$uploadImage->delete($content->categorias_imagen);
					}
					$data['categorias_imagen'] = $uploadImage->upload("categorias_imagen");
				} else {
					$data['categorias_imagen'] = $content->categorias_imagen;
				}
				$this->mainModel->update($data, $id);
			}
			$data['categorias_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR CATEGORIA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		 header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y elimina un Categoria  y redirecciona al listado de Categorias.
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
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->categorias_imagen) && $content->categorias_imagen != '') {
						$uploadImage->delete($content->categorias_imagen);
					}
					$this->mainModel->deleteRegister($id);
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR CATEGORIA';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Categorias.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['categorias_nombre'] = $this->_getSanitizedParam("categorias_nombre");
		$data['categorias_imagen'] = "";

		$data['categorias_descripcion'] = $this->_getSanitizedParamHtml("categorias_descripcion");
		$data['categorias_padre'] = $this->_getSanitizedParamHtml("padre");
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

		$padre = $this->_getSanitizedParamHtml("padre");
		!$padre ? $padre = 0 : null;
		$filtros .= " AND categorias_padre='$padre' ";

		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
			if ($filters->categorias_nombre != '') {
				$filtros = $filtros . " AND categorias_nombre LIKE '%" . $filters->categorias_nombre . "%'";
			}
			if ($filters->categorias_descripcion != '') {
				$filtros = $filtros . " AND categorias_descripcion LIKE '%" . $filters->categorias_descripcion . "%'";
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
			$parramsfilter['categorias_nombre'] = $this->_getSanitizedParam("categorias_nombre");
			$parramsfilter['categorias_descripcion'] = $this->_getSanitizedParam("categorias_descripcion");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}
}