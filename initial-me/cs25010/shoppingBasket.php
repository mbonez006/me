<?php

include("functions.php");

/*Count the number if products that has been selected by the user*/
$max = count($_POST);

/*Check for a user's detail from a session and look to store it inside
a cookie (if it hasn't been done already).
*/
if (!(isset($_SESSION["name"]))){
	session_save_path('php_sessions/');
	session_start();	
}

if (!(isset($_COOKIE["user"]))){
	setcookie("user", $_SESSION['name'], time()+3600);
}

/*Action to remove from a cart*/
if($_REQUEST['command']=='remove'){
	remove_product($_REQUEST['product_ref']);
}
/*Action to clear the cart*/
else if($_REQUEST['command']=='clear'){
	unset($_SESSION['cart']);
}

?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="shortcut icon" type="image/png" href='favicon.png' />
	<title>cs25010 Shopping Basket</title>
	
	<!--
	Javascript to handle product removing from cart as well as clearing the cart. It basically
	sets the appropriate values for the commands that needs to be called and it submits the form.
	-->
	<script>
		function remove(product_ref){
			document.form1.product_ref.value = product_ref;
			document.form1.command.value='remove';
			document.form1.submit();
		}
		function clear_cart(){
			if(confirm('This will empty your shopping cart, continue?')){
				document.form1.command.value='clear';
				document.form1.submit();
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
		<h3>Shopping Basket</h3>
		<p>Here is your shopping basket</p>

		<?php
		/*Open a database connection and create and handler*/
		$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=teaching user=csguest password=r3p41r3d");
		$res = pg_query($conn, "SELECT ref, manufacturer, model, price from phones");
		
		/*Fetch all the references that the user had selected on the store page, and add the references to
		the shopping cart.*/
		while ($a = pg_fetch_row($res)){
			for ($j = 0; $j < pg_num_fields($res); $j++)
			{
				if (array_key_exists($a[$j], $_POST)){
					addtocart($a[$j]);
				}
			}
		}
		?>
		
		
		<!--
		Create a form and a table that basically displays what is present inside the cart. There
		is the option to remove from the cart as well as clear the cart, or simply to carry on shopping.
		-->
		<form name="form1" method="post">
		<input type="hidden" name="product_ref" />
		<input type="hidden" name="command" />

		<table>
			<tr><td><input type="button" value="Continue Shopping" onclick="window.location='store.php'"></td></tr>
		</table>

		<section id = "storeTable">
			<table border = "1">
			<?
				if(is_array($_SESSION['cart'])){
					echo "
					<tr><th>Phone Manufacturer</th>
					<th>Phone Model</th>
					<th>Price</th>	
					<th>Options</th>
					</tr>";
					
					/*count the number if data in the cart array in order to loop through the cart*/
					$max=count($_SESSION['cart']);
					
					/*loop through the cart and display all the data in a table*/
					for($i = 0; $i < $max; $i++){
						$product_ref = $_SESSION['cart'][$i];
						$phone_manufacturer=get_phone_manuf($product_ref);
						$phone_model=get_phone_model($product_ref);
						$phone_price=get_phone_price($product_ref);
				?>
						<tr><td><?=$phone_manufacturer?></td>
						<td><?=$phone_model?></td>
						<td>&pound;<?=$phone_price?></td>
						<td><a href="javascript:remove(<?=$product_ref?>)">Remove</a></td></tr>
				<?					
					}
				?>
				<tfoot border = "0";>
					<tr><td><strong>Order Total: &pound;<?=get_order_total()?></strong></td>
					<td colspan="3" align = "right"><input type="button" value="Clear Cart" onclick="clear_cart()">
					
					<!--
					Display different links based on the state of a user (logged in or Not)
					-->
					<?php
						if(isset($_COOKIE["user"]) || isset($_SESSION["name"])){
							?>
							<input type='button' value='Check Out' onclick="window.location='checkOut.php'"></td></tr>
							<?			
						}
						else{
							?>
							<input type='button' value='Check Out As Guest' onclick="window.location='checkOut.php'"></td></tr>
							<?	
						}
					?>
				</tfoot>
				<?
				}
				else{
					echo "<tr><td>There are no items in your shopping cart!</td></tr>";
				}
			?>
			</table>
		</section>
		</form>
	</section>

	<!--
	The navigation on the shopping basket page
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
					echo "<tr>";
					echo "<td><a href = 'bye.php' class = 'normal'>Log Out</a></td>";
					echo "</tr>";	
				}
				?>

				<tr>
					<td><br/><br/>
					<p><strong><a href="#">Also Available...</a></strong></p>
					<img src = "images/pic5.jpg" alt="Available In Store" width="150" height="180"/>
					</td>
				</tr>
		</table>
	</nav>

	<!--
	The footer displays links to other pages on the website as well as the validation page.
	-->
	<footer>
		<a href= "about.php">About Us</a> | 
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2FshoppingBasket.php">Validate Page</a>
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
