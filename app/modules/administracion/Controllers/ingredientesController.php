<?php
/**
* Controlador de Ingredientes que permite la  creacion, edicion  y eliminacion de los ingrediente del Sistema
*/
class Administracion_ingredientesController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos ingrediente
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
	protected $pages ;

	/**
	 * $namefilter nombre de la variable a la fual se le van a guardar los filtros
	 * @var string
	 */
	protected $namefilter;

	/**
	 * $_csrf_section  nombre de la variable general csrf  que se va a almacenar en la session
	 * @var string
	 */
	protected $_csrf_section = "administracion_ingredientes";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador ingredientes .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Ingredientes();
		$this->namefilter = "parametersfilteringredientes";
		$this->route = "/administracion/ingredientes";
		$this->namepages ="pages_ingredientes";
		$this->namepageactual ="page_actual_ingredientes";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  ingrediente con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de ingrediente";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "orden ASC";
		$list = $this->mainModel->getList($filters,$order);
		$amount = $this->pages;
		$page = $this->_getSanitizedParam("page");
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
		$this->_view->register_number = count($list);
		$this->_view->pages = $this->pages;
		$this->_view->totalpages = ceil(count($list)/$amount);
		$this->_view->page = $page;
		$this->_view->lists = $this->mainModel->getListPages($filters,$order,$start,$amount);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->ingrediente_producto = $this->_getSanitizedParam("ingrediente_producto");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  ingrediente  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_ingredientes_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->ingrediente_producto = $this->_getSanitizedParam("ingrediente_producto");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->ingrediente_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar ingrediente";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear ingrediente";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear ingrediente";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un ingrediente  y redirecciona al listado de ingrediente.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$uploadImage =  new Core_Model_Upload_Image();
			if($_FILES['ingrediente_imagen']['name'] != ''){
				$data['ingrediente_imagen'] = $uploadImage->upload("ingrediente_imagen");
			}
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['ingrediente_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR INGREDIENTE';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$ingrediente_producto = $this->_getSanitizedParam("ingrediente_producto");
		header('Location: '.$this->route.'?ingrediente_producto='.$ingrediente_producto.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un ingrediente  y redirecciona al listado de ingrediente.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->ingrediente_id) {
				$data = $this->getData();
				$uploadImage =  new Core_Model_Upload_Image();
				if($_FILES['ingrediente_imagen']['name'] != ''){
					if($content->ingrediente_imagen){
						$uploadImage->delete($content->ingrediente_imagen);
					}
					$data['ingrediente_imagen'] = $uploadImage->upload("ingrediente_imagen");
				} else {
					$data['ingrediente_imagen'] = $content->ingrediente_imagen;
				}
				$this->mainModel->update($data,$id);
			}
			$data['ingrediente_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR INGREDIENTE';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		$ingrediente_producto = $this->_getSanitizedParam("ingrediente_producto");
		header('Location: '.$this->route.'?ingrediente_producto='.$ingrediente_producto.'');
	}

	/**
     * Recibe un identificador  y elimina un ingrediente  y redirecciona al listado de ingrediente.
     *
     * @return void.
     */
	public function deleteAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadImage =  new Core_Model_Upload_Image();
					if (isset($content->ingrediente_imagen) && $content->ingrediente_imagen != '') {
						$uploadImage->delete($content->ingrediente_imagen);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR INGREDIENTE';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$ingrediente_producto = $this->_getSanitizedParam("ingrediente_producto");
		header('Location: '.$this->route.'?ingrediente_producto='.$ingrediente_producto.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Ingredientes.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['ingrediente_nombre'] = $this->_getSanitizedParam("ingrediente_nombre");
		$data['ingrediente_descripcion'] = $this->_getSanitizedParamHtml("ingrediente_descripcion");
		$data['ingrediente_imagen'] = "";
		if($this->_getSanitizedParam("ingrediente_estado") == '' ) {
			$data['ingrediente_estado'] = '0';
		} else {
			$data['ingrediente_estado'] = $this->_getSanitizedParam("ingrediente_estado");
		}
		$data['ingrediente_producto'] = $this->_getSanitizedParamHtml("ingrediente_producto");
		$data['ingrediente_precio'] = $this->_getSanitizedParam("ingrediente_precio");
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
		$ingrediente_producto= $this->_getSanitizedParam("ingrediente_producto");
		$filtros = $filtros." AND ingrediente_producto = '$ingrediente_producto' ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->ingrediente_nombre != '') {
                $filtros = $filtros." AND ingrediente_nombre LIKE '%".$filters->ingrediente_nombre."%'";
            }
            if ($filters->ingrediente_imagen != '') {
                $filtros = $filtros." AND ingrediente_imagen LIKE '%".$filters->ingrediente_imagen."%'";
            }
            if ($filters->ingrediente_estado != '') {
                $filtros = $filtros." AND ingrediente_estado LIKE '%".$filters->ingrediente_estado."%'";
            }
            if ($filters->ingrediente_producto != '') {
                $filtros = $filtros." AND ingrediente_producto LIKE '%".$filters->ingrediente_producto."%'";
            }
            if ($filters->ingrediente_precio != '') {
                $filtros = $filtros." AND ingrediente_precio LIKE '%".$filters->ingrediente_precio."%'";
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
        if ($this->getRequest()->isPost()== true) {
        	Session::getInstance()->set($this->namepageactual,1);
            $parramsfilter = array();
					$parramsfilter['ingrediente_nombre'] =  $this->_getSanitizedParam("ingrediente_nombre");
					$parramsfilter['ingrediente_imagen'] =  $this->_getSanitizedParam("ingrediente_imagen");
					$parramsfilter['ingrediente_estado'] =  $this->_getSanitizedParam("ingrediente_estado");
					$parramsfilter['ingrediente_producto'] =  $this->_getSanitizedParam("ingrediente_producto");
					$parramsfilter['ingrediente_precio'] =  $this->_getSanitizedParam("ingrediente_precio");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}