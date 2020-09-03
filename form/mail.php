<?php

require ("SMTP.php");
require ("PHPMailer.php");
require ("Exception.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();

try {

    $mail->IsSMTP();
    $mail->SMTPDebug  = 0;
    $mail->Host       = 'mail_host'; // ex mail.guedesinvestt.com.br
    $mail->SMTPAuth   = true;
    $mail->Username   = '**'; // ex _mainaccount@guedesinvestt.com.br
    $mail->Password   = '**';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    $mail->setFrom('username_host', 'name_host'); // ex '_mainaccount@guedesinvestt.com.br', 'Guedes Investt'
    $mail->addAddress('mail_receive_form', 'name_user_mail_receive_form'); // ex 'valtercabral@guedesinvestt.com.br', 'Corporativo Guedes Investt'
    $mail->addBCC(''); // optional, used to send the form to second mail

    $mail->isHTML(true);
    $mail->Subject = 'subject_received_mail'; // ex Contato a partir do site
    $mail->Body    = 'Nome do cliente : '. $_POST['name'] .'<br />' // Dans le body, tu crée le texte qui sera reçu avec les infos du form
                       . 'Telefone : '. $_POST['tel'].'<br />'
                        . 'Email : '. $_POST['email'];

   $mail->send();

  header("Location: page.fr"); // Redirection vers une deuxième page après envoi du form
  // ex header ("Location: http://www.guedesinvestt.com.br/obrigado.html")
}
catch (Exception $e) {
   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>