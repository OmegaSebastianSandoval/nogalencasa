<?php 

/**
*
*/

class Page_contenidosController extends Page_mainController
{

	public function indexAction()
	{
      $contenidoModel = new Page_Model_DbTable_Contenido();
			$this->_view->contenidos =  $contenidoModel->getList(" contenido_padre = '0'","orden ASC");
    }
	
		public function detalleAction()
		{
			$data = $this->getRoutes()->getRoutes();
			$this->_view->contenidohome = $this->template->getContentid($data[0]);
		}


}