<?php 
/**
* clase que genera la insercion y edicion  de propinas opciones en la base de datos
*/
class Administracion_Model_DbTable_Propinasopciones extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'propinas_opciones';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'opcion_id';

	/**
	 * insert recibe la informacion de un propinas opciones y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$opcion_valor = $data['opcion_valor'];
		$query = "INSERT INTO propinas_opciones( opcion_valor) VALUES ( '$opcion_valor')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un propinas opciones  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$opcion_valor = $data['opcion_valor'];
		$query = "UPDATE propinas_opciones SET  opcion_valor = '$opcion_valor' WHERE opcion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}