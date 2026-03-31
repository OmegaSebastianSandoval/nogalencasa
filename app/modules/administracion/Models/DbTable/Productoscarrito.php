<?php 
/**
* clase que genera la insercion y edicion  de categorias en la base de datos
*/
class Administracion_Model_DbTable_Productoscarrito extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'productos_carrito';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'id_productos_carrito';

	/**
	 * insert recibe la informacion de un categorias y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$id_carrito = $data['id_carrito'];
		$id_productos = $data['id_productos'];
		$nombre = $data['nombre'];
		$cantidad = $data['cantidad'];
		$valor = $data['valor'];
		$valor_iva = $data['valor_iva'];
		if ($id_productos!='') {
			$query = "INSERT INTO productos_carrito( id_carrito, id_productos, nombre, cantidad, valor, valor_iva) VALUES ( '$id_carrito', '$id_productos', '$nombre', '$cantidad', '$valor', '$valor_iva')";
			$res = $this->_conn->query($query);
			return mysqli_insert_id($this->_conn->getConnection());
		}
	}

	/**
	 * update Recibe la informacion de un categorias  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$id_carrito = $data['id_carrito'];
		$id_productos = $data['id_productos'];
		$nombre = $data['nombre'];
		$cantidad = $data['cantidad'];
		$valor = $data['valor'];
		$valor_iva = $data['valor_iva'];
		$query = "UPDATE productos_carrito SET  id_carrito = '$id_carrito', id_productos = '$id_productos', nombre = '$nombre', cantidad = '$cantidad', valor = '$valor', valor_iva = '$valor_iva' WHERE id_productos_carrito = '".$id."'";
		$res = $this->_conn->query($query);
	}

	public function vaciar($pedido_id){
		if($pedido_id>0){
			$query = " DELETE FROM productos_carrito WHERE id_carrito = '".$pedido_id."'";
			$res = $this->_conn->query($query);
		}
	}

}