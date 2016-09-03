<?php
/* The code below checks if a user's detail from a session and look to store it inside
a cookie (if it hasnt been done already).
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
	
	<script>
		function showDescription(x)
		{
			x.style.height="64px";
			x.style.width="64px";
			
		}

		function removeDescription(x)
		{
			x.style.height="32px";
			x.style.width="32px";
		}
	</script>
	
	<!--
	<script type="text/javascript">
		function updateLowestInput(val) {
		  document.getElementById('lowestInput').value=val; 
		}

		function updateHighestInput(val) {
		  document.getElementById('highestInput').value=val; 
		}
	</script>
	-->
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
		<p>Here are the listing of the available phone models</p>

		<?php
		/*Open a database connection and create and handler*/
		$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=teaching user=csguest password=r3p41r3d");
		if (!$conn) {
			echo "<p>", pg_last_error(), "</p></body></html>";
			exit;
		}
		
		/*Check if given prices are equal to 0, if they are, display everything inside the database*/
		if($_GET["lowest_price"] == 0 && $_GET["highest_price"] == 0){
			$res = pg_query($conn, "SELECT ref, manufacturer,model,os,colour,screen,price,description from phones");
		}
		/*Else, check if a price has been stated by the user, then get data from the database based on user's input*/
		else if(isset($_GET["lowest_price"]) && isset($_GET["highest_price"])){
			$res = pg_query($conn, "SELECT ref, manufacturer,model,os,colour,screen,price,description FROM 
			phones WHERE price BETWEEN " . $_GET["lowest_price"] ." AND " . $_GET["highest_price"]);
			
			echo "<p>Available phone models of prices between &pound; " . $_GET["lowest_price"] . " and &pound; " . $_GET["highest_price"] . " </p>";
		}
		else{
			$res = pg_query($conn, "SELECT ref, manufacturer,model,os,colour,screen,price,description from phones");
		}
		?>

		<!--
		Below is a table that loads up the contents that has been retrieved from the database.
		Each row of information has an accompanying select button which a user can click to select a phone.
		On the click of purchase, the selected rows of phones would be sent to be processed by another .php file.
		-->
		<form action='shoppingBasket.php' method='post'>
		<table>
			<tr><td> <input type='submit' value = 'Purchase' id='top'></td></tr>
		</table>

		<section id = "storeTable">
			<table border = '1'>
				<tr>
					<th colspan = "4">Phones</th>
				</tr>
				
				<?
				/*loop round the rows and fields of a relation and print out the products */
				
				$count = 0;
				echo "<tr>";
				while ($a = pg_fetch_row($res)){
					echo "<td>";
					for ($j = 1; $j < pg_num_fields($res); $j++)
					{	
						if($a[$j] == "Nokia"){
							echo "<img src='images/nokia_logo.jpg' alt ='Nokia' width='50' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "LG"){
							echo "<img src='images/lg-logo.jpg' alt ='LG' width='50' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "Apple"){
							echo "<img src='images/iphone-logo.jpg' alt ='Apple' width='50' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "HTC"){
							echo "<img src='images/htc-logo.jpg' alt ='HTC' width='50' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "Samsung"){
							echo "<img src='images/samsung-logo.jpg' alt ='Samsung' width='50' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "Sony"){
							echo "<img src='images/sony-logo.jpg' alt ='Sony' width='50' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "Motorola"){
							echo "<img src='images/moto-logo.jpg' alt ='Motorola' width='65' height = '25'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "BlackBerry" || $a[$j] == "BlackBerry "){
							echo "<img src='images/blackberry-logo.jpg' alt='Blackberry' width='60' height = '30'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "Huawei"){
							echo "<img src='images/huawei-logo.jpg' alt='Huawei' width='60' height = '30'/>";
							include("phonedetails.php");
						}
						else if($a[$j] == "Sony Ericsson"){
							echo "<img src='images/sony-ericsson-logo.jpg' alt='Sony' width='60' height = '30'/>";
							include("phonedetails.php");
						}
					}
					
					
					echo "</td>";
					$count++;
					
					if($count == 4){
						echo "</tr>";
						$count = 0;
					}
				}
				?>
			</table>
		</section>
		
		<br>
		<table>
			<tr>
				<td> <input type='submit' value = 'Purchase' id = 'bottom' /></td>
			</tr>
		</table>
		</form>
		
		<?
		/*Close the database connection*/
		pg_close($conn);
		?>
	</section>

	<!--
	The navigation of the store page
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
			?>
				<tr>
					<td><a href = "shoppingBasket.php" class = "normal">Shopping Basket</a></td></tr>
				<tr>
					<td><a href = "about.php" class = "normal">About</a></td>
				</tr>
				<tr>
					<td><a href = "bye.php" class = "normal">Log Out</a></td>
				</tr>
			<?
			}
			?>
		</table>
	</nav>
	
	<!--
	Just below the navigation on the right side of the store page is a search functionality for a user to interact with what's being displayed in/on the table.
	-->
	<aside>
		<br/>

		<form action="#" method="get">
		<table id="anchorMenu">
			<tr>
				<td><strong><a href="#">Search by price:</a></strong></td>
			</tr>
			<tr>
				<td>Lowest: <input type ="number" min ="0" max = "999" name = "lowest_price" value = "0" /> 
				<!-- onchange="updateLowestInput(this.value);"> 
				<input type="text" id="lowestInput" value="0" size = "3">--></td></tr>
			<tr>
				<td>Highest: <input type ="number" min ="0" max = "999" name = "highest_price" value = "999" /> <!--onchange="updateHighestInput(this.value);">
				<input type="text" id="highestInput" value="999" size = "3">--></td></tr>
			<tr>
				<td><input type ="submit" value = "Search" /> </td></tr>
			<tr>
				<td><br/><a class="anchor" href="store.php"> Top of the Table </a></td></tr>
			<tr>
				<td><a class="anchor" href="#bottom"> Bottom of the Table</a></td></tr>
		</table>
		</form>
	</aside>
	
	<!--
	The footer displays links to other pages on the website as well as the validation page.
	-->
	<footer>
		<a href= "about.php">About Us</a> | 
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2Fstore.php">Validate Page</a>
		<br/>
		This page was last modified on: 
		<script type="text/javascript">
			document.write(document.lastModified);
		</script>

		<?php
		$viewmonth=date("n");
		if (($viewmonth<12)&&($viewmonth>6))
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
