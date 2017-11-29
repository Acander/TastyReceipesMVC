<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Log In</title>
		<link rel="stylesheet" type="text/css" href="resources/css/BasicLayout.css"/>
	</head>
	
	<body class = "bg">
	
		<h1 class = "headline1">Tasty Receipes</h1>
	
	<?php
		if(isset($_SESSION['e'])){
			echo "<div class = 'subline'>
				<form action = 'logout.php' method = 'POST' class = 'logOutButtonForm'>
					<button type = 'submit' name = 'submit' class = 'logOutButton'>Log Out</button>
				</form>
			</div>";
		}
	?>
		
		<ul class = "navigationBar">
			<li class = "navigation"><a href = "resources/views/MainPage.php">Main page</a></li>
			<li class = "navigation"><a href = "resources/views/Calender.php">Calender</a></li>
			<li class = "navigation"><a href = "resources/views/Meatballs.php">Meatball recipe</a></li>
			<li class = "navigation"><a href = "resources/views/Pancakes.php">Pancake recipe</a></li>
		</ul>
	
	<div class = "center">
		<form action="loginValidation.php" method = "POST">
			<div class="imgcontainer">
				<img src="resources/images/woman.png" alt="Image of a neutral character" class="avatar">
			</div>

			<div class="container">
					<h1 class = "headline4">E-mail</h1>
					<input type="text" placeholder="Enter Username" name="email" required>

					<h1 class = "headline4">Password</h1>
					<input type="password" placeholder="Enter Password" name="pwd" required>
					
					<?php
						if(isset($_GET['login']) && $_GET['login']=='error'){
							echo "<div class = 'errorMessage'>Wrong username or password!</div>";
						}
					?>
					
					<button type="submit" name="submit" class = "logInButton">Login</button>
					<span>Not registered? <a href="resources/views/UserRegister.php">Sign up</a></span>
			</div>

			<div class="lastContainer">
				<a href = 'resources/views/MainPage.php' class="cancelbtnLogIn">Cancel</a>
			</div>
		</form>
	
	</div>
		
	</body>
</html>