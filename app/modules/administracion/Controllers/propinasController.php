<?php
/**
* Controlador de Log que permite la  creacion, edicion  y eliminacion de los logs del Sistema
*/
class administracion_propinasController extends Administracion_mainController
{
      	public $botonpanel = 16;
	/**
	 * $mainModel  instancia del modelo de  base de datos logs
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
	protected $_csrf_section = "administracion_propinas";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
     * Inicializa las variables principales del controlador log .
     *
     * @return void.
     */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Log();
		$this->namefilter = "parametersfilterpropinas";
		$this->route = "/administracion/propinas";
		$this->namepages ="pages_propinas";
		$this->namepageactual ="page_actual_propinas";
		$this->_view->route = $this->route;
		if(Session::getInstance()->get($this->namepages)){
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
     * Recibe la informacion y  muestra un listado de  logs con sus respectivos filtros.
     *
     * @return void.
     */
	public function indexAction()
	{
		$title = "Propinas";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
	}

}