<?php

/**
*
*/
class Page_Model_DbTable_Productoscarrito extends Db_Table
{
	protected $_name = 'productos_carrito';
	protected $_id = 'id_productos_carrito';

	public function insert($carrito, $productos_id,$productos_nombre, $productos_imagen, $cantidad, $productos_valor, $valoriva){
		$query = "INSERT INTO productos_carrito(id_carrito, id_productos, nombre, imagen, cantidad, valor, valor_iva) VALUES ('$carrito','$productos_id', '$productos_nombre', '$cantidad', '$productos_valor', '$productos_imagen', '$valoriva')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}
	public function update($id,$valor,$cantidad,$productos_imagen){
		$query = "UPDATE productos_carrito SET cantidad = '$cantidad', valor = '$valor', imagen = '$productos_imagen' WHERE id_productos_carrito = '$id'";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	public function delete($id){
		$query = "DELETE FROM productos_carrito WHERE id_productos = '$id'";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	public function updateCantidad($id, $cantidad){
		$update="UPDATE productos_carrito SET cantidad = '$cantidad' WHERE id_productos_carrito = '$id'";
		$res = $this->_conn->query($update);
		return mysqli_insert_id($this->_conn->getConnection());
	}
} 