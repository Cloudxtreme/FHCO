<?php
$classSelect = $_POST['ClassSelect'];
$nameFirst = $_POST['NameFirst'];
$nameLast = $_POST['NameLast'];
$Email = $_POST['Email'];
$EmailVerify = $_POST['EmailVerify'];
$PhoneHome = $_POST['PhoneHomeAC'] . "-" . $_POST['PhoneHomePrefix'] . "-" . $_POST['PhoneHomeSuffix'];
$PhoneWork = $_POST['PhoneWorkAC'] . "-" . $_POST['PhoneWorkPrefix'] . "-" . $_POST['PhoneWorkSuffix'];
$Company = $_POST['Company'];
$JobTitle = $_POST['JobTitle'];
$Website = $_POST['website'];
$Address = $_POST['AddressStreet'] . ", " . $_POST['AddressUnit'] . ", " . $_POST['AddressCity'] . ", " . $_POST['AddressState'] . ", " . $_POST['AddressZip'];
$Country = $_POST['AddressCountry'];
$AmountDue = $_POST['amountpaid'];

if ($classSelect == ""){
$missingField += 1;

}

if ($nameFirst == ""){
$missingField += 1;

}

if ($nameLast == ""){
	$missingField += 1;
}
if ($Email == ""){
	$missingField += 1;
}

if ($EmailVerify == ""){
	$missingField += 1;
}

if ($Email != $EmailVerify){
	$missingField += 1;
}
if ($PhoneHome == ""){
	
}
if ($PhoneWork == ""){
	
}
if ($Company == ""){
	$Company = "--";
}

if ($JobTitle == ""){
	$JobTitle = "--";
}

if ($Website == ""){
	$Website = "--";
}
if ($Address == ", , , , "){
	$Address = "--";
}
if ($Country == ""){
	$Country = "--";
}


?>