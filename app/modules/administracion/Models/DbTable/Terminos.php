<?php 
/**
* clase que genera la insercion y edicion  de termino en la base de datos
*/
class Administracion_Model_DbTable_Terminos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'terminos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'termino_id';

	/**
	 * insert recibe la informacion de un termino y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$termino_nombre = $data['termino_nombre'];
		$termino_tipo = $data['termino_tipo'];
		$termino_producto = $data['termino_producto'];
		$query = "INSERT INTO terminos( termino_nombre, termino_tipo, termino_producto) VALUES ( '$termino_nombre', '$termino_tipo', '$termino_producto')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un termino  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$termino_nombre = $data['termino_nombre'];
		$termino_tipo = $data['termino_tipo'];
		$termino_producto = $data['termino_producto'];
		$query = "UPDATE terminos SET  termino_nombre = '$termino_nombre', termino_tipo = '$termino_tipo', termino_producto = '$termino_producto' WHERE termino_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}