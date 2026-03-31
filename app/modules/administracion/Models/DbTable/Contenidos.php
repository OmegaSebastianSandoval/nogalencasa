<?php 
/**
* clase que genera la insercion y edicion  de contenidos en la base de datos
*/
class Administracion_Model_DbTable_Contenidos extends Db_Table
{
	/**
	 * [ nombre de la tabla actual]
	 * @var string
	 */
	protected $_name = 'content';

	/**
	 * [ identificador de la tabla actual en la base de datos]
	 * @var string
	 */
	protected $_id = 'content_id';

	/**
	 * insert recibe la informacion de un contenido y la inserta en la base de datos
	 * @param  array Array array con la informacion con la cual se va a realizar la insercion en la base de datos
	 * @return integer      identificador del  registro que se inserto
	 */
	public function insert($data){
		$content_title = $data['content_title'];
		$content_subtitle = $data['content_subtitle'];
		$content_introduction = $data['content_introduction'];
		$content_description = $data['content_description'];
		$content_image = $data['content_image'];
		$content_banner = $data['content_banner'];
		$content_section = $data['content_section'];
		$content_delete = $data['content_delete'];
		$content_current_user = $data['content_current_user'];
		$content_date = $data['content_date'];
		$content_link = $data['content_link'];
		$query = "INSERT INTO content( content_title, content_subtitle, content_introduction, content_description, content_image, content_banner, content_section, content_delete, content_current_user, content_date, content_link) VALUES ( '$content_title', '$content_subtitle', '$content_introduction', '$content_description', '$content_image', '$content_banner', '$content_section', '$content_delete', '$content_current_user', '$content_date', '$content_link')";
		$res = $this->_conn->query($query);

		//LOG
		$data['log_tipo'] = "CAMBIO";
		$data['log_log'] = $query;
		$logModel = new Administracion_Model_DbTable_Log();
		$logModel->insert($data);

        return mysqli_insert_id($this->_conn->getConnection());
	}

	/**
	 * update Recibe la informacion de un contenido  y actualiza la informacion en la base de datos
	 * @param  array Array Array con la informacion con la cual se va a realizar la actualizacion en la base de datos
	 * @param  integer    identificador al cual se le va a realizar la actualizacion
	 * @return void
	 */
	public function update($data,$id){
		
		$content_title = $data['content_title'];
		$content_subtitle = $data['content_subtitle'];
		$content_introduction = $data['content_introduction'];
		$content_description = $data['content_description'];
		$content_image = $data['content_image'];
		$content_banner = $data['content_banner'];
		$content_section = $data['content_section'];
		$content_delete = $data['content_delete'];
		$content_current_user = $data['content_current_user'];
		$content_date = $data['content_date'];
		$content_link = $data['content_link'];
		$query = "UPDATE content SET  content_title = '$content_title', content_subtitle = '$content_subtitle', content_introduction = '$content_introduction', content_description = '$content_description', content_image = '$content_image', content_banner = '$content_banner', content_section = '$content_section', content_delete = '$content_delete', content_current_user = '$content_current_user', content_date = '$content_date', content_link = '$content_link' WHERE content_id = '".$id."'";

		$res = $this->_conn->query($query);
	}
}