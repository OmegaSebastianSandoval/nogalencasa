<?php 
/**
* clase que genera la insercion y edicion  de ingrediente en la base de datos
*/
class Administracion_Model_DbTable_Ingredientes extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'ingredientes';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'ingrediente_id';

	/**
	 * insert recibe la informacion de un ingrediente y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$ingrediente_nombre = $data['ingrediente_nombre'];
		$ingrediente_descripcion = $data['ingrediente_descripcion'];
		$ingrediente_imagen = $data['ingrediente_imagen'];
		$ingrediente_estado = $data['ingrediente_estado'];
		$ingrediente_producto = $data['ingrediente_producto'];
		$ingrediente_precio = $data['ingrediente_precio'];
		$query = "INSERT INTO ingredientes( ingrediente_nombre, ingrediente_descripcion, ingrediente_imagen, ingrediente_estado, ingrediente_producto, ingrediente_precio) VALUES ( '$ingrediente_nombre', '$ingrediente_descripcion', '$ingrediente_imagen', '$ingrediente_estado', '$ingrediente_producto', '$ingrediente_precio')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un ingrediente  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$ingrediente_nombre = $data['ingrediente_nombre'];
		$ingrediente_descripcion = $data['ingrediente_descripcion'];
		$ingrediente_imagen = $data['ingrediente_imagen'];
		$ingrediente_estado = $data['ingrediente_estado'];
		$ingrediente_producto = $data['ingrediente_producto'];
		$ingrediente_precio = $data['ingrediente_precio'];
		$query = "UPDATE ingredientes SET  ingrediente_nombre = '$ingrediente_nombre', ingrediente_descripcion = '$ingrediente_descripcion', ingrediente_imagen = '$ingrediente_imagen', ingrediente_estado = '$ingrediente_estado', ingrediente_producto = '$ingrediente_producto', ingrediente_precio = '$ingrediente_precio' WHERE ingrediente_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}