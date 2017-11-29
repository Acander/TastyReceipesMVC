<?php
	require 'resources/fragments/init.php';
	
	use Functionality\Controller\Controller;

	if(!isset($_POST['commentDelete'])){
		return;
	}
	
		$c_id = $_POST['c_id'];
		$food = $_POST['food'];
		
		$contr = Controller::getController();
		$contr->deleteComment($c_id, $food);
		
		header("Location: ../TastyRecepies/resources/views/$food.php");
		exit();
?>