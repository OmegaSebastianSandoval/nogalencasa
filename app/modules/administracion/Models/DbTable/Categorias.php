<?php 
/**
* clase que genera la insercion y edicion  de Categorias en la base de datos
*/
class Administracion_Model_DbTable_Categorias extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'categorias';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'categorias_id';

	/**
	 * insert recibe la informacion de un Categoria y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$categorias_nombre = $data['categorias_nombre'];
		$categorias_imagen = $data['categorias_imagen'];

		$categorias_descripcion = $data['categorias_descripcion'];
		$categorias_padre = $data['categorias_padre'];
		$query = "INSERT INTO categorias( categorias_nombre,categorias_imagen, categorias_descripcion, categorias_padre) VALUES ( '$categorias_nombre','$categorias_imagen', '$categorias_descripcion', '$categorias_padre')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un Categoria  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$categorias_nombre = $data['categorias_nombre'];
		$categorias_imagen = $data['categorias_imagen'];

		$categorias_descripcion = $data['categorias_descripcion'];
		$query = "UPDATE categorias SET  categorias_nombre = '$categorias_nombre',  categorias_imagen = '$categorias_imagen', categorias_descripcion = '$categorias_descripcion' WHERE categorias_id = '".$id."'";
		$res = $this->_conn->query($query);
	}
}