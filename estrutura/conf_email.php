<?php
class Email{
  private $remetente;
  private $host;
  private $porta;
  private $senha;

  public function __construct() {
    $this->remetente    = 'projetoratsis@gmail.com';
    $this->host = 'smtp.gmail.com';
    $this->porta   = '587';
    $this->senha   = 'projetorat123';
    $this->smtp   = 'tls';
  }

  public function enviaEmail($email, $mensagem, $assunto, $cc, $anexo){
    global $error;

    //require_once("../../lib/PHPMailer/PHPMailerAutoload.php");
    require_once('C:/xampp/htdocs/projetorat/trunk/lib/PHPMailer/PHPMailerAutoload.php');

    define('GUSER', $this->remetente);	// <-- Insira aqui o seu GMail
    define('GPWD', $this->senha);		// <-- Insira aqui a senha do seu GMail

    $mail = new PHPMailer();
    $mail->IsSMTP();		// Ativar SMTP
    $mail->SMTPDebug = 3;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
    $mail->SMTPAuth = true;		// Autenticação ativada
    $mail->SMTPSecure = $this->smtp;;	// SSL REQUERIDO pelo GMail
    $mail->Host = $this->host;	// SMTP utilizado
    $mail->Port = $this->porta;  		// A porta 587 deverá estar aberta em seu servidor
    $mail->Username = GUSER;
    $mail->Password = GPWD;
    $mail->SetFrom($this->remetente);
    $mail->Subject = utf8_decode($assunto);
    $mail->Body = $mensagem;
    $mail->AddAddress($email);
    $mail->AddCC($cc);
    $mail->addAttachment($anexo, "RAT.pdf");
    $mail->SMTPOptions = array(
      'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
      )
    );

    if(!$mail->Send()) {
      $error = 'Mail error: '.$mail->ErrorInfo;
      return false;
    } else
    return true;

    if (!empty($error)) echo $error;

  }
}

?>
