<?php

	require 'resources/fragments/init.php';
	
	use Functionality\Controller\Controller;

	if(!isset($_POST["pressButton"])){
		return;
	}
		$unescapedEmail = $_POST["email"];
		$unescapedPwd = $_POST["pwd"];
		$unescapedpwdRe = $_POST["pwd-repeat"];
		
		$contr = Controller::getController();
		$errorCode = $contr->userRegistration($unescapedEmail, $unescapedPwd, $unescapedpwdRe); //We register the user
		
		
		//errorCheck
		if ($errorCode == 0){
			header("Location: ../TastyRecepies/index.php");
			exit();
		}            
		else if($errorCode == 1){
			header("Location: ../TastyRecepies/resources/views/UserRegister.php?UserRegister=pwdFailure");
			exit();
		}
		else if($errorCode == 2){
			header("Location: ../TastyRecepies/resources/views/UserRegister.php?UserRegister=emailFailure");
			exit();
		}
?>