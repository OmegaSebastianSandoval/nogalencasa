<?php

/**
 *
 */

class Page_perfilController extends Page_mainController
{

    public function indexAction()
    {
        $kt_cedula = $_SESSION['kt_cedula'];
        $this->_view->desarrollo = "";

        //traer direcciones
        $direccionesModel = new Administracion_Model_DbTable_Direcciones();
        $this->_view->direcciones = $direccionesModel->getList(" direccion_usuario='$kt_cedula' ", " direccion_id DESC ");
        // print_r($this->_view->direcciones);


        //TRAERL HISTORIAL DE PEDIDOS
        $pedidoModel = new Administracion_Model_DbTable_Pedidos();
        $pedidos = $pedidoModel->getList(" pedido_documento='$kt_cedula' ", " pedido_fecha DESC ");

        $productosModel = new Page_Model_DbTable_Productoscarrito();
        $acompanamientoModel = new Administracion_Model_DbTable_Acompanamientos();
        $terminosModel = new Administracion_Model_DbTable_Terminos();


        // Obtener los productos de cada pedido
        foreach ($pedidos as $pedido) {
            $id = $pedido->pedido_id;
            $pedido->productos = $productosModel->getList("id_carrito='$id'", "");
        }

        foreach ($pedidos as $pedido) {
            foreach ($pedido->productos as $producto) {
                $producto_id = $producto->id_productos;
                // Inicializar el array de acompañamientos
                $producto->acompanamientos2 = array();
                for ($i = 1; $i <= 6; $i++) {
                    // Consultar los acompañamientos para cada tipo y producto
                    $acompanamientos = $acompanamientoModel->getList("acomp_tipo='$i' AND acomp_producto='$producto_id'", "orden ASC");
                    // Verificar que la consulta devuelve resultados
                    if ($acompanamientos !== false) {
                        $producto->acompanamientos2[$i] = $acompanamientos;
                    } else {
                        // Manejar el caso en que no se encuentran acompañamientos
                        $producto->acompanamientos2[$i] = array();
                    }
                }

                // Obtener los términos disponibles para este producto
                $terminos = $terminosModel->getList("termino_producto='$producto_id'", "orden ASC");
                if ($terminos !== false) {
                    $producto->terminos = $terminos;
                } else {
                    $producto->terminos = array();
                }
            }
        }

        // echo "<pre>";
        // print_r($pedidos);
        // echo "</pre>";


        $this->_view->err = $this->_getSanitizedParam("error");
        //$this->_view->err = 1;
        $this->_view->succ = $this->_getSanitizedParam("success");
        // $this->_view->succ = 1;


        $this->_view->cedula = Session::getInstance()->get("kt_cedula");
        $this->_view->accion = Session::getInstance()->get("kt_accion");

        $this->_view->nivel = Session::getInstance()->get("kt_login_level");



        $this->_view->pedidos = $pedidos;
        $this->_view->list_pedido_medio = $this->getPedidomedio();
        $this->_view->list_pedido_forma_envio = $this->getPedidoformaenvio();


    }
    public function generarpedidoAction()
    {

        $this->setLayout("blanco");
        error_reporting(E_ALL);
        $pedidoId = $this->_getSanitizedParam("pedido");
        $pedidoModel = new Administracion_Model_DbTable_Pedidos();
        $productosModel = new Page_Model_DbTable_Productoscarrito();

        $pedido = $pedidoModel->getList(" pedido_id='$pedidoId' ", "")[0];
        if ($pedido) {
            $id = $pedido->pedido_id;

            $pedido->productos = $productosModel->getList(" id_carrito='$id' ", "");
            echo "<pre>";
            print_r($pedido);
            echo "</pre>";
        }
    }


    public function generardenuevoAction()
    {
        $this->setLayout("blanco");
        //error_reporting(E_ALL);
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // Verificar si se está recibiendo una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los productos del formulario
            $productos = $_POST['productos'];

            // Array para almacenar los productos estructurados
            $data = [];

            // Recorrer cada grupo de productos recibidos
            foreach ($productos as $grupoProductos) {
                // Recorrer cada producto dentro del grupo
                foreach ($grupoProductos as $producto) {
                    // Obtener datos específicos del producto
                    $nombre = $producto['nombre'];
                    $id = $producto['id'];
                    $acompanamientos = $producto['acompanamientos'];
                    $termino = isset($producto['termino']) ? $producto['termino'] : '';

                    // Crear variables para los acompañamientos directamente
                    $acomp1 = '';
                    $acomp2 = '';
                    $acomp3 = '';

                    // Recorrer los acompaamientos y asignarlos a las variables correspondientes
                    foreach ($acompanamientos as $key => $acompanamiento) {
                        switch ($key) {
                            case 1:
                                $acomp1 = $acompanamiento;
                                break;
                            case 2:
                                $acomp2 = $acompanamiento;
                                break;
                            case 3:
                                $acomp3 = $acompanamiento;
                                break;
                            // Puedes agregar más casos según necesites más tipos de acompañamientos
                            default:
                                break;
                        }
                    }

                    // Crear un array con los datos del producto y sus acompañamientos directos
                    $producto_estructurado = [
                        'nombre' => $nombre,
                        'id' => $id,
                        'acomp1' => $acomp1,
                        'acomp2' => $acomp2,
                        'acomp3' => $acomp3,
                        'termino' => $termino,
                        // Agrega más variables según necesites para más tipos de acompañamientos
                    ];

                    // Agregar el producto estructurado al array principal
                    $data[] = $producto_estructurado;
                }
            }

            // Imprimir o utilizar $productos_estructurados según sea necesario
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            // Obtener el carrito y los acompañamientos actuales
            $carrito = $this->getCarrito();
            $acompanamientos = $this->getAcompanamientos();
            // Recorrer cada producto en `$data`
            foreach ($data as $producto) {
                $id = $producto['id'];
                $nombre = $producto['nombre'];
                $cantidad = 1;
                $acomp1 = $producto['acomp1'];
                $acomp2 = $producto['acomp2'];
                $acomp3 = $producto['acomp3'];
                $termino = $producto['termino'];

                // Verificar y añadir el producto al carrito
                if (isset($carrito[$id])) {
                    $carrito[$id] += $cantidad;
                } else {
                    $carrito[$id] = $cantidad;
                }

                // Añadir los acompañamientos al array `$acompanamientos`
                $i = $carrito[$id]; // Obtener el índice actual para los acompañamientos de este producto

                if ($acomp1 !== "") {
                    $acompanamientos[$id]['acomp1_' . $i] = $acomp1;
                }
                if ($acomp2 !== "") {
                    $acompanamientos[$id]['acomp2_' . $i] = $acomp2;
                }
                if ($acomp3 !== "") {
                    $acompanamientos[$id]['acomp3_' . $i] = $acomp3;
                }
                if ($termino !== "") {
                    $acompanamientos[$id]['termino_' . $i] = $termino;
                }
            }


            Session::getInstance()->set("carrito", $carrito);
            Session::getInstance()->set("acompanamientos", $acompanamientos);



            //log carrito
            $array['id'] = $id;
            $array['cantidad'] = $cantidad;
            $array['carrito'] = $carrito;
            $array['acompanamientos'] = $acompanamientos;
            $logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
            $data['log_cedula'] = $_SESSION['kt_cedula'];
            $data['log_detalle'] = "Agregar al carrito";
            $data['log_log'] = print_r($array, true);
            $data['log_fecha'] = date("Y-m-d H:i:s");
            $logcarritoModel->insert($data);

            header("Location: /page/compra");
        }
    }

    public function cambioAction()
    {
        $this->_view->bannerlogin = $this->template->bannerlogin(5);
        $this->getLayout()->setData("ocultarcarrito", 1);
        // Obtener y sanitizar los parámetros
        $codi = $this->_getSanitizedParam("cedula");
        $ncar = $this->_getSanitizedParam("ncar");
        $redirectUrl = "https://nogalencasa.com/";
        // $redirectUrl = "https://nogalencasa.com/page/login/";
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
  //          print_r($response);
//return;
            // Manejo de errores y redirección
            if ($error) {
                // Registra el error para depuración
                error_log('cURL Error: ' . $errorMessage);

                // Redirecciona en caso de error
                header('Location: /page/perfil/?error=1#v-pills-cambio-tab');
                exit(); // Asegúrate de que el script termine después de la redirección
            } else {
                // Verificar si la respuesta del servidor es la esperada
                error_log(print_r($response, true));
                if (trim($response) === "Se envio el correo con exito.") {
                    // Redirecciona en caso de éxito
                    header('Location: /page/perfil/?success=1#v-pills-cambio-tab');
                    exit(); // Asegúrate de que el script termine después de la redirección
                } else {
                    // Registra la respuesta inesperada para depuración
                    error_log('Respuesta inesperada del servidor: ' . $response);

                    // Redirecciona en caso de respuesta inesperada
                    header('Location: /page/perfil/?error=1#v-pills-cambio-tab');
                    exit(); // Asegúrate de que el script termine después de la redirección
                }
            }
        }
    }

    public function cambiarinvitadoAction()
    {
        // Obtener y sanear los parámetros de contrasea
        $passwordActual = $this->_getSanitizedParam('pass-act');
        $password = $this->_getSanitizedParam('pass-new');
        $password2 = $this->_getSanitizedParam('re-pass');

        // Crear una instancia del modelo de usuarios
        $usersModel = new Administracion_Model_DbTable_Usuario();

        // Obtener el ID de usuario de los parámetros de la solicitud y obtener información del usuario
        $user_id = Session::getInstance()->get("kt_cedula");

        // Obtener información del usuario
        $user = $usersModel->getList("user_user = '$user_id' ", "")[0];

        if ($user) {
            // Verificar que la contraseña actual sea correcta
            if (password_verify($passwordActual, $user->user_password)) {
                // Verificar si las nuevas contraseñas coinciden
                if ($password == $password2) {
                    // Cambiar la contraseña del usuario y actualizar otros campos relacionados
                    $usersModel->editField($user->user_id, 'user_password', password_hash($password, PASSWORD_DEFAULT));

                    // Preparar la respuesta de éxito
                    $response = [
                        'status' => 'success',
                        'message' => 'Contraseña cambiada correctamente'
                    ];
                } else {
                    // Preparar la respuesta de error si las contraseas no coinciden
                    $response = [
                        'status' => 'error',
                        'message' => 'Las nuevas contraseñas no coinciden'
                    ];
                }
            } else {
                // Preparar la respuesta de error si la contraseña actual es incorrecta
                $response = [
                    'status' => 'error',
                    'message' => 'La contraseña actual es incorrecta'
                ];
            }
        } else {
            // Preparar la respuesta de error si el usuario no existe
            $response = [
                'status' => 'error',
                'message' => 'Usuario no encontrado'
            ];
        }

        // Devolver la respuesta como JSON
        die(json_encode($response));
    }

    public function guardardireccionAction()
    {

        $direccionesModel = new Administracion_Model_DbTable_Direcciones();

        $dataDirecciones = $this->getDatadireccion();
        //consultar si direccion existe
        $direccionExiste = $direccionesModel->getList("direccion_usuario='" . $dataDirecciones['direccion_usuario'] . "' AND direccion_nomenclatura='" . $dataDirecciones['direccion_nomenclatura'] . "' AND direccion_numero1='" . $dataDirecciones['direccion_numero1'] . "' AND direccion_letra1='" . $dataDirecciones['direccion_letra1'] . "' AND direccion_numero2='" . $dataDirecciones['direccion_numero2'] . "' AND direccion_letra2='" . $dataDirecciones['direccion_letra2'] . "' AND  direccion_numero3 ='" . $dataDirecciones['direccion_numero3'] . "' AND direccion_complemento='" . $dataDirecciones['direccion_complemento'] . "' AND direccion_indicaciones='" . $dataDirecciones['direccion_indicaciones'] . "' ", "")[0];

        if (!$direccionExiste) {
            $id = $direccionesModel->insert($dataDirecciones);
        }

        header("Location: /page/perfil#v-pills-direcciones-tab");
    }

    private function getDatadireccion()
    {
        $data = array();
        $data['direccion_usuario'] = $_SESSION['kt_cedula'];
        $data['direccion_nomenclatura'] = $this->_getSanitizedParam("pedido_nomenclatura");
        $data['direccion_numero1'] = $this->_getSanitizedParam("numero1");
        $data['direccion_letra1'] = $this->_getSanitizedParam("letra1");
        $data['direccion_numero2'] = $this->_getSanitizedParam("numero2");
        $data['direccion_letra2'] = $this->_getSanitizedParam("letra2");
        $data['direccion_numero3'] = $this->_getSanitizedParam("numero3");
        $data['direccion_complemento'] = $this->_getSanitizedParam("complemento");
        $data['direccion_indicaciones'] = $this->_getSanitizedParam("indicaciones");
        return $data;
    }
    public function getPedidomedio()
    {
        $array = array();
        $array[1] = 'Cargo a la acción';
        $array[2] = 'Pago en línea';
        return $array;
    }

    public function getPedidoformaenvio()
    {
        $array = array();
        $array[1] = 'Domicilio';
        $array[2] = 'Recoger en el Club';

        return $array;
    }
    public function getCarrito()
    {
        if (Session::getInstance()->get("carrito")) {
            return Session::getInstance()->get("carrito");
        } else {
            return [];
        }
    }

    public function getAcompanamientos()
    {
        if (Session::getInstance()->get("acompanamientos")) {
            return Session::getInstance()->get("acompanamientos");
        } else {
            return [];
        }
    }
}
