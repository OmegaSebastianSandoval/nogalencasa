<?php 

/**
* 
*/
class Page_Model_DbTable_Productospedidos extends Db_Table
{
	protected $_name = 'productos';
    protected $_id = 'productos_id';
    
    public function insert($data){
		$productospedidos_pedido = $data['productospedidos_pedido'];
		$productospedidos_nombre = $data['productospedidos_nombre'];
		$productospedidos_cantidad = $data['productospedidos_cantidad'];
		$productospedidos_precio = $data['productospedidos_precio'];
		$query = "INSERT INTO productospedidos( productospedidos_pedido, productospedidos_nombre, productospedidos_cantidad, productospedidos_precio) VALUES ( '$productospedidos_pedido', '$productospedidos_nombre', '$productospedidos_cantidad', '$productospedidos_precio')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}
}