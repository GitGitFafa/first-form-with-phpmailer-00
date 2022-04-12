<?php
date_default_timezone_set('America/Sao_Paulo');

require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

  //Verifica se o email e a mensagem estão setadas, removendo os vazios, caso o usuário não digite as informações solicitadas nos campos citados.
  if((isset($_POST['email']) && !empty(trim($_POST['email']))) && (isset($_POST['mensagem']) && !empty(trim($_POST['mensagem'])))){

    //Verifica se os campos do formulário contidos no index.php estão vazios, e caso não estejam, pegam as informações nos campos setados dentro do método $_POST.
    $nome = !empty($_POST['nome']) ? $_POST['nome'] : 'Não informado';
    $email = !empty($_POST['email']) ? trim($_POST['email']) : 'Não informado';
    $assunto = !empty($_POST['assunto']) ? utf8_decode($_POST['assunto']) : 'Não informado';
    $mensagem = !empty($_POST['mensagem']) ? trim($_POST['mensagem']) : 'Não informado';
    //Registra data e hora do envio do formulário
    $data = date('d/m/Y H:i:s');

     $mail = new PHPMailer();
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host = 'smtp.gmail.com';
     $mail->SMTPAuth = true;
     $mail->Username = 'youremail@gmail.com';
     $mail->Password = 'password';
     $mail->Port = 587;

     $mail->setFrom('youremail@gmail.com');
     $mail->addAddress('youremail@gmail.com');  

     $mail->isHTML(true);
     $mail->Subject = $assunto;
     $mail->Body = "  Nome: {$nome}<br> 
                     Email: {$email}<br>
                     Mensagem: {$mensagem}<br> 
                     Data/Hora: {$data}";
     
       if($mail->send()) {
         echo 'Email enviado com sucesso.';
       } else {
         echo 'Email não enviado.';
       }
  } else{
    echo 'Não enviado: informar o email e a mensagem.';
  }
  


