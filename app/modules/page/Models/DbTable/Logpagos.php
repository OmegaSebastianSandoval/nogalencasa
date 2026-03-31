<?php 

/**
* 
*/
class Page_Model_DbTable_Logpagos extends Db_Table
{
	protected $_name = 'log_pagos';
	protected $_id = 'id';

	public function insert($request, $firmacreada, $respuesta, $transactionState, $estadoTX, $value, $referenceCodecarro, $franquicia){
		
		$query = "INSERT INTO log_pagos(request, firmacreada, firmacadena, firma, estadoTX, value, referenceCodecarro, franquicia) VALUES ('$request', '$firmacreada', '$respuesta', '$transactionState', '$estadoTX', '$value', '$referenceCodecarro', '$franquicia')";
		$res = $this->_conn->query($query);
        return mysqli_insert_id($this->_conn->getConnection());
	}
}