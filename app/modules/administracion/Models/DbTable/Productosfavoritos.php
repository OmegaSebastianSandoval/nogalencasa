<?php 
/**
* clase que genera la insercion y edicion  de productosfavoritos en la base de datos
*/
class Administracion_Model_DbTable_Productosfavoritos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'productos_favoritos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'productos_favoritos_id';

	/**
	 * insert recibe la informacion de un productosfavoritos y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$productos_favoritos_producto = $data['productos_favoritos_producto'];
		$productos_favoritos_usuario = $data['productos_favoritos_usuario'];
		$query = "INSERT INTO productos_favoritos( productos_favoritos_producto, productos_favoritos_usuario) VALUES ( '$productos_favoritos_producto', '$productos_favoritos_usuario')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un productosfavoritos  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$productos_favoritos_producto = $data['productos_favoritos_producto'];
		$productos_favoritos_usuario = $data['productos_favoritos_usuario'];
		$query = "UPDATE productos_favoritos SET  productos_favoritos_producto = '$productos_favoritos_producto', productos_favoritos_usuario = '$productos_favoritos_usuario' WHERE productos_favoritos_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}