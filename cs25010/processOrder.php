<?php
include("functions.php");

/*Check for a user's detail from a session and look to store it inside
a cookie (if it hasn't been done already).
*/
if (!(isset($_SESSION["name"]))){
	session_save_path('php_sessions/');
	session_start();	
	$_SESSION['name'] = $_POST["name"];
}

if (!(isset($_COOKIE["user"]))){
	setcookie("user", $_SESSION['name'], time()+3600);
}

/*Unset the cart, i.e empty the cart once this page is loaded*/
unset($_SESSION['cart']);
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
		<p>Your order has been Processed. Thanks for shopping with us! (You are still logged in.)</p>

		<!--
		Give the user the option to beging shopping again or log out.
		-->
		<table>
			<tr><td><input type="button" value="Begin Shopping Again" onclick="window.location='store.php'"></td>
			<td><input type="button" value="Log Out" onclick="window.location='bye.php'"></td></tr>
		</table>
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
			<tr>
				<td><a href = "store.php" class = "normal">Store</a></td>
			</tr>
			<tr>
				<td><a href = "about.php" class = "normal">About</a></td>
			</tr>
				<?php
				/*Only display some links if a user is logged in*/
				if(isset($_COOKIE["user"]) || isset($_SESSION["name"])){
					echo "<tr><td><a href = 'bye.php' class = 'normal'>Log Out</a></td>";
					echo "</tr>";	
				}
				?>
		</table>

	</nav>

	<!--
	The footer displays links to other pages on the website as well as the validation page.
	-->
	<footer>
		<a href= "about.php">About Us</a> | 
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2FprocessOrder.php">Validate Page</a>
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
