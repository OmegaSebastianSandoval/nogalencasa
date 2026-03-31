<?php 
/**
* clase que genera la insercion y edicion  de direccion en la base de datos
*/
class Administracion_Model_DbTable_Direcciones extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'direcciones';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'direccion_id';

	/**
	 * insert recibe la informacion de un direccion y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$direccion_usuario = $data['direccion_usuario'];
		$direccion_nomenclatura = $data['direccion_nomenclatura'];
		$direccion_numero1 = $data['direccion_numero1'];
		$direccion_letra1 = $data['direccion_letra1'];
		$direccion_numero2 = $data['direccion_numero2'];
		$direccion_letra2 = $data['direccion_letra2'];
		$direccion_numero3 = $data['direccion_numero3'];
		$direccion_complemento = $data['direccion_complemento'];
		$direccion_indicaciones = $data['direccion_indicaciones'];
		$query = "INSERT INTO direcciones( direccion_usuario, direccion_nomenclatura, direccion_numero1, direccion_letra1, direccion_numero2, direccion_letra2, direccion_numero3, direccion_complemento, direccion_indicaciones) VALUES ( '$direccion_usuario', '$direccion_nomenclatura', '$direccion_numero1', '$direccion_letra1', '$direccion_numero2', '$direccion_letra2', '$direccion_numero3', '$direccion_complemento', '$direccion_indicaciones')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un direccion  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$direccion_usuario = $data['direccion_usuario'];
		$direccion_nomenclatura = $data['direccion_nomenclatura'];
		$direccion_numero1 = $data['direccion_numero1'];
		$direccion_letra1 = $data['direccion_letra1'];
		$direccion_numero2 = $data['direccion_numero2'];
		$direccion_letra2 = $data['direccion_letra2'];
		$direccion_numero3 = $data['direccion_numero3'];
		$direccion_complemento = $data['direccion_complemento'];
		$direccion_indicaciones = $data['direccion_indicaciones'];
		$query = "UPDATE direcciones SET  direccion_usuario = '$direccion_usuario', direccion_nomenclatura = '$direccion_nomenclatura', direccion_numero1 = '$direccion_numero1', direccion_letra1 = '$direccion_letra1', direccion_numero2 = '$direccion_numero2', direccion_letra2 = '$direccion_letra2', direccion_numero3 = '$direccion_numero3', direccion_complemento = '$direccion_complemento', direccion_indicaciones = '$direccion_indicaciones' WHERE direccion_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}