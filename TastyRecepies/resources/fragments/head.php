<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Head</title>
		<link rel="stylesheet" type="text/css" href="/TastyRecepies/resources/css/BasicLayout.css"/>
	</head>
	
	<body>
	
	<h1 class = "headline1">Tasty Receipes</h1>
	
	<?php
		if(isset($_SESSION['e'])){
			echo "<div class = 'subline'>
				<form action = 'logout.php' method = 'POST' class = 'logOutButtonForm'>
					<button type = 'submit' name = 'submit' class = 'logOutButton'>Log Out</button>
				</form>
			</div>";
		}
		else{
			echo "<div class = 'subline'>
				<a href = 'index.php' class = 'logIn'>Log In</a>
			</div>";
		}
	?>
		
		<ul class = "navigationBar">
			<li class = "navigation"><a href = "MainPage.php">Main page</a></li>
			<li class = "navigation"><a href = "Calender.php">Calender</a></li>
			<li class = "navigation"><a href = "Meatballs.php">Meatball recipe</a></li>
			<li class = "navigation"><a href = "Pancakes.php">Pancake recipe</a></li>
		</ul>
		
	</body>
</html>