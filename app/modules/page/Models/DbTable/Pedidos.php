<?php 

/**
* 
*/
class Page_Model_DbTable_Pedidos extends Db_Table
{
	protected $_name = 'pedidos';
	protected $_id = 'pedido_id';

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
		$pedido_fecha = $data['pedido_fecha'];
		$pedido_valorpagar = $data['pedido_valorpagar'];
		$pedido_estado = $data['pedido_estado'];
		$pedido_zona = $data['pedido_zona'];

		$pedido_medio = $data['pedido_medio'];
		$pedido_forma_envio = $data['pedido_forma_envio'];
		
		$pedido_nombrefe = $data['pedido_nombrefe'];
		$pedido_correofe = $data['pedido_correofe'];
		$pedido_celularfe = $data['pedido_celularfe'];
		

		$pedido_cuotas = $data['pedido_cuotas'];

		$query = "INSERT INTO pedidos( pedido_tipodocumento, pedido_documento, pedido_nombre, pedido_correo, pedido_telefono, pedido_celular, pedido_nomenclatura, pedido_direccion, pedido_ciudad, pedido_envio, pedido_fecha, pedido_valorpagar, pedido_estado, pedido_zona,pedido_medio,pedido_forma_envio,pedido_nombrefe,pedido_correofe,pedido_celularfe, pedido_cuotas) VALUES ( '$pedido_tipodocumento', '$pedido_documento', '$pedido_nombre', '$pedido_correo', '$pedido_telefono', '$pedido_celular', '$pedido_nomenclatura', '$pedido_direccion', '$pedido_ciudad', '$pedido_envio', '$pedido_fecha', '$pedido_valorpagar' , '$pedido_estado', '$pedido_zona','$pedido_medio','$pedido_forma_envio', '$pedido_nombrefe','$pedido_correofe','$pedido_celularfe','$pedido_cuotas')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}
}