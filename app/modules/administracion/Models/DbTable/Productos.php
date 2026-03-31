<?php 
/**
* clase que genera la insercion y edicion  de producto en la base de datos
*/
class Administracion_Model_DbTable_Productos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'productos';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'productos_id';

	/**
	 * insert recibe la informacion de un producto y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$productos_nombre = $data['productos_nombre'];
		$productos_descripcion = $data['productos_descripcion'];
		$productos_imagen = $data['productos_imagen'];
		$productos_destacado = $data['productos_destacado'];
		$productos_precio = $data['productos_precio'];
		$productos_nuevo = $data['productos_nuevo'];
		$productos_cantidad = $data['productos_cantidad'];
		$productos_categorias = $data['productos_categorias'];
		$productos_categoriasdos = $data['productos_categoriasdos'];

		$productos_codigo = $data['productos_codigo'];
		$productos_subcategoria = $data['productos_subcategoria'];
		$query = "INSERT INTO productos( productos_nombre, productos_descripcion, productos_imagen, productos_destacado, productos_precio, productos_nuevo, productos_cantidad, productos_categorias, productos_codigo, productos_subcategoria, productos_subcategoriados) VALUES ( '$productos_nombre', '$productos_descripcion', '$productos_imagen', '$productos_destacado', '$productos_precio', '$productos_nuevo', '$productos_cantidad', '$productos_categorias', '$productos_codigo', '$productos_subcategoria', '$productos_categoriasdos')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un producto  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){

		$productos_nombre = $data['productos_nombre'];
		$productos_descripcion = $data['productos_descripcion'];
		$productos_imagen = $data['productos_imagen'];
		$productos_destacado = $data['productos_destacado'];
		$productos_precio = $data['productos_precio'];
		$productos_nuevo = $data['productos_nuevo'];
		$productos_cantidad = $data['productos_cantidad'];
		$productos_categorias = $data['productos_categorias'];
		$productos_codigo = $data['productos_codigo'];
		$productos_subcategoria = $data['productos_subcategoria'];
		$productos_subcategoriados = $data['productos_subcategoriados'];

		$query = "UPDATE productos SET  productos_nombre = '$productos_nombre', productos_descripcion = '$productos_descripcion', productos_imagen = '$productos_imagen', productos_destacado = '$productos_destacado', productos_precio = '$productos_precio', productos_nuevo = '$productos_nuevo', productos_cantidad = '$productos_cantidad', productos_categorias = '$productos_categorias', productos_codigo = '$productos_codigo', productos_subcategoria='$productos_subcategoria', productos_subcategoriados='$productos_subcategoriados' WHERE productos_id = '".$id."'";
		$res = $this->_conn->query($query);
	}


    public function getListCategorias($filters = '',$order = '')
    {
        $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
        }
        $select = 'SELECT productos.* FROM '.$this->_name.' LEFT JOIN categorias ON categorias_id = productos_categorias '.$filter.' '.$orders;
        $res = $this->_conn->query( $select )->fetchAsObject();
        return $res;
    }

    public function getListCategoriasPages($filters = '' ,$order = '' ,$page,$amount)
    {
       $filter = '';
        if($filters != ''){
            $filter = ' WHERE '.$filters;
        }
        $orders ="";
        if($order != ''){
            $orders = ' ORDER BY '.$order;
        }
        $select = 'SELECT productos.* FROM '.$this->_name.' LEFT JOIN categorias ON categorias_id = productos_categorias '.$filter.' '.$orders.' LIMIT '.$page.' , '.$amount;
        $res = $this->_conn->query($select)->fetchAsObject();
         return $res;
    }

}