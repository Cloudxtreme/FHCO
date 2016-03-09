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
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="css/handleform.css"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>

<h2><b>Submitted Info:</b></h2>

<hr>
</body>




<?php

	# Turn on output buffering so that we can set Location: HTTP Header later on
//	ob_start();

//	include ("dbaccess.php");

	# Field names we expect as keys within $_POST[]
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
echo "<table>";
 foreach($keys as $value){
     echo  "<tr><td>" . $_POST[$value] . "</td></tr>";
 }


 echo "</table>";
/*	# Utility function to set field values from posted data
	function setFieldData($record) {
		// declare $keys as a global variable
		global $keys;
		// loop over each field value and append to array
		$result = array();
		foreach ($keys as $fieldname) {
			$value = null;
			// workaround PHP's insistence that spaces in
			// form variables be replaced by "_"
			if (!strpos($fieldname, " ")) {
				$value = $_POST[$fieldname];
			} else {
				$value = $_POST[str_replace(" ", "_", $fieldname)];
			}
			if (strlen($value) > 0) {
				$record->setField($fieldname, $value);
			} elseif (strlen($record->getField($fieldname)) > 0) {
				$record->setField($fieldname, null);
			}
		}
		return $result;
	}//END FUNCTION
	
	# Declare $rec
	$rec = null;

	# Verify the user didn't hit 'cancel' button
	if (!array_key_exists('cancel', $_POST)) {
		# Check for recid parameter which determines if this is a create new or edit
		if (array_key_exists('recid', $_POST)) {
			$rec = $fm->getRecordById('RegInput_1_CWP', $_POST['recid']);
		} else {
			$rec =& $fm->createRecord('RegInput_1_CWP', $values);
		}//END IF
		if (FileMaker::isError($result)) {
			echo 'Record addition failed: (' . $result->getCode() . ') ' . $result->getMessage() . "\n";
			exit;
		}//END IF
		# Set field data from form data
		setFieldData($rec);
		# Commit record to database
		$result = $rec->commit();
		if (FileMaker::isError($result)) {
			echo 'Record addition failed: (' . $result->getCode() . ') ' . $result->getMessage() . "\n";
			exit;
		}//END IF
	}//END IF

	# Set Location: HTTP header to force redirect
	header("Location: displayRecords.php");

	# End output buffering and flush output
	ob_end_flush();*/




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