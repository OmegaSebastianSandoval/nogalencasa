<?php 
/**
* clase que genera la insercion y edicion  de Pedidos en la base de datos
*/
class Administracion_Model_DbTable_Pedidos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'pedidos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'pedido_id';

	/**
	 * insert recibe la informacion de un Pedido y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$pedido_tipodocumento = $data['pedido_tipodocumento'];
		$pedido_documento = $data['pedido_documento'];
		$pedido_nombre = $data['pedido_nombre'];
		$pedido_correo = $data['pedido_correo'];
		$pedido_telefono = $data['pedido_telefono'];
		$pedido_celular = $data['pedido_celular'];
		$pedido_nomenclatura = $data['pedido_nomenclatura'];
		$pedido_direccion = $data['pedido_direccion'];
		$pedido_ciudad = $data['pedido_ciudad'];
		$pedido_envio = $data['pedido_envio'];
		$pedido_medio = $data['pedido_medio'];
		$pedido_forma_envio = $data['pedido_forma_envio'];
		$pedido_fecha = $data['pedido_fecha'];
		$pedido_valorpagar = $data['pedido_valorpagar'];
		$pedido_zona = $data['pedido_zona'];
		
		
		$pedido_nombrefe = $data['pedido_nombrefe'];
		$pedido_correofe = $data['pedido_correofe'];
		$pedido_celularfe = $data['pedido_celularfe'];


		$pedido_estado = $data['pedido_estado'];
		$pedido_estado_texto = $data['pedido_estado_texto'];
		$pedido_estado_texto2 = $data['pedido_estado_texto2'];
		$pedido_cus = $data['pedido_cus'];
		$request_id = $data['request_id'];
		$query = "INSERT INTO pedidos( pedido_tipodocumento, pedido_documento, pedido_nombre, pedido_correo, pedido_telefono, pedido_celular, pedido_nomenclatura, pedido_direccion, pedido_ciudad, pedido_envio, pedido_medio, pedido_forma_envio, pedido_fecha, pedido_valorpagar, pedido_zona, pedido_nombrefe, pedido_correofe, pedido_celularfe, pedido_estado, pedido_estado_texto, pedido_estado_texto2, pedido_cus, request_id) VALUES ( '$pedido_tipodocumento', '$pedido_documento', '$pedido_nombre', '$pedido_correo', '$pedido_telefono', '$pedido_celular', '$pedido_nomenclatura', '$pedido_direccion', '$pedido_ciudad', '$pedido_envio', '$pedido_medio', '$pedido_forma_envio', '$pedido_fecha', '$pedido_valorpagar', '$pedido_zona', '$pedido_nombrefe','$pedido_correofe','$pedido_celularfe', '$pedido_estado', '$pedido_estado_texto', '$pedido_estado_texto2', '$pedido_cus', '$request_id')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Pedido  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$pedido_tipodocumento = $data['pedido_tipodocumento'];
		$pedido_documento = $data['pedido_documento'];
		$pedido_nombre = $data['pedido_nombre'];
		$pedido_correo = $data['pedido_correo'];
		$pedido_telefono = $data['pedido_telefono'];
		$pedido_celular = $data['pedido_celular'];
		$pedido_nomenclatura = $data['pedido_nomenclatura'];
		$pedido_direccion = $data['pedido_direccion'];
		$pedido_ciudad = $data['pedido_ciudad'];
		$pedido_envio = $data['pedido_envio'];
		$pedido_medio = $data['pedido_medio'];
		$pedido_forma_envio = $data['pedido_forma_envio'];
		$pedido_fecha = $data['pedido_fecha'];
		$pedido_valorpagar = $data['pedido_valorpagar'];
		$pedido_zona = $data['pedido_zona'];
		
		
		$pedido_nombrefe = $data['pedido_nombrefe'];
		$pedido_correofe = $data['pedido_correofe'];
		$pedido_celularfe = $data['pedido_celularfe'];


		$pedido_estado = $data['pedido_estado'];
		$pedido_estado_texto = $data['pedido_estado_texto'];
		$pedido_estado_texto2 = $data['pedido_estado_texto2'];
		$pedido_cus = $data['pedido_cus'];
		$request_id = $data['request_id'];
		$query = "UPDATE pedidos SET  pedido_tipodocumento = '$pedido_tipodocumento', pedido_documento = '$pedido_documento', pedido_nombre = '$pedido_nombre', pedido_correo = '$pedido_correo', pedido_telefono = '$pedido_telefono', pedido_celular = '$pedido_celular', pedido_nomenclatura = '$pedido_nomenclatura', pedido_direccion = '$pedido_direccion', pedido_ciudad = '$pedido_ciudad', pedido_envio = '$pedido_envio', pedido_medio = '$pedido_medio', pedido_forma_envio = '$pedido_forma_envio', pedido_fecha = '$pedido_fecha', pedido_valorpagar = '$pedido_valorpagar', pedido_zona = '$pedido_zona', pedido_nombrefe = '$pedido_nombrefe', pedido_correofe = '$pedido_correofe', pedido_celularfe = '$pedido_celularfe', pedido_estado = '$pedido_estado', pedido_estado_texto = '$pedido_estado_texto', pedido_estado_texto2 = '$pedido_estado_texto2', pedido_cus = '$pedido_cus', request_id = '$request_id' WHERE pedido_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}