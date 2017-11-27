<?php
	
	if(!isset($_POST['submit'])){
		return;
	}
		$contr = Controller::getController();
		$contr->userLogOut();
		
		header("Location: ../TastyRecepies/index.php");
		exit();
	
?>