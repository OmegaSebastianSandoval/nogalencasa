<?php 

/**
*
*/

class Page_domiciliosController extends Page_mainController
{

	public function indexAction()
	{
      $contenidoModel = new Page_Model_DbTable_Contenido();
      $this->_view->bannersimple = $this->template->bannersimple(4);
      $this->_view->domicilios = $contenidoModel->getList("contenido_seccion = '3' AND contenido_padre != '0' ", "orden ASC");
    }
    
}