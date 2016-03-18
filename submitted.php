<!DOCTYPE html>

<html>

<head>
	<title>Register The Class</title>

	 <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- bootstrap Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


  <!-- Boostrap Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>


  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/handleform.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
html, body{
  font-family: 'Roboto', sans-serif;
}
</style>

</head>
<body>

<h2><b>Thank You, Your Registration is Complete.</b></h2>

<hr>
<p style='text-align:center;'> Please check your e-mail for confirmation. <br><br>You may now close this window.</p>

<?php


ini_set( 'display_errors', 1 );
require_once ('FileMaker.php');
$fm = new FileMaker();
$fm->setProperty('database', 'FHCO_Registration');
$fm->setProperty('hostspec', '24.22.109.31');
$fm->setProperty('username', 'CWP');
$fm->setProperty('password', 'PHP');

$stringForFM = http_build_query($_POST); 
$command = $fm->newPerformScriptCommand("RegData", "PHP_process" , $stringForFM);
//EXECUTE THE COMMAND
$result = $command->execute();

?>



<?php
//PHP MAILER 


require 'php/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.owlgrenade.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'owladmin@owlgrenade.com';                 // SMTP username
$mail->Password = 'TvZd@]@0*Lt';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 26;                                    // TCP port to connect to

$mail->setFrom('owladmin@owlgrenade.com', 'Mailer');
$mail->addAddress($_POST['Email'], 'Honored Customer');     // Add a recipient
//$mail->addAddress('Warren');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'FHCO: Successful Registration';
$mail->Body    = "<h3>FHCO Event Registration</h3><br><b>You Have Been Successfully Registered</b><br>Hello " . $_POST['NameFirst'] . ',<br>Thanks for Registering for: <br><b>' . $_POST['ClassSelect'] . '</b><br><br>We will see you there!<br> -Thank you,<br>Your Friends at the FHCO';
$mail->AltBody = "Successful Registration: Hello " . $_POST['NameFirst'] . ',Thanks for Registering for: <br>' . $_POST['ClassSelect'] . 'We will see you there! -Thank you, Your Friends at the FHCO';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: Please contact us for confirmation.' . $mail->ErrorInfo;
} else {
    echo "<p style = 'text-align:center;'>Message has been sent to " . $_POST['Email'] . "</p>";
}

?>
</body>






</html>