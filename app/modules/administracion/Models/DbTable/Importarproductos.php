<?php 
/**
* clase que genera la insercion y edicion  de importar cedulas en la base de datos
*/
class Administracion_Model_DbTable_Importarproductos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'archivos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'archivo_id';

	/**
	 * insert recibe la informacion de un importar cedulas y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$archivo_puntos = $data['archivo_puntos'];
		$archivo_cedulas = $data['archivo_cedulas'];
		$archivo_productos = $data['archivo_productos'];
		$query = "INSERT INTO archivos( archivo_puntos, archivo_cedulas, archivo_productos) VALUES ( '$archivo_puntos', '$archivo_cedulas', '$archivo_productos')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un importar cedulas  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$archivo_puntos = $data['archivo_puntos'];
		$archivo_cedulas = $data['archivo_cedulas'];
		$archivo_productos = $data['archivo_productos'];
		$query = "UPDATE archivos SET  archivo_puntos = '$archivo_puntos', archivo_cedulas = '$archivo_cedulas', archivo_productos = '$archivo_productos' WHERE archivo_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}