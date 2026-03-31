<?php 
/**
* clase que genera la insercion y edicion  de Horarios Express en la base de datos
*/
class Administracion_Model_DbTable_Horariosexpress extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'horarios2';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'horario_id';

	/**
	 * insert recibe la informacion de un Horario y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$horario_dia = $data['horario_dia'];
		$horario_fecha = $data['horario_fecha'];
		$horario_hora1 = $data['horario_hora1'];
		$horario_hora2 = $data['horario_hora2'];
		$query = "INSERT INTO horarios2( horario_dia, horario_fecha, horario_hora1, horario_hora2) VALUES ( '$horario_dia', '$horario_fecha', '$horario_hora1', '$horario_hora2')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Horario  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$horario_dia = $data['horario_dia'];
		$horario_fecha = $data['horario_fecha'];
		$horario_hora1 = $data['horario_hora1'];
		$horario_hora2 = $data['horario_hora2'];
		$query = "UPDATE horarios2 SET  horario_dia = '$horario_dia', horario_fecha = '$horario_fecha', horario_hora1 = '$horario_hora1', horario_hora2 = '$horario_hora2' WHERE horario_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}