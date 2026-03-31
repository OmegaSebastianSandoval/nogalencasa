<?php
/**
* Controlador de Usuario que permite la  creacion, edicion  y eliminacion de los Usuarios del Sistema
*/
class Core_userController extends Controllers_Abstract
{
	public function validationAction()
    {
        $modelUser = new Core_Model_DbTable_User();
        $user= $this->_getSanitizedParam("user_user");
        $user2= $this->_getSanitizedParam("user");
        $res_user = $modelUser->searchUserByUser($user);
        if(  $user2 !='' &&  $user2 ==  $user  ){
            http_response_code(200);
        } else {
	        if ( $res_user != false ) {
	            header("HTTP/1.0 400 Usuario no Disponible");
	        } else {
	            http_response_code(200);
	        }
    	}
    }

    public function validationemailAction()
    {
        $modelUser = new Core_Model_DbTable_User();
        $correo= $this->_getSanitizedParam("user_email");
        $correo2= $this->_getSanitizedParam("email");
        $res_user = $modelUser->getList("user_email = '$correo'" ,"");
        if( $correo2 !='' && $correo2 == $correo  ){
            http_response_code(200);
        } else {
            if ( isset($res_user[0])) {
                header("HTTP/1.0 400 Correo ya existe");
            } else {
                http_response_code(200);
            }
        }
    }

    public function validarclaveAction (){
        $clave = $this->_getSanitizedParam("user_password");
        $error_clave = '';
       if(strlen($clave) < 8){
          $error_clave = "La clave debe tener al menos 8 caracteres";
       } else if(strlen($clave) > 16){
          $error_clave = "La clave no puede tener mas de 16 caracteres";
       } else if (!preg_match('`[a-z]`',$clave)){
          $error_clave = "La clave debe tener al menos una  minuscula";
       } else if (!preg_match('`[A-Z]`',$clave)){
          $error_clave = "La clave debe tener al menos una mayuscula";
       } else if (!preg_match('`[0-9]`',$clave)){
          $error_clave = "La clave debe tener al menos un numero";
       }
       if ( $error_clave != '' ) {
            header("HTTP/1.0 400 ".$error_clave);
        } else {
            http_response_code(200);
        }
}


public function validarclave2Action (){
    $clave = $this->_getSanitizedParam("contrasena_persona");
    $error_clave = '';
    if(strlen($clave) < 4){
        $error_clave = "La clave debe ser mayor a 4 caracteres";
     } 
 
   if ( $error_clave != '' ) {
        header("HTTP/1.0 400 ".$error_clave);
    } else {
        http_response_code(200);
    }
}
public function validarclave3Action (){
    $clave = $this->_getSanitizedParam("contrasena_negocio");
    $error_clave = '';
    if(strlen($clave) < 4){
        $error_clave = "La clave debe mayor a 4 caracteres";
     } 
   if ( $error_clave != '' ) {
        header("HTTP/1.0 400 ".$error_clave);
    } else {
        http_response_code(200);
    }
}

public function validarclaveloginAction (){
    $clave = $this->_getSanitizedParam("contrasena");
    $error_clave = '';
   if(strlen($clave) < 4){
      $error_clave = "La clave debe ser mayor a 4 caracteres";
   }
   if ( $error_clave != '' ) {
        header("HTTP/1.0 400 ".$error_clave);
    } else {
        http_response_code(200);
    }
}

  public function validarusuarioAction()
    {
        $modelUser = new Core_Model_DbTable_User();
        $user= $this->_getSanitizedParam("usuario_persona");
        $res_user = $modelUser->searchUserByUser($user);
          if ( $res_user != false ) {
              header("HTTP/1.0 400 Usuario no Disponible");
          } else {
              http_response_code(200);
          }
        }
        public function validarnegocioAction()
    {
        $modelUser = new Core_Model_DbTable_User();
        $user= $this->_getSanitizedParam("usuario_negocio");
        $res_user = $modelUser->searchUserByUser($user);
          if ( $res_user != false ) {
              header("HTTP/1.0 400 Usuario no Disponible");
          } else {
              http_response_code(200);
          }
        }
        public function validaraccionAction()
    {
        $modelSocios = new Administracion_Model_DbTable_Socios();
        $accion= $this->_getSanitizedParam("accion");
        $accion2 = str_pad($accion, 8, "0", STR_PAD_LEFT);
        $res_accion = $modelSocios->getList("socio_carnet='$accion' || socio_carnet='$accion2'","");
          if ( count($res_accion) == 0 ) {
                $error =utf8_decode("Número de acción no valido");
                header("HTTP/1.0 400 ".$error); 
          } else {
              http_response_code(200);
          }
        }
  public function validaraccionnegocioAction()
  {
      $modelSocios = new Administracion_Model_DbTable_Socios();
      $accion= $this->_getSanitizedParam("accion_negocio");
      $accion2 = str_pad($accion, 8, "0", STR_PAD_LEFT);
      $res_accion = $modelSocios->getList("socio_carnet='$accion' || socio_carnet='$accion2'","");
          if ( count($res_accion) == 0 ) {
              $error =utf8_decode("Número de acción no valido");
              header("HTTP/1.0 400 ".$error);
          } else {
              http_response_code(200);
          }
      }
  public function validartelusuarioAction (){
      $tel = $this->_getSanitizedParam("telefono");
      $error_tel = '';
     if(strlen($tel) < 7 ){
        $error_tel = "El número de telefono debe ser minimo de 7 dígitos";
     }
     if ( $error_tel != '' ) {
      $error_tel=utf8_decode($error_tel);
          header("HTTP/1.0 400 ".$error_tel);
      } else {
          http_response_code(200);
      }
  }
  public function validartelnegocioAction (){
      if($this->_getSanitizedParam("telefono_negocio")!=""){
      $tel = $this->_getSanitizedParam("telefono_negocio");
      }
      if($this->_getSanitizedParam("tiendas_telefono")!=""){
          $tel = $this->_getSanitizedParam("tiendas_telefono");
          }
          if($this->_getSanitizedParam("tiendas_telefono2")!=""){
              $tel = $this->_getSanitizedParam("tiendas_telefono2");
              }
      $error_tel = '';
     if(strlen($tel) < 7 ){
        $error_tel = "El número de telefono debe ser minimo de 7 dígitos";
     }
     if ( $error_tel != '' ) {
      $error_tel=utf8_decode($error_tel);
          header("HTTP/1.0 400 ".$error_tel);
      } else {
          http_response_code(200);
      }
  }

  public function validarwhatsappnegocioAction (){
      if($this->_getSanitizedParam("whatsapp")!=""){
      $cel = $this->_getSanitizedParam("whatsapp");
  }

    if($this->_getSanitizedParam("tiendas_whatsapp")!=""){
        $cel = $this->_getSanitizedParam("tiendas_whatsapp");
    }
      $error_cel = '';
     if(strlen($cel) != 10 ){
        $error_cel = "El numero de whatsapp debe ser de 10 dígitos";
     }
     if ( $error_cel != '' ) {
         $error_cel=utf8_decode($error_cel);
          header("HTTP/1.0 400 ".$error_cel);
      } else {
          http_response_code(200);
      }
  }

  public function validarusuarioexisteAction(){
    $modelUser = new Core_Model_DbTable_User();
    $user= $this->_getSanitizedParam("usuario");
    $res_user = $modelUser->searchUserByUser($user);
      if ( $res_user == false ) {
          header("HTTP/1.0 400 El usuario no existe");
      } else {
          http_response_code(200);
      }
    }


}