<?php 

/**
*
*/

class Page_nosotrosController extends Page_mainController
{

	public function indexAction()
	{
      $contenidoModel = new Page_Model_DbTable_Contenido();
      $this->_view->bannersimple = $this->template->bannersimple(2);
      $this->_view->nosotros = $this->template->getContentseccion(5);
    }
    
}