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
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="shortcut icon" type="image/png" href='favicon.png' />
	<title>cs25010 Phone Store</title>
	<script type="text/javascript">
	
	/*JavaScript to validate the check out form
	It uses regular expressions to check  that the email and the credit card number inputted
	by the user is valid*/
	function validate(orderForm) {
		orderForm.onsubmit = function()
		{
				/*Checking credit card number*/
				if(orderForm.elements['card_number'].value.length == 0) {
					alert("You have not entered a Credit Card Number!");
					return false;
				} else {
					var numberRegexp = /^([0-9])+$/; // 1 or more numbers
					var numberRegexp2 = /^([0-9]){16}$/; // 1 or more numbers
						if(!numberRegexp.test(orderForm.elements['card_number'].value))
						{
							alert("Invalid Credit Card - Input Numbers Only!");
							return false;
						}else if(!numberRegexp2.test(orderForm.elements['card_number'].value)){
							alert("Invalid Credit Card - Exactly 16 numbers required!");
							return false;
						}
			}

			/*Checking email*/
			var emailRegexp=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!emailRegexp.test(orderForm.elements['email'].value))
			{
				alert("Invalid email address!");
				return false;
			}
				return true;
			}
	}

	</script>
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

		<p><strong>"This is not a real web shop;
		it is created as part of my university coursework. Please do not attempt to buy anything
		from this site, nor enter your real card details."
		</strong></p><br/>
		<p>Here is where you check out. <strong>Input your details below</strong></p>

		<!--
		Form that accepts a user's email and credit card number
		-->
		<form name = "order" action ="processOrder.php" method = "post" autocomplete="on">
		<table>
			<tr><td>Name:</td><td><? if(isset($_COOKIE["user"])) echo $_COOKIE["user"]; else echo "Guest";?></td></tr>
			<tr><td>Email Address:</td><td><input type = "email" name = "email" required></td></tr>
			<tr><td>Credit Card Type:</td><td>
				<select name="card_type">
				<option value="visa" selected>VISA</option>
				<option value="master">MASTER CARD</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>Credit Card Number:</td><td><input type = "number" name = "card_number" required autocomplete="off"></td></tr>
			<tr>
				<td></td>
				<td><input type = "submit" value = "Place Order" onclick = "check_email()"></td>
			</tr>
		</table>
		</form>

		<script type="text/javascript">
		<!--
			new validate(document.forms['order']);
		-->
		</script>
	</section>
	
	<!--
	The navigation on the check-out page
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
				<?php
				/*Only display some links if a user is logged in*/
				if(isset($_COOKIE["user"]) || isset($_SESSION["name"])){
					echo "<tr>";
					echo "<td><a href = 'shoppingBasket.php' class = 'normal'>Shopping Basket</a></td></tr>";
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
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2FcheckOut.php">Validate Page</a>
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
