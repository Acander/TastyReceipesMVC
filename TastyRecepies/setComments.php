<?php 
	require './resources/fragments/init.php';
	
		if(!isset($_POST['submit'])){
			return;
		}
			
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		$food = $_POST['food'];
		
		$contr = Controller::getController();
		$contr->addANewComment($uid, $date, $message, $food);
		
		header("Location: ../TastyRecepies/$food.php");
		exit();
		
		

	
?>