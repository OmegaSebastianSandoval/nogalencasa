<?php 
/**
* clase que genera la insercion y edicion  de cofiguraci&oacute;n propinas en la base de datos
*/
class Administracion_Model_DbTable_Configpropinas extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'config_propinas';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'config_id';

	/**
	 * insert recibe la informacion de un cofiguraci&oacute;n propinas y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$config_tipo = $data['config_tipo'];
		$config_valor_minimo = $data['config_valor_minimo'];
		$config_valor_maximo = $data['config_valor_maximo'];
		$config_porcentaje = $data['config_porcentaje'];
		$config_opcional = $data['config_opcional'];
		$query = "INSERT INTO config_propinas( config_tipo, config_valor_minimo, config_valor_maximo, config_porcentaje, config_opcional) VALUES ( '$config_tipo', '$config_valor_minimo', '$config_valor_maximo', '$config_porcentaje', '$config_opcional')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un cofiguraci&oacute;n propinas  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$config_tipo = $data['config_tipo'];
		$config_valor_minimo = $data['config_valor_minimo'];
		$config_valor_maximo = $data['config_valor_maximo'];
		$config_porcentaje = $data['config_porcentaje'];
		$config_opcional = $data['config_opcional'];
		$query = "UPDATE config_propinas SET  config_tipo = '$config_tipo', config_valor_minimo = '$config_valor_minimo', config_valor_maximo = '$config_valor_maximo', config_porcentaje = '$config_porcentaje', config_opcional = '$config_opcional' WHERE config_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}