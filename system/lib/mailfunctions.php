<?php 
function sendMail($to,$subject,$body,$headers) {
//
 // echo "bb";die;
require_once('PHPMailer-master/PHPMailerAutoload.php');
include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  #$mail->Host       = "smtpx20.serverdata.net"; // SMTP server
  #$mail->Host       = "email-smtp.us-east-1.amazonaws.com"; // SMTP server
  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "email-smtp.us-east-1.amazonaws.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Port       = 25;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "AKIAIN6BNSRLL23ZV5SQ";  //  username
  $mail->Password   = "Ao5N7oQ0rb3yOw/1TaD7Big8aTEZkI8YYrRgeWX1wOcW";            //  password



  $mail->AddReplyTo('noreply@geohti.com', 'noreply');

  if (is_array($to)){
    foreach($to as $tto){
      $mail->AddAddress($tto);
    }
  }else{
  $mail->AddAddress($to);
  }
  $mail->SetFrom('noreply@geohti.com', 'noreply');

  $mail->Subject = $subject;
  $mail->AltBody = $body; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($body);
  #$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  #$mail->MsgHTML(file_get_contents('contents.html'));
  #$mail->AddAttachment('images/phpmailer.gif');      // attachment
  #$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  //echo "a";#die;
  $mail->Send();
   //echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
   //echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
   //echo $e->getMessage(); //Boring error messages from anything else!
}


  }



