<?php

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

</head>

<body>

<!--
Using a non fixed header style in order to be able to allow the user to read the
content of the page on fullscreen
-->
<div id = "non_fixed_header">
	<div id = "headerLogo">
		<a href = "index.php"><img src = "images/logo2.png" alt="logo" width="550" height="80"/></a>
	</div>
	<!--
	Including the side of the header which contains a link to the shopping basket
	-->
	<div id = "headerSide">
		<?php include 'headerSide.php'; ?>
	</div>
</div>

<!--
The container section has details about the main area of the web page. Again, using a container style
that supports not having a fixed header.
-->
<section id = "non_fixed_container">
	<section id = "mainArea">

		<article>
		<h3><a id="design">ABOUT THE DESIGN</a></h3>
		This website was designed using HTML5 (for marking the information up), CSS3 (for styling the page) 
		and PHP. <br/>
		I started by designing the homepage (<a href="index.php">index.php</a>). 
		The homepage had some information about the purpose of the website as well as a form that accepts a user’s name. 
		This was done in order to allow a user to log into the website using their name. 
		I made sure to start a session after a user logs in. 
		The session stores the user’s name and the session is maintained throughout until the user logs out of the system. 
		The session is also stored inside the cookie on the user’s local computer.<br/><br/>
		I designed the page that displays the list of available phones (<a href="store.php">store.php</a>) 
		and this was done by writing SQL queries that interacts with the given database and relation. 
		Retrieved data is displayed in a tabular form with each row accompanied with a select box that a user 
		can click on if they choose to purchase the phone. <br/><br/>
		The displayed table can also be sorted based on a range of price a user provides. 
		This is implemented by simply altering the SQL database query that loads the table 
		up based on the price range that user provides (“SQL SELECT BETWEEN” was particularly put into use here). <br/><br/>
		A user can then select the phone(s) they want and then click on “Purchase” in order. 
		The user would be sent to a shopping basket (<a href = "shoppingBasket.php">shoppingBasket.php</a>) 
		which would have the list of the phones the user had selected alongside options to remove a phone from the list, 
		clear the cart or check-out. This was implemented by adding the phones selected by the user to a 
		new session variable that was created ($_SESSION['cart'] – which is an array). 
		Functions were written to control the adding, removing and clearing or the array (This can be found in <a href ="functions.txt">functions.txt</a>). <br/><br/>
		When the user clicks check-out, the user is transferred to a page that requests the user’s email and credit card number. 
		The email and credit card supplied by the user would be validation on the client’s side using JavaScript, 
		regular expressions and HTML5 validation attributes. <br/><br/>
		Finally the user is sent to a page that thanks the user and gives the user 
		the option to either start shopping again or log out. In implementing this, 
		if a user chooses to begin to shop again, the user’s cart would be emptied 
		(by unsetting the cart array that’s stored in “session”). 
		If a user chooses to log out at this point instead or at any other point during the course of using the website, 
		the session that has been created for such user would be destroyed and the created 
		that has the saved session would also be deleted. <br/>
		<br/>
		<h3><a id="testing">TESTING</a></h3>
		<p>In testing the website, I created a <strong>test plan</strong>.<br/> 
		I also let some friends test the website for me and they gave me feedback.<br/>
		The test plan considered many scenarios and especially tested the border-line situations. It included; <br/> 
		</p>
		<ul>
			<li>Testing that the log-in form on the homepage doesn’t accept a blank field. </li>
			<li>Testing that the log in form on the homepage accepts a name which is then displayed in a greetings on other pages. </li>
			<li>Test to see that the table on the store.php page is properly updated based on user price range input. </li>
			<li>Test to see that the “Clear Cart” and “Remove” buttons on the shoppingBasket page works as expected. </li>
			<li>Test to see that the checkout page accepts only a valid email and 16 digits credit card number. </li>
			<li>Test to see that the user’s session ends once the user clicks on log out.</li>
			<li>I also generally tested that all the links and buttons are working as expected.</li>
		</ul>

		<br/>

		<section id = "testTable">
		<h3><a id="testplan">TEST PLAN</a> </h3>
		<table border = "1">
			<tr>
				<th>No.</th>
				<th>Description</th>
				<th>Input</th>
				<th>Expected Output</th>
				<th>Actual Output</th>
				<th>Pass/Fail</th>
			</tr>
			<tr>
				<td>0.1</td>
				<td>Test that the log in form on the homepage doesn’t accept a blank field</td>
				<td>“” (blank field)</td>
				<td>The user should be prompted to input a name into the field.</td>
				<td>The user was prompted to input a name into the field</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>0.2</td>
				<td>Test that the log in form on the homepage accepts a name which is then displayed in a greetings on other pages</td>
				<td>Input “Sean”</td>
				<td>The name should be considered valid and the user should be sent to the “store” page</td>
				<td>The user was sent to the store page</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>1.0</td>
				<td>Test to see that the table on the store.php page is properly updated based on user price range input</td>
				<td>User inputs lowest price = 100, highest price  = 300 and clicks “Submit”</td>
				<td>The table on the store page should be updated to show only the phones within the given price range.</td>
				<td>The table on the store page gets updated and shows only the phones within the given price range.</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>2.0</td>
				<td>Test to see that the “Clear Cart” and “Remove” buttons on the shoppingBasket page works as expected</td>
				<td>User clicks “Remove” on one of the phones in the shopping basket</td>
				<td>The phone on the row where “Remove” was clicked should be removed from the shopping basket</td>
				<td>The phone on the row where “Remove” is clicked is removed from the shopping basket</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>2.1</td>
				<td>Test to see that the “Clear Cart” and “Remove” buttons on the shoppingBasket page works as expected.</td>
				<td>User clicks “Clear Cart” on the shopping basket page.</td>
				<td>The shopping basket should be emptied.</td>
				<td>The shopping basket was emptied.</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.0</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs “ola” in the email field</td>
				<td>There should be an error message telling the user to input a correct email</td>
				<td>There was an error message telling the user to input a correct email</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.1</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs “ola@aber” in the email field</td>
				<td>There should be an error message telling the user to input a correct email</td>
				<td>There was an error message telling the user to input a correct email</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.2</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs ola@aber.ac.uk in the email field</td>
				<td>The email should be considered valid without any error message</td>
				<td>The email was considered valid.</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.3</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs “” (blank) in the email field</td>
				<td>There should be an error message telling the user to input an email</td>
				<td>There was an error message telling the user to input an email</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.4</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs 1111 in the credit card number field.</td>
				<td>There should be an error message telling the user that the credit card should be exactly 16 digits</td>
				<td>There was an error message telling the user that the credit card should be exactly 16 digits</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.5</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs 1111222233334444 in the credit card number field.</td>
				<td>The credit card number should be considered valid without any error message</td>
				<td>The credit card number should be considered valid without any error message</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>3.6</td>
				<td>Test to see that the checkout page accepts only a valid email and 16 digits credit card number.</td>
				<td>User inputs “11112222333344445555”</td>
				<td>The input should be rejected with an error message telling the user that the input is more than 16 numbers.</td>
				<td>The input was rejected with an error message telling the user that the input is more than 16 numbers.</td>
				<td>Pass</td>
			</tr>
			<tr>
				<td>4.0</td>
				<td>Test to see that the user’s session ends once the user clicks on log out.</td>
				<td>User clicks “Log Out”</td>
				<td>The user's session should end.</td>
				<td>The user's session ends.</td>
				<td>Pass</td>
			</tr>
		</table>
		</section>
		<br/>
		<h3><a id="browser"> BROWSER VERSIONS I USED FOR TESTING </a></h3>
		I used FireFox, Internet Explorer and Chrome for testing the web pages. The web pages worked fine on all the browser apart from Internet Explorer 11 which seemed to be ignoring the HTML5 semantics tags in the style sheet.

		<h3><a id="evaluation">EVALUATION</a> </h3>
		The website looks professional and attractive, I was able to meet all the requirements in the specification and it validates as a HTML5 document. <br/><br/>
		I would like to improve the table on the “store” page by making the table look less like a common and typical row by row table. I could implement this in some other way that looks more attractive (like having three phones on a row in the form of a box) and things like the description of a phone could be displayed using JavaScript onmouseover.<br/><br/>
		Although not part of the specification, I could improve the website by allowing a user to purchase multiple amount of one phone. I could implement this by simply having a “quantity” variable that gets stored in the SESSION and gets updated just as the cart is being updated. There would be a function that checks if a product already exist in the SESSION array “cart” and if it is, “quantity” would be updated. The same goes with removing from the cart where “quantity” would be reduced.
		At the moment however, the website supports multiple purchase of one product by simply having two or more of same products appear on separate rows in the shopping basket.

		<h4>Problems I Encountered and How I solved them</h4>
		While designing the website, I had no problem using SESSION to store a user’s name and maintaining it, but I struggled a bit with removing an item from a shopping cart. My initial approach was to use a PHP variable array, store the information about the cart on it, and then store the final result inside a SESSION, I later go to realise that it was more realistic having a SESSION variable array which then gets updated live.
		<br/><br/>
		Also, in order to destroy a session on the “logout” page, I realised that the session wasn’t getting destroyed. I was later able to fix this after learning that I’ll need to call “session.start()” before calling “session.destroy()”.
		<br/><br/>
		Lastly, In reading phones into the store from the database, some phone's desrciption has quotes "'" and this is difficult to handle as the mouseover element "title" would only display what's before the quote. This also causes the store page not to validate to HTML5.

		<h3><a id="declaration">DECLARATION OF ORIGINALITY</a></h3>
		I declare that the contents of this site are entirely my own work. <br/>

		<h3><a id="disclaimer">DISCLAIMER</a> </h3>
		The information provided on this and other pages by me, Olu Ashiru (ola@aber.ac.uk), is under my own personal responsibility and not that of Aberystwyth University. Similarly, any opinions expressed are my own and are in no way to be taken as those of A.U.
		<br/>
		<br/>


		</article>
	</section>
	
	<!--
	The navigation on the "about" page
	-->	
	<nav>
		<br/>
		<table>
			<tr><td><a href = "index.php" class = "normal">Home</a></td></tr>
			<tr><td><a href = "about.php" class = "normal">About</a></td></tr>
			<?php
			/*Only display some links if a user is logged in*/
			if(isset($_COOKIE["user"]) || isset($_SESSION["name"])){
				?>
				<tr>
				<td><a href = "shoppingBasket.php" class = "normal">Shopping Basket</a></td></tr>
				<tr><td><a href = "bye.php" class = "normal">Log Out</a></td>
				</tr>
				<?
			}
			?>
		</table>
	</nav>

	<!--
	Just below the navigation on the right side of the about page are links that'll help a 
	user navigate through the page easily
	-->
	<aside>
	<br/>
	<br/>
	<br/>
	<table id="anchorMenu">
	<tr><td><a href = "#design" class = "anchor">The Design</a></td></tr>
	<tr><td><a href = "#testing" class = "anchor">Testing</a></td></tr>
	<tr><td><a href = "#testplan" class = "anchor">Test Plan</a></td></tr>
	<tr><td><a href = "#browser" class = "anchor">Browser Testing</a></td></tr>
	<tr><td><a href = "#evaluation" class = "anchor">Evaluation</a></td></tr>
	<tr><td><a href = "#declaration" class = "anchor">Declaration</a></td></tr>
	<tr><td><a href = "#disclaimer" class = "anchor">Disclaimer</a></td></tr>
	</table>
	</aside>

	<!--
	The footer displays links to other pages on the website as well as the validation page.
	-->
	<footer>
		<a href= "about.php">About Us</a> | 
		<a href= "http://validator.w3.org/check?uri=http%3A%2F%2Fusers.aber.ac.uk%2Fola%2Fcs25010%2Fabout.php">Validate Page</a>
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
