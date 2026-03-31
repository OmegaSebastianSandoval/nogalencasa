<?php
/**
* Controlador de Configpropinas que permite la  creacion, edicion  y eliminacion de los cofiguraci&oacute;n propinas del Sistema
*/
class Administracion_configpropinasController extends Administracion_mainController
{

	public $botonpanel = 16;
	/**
	 * $mainModel  instancia del modelo de  base de datos cofiguraci&oacute;n propinas
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
	protected $_csrf_section = "administracion_configpropinas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador configpropinas .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Configpropinas();
		$this->namefilter = "parametersfilterconfigpropinas";
		$this->route = "/administracion/configpropinas";
		$this->namepages ="pages_configpropinas";
		$this->namepageactual ="page_actual_configpropinas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  cofiguraci&oacute;n propinas con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Administración de cofiguraci&oacute;n propinas";
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
		$this->_view->list_config_tipo = $this->getConfigtipo();
	}

	/**
     * Genera la Informacion necesaria para editar o crear un  cofiguraci&oacute;n propinas  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_configpropinas_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_config_tipo = $this->getConfigtipo();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->config_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar cofiguraci&oacute;n propinas";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear cofiguraci&oacute;n propinas";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear cofiguraci&oacute;n propinas";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un cofiguraci&oacute;n propinas  y redirecciona al listado de cofiguraci&oacute;n propinas.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {	
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			
			$data['config_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR COFIGURACI&OACUTE;N PROPINAS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un cofiguraci&oacute;n propinas  y redirecciona al listado de cofiguraci&oacute;n propinas.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->config_id) {
				$data = $this->getData();
					$this->mainModel->update($data,$id);
			}
			$data['config_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR COFIGURACI&OACUTE;N PROPINAS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);}
		header('Location: /administracion/configpropinas/manage/?id=1');
	}

	/**
     * Recibe un identificador  y elimina un cofiguraci&oacute;n propinas  y redirecciona al listado de cofiguraci&oacute;n propinas.
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
					$data['log_tipo'] = 'BORRAR COFIGURACI&OACUTE;N PROPINAS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Configpropinas.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['config_tipo'] = $this->_getSanitizedParam("config_tipo");
		$data['config_valor_minimo'] = $this->_getSanitizedParam("config_valor_minimo");
		$data['config_valor_maximo'] = $this->_getSanitizedParam("config_valor_maximo");
		$data['config_porcentaje'] = $this->_getSanitizedParam("config_porcentaje");
		$data['config_opcional'] = $this->_getSanitizedParam("config_opcional");
		return $data;
	}

	/**
     * Genera los valores del campo tipo.
     *
     * @return array cadena con los valores del campo tipo.
     */
	private function getConfigtipo()
	{
		$array = array();
		$array['0'] = 'Sin propina';
		$array['1'] = 'Valor abierto';
		$array['2'] = 'Menú de opciones';
		$array['3'] = 'Porcentaje sobre la compra';
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
            if ($filters->config_tipo != '') {
                $filtros = $filtros." AND config_tipo ='".$filters->config_tipo."'";
            }
            if ($filters->config_valor_minimo != '') {
                $filtros = $filtros." AND config_valor_minimo LIKE '%".$filters->config_valor_minimo."%'";
            }
            if ($filters->config_valor_maximo != '') {
                $filtros = $filtros." AND config_valor_maximo LIKE '%".$filters->config_valor_maximo."%'";
            }
            if ($filters->config_porcentaje != '') {
                $filtros = $filtros." AND config_porcentaje LIKE '%".$filters->config_porcentaje."%'";
            }
            if ($filters->config_opcional != '') {
                $filtros = $filtros." AND config_opcional LIKE '%".$filters->config_opcional."%'";
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
					$parramsfilter['config_tipo'] =  $this->_getSanitizedParam("config_tipo");
					$parramsfilter['config_valor_minimo'] =  $this->_getSanitizedParam("config_valor_minimo");
					$parramsfilter['config_valor_maximo'] =  $this->_getSanitizedParam("config_valor_maximo");
					$parramsfilter['config_porcentaje'] =  $this->_getSanitizedParam("config_porcentaje");
					$parramsfilter['config_opcional'] =  $this->_getSanitizedParam("config_opcional");Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}