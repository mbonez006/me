<?php
	/*End a user's session
	Delete the cookie that's been stored on the client's machine.*/

	setcookie("user", $_COOKIE["user"], time()-3600);
	setcookie("max", $_COOKIE["max"], time()-3600);
	session_save_path('php_sessions/');
	session_start();
	session_destroy();
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
		<br/>
		<a href="shoppingBasket.php"><img src = "images/basket.jpg" alt="basket" width="22" height="22"/>
		 Basket</a> <br/>

		<?php
		if (isset($_COOKIE["user"])){
		  echo "<a href='#'>Bye, " . $_COOKIE["user"] . "!</a><br>";
		}
		elseif (isset($_SESSION["name"]))
		  echo "<a href='#'>Bye, " . $_SESSION["name"] . "!</a><br>";
		elseif(isset($_COOKIE["user"]))
		  echo "<a href='#'>Bye, " . $_COOKIE["user"] . "!</a><br>";
		?>
	</div>
</header>


<!--
The container section has details about the main area of the web page
-->
<section id = "container">
	<section id = "mainArea">
		Thanks for shopping, You have been logged out...
		<br/><br/>	
	</section>
	
	
	<!--
	The navigation on this page
	-->	
	<nav>
		<br/>
		<table>
			<tr>
				<td><a href = "index.php" class = "normal">Home</a></td>
			</tr>
		</table>

	</nav>

	
	<!--
	The footer displays links to other pages on the website as well as the validation page.
	-->
	<footer>
		<a href= "about.php">About Us</a> | 
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2Fbye.php">Validate Page</a>
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
