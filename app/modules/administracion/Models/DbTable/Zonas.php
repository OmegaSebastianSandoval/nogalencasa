<?php 
/**
* clase que genera la insercion y edicion  de zonas en la base de datos
*/
class Administracion_Model_DbTable_Zonas extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'zonas';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'zona_id';

	/**
	 * insert recibe la informacion de un zona y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$zona_nombre = $data['zona_nombre'];
		$zona_calle_min = $data['zona_calle_min'];
		$zona_calle_max = $data['zona_calle_max'];
		$zona_calle_min2 = $data['zona_calle_min2'];
		$zona_calle_max2 = $data['zona_calle_max2'];
		$zona_cra_min = $data['zona_cra_min'];
		$zona_cra_max = $data['zona_cra_max'];
		$zona_valor = $data['zona_valor'];
		$zona_activa = $data['zona_activa'];
		$query = "INSERT INTO zonas( zona_nombre, zona_calle_min, zona_calle_max, zona_cra_min, zona_cra_max, zona_valor, zona_activa, zona_calle_min2, zona_calle_max2) VALUES ( '$zona_nombre', '$zona_calle_min', '$zona_calle_max', '$zona_cra_min', '$zona_cra_max', '$zona_valor', '$zona_activa', '$zona_calle_min2', '$zona_calle_max2')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un zona  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){

		$zona_nombre = $data['zona_nombre'];
		$zona_calle_min = $data['zona_calle_min'];
		$zona_calle_max = $data['zona_calle_max'];
		$zona_calle_min2 = $data['zona_calle_min2'];
		$zona_calle_max2 = $data['zona_calle_max2'];
		$zona_cra_min = $data['zona_cra_min'];
		$zona_cra_max = $data['zona_cra_max'];
		$zona_valor = $data['zona_valor'];
		$zona_activa = $data['zona_activa'];
		$query = "UPDATE zonas SET  zona_nombre = '$zona_nombre', zona_calle_min = '$zona_calle_min', zona_calle_max = '$zona_calle_max', zona_cra_min = '$zona_cra_min', zona_cra_max = '$zona_cra_max', zona_valor = '$zona_valor', zona_activa = '$zona_activa', zona_calle_min2='$zona_calle_min2', zona_calle_max2='$zona_calle_max2' WHERE zona_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}