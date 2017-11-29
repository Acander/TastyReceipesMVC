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
	$contr->conValUser($unescapedEmail, $unescapedPwd);
	
	
		
?>