<?php 
	include("dbLogInConfig.php");
	date_default_timezone_set('Europe/Stockholm');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Comment</title>
		<link rel="stylesheet" type="text/css" href="BasicLayout.css"/>
	</head>
	
	<body>
		
		<?php
		
		function setComments($food){
			echo "<form method = 'POST' action= '/TastyRecepies/setComments.php' id='commentform'>
				<input type = 'hidden' name = 'uid' value = '".$_SESSION['e']."'>
				<input type = 'hidden' name = 'date' value = '".date('Y-m-d H:i:s')."'>
				<input type = 'hidden' name = 'food' value = '$food'>
				<textarea class = 'textArea' name='message' rows='3' cols='40' placeholder='Write your opinion or ask a question'></textarea>
				<div>
					<input type='submit' name = 'submit'>
				</div>
				</form>";
		}
			
		function getComments($food){
			$contr = Controller::getController();
			$result = $contr->getComments();
			while($row = mysqli_fetch_assoc($result)){
				if($row['dish'] == $food){
					
					if(isset($_SESSION['e']) && $_SESSION['e'] == $row['user_id']){
						echo "<div class = 'commentDiv'><div class = 'deletebox'>
							<form class = 'delete-form' method = 'POST' action = 'deleteComment.php'>
							<input type = 'hidden' name = 'c_id' value = '".$row['c_id']."'>
							<input type = 'hidden' name = 'food' value = '$food'>
							<button class = 'commentDeleteButton' name = 'commentDelete'>Delete</button>
							</form></div>";
							
							echo "<div class = 'comment'>";
								echo $row['user_id']. "<br>";
								echo $row['date']. "<br><div class = 'message'>Comment: ";
								echo $row['message']. "</div><br><br>";
							echo "</div></div>";
							
					}
					else{
						echo "<div class = 'comment-boxes'>";
							echo $row['user_id']. "<br>";
							echo $row['date']. "<br><div class = 'message'>Comment: ";
							echo $row['message']. "</div><br><br>";
						echo "</div>";
					}
					
				}
			
		}
		}
		?>
	</body>
</html>