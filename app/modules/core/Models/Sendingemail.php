<?php

/**
 * Modelo del modulo Core que se encarga de  enviar todos los correos nesesarios del sistema.
 */
class Core_Model_Sendingemail
{
    /**
     * Intancia de la calse emmail
     * @var class
     */
    protected $email;

    protected $_view;

    public function __construct($view)
    {
        $this->email = new Core_Model_Mail();
        $this->_view = $view;
    }


    public function forgotpassword($user)
    {
        if ($user) {
            $code = [];
            $code['user'] = $user->user_id;
            $code['code'] = $user->code;
            $codeEmail = base64_encode(json_encode($code));
            $this->_view->url = "http://" . $_SERVER['HTTP_HOST'] . "/administracion/index/changepassword?code=" . $codeEmail;
            $this->_view->host = "http://" . $_SERVER['HTTP_HOST'] . "/";
            $this->_view->nombre = $user->user_names . " " . $user->user_lastnames;
            $this->_view->usuario = $user->user_user;

            $this->email->getMail()->addAddress($user->user_email, $user->user_names . " " . $user->user_lastnames);
            $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/forgotpassword.php');
            $this->email->getMail()->Subject = "Recuperación de Contraseña Gestor de Contenidos";
            $this->email->getMail()->msgHTML($content);
            $this->email->getMail()->AltBody = $content;
            if ($this->email->sed() == true) {
                return true;
            } else {
                return false;
            }
        }
    }



    public function enviarCompra($id)
    {
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $productos = $productosModel->getList(" id_carrito='$id' ", "");
        $incripcion = $formularioModel->getById($id);

        $this->_view->inscripcion = $incripcion;
        $this->_view->productos = $productos;
        if (APPLICATION_ENV == 'production') {
            $this->email->getMail()->addAddress("".$incripcion->pedido_correo, "".$incripcion->pedido_nombre);
            $this->email->getMail()->addBCC("nmendez@clubelnogal.com");
            $this->email->getMail()->addBCC("labodega@clubelnogal.com");
            $this->email->getMail()->addBCC("jjtriana@clubelnogal.com");
            $this->email->getMail()->addBCC("nogalencasa@clubelnogal.com");
        }

        $this->email->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");


        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/compra.php');
        $this->email->getMail()->Subject = "Notificación de Compra - Nogal en casa";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function enviarError($id)
    {
        $formularioModel = new Page_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $productos = $productosModel->getList(" id_carrito='$id' ", "");
        $incripcion = $formularioModel->getById($id);
        $this->_view->inscripcion = $incripcion;
        $this->_view->productos = $productos;
        if (APPLICATION_ENV == 'production') {

            $this->email->getMail()->addAddress("soporteomega@omegawebsystems.com");
        }
        $this->email->getMail()->addCC("desarrollo8@omegawebsystems.com");

        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/error.php');
        $this->email->getMail()->Subject = "Notificación de error Compra";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function envioLimite($producto_id)
    {
        $productosModel = new Page_Model_DbTable_Productos();
        $productos = $productosModel->getById($producto_id);
        $this->_view->productos = $productos;
        $this->email->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");
        if (APPLICATION_ENV == 'production') {

            $this->email->getMail()->addAddress("nogaldelivery@clubelnogal.com");
            $this->email->getMail()->addCC("lhoyos@clubelnogal.com");
            $this->email->getMail()->addCC("nmendez@clubelnogal.com");
        }
        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/limite.php');
        $this->email->getMail()->Subject = "Alerta stock de producto";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function enviarErrorPedido($id)
    {

        $formularioModel = new Page_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $productos = $productosModel->getList(" id_carrito='$id' ", "");
        $incripcion = $formularioModel->getById($id);
        $this->_view->inscripcion = $incripcion;
        $this->_view->productos = $productos;

        if (APPLICATION_ENV == 'production') {
            $this->email->getMail()->addAddress($incripcion->pedido_correo,  $incripcion->pedido_nombre);       
            $this->email->getMail()->addBCC("nmendez@clubelnogal.com");
            $this->email->getMail()->addBCC("labodega@clubelnogal.com");
            $this->email->getMail()->addBCC("jjtriana@clubelnogal.com");
            $this->email->getMail()->addBCC("nogalencasa@clubelnogal.com");
        }


        $this->email->getMail()->addCC("soporteomega@omegawebsystems.com");
        $this->email->getMail()->addCC("desarrollo8@omegawebsystems.com");



        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/errorCompra.php');
        $this->email->getMail()->Subject = "Notificación de error Compra";
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;
        if ($this->email->sed() == true) {
            //echo "envio";
        } else {
            //echo "no envio";
        }
    }

    public function recuperacion($data, $url)
    {
        $this->_view->data = $data;
        $this->_view->url = $url;
        $this->email->getMail()->addAddress($data['sbe_mail'], $data['sbe_nomb']. " " . $data['sbe_apel']);
        $this->email->getMail()->addBCC("desarrollo8@omegawebsystems.com");

        $content = $this->_view->getRoutPHP('/../app/modules/core/Views/templatesemail/Recuperacion.php');
        $this->email->getMail()->Subject = 'Recuperacion de contraseña';
        $this->email->getMail()->msgHTML($content);
        $this->email->getMail()->AltBody = $content;

        if ($this->email->sed() == true) {
            return 1;
        } else {
            return 2;
        }
    }

}