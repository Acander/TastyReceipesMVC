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
		$contr->userRegistration($unescapedEmail, $unescapedPwd, $unescapedpwdRe); //We register the user
	                                                           
?>