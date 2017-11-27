<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Meatballs</title>
		<link rel="stylesheet" type="text/css" href="../css/BasicLayout.css"/>
	</head>
	
	<body class = "bg">
		<?php
			include("../fragments/head.php");
		?>
		
		<div class = "center">
		
			<h1 class = "headline2">Meatballs</h1>
			<img class = "stdImage" src = "../images/spagetti.jpg" alt = "Image of sime meatballs"/>
		
		
		<div class = "recipeCenter">
				<p>Time: Forever, if you can't cook</p>
				<p>Portions: 8-10</p>
		</div>
		
			<h1 class = "headline3">Ingredients</h1>
			<div class = "instructions">
				<ul>
					<li>Lots of meat</li>
					<li>Spices. Look at a real cooking site for a specific quantity</li>
					<li>4 gallons of milk</li>
					<li>Tea spoon of water</li>
				</ul>
			</div>
			
			<h1 class = "headline4">If you are Findus or IKEA</h1>
			<div class = "instructions">
				<ul>
					<li>Use primarily horse meat</li>
				</ul>
			</div>
		
			<h1 class = "headline3">Directions</h1>
			<div class = "instructions">
				<ul>
					<li>Grind the meat like the children from Another Brick in the Wall</li>
					<li>Pour on spices, milk, water and the all the other stuff that were omitted from the ingredient section</li>
					<li>Voilá!</li>
				</ul>
			</div>
		
			<h1 class = "headline3">Comments</h1>
			
			<?php
				include("Comment.php");
			
				getComments("Meatballs");
				if(isset($_SESSION['e'])){
					setComments("Meatballs");
				}
				else{
					echo "<p>You need to be logged in to comment!</p>";
				}
			?>
			
			</div>
	</body>
</html>