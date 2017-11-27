<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Pancakes</title>
		<link rel="stylesheet" type="text/css" href="../css/BasicLayout.css"/>
	</head>
	
	<body class = "bg">
		<?php
			include("../fragments/head.php");
		?>
		
		<div class = "center">
		
			<h1 class = "headline2">Pancakes</h1>
			<img class = "stdImage" src = "../images/Pan.jpg" alt = "Image of some pancakes"/>
		
			<div class = "recipeCenter">
				<p>Time: 30 minutes </p>
				<p>Portions: 3-6</p>
			</div>
		
			<h1 class = "headline3">Ingredients</h1>
			<div class = "instructions">
				<ul>
					<li>2 pounds of Flower</li>
					<li>Sugar</li>
					<li>4 gallons of milk</li>
					<li>Tea spoon of water</li>
				</ul>
			</div>
		
			<h1 class = "headline3">Directions</h1>
			<div class = "instructions">
				<ul>
					<li>Pour on milk, water and etc.</li>
					<li>Voilá!</li>
				</ul>
			</div>
		
			<h1 class = "headline3">Comments</h1>
			
			<?php
				include("Comment.php");
				
				getComments("Pancakes");
				
				if(isset($_SESSION['e'])){
					setComments("Pancakes");
				}
				else{
					echo "<p>You need to be logged in to comment!</p>";
				}
			?>
		
		</div>
		
	</body>
</html>