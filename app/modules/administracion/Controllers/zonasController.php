<?php
/**
* Controlador de Zonas que permite la  creacion, edicion  y eliminacion de los zonas del Sistema
*/
class Administracion_zonasController extends Administracion_mainController
{
	public $botonpanel = 7;
	/**
	 * $mainModel  instancia del modelo de  base de datos zonas
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
	protected $_csrf_section = "administracion_zonas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador zonas .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Zonas();
		$this->namefilter = "parametersfilterzonas";
		$this->route = "/administracion/zonas";
		$this->namepages ="pages_zonas";
		$this->namepageactual ="page_actual_zonas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  zonas con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de zonas";
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
     * Genera la Informacion necesaria para editar o crear un  zona  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_zonas_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->zona_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar zona";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear zona";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear zona";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un zona  y redirecciona al listado de zonas.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			
			$data['zona_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR ZONA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un zona  y redirecciona al listado de zonas.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->zona_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['zona_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR ZONA';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un zona  y redirecciona al listado de zonas.
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
					$data['log_tipo'] = 'BORRAR ZONA';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Zonas.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['zona_nombre'] = $this->_getSanitizedParam("zona_nombre");
		if($this->_getSanitizedParam("zona_calle_min") == '' ) {
			$data['zona_calle_min'] = '0';
		} else {
			$data['zona_calle_min'] = $this->_getSanitizedParam("zona_calle_min");
		}
		if($this->_getSanitizedParam("zona_calle_max") == '' ) {
			$data['zona_calle_max'] = '0';
		} else {
			$data['zona_calle_max'] = $this->_getSanitizedParam("zona_calle_max");
		}

		if($this->_getSanitizedParam("zona_calle_min2") == '' ) {
			$data['zona_calle_min2'] = '0';
		} else {
			$data['zona_calle_min2'] = $this->_getSanitizedParam("zona_calle_min2");
		}
		if($this->_getSanitizedParam("zona_calle_max2") == '' ) {
			$data['zona_calle_max2'] = '0';
		} else {
			$data['zona_calle_max2'] = $this->_getSanitizedParam("zona_calle_max2");
		}

		if($this->_getSanitizedParam("zona_cra_min") == '' ) {
			$data['zona_cra_min'] = '0';
		} else {
			$data['zona_cra_min'] = $this->_getSanitizedParam("zona_cra_min");
		}
		if($this->_getSanitizedParam("zona_cra_max") == '' ) {
			$data['zona_cra_max'] = '0';
		} else {
			$data['zona_cra_max'] = $this->_getSanitizedParam("zona_cra_max");
		}
		$data['zona_valor'] = $this->_getSanitizedParam("zona_valor");
		$data['zona_activa'] = $this->_getSanitizedParam("zona_activa");
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
            if ($filters->zona_nombre != '') {
                $filtros = $filtros." AND zona_nombre LIKE '%".$filters->zona_nombre."%'";
            }
            if ($filters->zona_calle_min != '') {
                $filtros = $filtros." AND zona_calle_min LIKE '%".$filters->zona_calle_min."%'";
            }
            if ($filters->zona_calle_max != '') {
                $filtros = $filtros." AND zona_calle_max LIKE '%".$filters->zona_calle_max."%'";
            }
            if ($filters->zona_cra_min != '') {
                $filtros = $filtros." AND zona_cra_min LIKE '%".$filters->zona_cra_min."%'";
            }
            if ($filters->zona_cra_max != '') {
                $filtros = $filtros." AND zona_cra_max LIKE '%".$filters->zona_cra_max."%'";
            }
            if ($filters->zona_valor != '') {
                $filtros = $filtros." AND zona_valor LIKE '%".$filters->zona_valor."%'";
            }
            if ($filters->zona_activa != '') {
                $filtros = $filtros." AND zona_activa LIKE '%".$filters->zona_activa."%'";
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
					$parramsfilter['zona_nombre'] =  $this->_getSanitizedParam("zona_nombre");
					$parramsfilter['zona_calle_min'] =  $this->_getSanitizedParam("zona_calle_min");
					$parramsfilter['zona_calle_max'] =  $this->_getSanitizedParam("zona_calle_max");
					$parramsfilter['zona_cra_min'] =  $this->_getSanitizedParam("zona_cra_min");
					$parramsfilter['zona_cra_max'] =  $this->_getSanitizedParam("zona_cra_max");
					$parramsfilter['zona_valor'] =  $this->_getSanitizedParam("zona_valor");
					$parramsfilter['zona_activa'] =  $this->_getSanitizedParam("zona_activa");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}