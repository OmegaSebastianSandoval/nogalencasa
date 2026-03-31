<?php 
/**
* clase que genera la insercion y edicion  de Socios en la base de datos
*/
class Administracion_Model_DbTable_Socios extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'socios';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'socio_id';

	/**
	 * insert recibe la informacion de un Socio y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$socio_cedula = $data['socio_cedula'];
		$socio_tipo_documento = $data['socio_tipo_documento'];
		$socio_nombre = $data['socio_nombre'];
		$socio_carnet = $data['socio_carnet'];
		$socio_direccion = $data['socio_direccion'];
		$socio_ciudad = $data['socio_ciudad'];
		$socio_correo = $data['socio_correo'];
		$socio_telefono = $data['socio_telefono'];
		$socio_celular = $data['socio_celular'];
		$socio_estado = $data['socio_estado'];
		$query = "INSERT INTO socios( socio_cedula, socio_tipo_documento, socio_nombre, socio_carnet, socio_direccion, socio_ciudad, socio_correo, socio_telefono, socio_celular, socio_estado) VALUES ( '$socio_cedula', '$socio_tipo_documento', '$socio_nombre', '$socio_carnet', '$socio_direccion', '$socio_ciudad', '$socio_correo', '$socio_telefono', '$socio_celular', '$socio_estado')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Socio  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$socio_cedula = $data['socio_cedula'];
		$socio_tipo_documento = $data['socio_tipo_documento'];
		$socio_nombre = $data['socio_nombre'];
		$socio_carnet = $data['socio_carnet'];
		$socio_direccion = $data['socio_direccion'];
		$socio_ciudad = $data['socio_ciudad'];
		$socio_correo = $data['socio_correo'];
		$socio_telefono = $data['socio_telefono'];
		$socio_celular = $data['socio_celular'];
		$socio_estado = $data['socio_estado'];
		$query = "UPDATE socios SET  socio_cedula = '$socio_cedula', socio_tipo_documento = '$socio_tipo_documento', socio_nombre = '$socio_nombre', socio_carnet = '$socio_carnet', socio_direccion = '$socio_direccion', socio_ciudad = '$socio_ciudad', socio_correo = '$socio_correo', socio_telefono = '$socio_telefono', socio_celular = '$socio_celular', socio_estado = '$socio_estado' WHERE socio_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}