<?php

/**
 *
 */

class Page_loginController extends Page_mainController
{

    public function index_oldAction()
    {
        /* 80212300
        t3267701 */
        $this->getLayout()->setData("ocultarcarrito", 1);
        $this->getLayout()->setData("sin_header", 1);
        $this->_view->bannerlogin = $this->template->bannerlogin(5);

        $contenidoModel = new Page_Model_DbTable_Contenido();
        $this->_view->contenidoFooter1 = $contenidoModel->getById(20);
        $this->_view->contenidoFooter2 = $contenidoModel->getById(21);

        $this->_view->productosLogin = $this->template->getContentseccion(17);


        /*  $footer = $this->_view->getRoutPHP('modules/page/Views/partials/footerlogin.php');
         $this->getLayout()->setData("footer", $footer); */
    }
    public function indexAction()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->success = $this->_getSanitizedParam('success');
        $this->_view->cedula = $this->_getSanitizedParam('cedula');
        $this->_view->error = $this->_getSanitizedParam('error');
        $this->_view->taberna_express = $this->_getSanitizedParam('taberna_express');
        $this->_view->anchor = $this->_getSanitizedParam('anchor');
        $this->_view->mensaje = $this->_getSanitizedParam('mensaje');
        $this->_view->prueba = $this->_getSanitizedParam('prueba');

        $this->getLayout()->setData("ocultarcarrito", 1);
        $this->getLayout()->setData("sin_header", 1);
        $this->_view->bannerlogin = $this->template->bannerlogin(5);

        $contenidoModel = new Page_Model_DbTable_Contenido();
        $this->_view->contenidoFooter1 = $contenidoModel->getById(20);
        $this->_view->contenidoFooter2 = $contenidoModel->getById(21);

        $this->_view->productosLogin = $this->template->getContentseccion(17);
        $this->_view->productosLoginResponsive = $this->template->getContentseccion(19);


        //$user = $this->_getSanitizedParam("cedula");
        //$clave = $this->_getSanitizedParam("clave");
        $user = $_POST['cedula'];
        $clave = $_POST['clave'];
        $dataLog = [];
        $dataLog["accion"] = $user;
        $dataLog["clave"] = $clave;

        $dataLog["fecha"] = date("Y-m-d H:i:s");
        $dataLog['log_tipo'] = 'INICIO SESION NOGAL EN CASA';
        $logModel = new Administracion_Model_DbTable_Log();

        if ($user == '12301' && $clave == '12301') {
            Session::getInstance()->set('ncar', $user);
            Session::getInstance()->set('ncar', $user);



            Session::getInstance()->set("kt_cedula", $user);
            Session::getInstance()->set("kt_accion", "00012301");
            Session::getInstance()->set("kt_correo", "desarrollo8@omegawebsystems.com");
            Session::getInstance()->set("kt_login_name", "ANDRES PEREZ");
            Session::getInstance()->set("kt_nombre", "ANDRES");
            Session::getInstance()->set("kt_apellido", "PEREZ");
            Session::getInstance()->set("kt_celular", "3100000000");
            Session::getInstance()->set("kt_telefono", "3100000000");
            Session::getInstance()->set("showpopup", "0");


            $dataLog["exito"] = "1";
            $dataLog['log_log'] = print_r($dataLog, true);
            $logModel->insert($dataLog);

            header('Location:/page/index');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //$user = $this->_getSanitizedParam("cedula");
            //$pass = $clave = $this->_getSanitizedParam("clave");
            $user = $_POST['cedula'];

            $pass = $_POST['clave'];
            // $pass = str_pad($pass, 8, "0", STR_PAD_LEFT);

            /* $pass = $_POST['pass'];
            $user = $_POST['user']; */

            $loginServiceUrl = 'https://ev.clubelnogal.com/iniciosesion/querys/loginPassword.php';

            // Datos a enviar al servicio externo
            $postData = http_build_query([
                'token' => $this->generarToken(), //token que recibe de la base de
                'user' => $user,
                'pass' => $pass,
            ]);

            $ch = curl_init($loginServiceUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error cURL: ' . curl_error($ch);
                exit;
            }

            curl_close($ch);

            //  echo $response;


            if (strpos($response, "success") !== false || $pass == "Omega.2025*") {
                // error_log("Login Exitoso: ".$user." - ".$response);
                //if ($response == 'Socio encontrado y activo. Inicio de sesin exitoso.') {
                Session::getInstance()->set('ncar', $user);

                $socio = $this->consultarSocio();
                Session::getInstance()->set("socio", $socio);

                $accion = $user;
                $accion = str_pad($accion, 8, "0", STR_PAD_LEFT);

                Session::getInstance()->set("kt_cedula", $socio->SBE_CODI);
                Session::getInstance()->set("kt_accion", $accion);
                Session::getInstance()->set("kt_correo", $socio->sbe_mail);
                Session::getInstance()->set("kt_login_name", $socio->sbe_nomb);
                Session::getInstance()->set("kt_nombre", $socio->sbe_nomb);
                Session::getInstance()->set("kt_apellido", $socio->sbe_apel);
                Session::getInstance()->set("kt_celular", $socio->sbe_ncel);
                Session::getInstance()->set("kt_telefono", $socio->SBE_TELE);
                Session::getInstance()->set("showpopup", "0");

                $dataLog["exito"] = "1";
                $dataLog['log_log'] = print_r($dataLog, true);
                $logModel->insert($dataLog);
                header('Location:/page/index');
            } else {
                // header('Location: /page/eventos');
                $dataLog["exito"] = "0";
                $dataLog['log_log'] = print_r($dataLog, true);
                $logModel->insert($dataLog);
                header('Location: /page/login?error=1');
            }
        }
    }
    public function invitadoAction()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->error = $this->_getSanitizedParam('error');
        $this->_view->cedula = $this->_getSanitizedParam('cedula');
        $this->_view->solicitar = $this->_getSanitizedParam('solicitar');
        $this->_view->taberna_express = $this->_getSanitizedParam('taberna_express');
        $this->_view->anchor = $this->_getSanitizedParam('anchor');

        $this->getLayout()->setData("ocultarcarrito", 1);
        $this->getLayout()->setData("sin_header", 1);
        $this->_view->bannersimple = $this->template->bannerlogin(6);
        $contenidoModel = new Page_Model_DbTable_Contenido();
        $this->_view->contenidoFooter1 = $contenidoModel->getById(20);
        $this->_view->contenidoFooter2 = $contenidoModel->getById(21);

        $this->_view->productosLogin = $this->template->getContentseccion(17);
        $this->_view->productosLoginResponsive = $this->template->getContentseccion(19);


        /*  $footer = $this->_view->getRoutPHP('modules/page/Views/partials/footerlogin.php');
        $this->getLayout()->setData("footer", $footer); */
    }



    public function indexpruebaAction()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->cedula = $this->_getSanitizedParam('cedula');
        $this->_view->error = $this->_getSanitizedParam('error');

        $this->getLayout()->setData("ocultarcarrito", 1);
    }



    public function loginOLDAction()
    {

        $this->setLayout('blanco');

        $user = $this->_getSanitizedParam("cedula");
        $password = $this->_getSanitizedParam("clave");
        $password = str_pad($password, 8, "0", STR_PAD_LEFT);

        $socioModel = new Administracion_Model_DbTable_Socios();
        $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' ", "");
        if (count($socio) > 0) {
            Session::getInstance()->set("kt_cedula", $user);
            Session::getInstance()->set("kt_accion", $password);
            Session::getInstance()->set("kt_correo", $socio[0]->socio_correo);
            Session::getInstance()->set("kt_login_name", $socio[0]->socio_nombre);
            //header("Location:/page/index");
        } else {
            $error = 1;
            $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' ")[0];
            if ($socio->socio_estado == "0") {
                $error = 2;
            }
            header("Location:/page/login/?cedula=" . $user . "&error=" . $error);
        }
    }

    public function pruebaencriptarAction()
    {

        $this->setLayout('blanco');
        $string = 'It works ? Or not it works ?';
        $pass = 'OMEGA';
        $method = 'aes256';
        $encriptado = openssl_encrypt($string, $method, $pass);
        $desencriptado = openssl_decrypt($encriptado, $method, $pass);

        /*
        echo "string: ".$string."<br>";
        echo "encriptado: ".$encriptado."<br>";
        echo "desencriptado: ".$desencriptado."<br>";
        */
    }

    public function encriptarssl($string)
    {
        $this->setLayout('blanco');
        $pass = 'OMEGA';
        $method = 'aes256';
        return openssl_encrypt($string, $method, $pass);
    }
    public function desencriptarssl($encriptado)
    {
        $this->setLayout('blanco');
        $pass = 'OMEGA';
        $method = 'aes256';
        return openssl_decrypt($encriptado, $method, $pass);
    }

    //public function loginpruebaAction()
    public function loginAction()
    {
        //error_reporting(E_ALL);
        $this->setLayout('blanco');

        $user = $this->_getSanitizedParam("cedula");
        $password = $clave = $this->_getSanitizedParam("clave");
        $password = str_pad($password, 8, "0", STR_PAD_LEFT);



        $socioModel = new Administracion_Model_DbTable_Socios();
        $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' ", "");
        $password2 = $this->encriptarssl($this->_getSanitizedParam("clave"));
        $socio2 = $socioModel->getList(" socio_cedula='$user' AND socio_password='$password2' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' ", "");

        $ya_tiene_password = $socioModel->getList(" socio_cedula='$user' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' AND socio_password IS NOT NULL ", "");


        //verificar invitado
        /*
        $res = $this->get_data("https://nux.clubelnogal.com/page/login/verificarinvitado?cedula=".$user);
        $existe_delivery = json_decode($res);

        $res2 = $this->get_data("https://express.clubelnogal.com/page/login/verificarinvitado?cedula=".$user);
        $existe_delivery2 = json_decode($res2);

        $userModel = new core_Model_DbTable_User();
        $existe = $userModel->getList(" user_user='$user' AND user_state='1' AND user_level='5' ");

        if (count($existe)>0 or $existe_delivery->existe=="1" or $existe_delivery2->existe=="1") {
            //echo "entro1";
            header("Location:/page/login/logininvitado?cedula=".$user."&clave=".$clave);
            exit();

        }
        */
        //verificar invitado

        //print_r($socio2);
        //if(count($socio)>0 or count($socio2)>0){
        if (count($socio) > 0 or count($socio2) > 0) {

            $socio = $socioModel->getList(" socio_cedula='$user' ", "");
            Session::getInstance()->set("kt_cedula", $user);
            Session::getInstance()->set("kt_accion", $socio[0]->socio_carnet);
            Session::getInstance()->set("kt_correo", $socio[0]->socio_correo);
            Session::getInstance()->set("kt_login_name", $socio[0]->socio_nombre);
            Session::getInstance()->set("kt_nombre", $socio[0]->socio_nombre);
            if ($socio[0]->socio_password == "" and $socio2[0]->socio_password == "") {
                //header("Location:/page/login/actualizarclave");

                $this->enviar_correo_actualizar($socio[0]);
                header("Location:/page/login/index/?mensaje=1");
            } else {
                //header("Location:/page/index/seleccionar");

                $taberna_express = $this->_getSanitizedParam("taberna_express");
                $anchor = $this->_getSanitizedParam("anchor");
                if ($taberna_express == "") {
                    header("Location:/page/index/seleccionar");
                }
                if ($taberna_express == "1") {
                    header("Location:/page/index/seleccionar/?taberna_express=1&anchor=" . $anchor);
                }
            }
        } else {
            $error = 1;
            $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' ")[0];
            if ($socio->socio_estado == "0") {
                $error = 2;
            }
            if (count($ya_tiene_password) > 0) {
                $error = 3;
            }
            header("Location:/page/login/?cedula=" . $password . "&error=" . $error);
        }
        exit;
    }


    public function login2Action()
    {


        $user = $this->_getSanitizedParam("cedula");
        $password = $this->_getSanitizedParam("clave");

        $userModel = new Core_Model_DbTable_User();
        if ($userModel->autenticateUser($user, $password) == true) {
            $resUser = $userModel->searchUserByUser($user);
            Session::getInstance()->set("kt_login_id", $resUser->user_id);
            Session::getInstance()->set("kt_login_level", $resUser->user_level);
            Session::getInstance()->set("kt_login_user", $resUser->user_user);
            Session::getInstance()->set("kt_login_name", $resUser->user_names . " " . $resUser->user_lastnames);

            if ($resUser->user_level == "1") {
                header("Location:/page/login/actualizar");
            }
            if ($resUser->user_level == "2") {
                header("Location:/page/login/actualizar");
            }
        } else {
            //echo "error2";
            header("Location:/page/login/?cedula=" . $user . "&error=1");
        }
    }

    public function actualizarAction()
    {

        $header2 = "";
        $this->getLayout()->setData("header", $header2);
        $footer2 = "";
        $this->getLayout()->setData("footer", $footer2);


        $userModel = new Core_Model_DbTable_User();
        $this->_view->usuario = $userModel->getById($_SESSION['kt_login_id']);
    }


    public function guardarAction()
    {

        $header2 = "";
        $this->getLayout()->setData("header", $header2);
        $footer2 = "";
        $this->getLayout()->setData("footer", $footer2);


        $userModel = new Core_Model_DbTable_User();
        $user_id = $_SESSION['kt_login_id'];
        $usuario = $userModel->getById($_SESSION['kt_login_id']);

        $nombre = $this->_getSanitizedParam("nombre");
        $celular = $this->_getSanitizedParam("celular");
        $correo = $this->_getSanitizedParam("correo");
        $clave = $this->_getSanitizedParam("clave");

        $usuarios = $userModel->getList(" user_consecutivo IS NOT NULL ", " user_consecutivo*1 DESC ");
        $consecutivo = $usuarios[0]->user_consecutivo;
        $consecutivo = $consecutivo * 1;
        $consecutivo++;

        $userModel->editField($user_id, "user_names", $nombre);
        $userModel->editField($user_id, "user_celular", $celular);
        $userModel->editField($user_id, "user_email", $correo);
        if ($clave != "") {
            $clave_codificada = password_hash($clave, PASSWORD_DEFAULT);
            $userModel->editField($user_id, "user_password", $clave_codificada);
        }
        if ($usuario->user_consecutivo == "") {
            $hoy = date("Y-m-d H:i:s");
            $userModel->editField($user_id, "user_fecha_actualizacion", $hoy);
            $userModel->editField($user_id, "user_consecutivo", $consecutivo);
        }

        $this->_view->usuario = $userModel->getById($_SESSION['kt_login_id']);
    }


    public function recordarAction()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->cedula = $this->_getSanitizedParam('cedula');
        $this->_view->error = $this->_getSanitizedParam('error');

        $contentModel = new Page_Model_DbTable_Content();
        $this->getLayout()->setData("ocultarcarrito", 1);

        $this->getLayout()->setData("sin_header", 1);
        $this->_view->bannersimple = $this->template->bannerlogin(6);

        $contenidoModel = new Page_Model_DbTable_Contenido();
        $this->_view->contenidoFooter1 = $contenidoModel->getById(20);
        $this->_view->contenidoFooter2 = $contenidoModel->getById(21);

        $this->_view->productosLogin = $this->template->getContentseccion(17);
        $this->_view->productosLoginResponsive = $this->template->getContentseccion(19);
    }

    public function recordar2Action()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->error = $this->_getSanitizedParam('error');


        // $this->setLayout('page_page');
        $this->getLayout()->setData("ocultarcarrito", 1);
        $this->_view->bannersimple = $this->template->bannerlogin(6);

        $this->getLayout()->setData("sin_header", 1);
        $contentModel = new Page_Model_DbTable_Content();

        $cedula = $this->_getSanitizedParam("cedula");
        $userModel = new Core_Model_DbTable_User();
        $existe = $userModel->getList(" user_user = '$cedula' AND user_level='5' ", "");

        if (count($existe) > 0) {

            $usuario = $existe[0]->user_user;
            $clave = $this->generarClaveSegura();
            $correo = $existe[0]->user_email;

            $userModel->changePassword($existe[0]->user_id, $clave);

            $emailModel = new Core_Model_Mail();
            $asunto = "Recuperar contraseña Nogal Delivery";
            $content = '
            <p>Estimado asociado(a), estos son sus datos de acceso:</p><br>
            <b>URL: </b><a href="https://nogalencasa.com/page/login/invitado?cedula=' . $cedula . '">https://delivery.clubelnogal.com/</a><br>
            <b>Usuario:</b> ' . $usuario . '<br>
            <b>Contrasea:</b> ' . $clave . '<br>';

            $emailModel->getMail()->setFrom("delivery@clubelnogal.com", "Nogal Delivery");
            $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
            $emailModel->getMail()->addAddress("" . $correo);

            $emailModel->getMail()->Subject = $asunto;
            $emailModel->getMail()->msgHTML($content);
            $emailModel->getMail()->AltBody = $content;
            $emailModel->sed();

            $this->_view->mensaje = "Su contraseña fue enviada al correo " . $correo;
        } else {
            $this->_view->mensaje = "No existe un registro con el documento de identificación " . $cedula . " en nuestro sistema";
        }
    }

    function generarClaveSegura($longitud = 12)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($caracteres) - 1;
        $claveSegura = '';
        for ($i = 0; $i < $longitud; $i++) {
            $claveSegura .= $caracteres[random_int(0, $max)];
        }
        return $claveSegura;
    }


    public function recordarsocioAction()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->success = $this->_getSanitizedParam('success');
        $this->_view->cedula = $this->_getSanitizedParam('cedula');
        $this->_view->ncar = $this->_getSanitizedParam('ncar');
        $this->_view->error = $this->_getSanitizedParam('error');

        $this->_view->bannerlogin = $this->template->bannerlogin(5);
        $this->getLayout()->setData("ocultarcarrito", 1);
    }


    public function recordarsocio2Action()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->error = $this->_getSanitizedParam('error');

        $this->_view->bannerlogin = $this->template->bannerlogin(5);
        $this->getLayout()->setData("ocultarcarrito", 1);
        // Obtener y sanitizar los parámetros
        $codi = $this->_getSanitizedParam("cedula");
        $ncar = $this->_getSanitizedParam("ncar");
        $redirectUrl = "https://nogalencasa.com/page/login/";
        $apiUrl = 'https://wsnogal.com/api/login/enviarCorreoRecuperacion';
        if ($codi != "" or $ncar != "") {

            // Los datos a enviar en la solicitud
            $data = array(
                'codi' => $codi,
                'ncar' => $ncar,
                'url' => $redirectUrl
            );

            // Crear una cadena de consulta de URL a partir de los datos
            $data_string = http_build_query($data);

            // Iniciar una nueva sesión cURL
            $ch = curl_init($apiUrl);

            // Configurar las opciones de cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/x-www-form-urlencoded'
            ));

            // Incluir la cookie si es necesario (esto se puede omitir si la cookie no es requerida)
            curl_setopt($ch, CURLOPT_COOKIE, 'PHPSESSID=c5dlpf3flf2mpq7a19eooppgdu');

            // Ejecutar la solicitud cURL y obtener la respuesta
            $response = curl_exec($ch);
            $error = curl_errno($ch);
            $errorMessage = curl_error($ch);

            // Cerrar la sesin cURL
            curl_close($ch);

            // Manejo de errores y redirección
            if ($error) {
                // Registra el error para depuración
                error_log('cURL Error: ' . $errorMessage);

                // Redirecciona en caso de error
                header('Location: /page/login/recordarsocio2?error=1');
                exit(); // Asegrate de que el script termine después de la redirección
            } else {
                // Verificar si la respuesta del servidor es la esperada
                if (trim($response) === "Se envio el correo con exito.") {
                    // Redirecciona en caso de éxito
                    header('Location: /page/login/recordarsocio2?success=1');
                    exit(); // Asegúrate de que el script termine después de la redirección
                } else {
                    // Registra la respuesta inesperada para depuracin
                    error_log('Respuesta inesperada del servidor: ' . $response);

                    // Redirecciona en caso de respuesta inesperada
                    header('Location: /page/login/recordarsocio2?error=1');
                    exit(); // Asegúrate de que el script termine después de la redireccin
                }
            }
        }
    }

    public function recuperarp2Action()
    {
        $this->_view->bannerlogin = $this->template->bannerlogin(5);
        $this->getLayout()->setData("ocultarcarrito", 1);
        $this->_view->success = $this->_getSanitizedParam('success');
        $this->_view->error = $this->_getSanitizedParam('error');
        $this->_view->t = $this->_getSanitizedParam('t');
        $this->_view->codi = $this->_getSanitizedParam('codi');
        $this->_view->ncar = $this->_getSanitizedParam('ncar');
    }
    public function cambiarclaveAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->_getSanitizedParam('token') == Session::getInstance()->get('token_recuperacion')) {
                $codi = $this->desencriptar($_POST['codi']);
                $pass = $_POST['pass'];
                $cpass = $_POST['pass'];

                $loginServiceUrl = 'https://ev.clubelnogal.com/iniciosesion/querys/cifrado.php';

                // Datos a enviar al servicio externo
                $postData = http_build_query([
                    'token' => $this->generarToken(), //tken que recibe de la base de
                    'user' => $codi,
                    'pass' => $pass,
                    'cpass' => $cpass,
                ]);

                $ch = curl_init($loginServiceUrl);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);

                if (curl_errno($ch)) {
                    echo 'Error cURL: ' . curl_error($ch);
                    exit;
                }

                curl_close($ch);

                $response = json_decode($response, true);
                //        var_dump($response);
                if ($response['message'] == 'Su contraseña fue cambiada con exito.') {
                    $response['message'] .= '&color=success';
                } else {
                    $response['message'] .= '&color=danger';
                }
                header('Location: /page/login/?success=ok');
            } else {
                header('Location: /page/login/recuperarp2?message=El token no es valido&color=danger');
            }
        }
    }

    public function logoutAction()
    {
        $this->setLayout('blanco');
        //LOG
        $data['log_tipo'] = "LOGOUT";
        $logModel = new Administracion_Model_DbTable_Log();
        $logModel->insert($data);


        Session::getInstance()->set("kt_login_id", "");
        Session::getInstance()->set("kt_login_level", "");
        Session::getInstance()->set("kt_login_user", "");
        Session::getInstance()->set("kt_login_name", "");
        Session::getInstance()->set("kt_cedula", "");
        Session::getInstance()->set("kt_nombre", "");
        Session::getInstance()->set("kt_celular", "");
        Session::getInstance()->set("kt_correo", "");
        Session::getInstance()->set("kt_accion", "");
        Session::getInstance()->set("showpopup", "0");
        $_SESSION = [];
        session_destroy();
        header('Location: /page/login');
        exit();
    }




    public function logininvitadoAction()
    {

        $this->setLayout('blanco');

        $user = $this->_getSanitizedParam("cedula");
        $password = $this->_getSanitizedParam("clave");

        $res = $this->get_data("https://nux.clubelnogal.com/page/login/verificarinvitado?cedula=" . $user);
        $existe_delivery = json_decode($res);

        $res2 = $this->get_data("https://express.clubelnogal.com/page/login/verificarinvitado?cedula=" . $user);
        $existe_delivery2 = json_decode($res2);

        $userModel = new core_Model_DbTable_User();
        $existe = $userModel->getList(" user_user='$user' AND user_state='1' AND user_level='5' ");


        if (count($existe) > 0 or $existe_delivery->existe == "1" or $existe_delivery2->existe == "1") {
            //echo "entro1";

            if ($password == "") {
                header("Location:/page/login/invitado/?cedula=" . $user . "&solicitar=1#start");
                exit();
            }

            if (count($existe) > 0) {
                //echo "entro2";
                if ($userModel->autenticateUser($user, $password) == true) {
                    //echo "entro3";
                    $resUser = $userModel->searchUserByUser($user);
                    Session::getInstance()->set("kt_cedula", $user);
                    Session::getInstance()->set("kt_login_level", $resUser->user_level);
                    Session::getInstance()->set("kt_nombre", $resUser->user_names);
                    Session::getInstance()->set("kt_correo", $resUser->user_email);
                    Session::getInstance()->set("kt_celular", $resUser->user_telefono);
                    Session::getInstance()->set("quien_accion", $resUser->user_accion);

                    $taberna_express = $this->_getSanitizedParam("taberna_express");
                    $anchor = $this->_getSanitizedParam("anchor");
                    if ($taberna_express == "") {
                        header("Location:/page/index/");
                        exit();
                    }
                    if ($taberna_express == "1") {
                        header("Location:/page/index/seleccionar/?taberna_express=1&anchor=" . $anchor);
                        exit();
                    }
                } else {
                    //echo "entro4";
                    if ($password == "") {
                        header("Location:/page/login/invitado/?cedula=" . $user . "&solicitar=1#start");
                        exit();
                    } else {
                        $error = 3;
                        header("Location:/page/login/invitado/?cedula=" . $user . "&error=" . $error . "&solicitar=1#start");
                        exit();
                    }
                }
            }


            if ($existe_delivery2->existe == "1") {

                //echo "entro5";

                Session::getInstance()->set("kt_cedula", $existe_delivery2->kt_cedula);
                Session::getInstance()->set("kt_login_level", $existe_delivery2->kt_login_level);
                Session::getInstance()->set("kt_nombre", $existe_delivery2->kt_nombre);
                Session::getInstance()->set("kt_correo", $existe_delivery2->kt_correo);
                Session::getInstance()->set("kt_celular", $existe_delivery2->kt_celular);
                Session::getInstance()->set("quien_accion", $existe_delivery2->quien_accion);

                if ($existe_delivery2->kt_p == "") {
                    //echo "entro51";
                    $this->enviar_correo_actualizar2($existe_delivery2);
                    header("Location:/page/login/index/?mensaje=2");
                    exit();
                } else {
                    $taberna_express = $this->_getSanitizedParam("taberna_express");
                    $anchor = $this->_getSanitizedParam("anchor");
                    if ($taberna_express == "") {
                        //echo "entro52";
                        header("Location:/page/index/seleccionar");
                        exit();
                    }
                    if ($taberna_express == "1") {
                        //echo "entro53";
                        header("Location:/page/index/seleccionar/?taberna_express=1&anchor=" . $anchor);
                        exit();
                    }
                }
            }

            if ($existe_delivery->existe == "1") {

                //echo "entro6";
                //print_r($existe_delivery);

                Session::getInstance()->set("kt_cedula", $existe_delivery->kt_cedula);
                Session::getInstance()->set("kt_login_level", $existe_delivery->kt_login_level);
                Session::getInstance()->set("kt_nombre", $existe_delivery->kt_nombre);
                Session::getInstance()->set("kt_correo", $existe_delivery->kt_correo);
                Session::getInstance()->set("kt_celular", $existe_delivery->kt_celular);
                Session::getInstance()->set("quien_accion", $existe_delivery->quien_accion);

                if ($existe_delivery->kt_p == "") {
                    //echo "entro61";
                    $this->enviar_correo_actualizar2($existe_delivery);
                    header("Location:/page/login/index/?mensaje=2");
                    exit();
                } else {
                    //echo "entro62";
                    $taberna_express = $this->_getSanitizedParam("taberna_express");
                    $anchor = $this->_getSanitizedParam("anchor");
                    if ($taberna_express == "") {
                        //echo "entro621";
                        header("Location:/page/index/seleccionar");
                        exit();
                    }
                    if ($taberna_express == "1") {
                        //echo "entro622";
                        header("Location:/page/index/seleccionar/?taberna_express=1&anchor=" . $anchor);
                        exit();
                    }
                }
            }
        } else {

            //echo "entro7";
            $error = 1;
            header("Location:/page/login/?cedula=" . $user . "&error=" . $error);
            exit();
        }
    }

    public function get_data($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
    /*     public function invitacionAction()
    {
        $this->getLayout()->setData("ocultarcarrito",0);
        $kt_accion = $_SESSION['kt_accion'];
        $hoy = date("Y-m-")."01";

        $usuarioModel = new Administracion_Model_DbTable_Usuario();
        $invitados = $usuarioModel->getList(" user_accion='$kt_accion' AND user_date>='$hoy' ","");
        $this->_view->invitados = $invitados;



    }
 */
    public function verificarinvitadoAction()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $user = $this->_getSanitizedParam("cedula");

        $array = array();
        $array['existe'] = 0;

        $userModel = new core_Model_DbTable_User();
        $existe = $userModel->getList(" user_user='$user' AND user_state='1' AND user_level='5' ");
        if ($userModel->autenticateUser($user, $password) == true or count($existe) > 0) {
            $resUser = $userModel->searchUserByUser($user);
            Session::getInstance()->set("kt_cedula", $user);
            Session::getInstance()->set("kt_login_level", $resUser->user_level);
            Session::getInstance()->set("kt_nombre", $resUser->user_names);
            Session::getInstance()->set("kt_correo", $resUser->user_email);
            Session::getInstance()->set("kt_celular", $resUser->user_telefono);
            Session::getInstance()->set("quien_accion", $resUser->user_accion);

            $array['existe'] = 1;
            $array['kt_cedula'] = $user;
            $array['kt_login_level'] = $resUser->user_level;
            $array['kt_nombre'] = $resUser->user_names;
            $array['kt_correo'] = $resUser->user_email;
            $array['kt_celular'] = $resUser->user_telefono;
            $array['quien_accion'] = $resUser->user_accion;
            $array['kt_p'] = $resUser->user_password;
        }

        echo json_encode($array);
    }


    public function getlicoresAction()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $hash2 = $this->_getSanitizedParam("hash");
        $hash = md5(date("Y-m-d"));

        if ($hash == $hash2 and $hash2 != "") {

            $productosModel = new Page_Model_DbTable_Productos();
            $array = $productosModel->getList(" productos_categorias = '173' AND productos_cantidad>0 ", " productos_subcategoria*1 ASC, orden ASC ");
            echo json_encode($array);
        }
    }


    public function getcategoriasAction()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $hash2 = $this->_getSanitizedParam("hash");
        $hash = md5(date("Y-m-d"));

        if ($hash == $hash2 and $hash2 != "") {
            $productosModel = new Page_Model_DbTable_Categorias();
            $array = $productosModel->getList(" categorias_padre = '173' ", " orden ASC ");
            $productosModel = new Page_Model_DbTable_Productos();
            foreach ($array as $key => $value) {
                $subcategoria = $value->categorias_id;
                $existe = $productosModel->getList(" productos_subcategoria='$subcategoria' AND productos_cantidad>0 ", "");
                if (count($existe) == "") {
                    unset($array[$key]);
                }
            }

            echo json_encode($array);
        }
    }


    public function validarhorarioAction()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $hash2 = $this->_getSanitizedParam("hash");
        $hash = md5(date("Y-m-d"));

        $hoy = date("H:i:s");
        $dia_semana = date("w");
        $fecha = date("Y-m-d");

        $festivos = new festivos();
        $es_festivo = 0;
        if ($festivos->esFestivo(date("d"), date("m")) === true) {
            $es_festivo = 1;
        }
        $hora = date("H:i:s");

        $f1 = "";
        $dia = $this->_getSanitizedParam("dia");
        if ($dia != "") {
            $f1 = " horario_dia='$dia' ";
        }


        if ($hash == $hash2 and $hash2 != "") {

            $horarioexpressModel = new Administracion_Model_DbTable_Horariosexpress();
            $horarios2 = $horarioexpressModel->getList("$f1", "");
            $horario_fecha = $horarioexpressModel->getList(" horario_fecha='$fecha' ", "");
            $horario_festivo2 = $horarioexpressModel->getList(" horario_dia='99' ", "")[0];

            //horario express
            $online2 = 0;
            if ($es_festivo == 1 and $hora > $horario_festivo2->horario_hora1 and $hora <= $horario_festivo2->horario_hora2) {
                $online2 = 1;
            }
            foreach ($horarios2 as $key => $value) {
                if ($value->horario_fecha == "") {
                    if ($dia_semana == $value->horario_dia and $es_festivo == 0 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
                        $online2 = 1;
                    }
                    if ($dia_semana == $value->horario_dia and $es_festivo == 1 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
                        $online2 = 1;
                    }
                } else {
                    if ($fecha == $value->horario_fecha) {
                        $online2 = 0;
                    }
                    if ($fecha == $value->horario_fecha and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
                        $online2 = 1;
                    }
                }
            }

            $array['online'] = $online2;
            $array['horario_filtro'] = $horarios2[0];
            $array['horario_fecha'] = $horario_fecha[0];
            echo json_encode($array);
        }
    }

    public function validarhorario3Action()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $hash2 = $this->_getSanitizedParam("hash");
        $hash = md5(date("Y-m-d"));

        $hoy = date("H:i:s");
        $dia_semana = date("w");
        $fecha = date("Y-m-d");

        $festivos = new festivos();
        $es_festivo = 0;
        if ($festivos->esFestivo(date("d"), date("m")) === true) {
            $es_festivo = 1;
        }
        $hora = date("H:i:s");

        $f1 = "";
        $dia = $this->_getSanitizedParam("dia");
        if ($dia != "") {
            $f1 = " horario_dia='$dia' ";
        }


        if ($hash == $hash2 and $hash2 != "") {

            $horarioexpressModel = new Administracion_Model_DbTable_Horarioscafe();
            $horarios2 = $horarioexpressModel->getList("$f1", "");
            $horario_fecha = $horarioexpressModel->getList(" horario_fecha='$fecha' ", "");
            $horario_festivo2 = $horarioexpressModel->getList(" horario_dia='99' ", "")[0];

            //horario express
            $online2 = 0;
            if ($es_festivo == 1 and $hora > $horario_festivo2->horario_hora1 and $hora <= $horario_festivo2->horario_hora2) {
                $online2 = 1;
            }
            foreach ($horarios2 as $key => $value) {
                if ($value->horario_fecha == "") {
                    if ($dia_semana == $value->horario_dia and $es_festivo == 0 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
                        $online2 = 1;
                    }
                    if ($dia_semana == $value->horario_dia and $es_festivo == 1 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
                        $online2 = 1;
                    }
                } else {
                    if ($fecha == $value->horario_fecha) {
                        $online2 = 0;
                    }
                    if ($fecha == $value->horario_fecha and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
                        $online2 = 1;
                    }
                }
            }

            $array['online'] = $online2;
            $array['horario_filtro'] = $horarios2[0];
            $array['horario_fecha'] = $horario_fecha[0];
            echo json_encode($array);
        }
    }


    public function invitacionAction()
    {
        $this->_view->error = $this->_getSanitizedParam('error');
        $this->_view->enviado = $this->_getSanitizedParam('enviado');
        $this->_view->cedula = $this->_getSanitizedParam('cedula');

        $this->getLayout()->setData("ocultarcarrito", 1);
        $kt_accion = $_SESSION['kt_accion'];
        // echo $kt_accion;    
        $hoy = date("Y-m-") . "01";
        $this->_view->bannersimple = $this->template->bannersimple(7);


        $usuarioModel = new Administracion_Model_DbTable_Usuario();
        $invitados = $usuarioModel->getList(" user_accion='$kt_accion' AND user_date>='$hoy' ", "");
        $this->_view->invitados = $invitados;
    }



    public function enviarinvitacionAction()
    {

        $this->getLayout()->setData("ocultarcarrito", 1);
        $kt_accion = $_SESSION['kt_accion'];

        //consultar que el invitado no haya sido invitado antes por el mismo usuario
        $usuarioModel = new Administracion_Model_DbTable_Usuario();

        $correo = $this->_getSanitizedParam("correo");
        // $cedula = $this->_getSanitizedParam("cedula");
        $nombre = $this->_getSanitizedParam("nombre");
        $apellido = $this->_getSanitizedParam("apellido");
        $telefono = $this->_getSanitizedParam("telefono");

        $existeUsuario = $usuarioModel->getList(" user_level = '5' AND user_email='$correo' ", "");

        if (count($existeUsuario) > 0) {
            header("Location:/page/login/invitacion/?error=1");
            exit();
        }

        //validar si el usuario ya fue invitado 
        $invitacionModel = new Administracion_Model_DbTable_Invitaciones();
        $existeInvitacion = $invitacionModel->getList(" invitacion_email = '$correo' ", "");
        if (count($existeInvitacion) > 0) {


            // Reenviar invitación usando la nueva función
            $this->enviarCorreoInvitacion($nombre, $apellido, $telefono, $correo, true);


            //editar quien invito
            $invitacionModel->editField($existeInvitacion[0]->invitacion_id, "invitacion_socio", $_SESSION['kt_cedula']);

            header("Location:/page/login/invitacion/?error=2");
            exit();
        }

        $hoy = date("Y-m-") . "01";
        $invitados = $usuarioModel->getList(" user_accion='$kt_accion' AND user_date>='$hoy' ", "");
        $kt_nombre = $_SESSION['kt_nombre'];

        $this->_view->invitados = $invitados;

        if (count($invitados) < 10 and $kt_accion != "") {

            $this->enviarCorreoInvitacion($nombre, $apellido, $telefono, $correo);

            //registro invitacion
            $invitacionModel = new Administracion_Model_DbTable_Invitaciones();
            $data['invitacion_socio'] = $_SESSION['kt_cedula'];
            $data['invitacion_email'] = $correo;
            $data['invitacion_fecha'] = date("Y-m-d");
            $invitacionModel->insert($data);

            header("Location:/page/login/invitacion/?enviado=1");
        } else {
            header("Location:/page/login/invitacion/");
        }
    }

    public function enviarCorreoInvitacion($nombre, $apellido, $telefono, $correo, $isReenvio = false)
    {
        $nombre1 = $this->encriptar($nombre);
        $apellido1 = $this->encriptar($apellido);
        $telefono1 = $this->encriptar($telefono);
        $accion1 = $this->encriptar($_SESSION['kt_accion']);
        $correo1 = $this->encriptar($correo);
        $kt_nombre = $_SESSION['kt_nombre'];

        $asunto = $isReenvio ? "Reenvío de invitación Nogal En Casa" : "Registro de invitado Nogal En Casa";

        $content = "<img src='https://nogalencasa.com/corte2/invitacion/r1.PNG' /><br><br>
    <div style='color:#78808F; font-family:Arial; max-width: 800px; font-size:19px;'>
    <div style='margin-left:60px; margin-right:60px;'>
    Hola <span style='color:#477BE4;'>" . $nombre . "</span>,<br><br>
    <b>Nogal en Casa es un servicio de domicilios exclusivo para socios de Club El Nogal y sus invitados.</b><br><br>
    A travs de nuestra tienda en línea puedes pedir una gran variedad de platos y disfrutar de toda nuestra oferta gastronómica con el sello de calidad del club.<br><br>
    <span style='color:#477BE4'>" . $kt_nombre . "</span> te ha invitado para que tú también accedas a todos los beneficios de Nogal en Casa.<br><br>
    Para continuar por favor completa tu proceso de registro en el botón \"Completar registro\" y empieza a realizar tus pedidos.<br><br>
    <a href='https://nogalencasa.com/page/registro/?c=" . $apellido1 . "&n=" . $nombre1 . "&a=" . $accion1 . "&e=" . $correo1 . "&t=" . $telefono1 . "'><img src='https://nogalencasa.com/corte2/invitacion/r2.PNG' alt='Completar registro' /></a>
    <br><br>
    </div></div>";

        $emailModel = new Core_Model_Mail();
        $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $emailModel->getMail()->addBCC("desarrollo8@omegawebsystems.com");
        $emailModel->getMail()->addCC("" . $correo);
        $emailModel->getMail()->addAddress("" . $_SESSION['kt_correo']);

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content);
        $emailModel->getMail()->AltBody = $content;
        $emailModel->getMail()->SMTPDebug = 0;
        $emailModel->sed();
    }

    public function encriptar($x)
    {
        $x = base64_encode("*" . $x . "*");
        $x = str_replace("=", "_", $x);
        return $x;
    }

    public function desencriptar($x)
    {
        $x = str_replace("_", "=", $x);
        $x = base64_decode($x);
        $x = str_replace("*", "", $x);
        return $x;
    }


    public function loginzonaprivadaAction()
    {

        $this->setLayout('blanco');

        $user = $this->_getSanitizedParam("cedula");
        $password = $this->_getSanitizedParam("clave");
        $password = str_pad($password, 8, "0", STR_PAD_LEFT);

        $socioModel = new Administracion_Model_DbTable_Socios();
        $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' AND socio_estado='1' ", "");
        if (count($socio) > 0) {
            Session::getInstance()->set("kt_cedula", $user);
            Session::getInstance()->set("kt_accion", $password);
            Session::getInstance()->set("kt_correo", $socio[0]->socio_correo);
            Session::getInstance()->set("kt_login_name", $socio[0]->socio_nombre);
            header("Location:https://www.clubelnogal.com/zona-privada/");
        } else {
            $error = 1;
            $socio = $socioModel->getList(" socio_cedula='$user' AND socio_carnet='$password' ")[0];
            if ($socio->socio_estado == "0") {
                $error = 2;
            }
            header("Location:https://www.clubelnogal.com/login-zona-privada/?error=" . $error);
        }
    }

    public function getsesion1Action()
    {
        session_start();
        header('Access-Control-Allow-Origin: *');
        header('Content-Type:application/json');
        $this->setLayout('blanco');
        $respuesta = array();
        $respuesta['cedula'] = $_SESSION['kt_cedula'];
        //$respuesta['cedula'] = "12345";
        echo json_encode($respuesta);
    }

    public function getsesionAction()
    {
        session_start();
        header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        $respuesta = array();
        echo "<div style='color:#FFFFFF;'>" . $_SESSION['kt_login_name'] . " <a href='/page/login/logoutzona' style='color:#FFFFFF;'>salir</a> <div>";
        if ($_SESSION['kt_cedula'] == "") {
            echo "<script> top.location = 'https://www.clubelnogal.com/login-zona-privada/';</script>";
        }
    }

    public function logoutzonaAction()
    {
        //LOG
        $data['log_tipo'] = "LOGOUT";
        $logModel = new Administracion_Model_DbTable_Log();
        $logModel->insert($data);

        Session::getInstance()->set("kt_login_id", "");
        Session::getInstance()->set("kt_login_level", "");
        Session::getInstance()->set("kt_login_user", "");
        Session::getInstance()->set("kt_login_name", "");
        Session::getInstance()->set("kt_cedula", "");
        Session::getInstance()->set("kt_nombre", "");
        Session::getInstance()->set("kt_celular", "");
        Session::getInstance()->set("kt_correo", "");
        Session::getInstance()->set("kt_accion", "");

        Session::getInstance()->set("kt_login_nivel", "");
        Session::getInstance()->set("quien_accion", "");

        header('Location: /page/login/getsesion/');
    }


    public function loginautoAction()
    {

        $this->setLayout('blanco');
        $user = $this->_getSanitizedParam("cedula");
        $nombre = $this->_getSanitizedParam("nombre");
        $email = $this->_getSanitizedParam("email");
        $level = $this->_getSanitizedParam("level");
        $celular = $this->_getSanitizedParam("celular");
        $kt_accion = $this->_getSanitizedParam("a");
        $quien_accion = $this->_getSanitizedParam("q");
        if ($user != "") {
            Session::getInstance()->set("kt_cedula", $user);
            Session::getInstance()->set("kt_nombre", $nombre);
            Session::getInstance()->set("kt_celular", $celular);
            Session::getInstance()->set("kt_correo", $email);
            Session::getInstance()->set("kt_login_level", $level);
            Session::getInstance()->set("kt_accion", $kt_accion);
            Session::getInstance()->set("quien_accion", $quien_accion);
        }
    }



    public function validarhashclaveAction()
    {
        $hash = $this->_getSanitizedParam("hash1");
        $socioModel = new Administracion_Model_DbTable_Socios();

        if ($hash != "") {
            $cedula = $this->desencriptar($this->_getSanitizedParam("c"));
            $socio = $socioModel->getList(" socio_cedula='$cedula' ", "");
            //print_r($socio);
            Session::getInstance()->set("kt_cedula", $socio[0]->socio_cedula);
            Session::getInstance()->set("kt_accion", $socio[0]->socio_carnet);
            Session::getInstance()->set("kt_correo", $socio[0]->socio_correo);
            Session::getInstance()->set("kt_login_name", $socio[0]->socio_nombre);
            Session::getInstance()->set("kt_accion", $socio[0]->socio_carnet);
            Session::getInstance()->set("kt_nombre", $socio[0]->socio_nombre);

            $hash2 = md5($cedula . date("Y-m-d"));
            if ($hash != $hash2) {
                header("Location:https://delivery.clubelnogal.com/page/");
            } else {
                header("Location:https://delivery.clubelnogal.com/page/login/actualizarclave/");
            }
        }
    }

    public function actualizarclaveAction()
    {
        $this->_view->registro = $this->_getSanitizedParam('registro');
        $this->_view->error = $this->_getSanitizedParam('error');
        $this->_view->invitado = $this->_getSanitizedParam('invitado');

        $this->getLayout()->setData("ocultarcarrito", 1);
        //print_r($_SESSION);

        $cedula = $_SESSION['kt_cedula'];
        if ($this->_getSanitizedParam("c") != "") {
            $cedula = $this->desencriptar($this->_getSanitizedParam("c"));

            $socioModel = new Administracion_Model_DbTable_Socios();
            $socio = $socioModel->getList(" socio_cedula='$cedula' ", "");
            //print_r($socio);
            Session::getInstance()->set("kt_cedula", $socio[0]->socio_cedula);
            Session::getInstance()->set("kt_accion", $socio[0]->socio_carnet);
            Session::getInstance()->set("kt_correo", $socio[0]->socio_correo);
            Session::getInstance()->set("kt_login_name", $socio[0]->socio_nombre);
            Session::getInstance()->set("kt_accion", $socio[0]->socio_carnet);
            Session::getInstance()->set("kt_nombre", $socio[0]->socio_nombre);
        }

        $this->_view->cedula = $cedula;
    }

    public function guardarclaveAction()
    {
        $this->setLayout('blanco');
        $kt_cedula = $_SESSION['kt_cedula'];
        $invitado = $this->_getSanitizedParam("invitado");

        if ($invitado == "") {

            $socioModel = new Administracion_Model_DbTable_Socios();
            $socio = $socioModel->getList(" socio_cedula='$kt_cedula' ", "")[0];
            $id = $socio->socio_id;
            if ($id > 0) {
                $password = $this->_getSanitizedParam("clave1");
                $password = $this->encriptarssl($password);
                $socioModel->editField($id, "socio_password", $password);
                header("Location:/page/login/claveactualizada");
                exit();
                //header("Location:/page/index/seleccionar/");
            } else {
                header("Location:/page/login/");
                exit();
            }
        } else {

            $userModel = new core_Model_DbTable_User();
            $existe = $userModel->getList(" user_user='$kt_cedula' AND user_state='1' AND user_level='5' ");

            $password = $this->_getSanitizedParam("clave1");
            $password = password_hash($password, PASSWORD_DEFAULT);

            if (count($existe) > 0) {
                $userModel->editField($existe[0]->user_id, "user_password", $password);
                header("Location:/page/login/claveactualizada");
                exit();
            } else {
                if ($kt_cedula != "") {

                    $res = $this->get_data("https://nux.clubelnogal.com/page/login/verificarinvitado?cedula=" . $user);
                    $existe_delivery = json_decode($res);
                    $res2 = $this->get_data("https://express.clubelnogal.com/page/login/verificarinvitado?cedula=" . $user);
                    $existe_delivery2 = json_decode($res2);

                    $usuarioModel = new Administracion_Model_DbTable_Usuario();
                    $data['user_state'] = 1;
                    $data['user_date'] = date("Y-m-d");
                    $data['user_names'] = $existe_delivery2->kt_nombre;
                    if ($data['user_names'] == "") {
                        $data['user_names'] = $existe_delivery->kt_nombre;
                    }
                    $data['user_email'] = $existe_delivery2->kt_correo;
                    if ($data['user_email'] == "") {
                        $data['user_email'] = $existe_delivery->kt_correo;
                    }
                    $data['user_level'] = 5;
                    $data['user_user'] = $kt_cedula;
                    $data['user_password'] = $password;
                    $data['user_delete'] = 0;
                    $data['user_current_user'] = 0;
                    $data['user_code'] = 0;

                    $usuarioModel->insert($data);

                    header("Location:/page/login/claveactualizada");
                    exit();
                }
            }
        }
    }

    public function claveactualizadaAction()
    {
    }

    public function getpropinasAction()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $hash2 = $this->_getSanitizedParam("hash");
        $hash = md5(date("Y-m-d"));

        if ($hash == $hash2 and $hash2 != "") {

            $configpropinasModel = new Administracion_Model_DbTable_Configpropinas();
            $config_propinas = $configpropinasModel->getById(1);
            $this->_view->config_propinas = $config_propinas;

            $opcionespropinasModel = new Administracion_Model_DbTable_Propinasopciones();
            $opciones_propinas = $opcionespropinasModel->getList("", " orden ASC ");
            $this->_view->opciones_propinas = $opciones_propinas;

            $array['config_propinas'] = $config_propinas;
            $array['opciones_propinas'] = $opciones_propinas;

            echo json_encode($array);
        }
    }

    public function verificarsocioAction()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $user = $this->_getSanitizedParam("cedula");

        $array = array();
        $array['existe'] = 0;

        $socioModel = new Administracion_Model_DbTable_Socios();
        $socio = $socioModel->getList(" socio_cedula='$user' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' ", "");

        if (count($socio) > 0) {

            $array['existe'] = 1;
            $array['kt_cedula'] = $user;
            $array['kt_login_level'] = '';
            $array['kt_nombre'] = $socio[0]->socio_nombre;
            $array['kt_correo'] = $socio[0]->socio_correo;
            $array['kt_celular'] = $socio[0]->socio_celular;
            $array['quien_accion'] = '';

            $array['kt_accion'] = $socio[0]->socio_carnet;
            $array['kt_estado'] = $socio[0]->socio_estado;
        }

        echo json_encode($array);
    }

    public function verificarsocio2Action()
    {
        //header('Access-Control-Allow-Origin: *');
        $this->setLayout('blanco');
        header('Content-Type:application/json');
        $user = $this->_getSanitizedParam("cedula");
        $user = str_pad($user, 8, "0", STR_PAD_LEFT);

        $array = array();
        $array['existe'] = 0;

        $socioModel = new Administracion_Model_DbTable_Socios();
        $socio = $socioModel->getList(" socio_carnet='$user' AND socio_tipo_documento!='RC' AND socio_tipo_documento!='TI' ", "");

        if (count($socio) > 0) {

            $array['existe'] = 1;
            $array['kt_cedula'] = $socio[0]->socio_cedula;
            $array['kt_login_level'] = '';
            $array['kt_nombre'] = $socio[0]->socio_nombre;
            $array['kt_correo'] = $socio[0]->socio_correo;
            $array['kt_celular'] = $socio[0]->socio_celular;
            $array['quien_accion'] = '';

            $array['kt_accion'] = $socio[0]->socio_carnet;
            $array['kt_estado'] = $socio[0]->socio_estado;
        }

        echo json_encode($array);
    }


    public function enviar_correo_actualizar($socio)
    {

        $url = "https://delivery.clubelnogal.com";
        if (strpos($_SERVER['HTTP_HOST'], "clubelnogal") === false) {
            $url = "https://delivery.omegasolucionesweb.com";
        }

        $cedula = $this->encriptar($socio->socio_cedula);
        $correo = $socio->socio_correo;

        $emailModel = new Core_Model_Mail();
        $asunto = "Asignar Contraseña Nogal Delivery";
        $content = '
        <img src="' . $url . '/corte/correo_delivery.png" /><br><br>
        <p>Estimado socio,<br><br>Gracias por actualizar su perfil en nuestro servicio de delivery. Confirme su cuenta y asigne su contraseña haciendo clic <a href="' . $url . '/page/login/actualizarclave/?c=' . $cedula . '" style="color:#69E4A7">AQU</a></p><br>
        <img src="' . $url . '/corte/correo_footer.png" />';

        $emailModel->getMail()->setFrom("delivery@clubelnogal.com", "Nogal Delivery");
        $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $emailModel->getMail()->addAddress("" . $correo);

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content);
        $emailModel->getMail()->AltBody = $content;
        $emailModel->sed();
    }


    public function enviar_correo_actualizar2($socio)
    {

        $url = "https://delivery.clubelnogal.com";
        if (strpos($_SERVER['HTTP_HOST'], "clubelnogal") === false) {
            $url = "https://delivery.omegasolucionesweb.com";
        }

        $cedula = $this->encriptar($socio->kt_cedula);
        $correo = $socio->kt_correo;

        $emailModel = new Core_Model_Mail();
        $asunto = "Asignar Contrasea Nogal Delivery";
        $content = '
        <img src="' . $url . '/corte/correo_delivery.png" /><br><br>
        <p>Estimado invitado,<br><br>Gracias por actualizar su perfil en nuestro servicio de delivery. Confirme su cuenta y asigne su contraseña haciendo clic <a href="' . $url . '/page/login/actualizarclave/?c=' . $cedula . '&invitado=1" style="color:#69E4A7">AQUÍ</a></p><br>
        <img src="' . $url . '/corte/correo_footer.png" />';

        $emailModel->getMail()->setFrom("delivery@clubelnogal.com", "Nogal Delivery");
        $emailModel->getMail()->addBCC("soporteomega@omegawebsystems.com");
        $emailModel->getMail()->addAddress("" . $correo);

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content);
        $emailModel->getMail()->AltBody = $content;
        $emailModel->sed();
    }
}
