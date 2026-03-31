<?php
/**
* Controlador de Direcciones que permite la  creacion, edicion  y eliminacion de los direccion del Sistema
*/
class Administracion_direccionesController extends Administracion_mainController
{
	/**
	 * $mainModel  instancia del modelo de  base de datos direccion
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
	protected $_csrf_section = "administracion_direcciones";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador direcciones .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Direcciones();
		$this->namefilter = "parametersfilterdirecciones";
		$this->route = "/administracion/direcciones";
		$this->namepages ="pages_direcciones";
		$this->namepageactual ="page_actual_direcciones";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  direccion con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de direccion";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters =(object)Session::getInstance()->get($this->namefilter);
        $this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = "";
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
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  direccion  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_direcciones_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->direccion_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar direccion";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear direccion";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear direccion";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un direccion  y redirecciona al listado de direccion.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			
			$data['direccion_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR DIRECCION';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un direccion  y redirecciona al listado de direccion.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->direccion_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['direccion_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR DIRECCION';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un direccion  y redirecciona al listado de direccion.
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
					$data['log_tipo'] = 'BORRAR DIRECCION';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Direcciones.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['direccion_usuario'] = $this->_getSanitizedParam("direccion_usuario");
		$data['direccion_nomenclatura'] = $this->_getSanitizedParam("direccion_nomenclatura");
		$data['direccion_numero1'] = $this->_getSanitizedParam("direccion_numero1");
		$data['direccion_letra1'] = $this->_getSanitizedParam("direccion_letra1");
		$data['direccion_numero2'] = $this->_getSanitizedParam("direccion_numero2");
		$data['direccion_letra2'] = $this->_getSanitizedParam("direccion_letra2");
		$data['direccion_numero3'] = $this->_getSanitizedParam("direccion_numero3");
		$data['direccion_complemento'] = $this->_getSanitizedParam("direccion_complemento");
		$data['direccion_indicaciones'] = $this->_getSanitizedParam("direccion_indicaciones");
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
        if (Session::getInstance()->get($this->namefilter)!="") {
            $filters =(object)Session::getInstance()->get($this->namefilter);
            if ($filters->direccion_usuario != '') {
                $filtros = $filtros." AND direccion_usuario LIKE '%".$filters->direccion_usuario."%'";
            }
            if ($filters->direccion_nomenclatura != '') {
                $filtros = $filtros." AND direccion_nomenclatura LIKE '%".$filters->direccion_nomenclatura."%'";
            }
            if ($filters->direccion_numero1 != '') {
                $filtros = $filtros." AND direccion_numero1 LIKE '%".$filters->direccion_numero1."%'";
            }
            if ($filters->direccion_letra1 != '') {
                $filtros = $filtros." AND direccion_letra1 LIKE '%".$filters->direccion_letra1."%'";
            }
            if ($filters->direccion_numero2 != '') {
                $filtros = $filtros." AND direccion_numero2 LIKE '%".$filters->direccion_numero2."%'";
            }
            if ($filters->direccion_letra2 != '') {
                $filtros = $filtros." AND direccion_letra2 LIKE '%".$filters->direccion_letra2."%'";
            }
            if ($filters->direccion_numero3 != '') {
                $filtros = $filtros." AND direccion_numero3 LIKE '%".$filters->direccion_numero3."%'";
            }
            if ($filters->direccion_complemento != '') {
                $filtros = $filtros." AND direccion_complemento LIKE '%".$filters->direccion_complemento."%'";
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
					$parramsfilter['direccion_usuario'] =  $this->_getSanitizedParam("direccion_usuario");
					$parramsfilter['direccion_nomenclatura'] =  $this->_getSanitizedParam("direccion_nomenclatura");
					$parramsfilter['direccion_numero1'] =  $this->_getSanitizedParam("direccion_numero1");
					$parramsfilter['direccion_letra1'] =  $this->_getSanitizedParam("direccion_letra1");
					$parramsfilter['direccion_numero2'] =  $this->_getSanitizedParam("direccion_numero2");
					$parramsfilter['direccion_letra2'] =  $this->_getSanitizedParam("direccion_letra2");
					$parramsfilter['direccion_numero3'] =  $this->_getSanitizedParam("direccion_numero3");
					$parramsfilter['direccion_complemento'] =  $this->_getSanitizedParam("direccion_complemento");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}