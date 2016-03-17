<html>

<head>
	<title>Register The Class</title>

	 <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- bootstrap Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

  <!-- Boostrap Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/handleform.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>

</style>

</head>
<body>

<h2><b>Review Your Order:</b></h2>

<hr>





<?php
$payment = $_POST['amountpaid'];
$paymentModified = str_replace('.', '', $payment);


	# Field names we expect as keys within $_POST[]
$missingField = 0;
require_once('php/phpVars.php');

if ($missingField == 0){


echo "<table>";
 //foreach($keys as $value){
  //   echo  "<tr><td>" . $_POST[$value] . "</td></tr>";
 //}
echo  "<tr><td> Selected Class: </td><td><h4>" . $classSelect . "</h4></td></tr>";
echo  "<tr><td> First Name: </td><td>" . $nameFirst . "</td></tr>";
echo  "<tr><td> Last Name: </td><td>" . $nameLast . "</td></tr>";
echo  "<tr><td> E-Mail: </td><td>" . $Email . "</td></tr>";
echo  "<tr><td> Home Phone: </td><td>" . $PhoneHome .  "</td></tr>";
echo  "<tr><td> Work Phone: </td><td>" . $PhoneWork . "</td></tr>";
echo  "<tr><td> Company: </td><td>" . $Company . "</td></tr>";
echo  "<tr><td> Job Title: </td><td>" . $JobTitle . "</td></tr>";
echo  "<tr><td> Website: </td><td>" . $Website . "</td></tr>";
echo  "<tr><td> Address: </td><td>" . $Address . "</td></tr>";

echo  "<tr><td> Country: </td><td>" . $Country . "</td></tr>";
echo  "<tr><td><h3> Amount Due: </h3></td><td style= 'text-align:center;'><h3><b>$" . $AmountDue . "</b></h3></td></tr>";


 echo "</table>";
 }

 if ($missingField > 0){
 	echo "<a style='text-align:center;' href='javascript:history.go(-1)''>You are missing a required field, Please return to the previous page.</a>";

 }
if ($payment > 0 && $missingField == 0){
echo" <div id = 'buttoncontainer'>
<button class='btn' style= 'text-align:center; margin: 0px auto;'id='customButton'>Confirm & Purchase</button>
</div>";
}
if ($payment == 0 && $missingField == 0){
  echo" <div id = 'buttoncontainer'>
<button class='btn' onclick='submitForm();' style= 'text-align:center; margin: 0px auto;'id=''>Confirm & Register</button>
</div>";
}



	$keys = array(
		'ClassSelect',
		'NameFirst',
		'NameLast',
		'Email',
		'EmailVerify',
		'PhoneHomeAC',
		'PhoneHomePrefix',
		'PhoneHomeSuffix',
		'PhoneWorkAC',
		'PhoneWorkPrefix',
		'PhoneWorkSuffix',
		'Company',
		'JobTitle',
		'website',
		'AddressStreet',
		'AddressUnit',
		'AddressCity',
		'AddressState',
		'AddressZip',
		'AddressCountry',
		'paid',
		'amountpaid',
		);
echo "<form name='userinfo' id ='userinfo' action='submitted.php' method='post' data-ajax='true'>";
 foreach($keys as $value){
     echo  "<input  max-height:1px;' style='display:none;' readonly type='text' name='"  . $_POST[$value] . "' value ='"  . $_POST[$value] . "'> <br>";
 }
echo "</form>";
?>


<script src="https://checkout.stripe.com/checkout.js"></script>



<script>
// var costsMoney = <?php echo $payment ?>;
// $( document ).ready(function() {
//     if (costsMoney == 0){
// alert('FREE')
// }
// });

  var handler = StripeCheckout.configure({
    key: 'pk_test_6pRNASCoBOKtIshFeQd4XMUh',
    image: 'img/FHCO.png',
    locale: 'auto',
    token: function(token) {
      // Use the token to create the charge with a server-side script.
      // You can access the token ID with `token.id`

          $("#userinfo").submit();
    }
  });
     //  var str = $( "#ClassSelect" ).val(); 
   
      //  str = str.substring(str.indexOf("$") + 1);

  $('#customButton').on('click', function(e) {
    // Open Checkout with further options
    handler.open({
      name: 'FHCO Sign Up',
      description: 'Enter Your Payment Information Below',
    


      amount: <?php echo "'". $paymentModified . "'" ?>
    });
    e.preventDefault();
  });

  // Close Checkout on page navigation
  $(window).on('popstate', function() {
    handler.close();
    

  });

  function submitForm(){
     document.getElementById("userinfo").submit();
};
</script>
</body>



</html> 