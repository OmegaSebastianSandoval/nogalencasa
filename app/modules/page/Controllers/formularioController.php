<?php
//**************************************** INSTANCIA LA TABLA DE INFORMACION CON EL INDEX DE FORMULARIO ************************************


class Page_formularioController extends Page_mainController
{
    public $botonactivo = 4;

    public function indexAction()
    {
        //$this->_view->bannersimple = $this->template->bannersimple(3);
        $this->_view->bannersimple = $this->template->bannerprincipal(1);
        $contactosModel = new Page_Model_DbTable_Informacion();
        $this->_view->informaciones = $contactosModel->getList("'1'", "");
        //USAMOS VARIABLE QUE NO SEA LISTA (SIN FOREACH)
        $this->_view->red = $contactosModel->getById('1');
        //
        $this->_view->res = $this->_getSanitizedParam('res');


        $portafoliosModel = new Page_Model_DbTable_Contenido();
        $this->_view->terminos = $portafoliosModel->getList(" contenido_seccion='11' ", "")[0];

    }
    //****************************************/ESTE ARCHIVO RECIBE LOS DATOS DEL FORMULARIO Y LOS ENVIA AL CORREO QUE SE DIGITA************************************

    public function enviarAction()
    {
        //error_reporting(E_ALL);
        $this->setLayout('blanco');
        $data = [''];
        $data['formulario_nombre'] = $this->_getSanitizedParam('formulario_nombre');
        $data['formulario_email'] = $this->_getSanitizedParam('formulario_email');
        $data['formulario_telefono'] = $this->_getSanitizedParam('formulario_telefono');
        $data['formulario_ciudad'] = $this->_getSanitizedParam('formulario_ciudad');
        $data['formulario_mensaje'] = $this->_getSanitizedParam('formulario_mensaje');

        //Llamar la instancia del modelo
        //$formularioModel = new Page_Model_DbTable_Formulario();
        //$formulario = $formularioModel->insert($data);
        $envioCorreo = $this->enviarCorreo($data);
        $envioCorreo == 1 ? $res = 1 : $res = 0;
        header("Location: /page/formulario?res=" . $res);

    }

    public function enviarCorreo($data)
    {


        $content = "<h1>Contacto Nogal Delivery</h1><b>Nombre: </b>" . $data['formulario_nombre'] . "<br><b>Correo: </b>" . $data['formulario_email'] . "<br><b>Teléfono: </b>" . $data['formulario_telefono'] . "<br><b>Ciudad: </b>" . $data['formulario_ciudad'] . "<br><b>Mensaje: </b>" . $data['formulario_mensaje'];

        $content2 = '
        <div style="width: 100%; background: #6e6e6e20; padding: 50px; font-size: 15px;">
  <table style="max-width: 600px; background: #FFF; border: 2px solid #333; margin: auto; padding: 20px;">
    <tr>
      <td style="background-color: #333; display: flex; justify-content: center;">
        <img src="https://delivery.clubelnogal.com/corte/logo.jpg" alt="" height="50"  style="margin:auto;">
      </td>
    </tr>
    <tr>
      <td style="padding: 10px 20px; padding-bottom: 20px;">
        <span style="color: #333333;">
          Se ha enviado una consulta con los siguientes datos:
        </span>
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Nombre:
          </b>
         ' . $data["formulario_nombre"] . '
        </span>
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Ciudad:
          </b>
         ' . $data["formulario_ciudad"] . '
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Teléfono:
          </b>
         ' . $data["formulario_telefono"] . '
      </td>
    </tr>
    <tr>
      <td style="padding: 3px 20px;">
        <span style="color: #6e6e6e;">
          <b>
            Correo electrónico:
          </b>
         ' . $data["formulario_email"] . '
        </span>
      </td>
    </tr>
    
    <tr>
      <td style="padding: 3px 20px; padding-bottom: 30px;">
        <span style="color: #6e6e6e;">
          <b>
          Asunto:
          </b>
         ' . $data["formulario_mensaje"] . '
      </td>
    </tr>
  </table>
</div>
';


        $emailModel = new Core_Model_Mail();
        $asunto = "Contacto Nogal Delivery";

        $emailModel->getMail()->addBCC("desarrollo8@omegawebsystems.com");
        // $emailModel->getMail()->addAddress("" . $data['formulario_email']);

        $emailModel->getMail()->Subject = $asunto;
        $emailModel->getMail()->msgHTML($content2);
        $emailModel->getMail()->AltBody = $content2;
        $emailModel->getMail()->SMTPDebug = 0;
        $status = $emailModel->sed();
        return $status;



    }

}