<?php

/**
 *
 */

class Page_respuestaController extends Page_mainController
{

    public function indexAction()
    {
        $id = $this->_getSanitizedParam("id");
        $pedidoModel = new Page_Model_DbTable_Pedidos();
        $pedido = $pedidoModel->getById($id);
        if ($pedido->pedido_estado == 3) {
            $mail = new Core_Model_Sendingemail($this->_view);
            $mail->enviarErrorPedido($id);
        }
        $this->_view->pedido = $pedido;
    }
    public function testAction()
    {
        $this->setLayout("blanco");
        $id = $this->_getSanitizedParam("id");
       
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $productos = $productosModel->getList(" id_carrito='$id' ", "");
        $incripcion = $formularioModel->getById($id);


        $this->_view->inscripcion = $incripcion;
        $this->_view->productos = $productos;
    }
}
