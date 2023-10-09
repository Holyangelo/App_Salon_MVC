<?php
/*Namespace Classes*/
namespace Classes;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class Email{

    /*Atributos de la clase*/
    public $email;
    public $nombre;
    public $token;

    /*Constructor*/
    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    /*Enviar email*/
    public function enviarConfirmacion(){
        /*crear el objeto de email*/
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';  //Set the SMTP server 
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Port = 2525;//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Username = 'efaf6a30613775'; //SMTP username
        $mail->Password = '29823b6c8e6a60'; //SMTP password                                      

        //Recipients
        $mail->setFrom('localhost.robot@gmail.com', 'Mailer');
        $mail->addAddress($this->email, $this->nombre);     //Add a recipient
        $mail->addReplyTo('localhost.robot@gmail.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Charset = 'UTF-8';   //Using Decode UTF-8
        $mail->Subject = 'Token for Confirmation';
        $content = '<html>';
        $content .= 'This is your token for confirmation: <b>'.$this->token.'</b>';
        $content .= '<span>  put here for confirm your account: <a href="http://localhost:3000/confirmar-cuenta?token='.$this->token.'">Confirm Your Account</a></span>';
        $content .= '</html>';
        $mail->Body    = $content;
        
        if($mail->send()){
            return true;
        }
    }catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

/*Enviar email - Recuperar Password*/
    public function enviarInstrucciones(){
        /*crear el objeto de email*/
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';  //Set the SMTP server 
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Port = 2525;//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Username = 'efaf6a30613775'; //SMTP username
        $mail->Password = '29823b6c8e6a60'; //SMTP password                                      

        //Recipients
        $mail->setFrom('localhost.robot@gmail.com', 'Mailer');
        $mail->addAddress($this->email, $this->nombre);     //Add a recipient
        $mail->addReplyTo('localhost.robot@gmail.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Charset = 'UTF-8';   //Using Decode UTF-8
        $mail->Subject = 'Token for Renew Password';
        $content = '<html>';
        $content .= 'This is your token for Renew your password: <b>'.$this->token.'</b>';
        $content .= '<span>  put here for renew : <a href="http://localhost:3000/recuperar?token='.$this->token.'">Renew Password</a></span>';
        $content .= '</html>';
        $mail->Body    = $content;
        
        if($mail->send()){
            return true;
        }
    }catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
}

?>