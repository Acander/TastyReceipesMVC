<?php
	
	require 'resources/fragments/init.php';
	use Functionality\Controller\Controller;
	
	if(!isset($_POST['submit'])){
		return;
	}
		$contr = Controller::getController();
		$contr->userLogOut();
		
		header("Location: ../TastyRecepies/index.php");
		exit();
	
?>