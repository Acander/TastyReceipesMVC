<?php 
	require 'resources/fragments/init.php';
	
	use Functionality\Controller\Controller;
	
		if(!isset($_POST['submit'])){
			return;
		}
			
		$uid = $_POST['uid'];
		$date = $_POST['date'];
		$message = $_POST['message'];
		$food = $_POST['food'];
		
		$contr = Controller::getController();
		$contr->addANewComment($uid, $message, $date, $food);
		
		header("Location: ../TastyRecepies/resources/views/$food.php");
		exit();
		
		

	
?>