<?php 
/**
* clase que genera la insercion y edicion  de invitaciones en la base de datos
*/
class Administracion_Model_DbTable_Invitaciones extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'invitaciones';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'invitacion_id';

	/**
	 * insert recibe la informacion de un invitacion y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$invitacion_socio = $data['invitacion_socio'];
		$invitacion_email = $data['invitacion_email'];
		$invitacion_fecha = $data['invitacion_fecha'];
		$query = "INSERT INTO invitaciones( invitacion_socio, invitacion_email, invitacion_fecha) VALUES ( '$invitacion_socio', '$invitacion_email', '$invitacion_fecha')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un invitacion  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$invitacion_socio = $data['invitacion_socio'];
		$invitacion_email = $data['invitacion_email'];
		$invitacion_fecha = $data['invitacion_fecha'];
		$query = "UPDATE invitaciones SET  invitacion_socio = '$invitacion_socio', invitacion_email = '$invitacion_email', invitacion_fecha = '$invitacion_fecha' WHERE invitacion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}