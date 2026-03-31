<?php 
/**
* clase que genera la insercion y edicion  de fotos producto en la base de datos
*/
class Administracion_Model_DbTable_Fotosproducto extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'fotos_productos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'fotos_productos_id';

	/**
	 * insert recibe la informacion de un fotos producto y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$fotos_productos_estado = $data['fotos_productos_estado'];
		$fotos_productos_imagen = $data['fotos_productos_imagen'];
		$fotos_productos_producto = $data['fotos_productos_producto'];
		$fotos_productos_nombre = $data['fotos_productos_nombre'];
		$fotos_productos_descripcion = $data['fotos_productos_descripcion'];
		$query = "INSERT INTO fotos_productos( fotos_productos_estado, fotos_productos_imagen, fotos_productos_producto, fotos_productos_nombre, fotos_productos_descripcion) VALUES ( '$fotos_productos_estado', '$fotos_productos_imagen', '$fotos_productos_producto', '$fotos_productos_nombre', '$fotos_productos_descripcion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un fotos producto  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$fotos_productos_estado = $data['fotos_productos_estado'];
		$fotos_productos_imagen = $data['fotos_productos_imagen'];
		$fotos_productos_producto = $data['fotos_productos_producto'];
		$fotos_productos_nombre = $data['fotos_productos_nombre'];
		$fotos_productos_descripcion = $data['fotos_productos_descripcion'];
		$query = "UPDATE fotos_productos SET  fotos_productos_estado = '$fotos_productos_estado', fotos_productos_imagen = '$fotos_productos_imagen', fotos_productos_producto = '$fotos_productos_producto', fotos_productos_nombre = '$fotos_productos_nombre', fotos_productos_descripcion = '$fotos_productos_descripcion' WHERE fotos_productos_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}