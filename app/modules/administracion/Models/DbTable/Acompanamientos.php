<?php 
/**
* clase que genera la insercion y edicion  de Acompa&ntilde;amientos en la base de datos
*/
class Administracion_Model_DbTable_Acompanamientos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'acompanamientos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'acomp_id';

	/**
	 * insert recibe la informacion de un Acompa&ntilde;amiento y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$acomp_nombre = $data['acomp_nombre'];
		$acomp_tipo = $data['acomp_tipo'];
		$acomp_producto = $data['acomp_producto'];
		$query = "INSERT INTO acompanamientos( acomp_nombre, acomp_tipo, acomp_producto) VALUES ( '$acomp_nombre', '$acomp_tipo', '$acomp_producto')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Acompa&ntilde;amiento  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$acomp_nombre = $data['acomp_nombre'];
		$acomp_tipo = $data['acomp_tipo'];
		$acomp_producto = $data['acomp_producto'];
		$query = "UPDATE acompanamientos SET  acomp_nombre = '$acomp_nombre', acomp_tipo = '$acomp_tipo', acomp_producto = '$acomp_producto' WHERE acomp_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}