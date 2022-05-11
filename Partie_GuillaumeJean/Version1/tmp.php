<?php
	// SET HEADER (mandatory)
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Allow-Credentials: true");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	$modif = "";
	if(isset($_POST['modif']))
		$modif = $_POST['modif']; //on stock la donnee modifiee
	
	// ajoute ton script pr update ds la db
	
	
	
	
	
	// reponse a la requete
	
	$arr = array('response' => "OK");	
	echo json_encode($arr);

?>