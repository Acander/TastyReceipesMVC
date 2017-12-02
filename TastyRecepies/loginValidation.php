<?php

	/**
	*	This code validates users email- and password input
	*/
	
	require 'resources/fragments/init.php';
	
	use Functionality\Controller\Controller;
	
	if(!isset($_POST["submit"])){
		return;
	}
		
	$unescapedEmail = $_POST["email"];
	$unescapedPwd = $_POST["pwd"];
	
	$contr = Controller::getController();
	$errorCode = $contr->conValUser($unescapedEmail, $unescapedPwd);
	
	if($errorCode == 1){
		header("Location: ../TastyRecepies/index.php?login=error");
		exit();
	}
	else if($errorCode == 0){
		header("Location: ../TastyRecepies/resources/views/MainPage.php");
		exit();
	}
	
		
?>