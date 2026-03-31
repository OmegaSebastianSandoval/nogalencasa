<?php 
/**
* clase que genera la insercion y edicion  de Calificaci&oacute;n de producto en la base de datos
*/
class Administracion_Model_DbTable_Calificacionproductos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'calificacion_productos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'calificacion_producto_id';

	/**
	 * insert recibe la informacion de un Calificaci&oacute;n de producto y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$calificacion_producto_producto = $data['calificacion_producto_producto'];
		$calificacion_producto_usuario = $data['calificacion_producto_usuario'];
		$calificacion_producto_calificacion = $data['calificacion_producto_calificacion'];
		$query = "INSERT INTO calificacion_productos( calificacion_producto_producto, calificacion_producto_usuario, calificacion_producto_calificacion) VALUES ( '$calificacion_producto_producto', '$calificacion_producto_usuario', '$calificacion_producto_calificacion')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Calificaci&oacute;n de producto  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$calificacion_producto_producto = $data['calificacion_producto_producto'];
		$calificacion_producto_usuario = $data['calificacion_producto_usuario'];
		$calificacion_producto_calificacion = $data['calificacion_producto_calificacion'];
		$query = "UPDATE calificacion_productos SET  calificacion_producto_producto = '$calificacion_producto_producto', calificacion_producto_usuario = '$calificacion_producto_usuario', calificacion_producto_calificacion = '$calificacion_producto_calificacion' WHERE calificacion_producto_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}