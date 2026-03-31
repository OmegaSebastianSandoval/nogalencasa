<?php
/**
 * Controlador de Pedidos que permite la  creacion, edicion  y eliminacion de los Pedidos del Sistema
 */
class Administracion_pedidosController extends Administracion_mainController
{
	public $botonpanel = 13;
	/**
	 * $mainModel  instancia del modelo de  base de datos Pedidos
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
	protected $_csrf_section = "administracion_pedidos";

	/**
	 * $namepages nombre de la pvariable en la cual se va a guardar  el numero de seccion en la paginacion del controlador
	 * @var string
	 */
	protected $namepages;



	/**
	 * Inicializa las variables principales del controlador pedidos .
	 *
	 * @return void.
	 */
	public function init()
	{
		$this->mainModel = new Administracion_Model_DbTable_Pedidos();
		$this->namefilter = "parametersfilterpedidos";
		$this->route = "/administracion/pedidos";
		$this->namepages = "pages_pedidos";
		$this->namepageactual = "page_actual_pedidos";
		$this->_view->route = $this->route;
		if (Session::getInstance()->get($this->namepages)) {
			$this->pages = Session::getInstance()->get($this->namepages);
		} else {
			$this->pages = 20;
		}
		parent::init();
	}


	/**
	 * Recibe la informacion y  muestra un listado de  Pedidos con sus respectivos filtros.
	 *
	 * @return void.
	 */
	public function indexAction()
	{
		$title = "Administración de Pedidos";
		$this->getLayout()->setTitle($title);
		$this->_view->titlesection = $title;
		$this->filters();
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$filters = (object) Session::getInstance()->get($this->namefilter);
		$this->_view->filters = $filters;
		$filters = $this->getFilter();
		$order = " pedido_fecha DESC ";
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
		$this->_view->lists = $lists = $this->mainModel->getListPages($filters, $order, $start, $amount);

		$sociosModel = new Administracion_Model_DbTable_Socios();
		foreach ($lists as $key => $value) {
			$cedula = $value->pedido_documento;
			$value->socio = $sociosModel->getList(" socio_cedula='$cedula' ", "")[0];
		}
		$this->_view->lists = $lists;

		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->list_pedido_medio = $this->getPedidomedio();
		$this->_view->list_pedido_forma_envio = $this->getPedidoformaenvio();
		$this->_view->list_pedido_estado = $this->getPedidoestado();
	}

	/**
	 * Genera la Informacion necesaria para editar o crear un  Pedido  y muestra su formulario
	 *
	 * @return void.
	 */
	public function manageAction()
	{
		$this->_view->route = $this->route;
		$this->_csrf_section = "manage_pedidos_" . date("YmdHis");
		$this->_csrf->generateCode($this->_csrf_section);
		$this->_view->csrf_section = $this->_csrf_section;
		$this->_view->csrf = Session::getInstance()->get('csrf')[$this->_csrf_section];
		$this->_view->list_pedido_tipodocumento = $this->getPedidotipodocumento();
		$this->_view->list_pedido_medio = $this->getPedidomedio();
		$this->_view->list_pedido_forma_envio = $this->getPedidoformaenvio();
		$this->_view->list_pedido_estado = $this->getPedidoestado();
		$id = $this->_getSanitizedParam("id");
		if ($id > 0) {
			$content = $this->mainModel->getById($id);
			if ($content->pedido_id) {
				$this->_view->content = $content;
				$this->_view->routeform = $this->route . "/update";
				$title = "Actualizar Pedido";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			} else {
				$this->_view->routeform = $this->route . "/insert";
				$title = "Crear Pedido";
				$this->getLayout()->setTitle($title);
				$this->_view->titlesection = $title;
			}
		} else {
			$this->_view->routeform = $this->route . "/insert";
			$title = "Crear Pedido";
			$this->getLayout()->setTitle($title);
			$this->_view->titlesection = $title;
		}

		$productosModel = new Page_Model_DbTable_Productoscarrito();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();
		$productoModel = new Page_Model_DbTable_Productos();

		$productos = $productosModel->getList(" id_carrito='$id' ", "");

		foreach ($productos as $key => $value) {
			$productoId = $productoModel->getById($value->id_productos);
			$value->categorianombre = $categoriasModel->getById($productoId->productos_categorias)->categorias_nombre;
			$value->subcategoriacategorianombre = $categoriasModel->getById($productoId->productos_subcategoria)->categorias_nombre;

			$value->productoinfo = $productoId;


		}

		$this->_view->productos = $productos;


		$sociosModel = new Administracion_Model_DbTable_Socios();
		$cedula = $content->pedido_documento;
		$this->_view->socio = $socio = $sociosModel->getList(" socio_cedula='$cedula' ", "")[0];

		if ($content->pedido_numeroaccion != "") {
			$tipo = "SOCIO";
		} else {
			if ($content->pedido_quien_accion == "" or $content->pedido_quien_accion == "00000000") {
				$tipo = "INVITADO NUX";
			} else {
				$socio_carnet = str_pad($content->pedido_quien_accion, 8, "0", STR_PAD_LEFT);
				$this->_view->socio = $sociosModel->getList(" socio_carnet='$socio_carnet' ", "")[0];
				$tipo = "INVITADO";
			}
		}
		$this->_view->tipo = $tipo;

	}

	/**
	 * Inserta la informacion de un Pedido  y redirecciona al listado de Pedidos.
	 *
	 * @return void.
	 */
	public function insertAction()
	{
		$this->setLayout('blanco');
		$csrf = $this->_getSanitizedParam("csrf");
		if (Session::getInstance()->get('csrf')[$this->_getSanitizedParam("csrf_section")] == $csrf) {
			$data = $this->getData();
			$id = $this->mainModel->insert($data);
			$data['pedido_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'CREAR PEDIDO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);

			$data['pedido_complemento'] = $this->_getSanitizedParam("pedido_complemento");
			$data['pedido_indicaciones'] = $this->_getSanitizedParam("pedido_indicaciones");
			$this->mainModel->editField($id, "pedido_complemento", $data['pedido_complemento']);
			$this->mainModel->editField($id, "pedido_indicaciones", $data['pedido_indicaciones']);

		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y Actualiza la informacion de un Pedido  y redirecciona al listado de Pedidos.
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
			if ($content->pedido_id) {
				$data = $this->getData();
				$this->mainModel->update($data, $id);
			}
			$data['pedido_id'] = $id;
			$data['log_log'] = print_r($data, true);
			$data['log_tipo'] = 'EDITAR PEDIDO';
			$logModel = new Administracion_Model_DbTable_Log();
			$logModel->insert($data);

			$data['pedido_complemento'] = $this->_getSanitizedParam("pedido_complemento");
			$data['pedido_indicaciones'] = $this->_getSanitizedParam("pedido_indicaciones");
			$this->mainModel->editField($id, "pedido_complemento", $data['pedido_complemento']);
			$this->mainModel->editField($id, "pedido_indicaciones", $data['pedido_indicaciones']);

		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe un identificador  y elimina un Pedido  y redirecciona al listado de Pedidos.
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
					$this->mainModel->deleteRegister($id);
					$data = (array) $content;
					$data['log_log'] = print_r($data, true);
					$data['log_tipo'] = 'BORRAR PEDIDO';
					$logModel = new Administracion_Model_DbTable_Log();
					$logModel->insert($data);
				}
			}
		}
		header('Location: ' . $this->route . '' . '');
	}

	/**
	 * Recibe la informacion del formulario y la retorna en forma de array para la edicion y creacion de Pedidos.
	 *
	 * @return array con toda la informacion recibida del formulario.
	 */
	private function getData()
	{
		$data = array();
		$data['pedido_tipodocumento'] = $this->_getSanitizedParam("pedido_tipodocumento");
		$data['pedido_documento'] = $this->_getSanitizedParam("pedido_documento");
		$data['pedido_nombre'] = $this->_getSanitizedParam("pedido_nombre");
		$data['pedido_correo'] = $this->_getSanitizedParam("pedido_correo");
		$data['pedido_telefono'] = $this->_getSanitizedParam("pedido_telefono");
		$data['pedido_celular'] = $this->_getSanitizedParam("pedido_celular");
		$data['pedido_nomenclatura'] = '';
		$data['pedido_direccion'] = $this->_getSanitizedParam("pedido_direccion");
		$data['pedido_ciudad'] = '';
		$data['pedido_envio'] = $this->_getSanitizedParam("pedido_envio");
		$data['pedido_medio'] = $this->_getSanitizedParam("pedido_medio");
		$data['pedido_forma_envio'] = $this->_getSanitizedParam("pedido_forma_envio");
		$data['pedido_fecha'] = $this->_getSanitizedParam("pedido_fecha");
		if ($this->_getSanitizedParam("pedido_valorpagar") == '') {
			$data['pedido_valorpagar'] = '0';
		} else {
			$data['pedido_valorpagar'] = $this->_getSanitizedParam("pedido_valorpagar");
		}
		$data['pedido_zona'] = '';
		if ($this->_getSanitizedParam("pedido_estado") == '') {
			$data['pedido_estado'] = '0';
		} else {
			$data['pedido_estado'] = $this->_getSanitizedParam("pedido_estado");
		}
		$data['pedido_estado_texto'] = $this->_getSanitizedParam("pedido_estado_texto");
		$data['pedido_estado_texto2'] = $this->_getSanitizedParam("pedido_estado_texto2");
		$data['pedido_cus'] = $this->_getSanitizedParam("pedido_cus");
		$data['request_id'] = $this->_getSanitizedParam("request_id");

		$data['pedido_nombrefe'] = $this->_getSanitizedParam("pedido_nombrefe");
		$data['pedido_correofe'] = $this->_getSanitizedParam("pedido_correofe");
		$data['pedido_celularfe'] = $this->_getSanitizedParam("pedido_celularfe");
		return $data;
	}

	/**
	 * Genera los valores del campo Tipo Documento.
	 *
	 * @return array cadena con los valores del campo Tipo Documento.
	 */
	private function getPedidotipodocumento()
	{
		$array = array();
		$array['CC'] = 'CC';
		$array['CE'] = 'CE';
		$array['PS'] = 'PASAPORTE';
		$array['NIT'] = 'NIT';
		return $array;
	}


	/**
	 * Genera los valores del campo Metodo de pago.
	 *
	 * @return array cadena con los valores del campo Metodo de pago.
	 */
	private function getPedidomedio()
	{
		$array = array();
		$array[1] = 'Cargo a la acción';
		$array[2] = 'Pago en línea';
		return $array;
	}


	/**
	 * Genera los valores del campo Forma de envio.
	 *
	 * @return array cadena con los valores del campo Forma de envio.
	 */
	private function getPedidoformaenvio()
	{
		$array = array();
		$array[1] = 'Domicilio';
		$array[2] = 'Recoger en el Club';
		return $array;
	}


	/**
	 * Genera los valores del campo Estado.
	 *
	 * @return array cadena con los valores del campo Estado.
	 */
	private function getPedidoestado()
	{
		$array = array();
		$array[1] = 'Aprobado';
		$array[2] = 'Pendiente';
		$array[3] = 'Fallido';
		$array[4] = 'Rechazado';
		$array[10] = 'Enviado';
		$array[11] = 'Entregado';
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
		if (Session::getInstance()->get($this->namefilter) != "") {
			$filters = (object) Session::getInstance()->get($this->namefilter);
			if ($filters->pedido_documento != '') {
				$filtros = $filtros . " AND pedido_documento LIKE '%" . $filters->pedido_documento . "%'";
			}
			if ($filters->pedido_nombre != '') {
				$filtros = $filtros . " AND pedido_nombre LIKE '%" . $filters->pedido_nombre . "%'";
			}
			if ($filters->pedido_correo != '') {
				$filtros = $filtros . " AND pedido_correo LIKE '%" . $filters->pedido_correo . "%'";
			}
			if ($filters->pedido_medio != '') {
				$filtros = $filtros . " AND pedido_medio ='" . $filters->pedido_medio . "'";
			}
			if ($filters->pedido_forma_envio != '') {
				$filtros = $filtros . " AND pedido_forma_envio ='" . $filters->pedido_forma_envio . "'";
			}
			if ($filters->pedido_fecha != '') {
				$filtros = $filtros . " AND pedido_fecha LIKE '%" . $filters->pedido_fecha . "%'";
			}
			if ($filters->pedido_valorpagar != '') {
				$filtros = $filtros . " AND pedido_valorpagar LIKE '%" . $filters->pedido_valorpagar . "%'";
			}
			if ($filters->pedido_estado != '') {
				$filtros = $filtros . " AND pedido_estado ='" . $filters->pedido_estado . "'";
			}
			if ($filters->pedido_id != '') {
				$filtros = $filtros . " AND pedido_id ='" . $filters->pedido_id . "'";
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
			$parramsfilter['pedido_documento'] = $this->_getSanitizedParam("pedido_documento");
			$parramsfilter['pedido_nombre'] = $this->_getSanitizedParam("pedido_nombre");
			$parramsfilter['pedido_correo'] = $this->_getSanitizedParam("pedido_correo");
			$parramsfilter['pedido_medio'] = $this->_getSanitizedParam("pedido_medio");
			$parramsfilter['pedido_forma_envio'] = $this->_getSanitizedParam("pedido_forma_envio");
			$parramsfilter['pedido_fecha'] = $this->_getSanitizedParam("pedido_fecha");
			$parramsfilter['pedido_valorpagar'] = $this->_getSanitizedParam("pedido_valorpagar");
			$parramsfilter['pedido_estado'] = $this->_getSanitizedParam("pedido_estado");
			$parramsfilter['pedido_id'] = $this->_getSanitizedParam("pedido_id");
			Session::getInstance()->set($this->namefilter, $parramsfilter);
		}
		if ($this->_getSanitizedParam("cleanfilter") == 1) {
			Session::getInstance()->set($this->namefilter, '');
			Session::getInstance()->set($this->namepageactual, 1);
		}
	}


	public function exportarAction()
	{


		$hoy = date("YmdHis");
		$excel = $this->_getSanitizedParam("excel");
		if ($excel == 1) {
			$this->setLayout('blanco');
			header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
			header("Content-type:   application/x-msexcel; charset=utf-8");
			header("Content-Disposition: attachment; filename=exportar-pedidos-" . $hoy . ".xls");
		}


		$pedidosModel = new Administracion_Model_DbTable_Pedidos();
		$productosModel = new Page_Model_DbTable_Productoscarrito();
		$productoModel = new Administracion_Model_DbTable_Productos();
		$categoriasModel = new Administracion_Model_DbTable_Categorias();

		$fecha1 = $this->_getSanitizedParam("fecha1");
		$fecha2 = $this->_getSanitizedParam("fecha2");
		$f1 = " 1=1 ";
		if ($fecha1 != "" and $fecha2 != "") {
			$fecha1 .= " 00:00:00";
			$fecha2 .= " 23:59:59";
			$f1 .= " AND pedido_fecha>='$fecha1' AND pedido_fecha<='$fecha2' ";
		}

		$limite = "LIMIT 100";
		if ($excel == "1") {
			$limite = "";
		}

		$pedidos = $pedidosModel->getList(" $f1 $limite ", "");

		foreach ($pedidos as $key => $value) {
			$id = $value->pedido_id;
			$productos = $productosModel->getList(" id_carrito='$id' ", "");
			$value->productos = $productos;
		}


		$this->_view->pedidos = $pedidos;

		$sociosModel = new Administracion_Model_DbTable_Socios();
		$socios = $sociosModel->getList("", "");
		$array_socios = array();
		foreach ($socios as $socio) {
			$array_socios[$socio->socio_cedula] = $socio;
			$array_accion[$socio->socio_carnet] = $socio->nombre;
		}
		$this->_view->array_socios = $array_socios;
		$this->_view->array_accion = $array_accion;


		$this->_view->list_pedido_medio = $this->getPedidomedio();
		$this->_view->list_pedido_forma_envio = $this->getPedidoformaenvio();
		$this->_view->list_pedido_estado = $this->getPedidoestado();

		$array_categorias = array();
		$array_codigos = array();
		$productos1 = $productoModel->getList("", "");
		foreach ($productos1 as $key => $value) {
			$productos_id = $value->productos_id;
			$categoria_id = $value->productos_categorias;
			$categoria = $categoriasModel->getById($categoria_id);
			$array_categorias[$productos_id] = $categoria->categorias_nombre;

			$array_codigos[$productos_id] = $value->productos_codigo;
		}

		$this->_view->array_categorias = $array_categorias;
		$this->_view->array_codigos = $array_codigos;


	}


}