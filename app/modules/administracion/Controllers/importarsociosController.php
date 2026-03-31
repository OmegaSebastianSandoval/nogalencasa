<?php
/**
* Controlador de Importarcedulas que permite la  creacion, edicion  y eliminacion de los importar cedulas del Sistema
*/
class Administracion_importarsociosController extends Administracion_mainController
{
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
		$this->route = "/administracion/importarsocios";
		$this->namepages ="pages_importarcedulas";
		$this->namepageactual ="page_actual_importarcedulas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
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
     * Genera la Informacion necesaria para editar o crear un  importar cedulas  y muestra su formulario
     *
     * @return void.
     */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_importarcedulas_".date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if($content->archivo_id){
				$this->_view->content = $content;
				$this->_view->routeform = $this->route."/update";
				$title = "Actualizar importar socios";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}else{
				$this->_view->routeform = $this->route."/insert";
				$title = "Crear importar socios";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route."/insert";
			$title = "Crear importar socios";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}
	}

	/**
     * Inserta la informacion de un importar cedulas  y redirecciona al listado de importar cedulas.
     *
     * @return void.
     */
	public function insertAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$data = $this->getData();
			$uploadDocument =  new Core_Model_Upload_Document();
			if($_FILES['archivo_cedulas']['name'] != ''){
				$data['archivo_cedulas'] = $uploadDocument->upload("archivo_cedulas");
			}
			$id = $this->mainModel->insert($data);

			$data['archivo_id']= $id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'CREAR IMPORTAR SOCIOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe un identificador  y Actualiza la informacion de un importar cedulas  y redirecciona al listado de importar cedulas.
     *
     * @return void.
     */
	public function updateAction(){
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf ) {
			$id = $this->_getSanitizedParam("id");
			$content = $this->mainModel->getById($id);
			if ($content->archivo_id) {
				$data = $this->getData();
					$uploadDocument =  new Core_Model_Upload_Document();
				if($_FILES['archivo_cedulas']['name'] != ''){
					if($content->archivo_cedulas){
						$uploadDocument->delete($content->archivo_cedulas);
					}
					$data['archivo_cedulas'] = $uploadDocument->upload("archivo_cedulas");
				} else {
					$data['archivo_cedulas'] = $content->archivo_cedulas;
				}
				$this->mainModel->update($data,$id);
			}
			$data['archivo_id']=$id;
			$data['log_log'] = print_r($data,true);
			$data['log_tipo'] = 'EDITAR IMPORTAR SOCIOS';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);
		}
		//header('Location: '.$this->route.''.'');
		header('Location: '.$this->route.'/carga/');
	}


	public function cargaAction()
	{
		$id = 1;
		$content = $this->mainModel->getById($id);
		$archivo = $content->archivo_cedulas;
		$this->getLayout()->setTitle("Importar socios");

		//leer archivo
    	ini_set('memory_limit', '-1');
    	ini_set('max_execution_time', 300);
    	$inputFileName = FILE_PATH.'/'.$archivo;
   		/* $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		$infoexel = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true); */
		$objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		$infoexel = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$sociosModel = new Administracion_Model_DbTable_Socios();
		$i=0;
		$hoy = date("Y-m-d H:i:s");

		foreach ($infoexel as $fila) {
			$i++;

			if($i>1){


				$socio_cedula = $data['socio_cedula'] = trim($fila['A']);
				$socio_tipo_documento = $data['socio_tipo_documento'] = trim($fila['B']);
				$socio_nombre = $data['socio_nombre'] = trim($fila['C']);
				$socio_carnet = $data['socio_carnet'] = $fila['D'];
				$socio_direccion = $data['socio_direccion'] = $fila['E'];
				$socio_ciudad = $data['socio_ciudad'] = $fila['F'];
				$socio_correo = $data['socio_correo'] = $fila['G'];

				if(strpos($socio_correo,"@")===FALSE){
					$socio_correo = $data['socio_correo'] = "";
				}

				$socio_telefono = $data['socio_telefono'] = $fila['H'];
				$socio_celular = $data['socio_celular'] = $fila['I'];

				if($socio_celular=="0" or $socio_celular == "0-0"){
					$socio_celular = $data['socio_celular'] = "";
				}

				$socio_tipo_documento = str_replace(" ","",$socio_tipo_documento);

				$socio_estado = $data['socio_estado'] = trim($fila['J']);


				$socio_tipo_documento = str_replace(" ","",$socio_tipo_documento);
				$socio_tipo_documento = str_replace(".","",$socio_tipo_documento);
				$data['socio_tipo_documento'] = $socio_tipo_documento;

				if($socio_estado=="Activo" or $socio_estado==""){
					$socio_estado = $data['socio_estado'] = 1;
				}else{
					$socio_estado = $data['socio_estado'] = 0;
				}


				$existe = $sociosModel->getList(" socio_cedula='$socio_cedula' ","");
				if(count($existe)==0){
					if($data['socio_cedula']!=""){
						$id = $sociosModel->insert($data);
					}
				}else{
					$socio1 = $existe[0];
					$id = $socio1->socio_id;

					//echo $i." ".$socio_cedula." estado:".$socio_estado."<br>";


					if($socio_tipo_documento!="" and $socio_tipo_documento!=$socio1->socio_tipo_documento){
						$sociosModel->editField($id,"socio_tipo_documento",$socio_tipo_documento);
					}
					if($socio_nombre!="" and $socio_nombre!=$socio1->socio_nombre){
						$sociosModel->editField($id,"socio_nombre",$socio_nombre);
					}
					if($socio_carnet!="" and $socio_carnet!=$socio1->socio_carnet){
						$sociosModel->editField($id,"socio_carnet",$socio_carnet);
					}
					/* if($productos_precio!="" and $productos_precio!=$socio1->productos_precio){
						$sociosModel->editField($id,"productos_precio",$productos_precio);
					} */
					if($socio_direccion!="" and $socio_direccion!=$socio1->socio_direccion){
						$sociosModel->editField($id,"socio_direccion",$socio_direccion);
					}
					if($socio_ciudad!="" and $socio_ciudad!=$socio1->socio_ciudad){
						$sociosModel->editField($id,"socio_ciudad",$socio_ciudad);
					}
					if($socio_correo!="" and $socio_correo!=$socio1->socio_correo){
						$sociosModel->editField($id,"socio_correo",$socio_correo);
					}
					if($socio_telefono!="" and $socio_telefono!=$socio1->socio_telefono){
						$sociosModel->editField($id,"socio_telefono",$socio_telefono);
					}
					if($socio_celular!="" and $socio_celular!=$socio1->socio_celular){
						$sociosModel->editField($id,"socio_celular",$socio_celular);
					}
					if($socio_estado!=$socio1->socio_estado){
						$sociosModel->editField($id,"socio_estado",$socio_estado);
					}

				}

			}

			//$contador[$socio_cedula]++;

		}

		/*
		foreach($contador as $value){
			if($value>1){
				$repetidos+=$value-1;
			}
		}
		echo "<br>repetidos:".$repetidos;
		*/

		header("Location:/administracion/socios/");
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
		if (Session::getInstance()->get('csrf')[$this->_csrf_section] == $csrf ) {
			$id =  $this->_getSanitizedParam("id");
			if (isset($id) && $id > 0) {
				$content = $this->mainModel->getById($id);
				if (isset($content)) {
					$uploadDocument =  new Core_Model_Upload_Document();
					if (isset($content->archivo_cedulas) && $content->archivo_cedulas != '') {
						$uploadDocument->delete($content->archivo_cedulas);
					}
					$this->mainModel->deleteRegister($id);$data = (array)$content;
					$data['log_log'] = print_r($data,true);
					$data['log_tipo'] = 'BORRAR IMPORTAR SOCIOS';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data); }
			}
		}
		header('Location: '.$this->route.''.'');
	}

	/**
     * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Importarcedulas.
     *
     * @return array con toda la informacion recibida del formulario.
     */
	private function getData()
	{
		$data = array();
		$data['archivo_puntos'] = '' ;
		$data['archivo_cedulas'] = "";
		$data['archivo_productos'] = '' ;
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
            if ($filters->archivo_cedulas != '') {
                $filtros = $filtros." AND archivo_cedulas LIKE '%".$filters->archivo_cedulas."%'";
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
			$parramsfilter['archivo_cedulas'] =  $this->_getSanitizedParam("archivo_cedulas");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
        }
        if ($this->_getSanitizedParam("cleanfilter") == 1) {
            Session::getInstance()->set($this->namefilter, '');
            Session::getInstance()->set($this->namepageactual,1);
        }
    }
}