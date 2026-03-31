<?php

/**
 * Modelo del modulo Core que se encarga de inicializar  la clase de envio de correos
 */
class Core_Model_Mail
{
    /**
     * classe de  phpmailer
     * @var class
     */
    private $mail;

    /**
     * asigna los valores a la clase e instancia el phpMailer
     */
    public function __construct()
    {
        /*
        $this->mail = new PHPMailer;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Host = "mail.networkingclubelnogal.com";
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->Username ="delivery@networkingclubelnogal.com";
-       $this->mail->Password ="admin.2008";
-       $this->mail->setFrom("delivery@networkingclubelnogal.com","Nogal Delivery");
        */

        $this->mail = new PHPMailer;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Host = "smtp.gmail.com";
        $this->mail->Port = 587;
        $this->mail->SMTPAuth = true;
        //$this->mail->Username ="nogaldelivery@omegawebsystems.com";
        //$this->mail->Password ="admin.2008";
        //$this->mail->setFrom("nogaldelivery@omegawebsystems.com","Nogal Delivery");
        if (APPLICATION_ENV == 'production') {
            $this->mail->Username = "deliveryclubelnogal@gmail.com";
            $this->mail->Password = "igijajtcfiayccjs";
        } else {
            $this->mail->Username = "deliveryclubelnogal@gmail.com";
            $this->mail->Password = "igijajtcfiayccjs";
        }

        $this->mail->setFrom("deliveryclubelnogal@gmail.com", "Nogal en casa");

    }
    /**
     * retorna la  instancia de email
     * @return class email
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * envia el correo
     * @return bool envia el estado del correo
     */
    public function sed()
    {
        if ($this->mail->send()) {
            return true;
        } else {
            if (APPLICATION_ENV == 'production') {
                $this->mail->Username = "deliveryclubelnogal@gmail.com";
            } else {
                $this->mail->Username = "deliveryclubelnogal@gmail.com";
            }
            $this->mail->Password = "Admin.2008";
            $this->mail->send();

            return false;
        }
    }
}