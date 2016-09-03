<?php

/* The code below checks for a user's detail from a session and look to store it inside
a cookie (if it hasnt been done already).
*/

	if (!(isset($_SESSION["name"]))){
		session_save_path('php_sessions/');
		session_start();
	}

	if (!(isset($_COOKIE["user"]))){
		setcookie("user", $_SESSION['name'], time()+3600);
	}
?>

<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="shortcut icon" type="image/png" href='favicon.png' />
	<title>cs25010 Phone Store</title>
</head>

<body>

<!--
The header of the file begins from here and it contains a logo and an included php file
that displays greetings to the user as well as a link to the basket.
-->
<header>
	<div id = "headerLogo">
		<a href = "index.php"><img src = "images/logo2.png" alt="logo" width="550" height="80"/></a>
	</div>
	<div id = "headerSide">
		<?php include 'headerSide.php'; ?>
	</div>
</header>

<!--
The container section has details about the main area of the web page
-->
<section id = "container">
	<section id = "mainArea">
	<p>Visit our store to check out the latest phone.</p>
		
	<br/>
		<!--
		A section that displays images on the home screen.
		-->
		<section id = "images">
		<p>
			<img src = "images/pic5.jpg" alt="Available In Store" width="320" height="180"/>
			<img src = "images/pic6.jpg" alt="Available In Store" width="320" height="180"/>
		</p>
		<p>
			<img src = "images/pic1.jpg" alt="Available In Store" width="320" height="180"/>
			<img src = "images/pic3.jpg" alt="Available In Store" width="320" height="180"/>
		</p>
		<p>
			<img src = "images/pic2.jpg" alt="Available In Store" width="320" height="180"/>
			<img src = "images/pic4.jpg" alt="Available In Store" width="320" height="180"/>
		</p>
		</section>
	</section>
	
	<!--
	The navigation of the homescreen
	-->
	<nav>
	<br/>
	<table>
		<tr>
			<td><a href = "index.php" class = "normal">Home</a></td>
		</tr>
		<tr>
			<td><a href = "store.php" class = "normal">Store</a></td>
		</tr>
		<tr>
			<td><a href = "about.php" class = "normal">About</a></td>
		</tr>
		<tr>
			<td><a href = "bye.php" class = "normal">Log Out</a></td>
		</tr>
	</table>

	</nav>

	<!--
	Just below the navigation on the right side of the home screen should be a display of
	general information about the products in the store.
	-->
	<aside>
	<br /><br />
	<ul>
		<li>
		<a href="#"><strong>Top Handsets</strong></a><br/></li>
		<li>Apple iPhone 5s</li>
		<li>Apple iPhone 5c</li>
		<li>Samsung Galaxy S4</li>
		<li>Samsung Galaxy S3</li>
		<li>HTC One<br/></li>
		<li>Sony Xperia Z</li>
	</ul>

	<br/><br/>
	<ul>
		<li><a href="#"><strong>Manufacturers</strong></a></li>
		<li>HTC Phones<br/></li>
		<li>BlackBerry Phones</li>
		<li>Apple Phones</li>
		<li>Samsung Phones</li>
		<li>Nokia Phones</li>
		<li>Huawei Phones<br/></li>
		<li>Sony Phones</li>
	</ul>

	<br/><br/>
	<ul>
		<li><a href="#"><strong>Networks</strong></a></li>
		<li>LIFE Mobile Shop</li>
		<li>EE Shop<br/></li>
		<li>Orange Shop</li>
		<li>Vodafone Shop<br/></li>
		<li>O2 Shop<br/></li>
		<li>TMobile Shop</li>
		<li>Lebara Shop</li>
	</ul>
	</aside>
	
	<!--
	The footer displays links to other pages on the website as well as the validation page.
	-->
	<footer>
		<a href= "about.php">About Us</a> | 
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2F">Validate Page</a>
		<br/>
		This page was last modified on: 
		<script type="text/javascript">
			document.write(document.lastModified);
		</script>

		<?php
		$viewmonth=date("n");
		if (($viewmonth==12)||($viewmonth<7))
		{
		if (isset($_POST["viewsource"])) {echo"<hr />";highlight_file(__FILE__);}
		else echo('<form action="' . $_SERVER["PHP_SELF"] . '" method="post">
		<p><input type="submit" name="viewsource" value="View source"/> | <a href="functions.txt">Other PHP Files </a></p></form>');
		}
		?>
	</footer>

</section>
</body>

</html>
