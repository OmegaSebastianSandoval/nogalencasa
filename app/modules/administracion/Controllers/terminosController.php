<?php
/**
* Controlador de Terminos que permite la  creacion, edicion  y eliminacion de los termino del Sistema
*/
class Administracion_terminosController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos termino
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
	protected $_csrf_section = "administracion_terminos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador terminos .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Terminos();
		$this->namefilter = "parametersfilterterminos";
		$this->route = "/administracion/terminos";
		$this->namepages ="pages_terminos";
		$this->namepageactual ="page_actual_terminos";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  termino con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de términos";
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
		$productoId = $this->_getSanitizedParam("termino_producto");
		if($productoId){
			$productosModel = new Administracion_Model_DbTable_Productos();
			$this->_view->producto = $productosModel->getById($productoId);
		}
		$this->_view->termino_producto = $this->_getSanitizedParam("termino_producto");
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  termino  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_terminos_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->termino_producto = $this->_getSanitizedParam("termino_producto");
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->termino_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar termino";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear termino";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear termino";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un termino  y redirecciona al listado de termino.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			$this->mainModel->changeOrder($id,$id);
			$data['termino_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR TERMINO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		$termino_producto = $this->_getSanitizedParam("termino_producto");
		header('Location: '.$this->route.'?termino_producto='.$termino_producto.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un termino  y redirecciona al listado de termino.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->termino_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['termino_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR TERMINO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		$termino_producto = $this->_getSanitizedParam("termino_producto");
		header('Location: '.$this->route.'?termino_producto='.$termino_producto.'');
	}

	/**
     * Recibe un identificador  y elimina un termino  y redirecciona al listado de termino.
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
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR TERMINO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		$termino_producto = $this->_getSanitizedParam("termino_producto");
		header('Location: '.$this->route.'?termino_producto='.$termino_producto.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Terminos.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['termino_nombre'] = $this->_getSanitizedParam("termino_nombre");
		$data['termino_tipo'] = $this->_getSanitizedParam("termino_tipo");
		$data['termino_producto'] = $this->_getSanitizedParamHtml("termino_producto");
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
		$termino_producto= $this->_getSanitizedParam("termino_producto");
		$filtros = $filtros." AND termino_producto = '$termino_producto' ";
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->termino_nombre != '') {
                $filtros = $filtros." AND termino_nombre LIKE '%".$filters->termino_nombre."%'";
            }
            if ($filters->termino_tipo != '') {
                $filtros = $filtros." AND termino_tipo LIKE '%".$filters->termino_tipo."%'";
            }
            if ($filters->termino_producto != '') {
                $filtros = $filtros." AND termino_producto LIKE '%".$filters->termino_producto."%'";
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
					$parramsfilter['termino_nombre'] =  $this->_getSanitizedParam("termino_nombre");
					$parramsfilter['termino_tipo'] =  $this->_getSanitizedParam("termino_tipo");
					$parramsfilter['termino_producto'] =  $this->_getSanitizedParam("termino_producto");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}