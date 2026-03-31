<?php 
/**
* clase que genera la insercion y edicion  de carrito en la base de datos
*/
class Administracion_Model_DbTable_Carrito extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'carrito';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'carrito_id';

	/**
	 * insert recibe la informacion de un carrito y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$pedido_carritovalor = $data['pedido_valorpagar'];
		$pedido_usuario = $data['pedido_documento'];
		$pedido_nombre = $data['pedido_nombre'];
		$pedido_direccion = $data['pedido_direccion'];
		$pedido_ciudad = $data['pedido_ciudad'];
		$pedido_telefono = $data['pedido_telefono'];
		$pedido_correo = $data['pedido_correo'];
		$pedido_estado = $data['pedido_estado'];
		$pedido_fecha = $data['pedido_fecha'];
		
		$query = "INSERT INTO carrito( carrito_valor, usuario, nombre, direccion, ciudad, telefono, correo, estado, fecha) VALUES ( '$pedido_carritovalor', '$pedido_usuario', '$pedido_nombre', '$pedido_direccion', '$pedido_ciudad', '$pedido_telefono', '$pedido_correo', '$pedido_estado', '$pedido_fecha')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un carrito  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$carrito_valor = $data['carrito_valor'];
		$fecha = $data['fecha'];
		$id_usuario = $data['id_usuario'];
		$query = "UPDATE carrito SET  carrito_valor = '$carrito_valor', fecha = '$fecha', id_usuario = '$id_usuario' WHERE carrito_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}