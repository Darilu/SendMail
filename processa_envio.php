<?php

    require "./bibliotecas/PHPMailer/Exception.php";
    require "./bibliotecas/PHPMailer/PHPMailer.php";
    require "./bibliotecas/PHPMailer/OAuth.php";
    require "./bibliotecas/PHPMailer/POP3.php";//Protocolo de recebimento de emails
    require "./bibliotecas/PHPMailer/SMTP.php";//Protocolo de envio de emails.

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mensagem {
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        public function __get($atributo){
            return $this->$atributo;
        }

        public function __set($atributo, $valor) {
            $this-> $atributo = $valor;
        }

        public function mensagemValida() {
            //
            if(empty($this->para) || empty($this->assunto || empty($this->mensagem))){
                return false;//se algum campo citado acima estiver vazio, a função mensagem valida retornara false
            }

            return true;//se todos os campos estiverem preenchidos corretamente a função retornara verdadeira
        }

        
    }

    $mensagem = new Mensagem();

    $mensagem->__set('para', $_POST['para']);


    //print_r($mensagem);

    if(!$mensagem-> mensagemValida()){
        echo 'mensagem é valida';
        die();
    }

    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'danilotestes17@gmail.com';                     //SMTP username
    $mail->Password   = 'whhbnpzmocjeqfgj';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('webcompleto2@gmail.com', 'Mailer');
    $mail->addAddress($mensagem->__get('para'));     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('sucesso.png');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Cadastro efetuado com sucesso.';
    $mail->Body    = '
                    <h1>Parabéns por dar esse impotante passo em sua <br>
                        Carreira
                    </h1>
                    
                    <h4> Só mandamos esse email para confirmar que você se inscreveu em nossa plataforma</h4>


    ';
    $mail->AltBody = 'É necessário ter um client com suporte a html para ter acesso ao conteúdo completo dessa mensagen';

    $mail->send();
    echo 'E-mail enviado com sucesso';
} catch (Exception $e) {
    echo "Não foi possivel enviar para este email! tente novamente. Detalhes do erro: {$mail->ErrorInfo}";
}
    
    ?>
    