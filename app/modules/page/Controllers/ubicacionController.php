<?php 

/**
*
*/

class Page_ubicacionController extends Page_mainController
{

	public function indexAction()
	{
      $contenidoModel = new Page_Model_DbTable_Contenido();
      $this->_view->bannersimple = $this->template->bannersimple(2);
      $this->_view->ubicacion = $this->template->getContentseccion(6);
    }
    
}