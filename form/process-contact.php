<?php
require ("class.smtp.php"); 
require ("PHPMailer.php");

$mail = new PHPMailer\PHPMailer\PHPMailer();

$mail->IsSMTP();
   // $from = $_REQUEST['email'];
   // $name = $_REQUEST['firstname'];
    // $name = $_REQUEST['lastname'];
	  $message = $_REQUEST['message'];
    $headers = "From: $from";
	  $subject = "Contact Form BuildPower Site";
   
    $mail->isHTML(true);
    $mail->SMTPAuth = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host = "***"; // iciii     // sets GMAIL as the SMTP server
    $mail->Port = 465;                   // set the SMTP port

    $mail->setFrom('in-v3.mailjet.com', 'name_host');  // Your email here // iciii
    $mail->addAddress('melinamalvina@gmail.com', 'name_user_mail_receive_form');
    $mail->Username = "*****"; // iciiii
    $mail->Password = "*****"; // iciiii 

    $mail->From = "contact@centreberlioz.fr";
    $mail->FromName = "Centre berlioz Marseille";

      $mail->Subject = "Contact Form BuildPower Site"; // ex Contato a partir do site
      $mail->Body    = 'prenom : '. $_POST['name'] .'<br />' // Dans le body, tu crée le texte qui sera reçu avec les infos du form
                         . 'nom : '. $_POST['lastname'];
                          
  
     $mail->send();



//    $fields = array();
  //  $fields{"firstname"} = "First name";
   // $fields{"lastname"} = "Last name";
   // $fields{"email"} = "Email";
   // $fields{"message"} = "Message";
	

    //$body = "Here is what was sent:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n\n",$b,$_REQUEST[$a]); }

    $send = mail($to, $subject, $body, $headers);

?>
