<?php 

/**
*
*/

class Page_historialController extends Page_mainController
{

	public function indexAction()
	{
      //$contenidoModel = new Page_Model_DbTable_Contenido();
      //$this->_view->bannersimple = $this->template->bannersimple(4);
      //$this->_view->domicilios = $contenidoModel->getList("contenido_seccion = '3' AND contenido_padre != '0' ", "orden ASC");

        $cedula = $_SESSION['kt_cedula'];
        $pedidoModel = new Administracion_Model_DbTable_Pedidos();
        $pedidos = $pedidoModel->getList(" pedido_documento='$cedula' "," pedido_fecha DESC ");

        $productosModel = new Page_Model_DbTable_Productoscarrito();

        foreach ($pedidos as $value) {
            $id = $value->pedido_id;
            $value->productos = $productosModel->getList(" id_carrito='$id' ","");
        }

        $this->_view->pedidos = $pedidos;
        $this->_view->list_pedido_estado = Administracion_pedidosController::getPedidoestado();
        $this->_view->list_pedido_medio = Administracion_pedidosController::getPedidomedio();
        $this->_view->list_pedido_forma_envio = Administracion_pedidosController::getPedidoformaenvio();
    }

    private function getPedidoestado1()
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
    
}