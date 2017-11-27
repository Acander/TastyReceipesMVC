<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Log In</title>
		<link rel="stylesheet" type="text/css" href="/TastyRecepies/resources/css/BasicLayout.css"/>
	</head>
	
	<body class = "bg">
	
		<?php
			include("/TastyRecepies/resources/head.php");
		?>
	
	<div class = "center">
		<form action="/TastyRecepies/loginValidation.php" method = "POST">
			<div class="imgcontainer">
				<img src="/TastyRecepies/resources/images/woman.png" alt="Image of a neutral character" class="avatar">
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
					<span>Not registered? <a href="UserRegister.php">Sign up</a></span>
			</div>

			<div class="lastContainer">
				<a href = 'MainPage.php' class="cancelbtnLogIn">Cancel</a>
			</div>
		</form>
	
	</div>
		
	</body>
</html>