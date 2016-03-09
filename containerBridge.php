<?php
  include ("dbaccess.php");

#This is a bridge script that calls FileMaker::getContainerData with the provided url.    
if (isset($_GET['path'])){
	$url = $_GET['path'];
	$url = substr($url, 0, strpos($url, "?"));
	$url = substr($url, strrpos($url, ".") + 1);
	if($url == "jpg"){
		header('Content-type: image/jpeg');
	}
	else if($url == "gif"){
		header('Content-type: image/gif');
	}
	else if($url == "png"){
		header('Content-type: image/png');
	}	
	else if($url == "pdf"){
		header('Content-type: application/pdf');
	}	
	else{
		header('Content-type: application/octet-stream');
	}
	echo $fm->getContainerData($_GET['path']);
}

?>
