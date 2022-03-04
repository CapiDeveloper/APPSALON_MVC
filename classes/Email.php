<?php
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;    
    }
    public function enviarConfirmacion(){
//vamosa crear el objeto de email - todo a continuacion esta en mailtrap
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a2402c03928355';
        $mail->Password = '62ffa0d3f54351';

        $mail->setFrom('admin@capidev.com');
        $mail->addAddress('cuentasapp@appsalon.com','appsalon.com');
        $mail->Subject='Confirma tu cuenta';

        //Set html
        $mail->isHTML(TRUE);
        $mail->CharSet ='UTF-8';
        $contenido = "<html>";
        $contenido .="<p><strong>Hola ".$this->nombre."</strong> Has creado una cuenta 
        en appsalon, solo debes confirmarla presionando en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=". $this->token ."'> Confirmar Cuenta</a></p>";
        $contenido .="<p>Si tu no solicistaste esta cuenta, puede ignorar el emnsaje</p>";
        $contenido .="</html>";

        $mail->Body = $contenido;
        //Por ultimo enviamos el email
        $mail->send();
    }
    public function enviarInstrucciones(){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'a2402c03928355';
        $mail->Password = '62ffa0d3f54351';

        $mail->setFrom('admin@capidev.com');
        $mail->addAddress('cuentasapp@appsalon.com','appsalon.com');
        $mail->Subject='Reestablece tu password';

        //Set html
        $mail->isHTML(TRUE);
        $mail->CharSet ='UTF-8';
        $contenido = "<html>";
        $contenido .="<p><strong>Hola ".$this->nombre."</strong> Has solicitado reestablece tus password, sigue el
        siguiente enlace para hacerlo</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=". $this->token ."'> Reestablecer contraseña</a></p>";
        $contenido .="<p>Si tu no solicistaste esta cuenta, puede ignorar el emnsaje</p>";
        $contenido .="</html>";

        $mail->Body = $contenido;
        //Por ultimo enviamos el email
        $mail->send();
    }
} 