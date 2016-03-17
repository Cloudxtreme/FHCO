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
</body>






</html>