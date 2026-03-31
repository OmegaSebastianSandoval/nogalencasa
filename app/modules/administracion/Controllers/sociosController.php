<?php
/**
* Controlador de Socios que permite la  creacion, edicion  y eliminacion de los Socios del Sistema
*/
class Administracion_sociosController extends Administracion_mainController
{
    
    	public $botonpanel =11;

	/**
	 * $mainModel  instancia del modelo de  base de datos Socios
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
	protected $_csrf_section = "administracion_socios";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador socios .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Socios();
		$this->namefilter = "parametersfiltersocios";
		$this->route = "/administracion/socios";
		$this->namepages ="pages_socios";
		$this->namepageactual ="page_actual_socios";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  Socios con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de Socios";
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
		$this->_view->list_socio_tipo_documento = $this->getSociotipodocumento();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  Socio  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_socios_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_socio_tipo_documento = $this->getSociotipodocumento();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->socio_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar Socio";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear Socio";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear Socio";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un Socio  y redirecciona al listado de Socios.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			
			$data['socio_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR SOCIO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un Socio  y redirecciona al listado de Socios.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->socio_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['socio_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR SOCIO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y elimina un Socio  y redirecciona al listado de Socios.
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
					$data['log_tipo'] = 'BORRAR SOCIO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Socios.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['socio_cedula'] = $this->_getSanitizedParam("socio_cedula");
		$data['socio_tipo_documento'] = $this->_getSanitizedParam("socio_tipo_documento");
		$data['socio_nombre'] = $this->_getSanitizedParam("socio_nombre");
		$data['socio_carnet'] = $this->_getSanitizedParam("socio_carnet");
		$data['socio_direccion'] = $this->_getSanitizedParam("socio_direccion");
		$data['socio_ciudad'] = $this->_getSanitizedParam("socio_ciudad");
		$data['socio_correo'] = $this->_getSanitizedParam("socio_correo");
		$data['socio_telefono'] = $this->_getSanitizedParam("socio_telefono");
		$data['socio_celular'] = $this->_getSanitizedParam("socio_celular");
		$data['socio_estado'] = $this->_getSanitizedParam("socio_estado");
		return $data;
	}

	/**
     * Genera los valores del campo Tipo documento.
     *
     * @return array cadena con los valores del campo Tipo documento.
     */
	private function getSociotipodocumento()
	{
		$array = array();
		$array['CC'] = 'CC';
		$array['CE'] = 'CE';
		$array['PS'] = 'PASAPORTE';
		$array['NIT'] = 'NIT';
		$array['RC'] = 'RC';
		$array['TI'] = 'TI';
		return $array;
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
            if ($filters->socio_cedula != '') {
                $filtros = $filtros." AND socio_cedula LIKE '%".$filters->socio_cedula."%'";
            }
            if ($filters->socio_tipo_documento != '') {
                $filtros = $filtros." AND socio_tipo_documento ='".$filters->socio_tipo_documento."'";
            }
            if ($filters->socio_nombre != '') {
                $filtros = $filtros." AND socio_nombre LIKE '%".$filters->socio_nombre."%'";
            }
            if ($filters->socio_carnet != '') {
                $filtros = $filtros." AND socio_carnet LIKE '%".$filters->socio_carnet."%'";
            }
            if ($filters->socio_correo != '') {
                $filtros = $filtros." AND socio_correo LIKE '%".$filters->socio_correo."%'";
            }
            if ($filters->socio_celular != '') {
                $filtros = $filtros." AND socio_celular LIKE '%".$filters->socio_celular."%'";
            }
            if ($filters->socio_estado != '') {
                $filtros = $filtros." AND socio_estado LIKE '%".$filters->socio_estado."%'";
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
					$parramsfilter['socio_cedula'] =  $this->_getSanitizedParam("socio_cedula");
					$parramsfilter['socio_tipo_documento'] =  $this->_getSanitizedParam("socio_tipo_documento");
					$parramsfilter['socio_nombre'] =  $this->_getSanitizedParam("socio_nombre");
					$parramsfilter['socio_carnet'] =  $this->_getSanitizedParam("socio_carnet");
					$parramsfilter['socio_correo'] =  $this->_getSanitizedParam("socio_correo");
					$parramsfilter['socio_celular'] =  $this->_getSanitizedParam("socio_celular");
					$parramsfilter['socio_estado'] =  $this->_getSanitizedParam("socio_estado");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }


    public function exportarAction(){

    	$list = $this->mainModel->getList("","");
    	$this->_view->list = $list;

		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");
		if($excel==1){
			$this->setLayout('blanco');
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=exportar-socios-".$hoy.".xls");
		}

    }

}