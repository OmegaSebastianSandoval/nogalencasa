<?php 

/**
*
*/

class Page_comprarController extends Page_mainController
{

	public function indexAction()
	{
      $contenidoModel = new Page_Model_DbTable_Contenido();
      //$this->_view->bannersimple = $this->template->bannersimple(2);
      $this->_view->bannersimple = $this->template->bannerprincipal(1);
      $this->_view->comprar = $this->template->getContentseccion(2);
    }
    
}