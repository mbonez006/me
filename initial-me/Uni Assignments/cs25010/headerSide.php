<br />
<?php

/*Check if there's already been a session array called cart, if there is,
then count and save the total number of elements in that array, else, set the amount to 0*/
if(is_array($_SESSION['cart'])){
	$max=count($_SESSION['cart']);
}
else if($max == 0){
	$max = 0;
}

/*If a user is loggen in, then display a link to the shopping basket page which also 
displays on its side the amount of product that the user has added to cart*/
if(isset($_COOKIE["user"]) || isset($_SESSION["name"])){
	echo "<a href='shoppingBasket.php'><img src = 'images/basket.jpg' alt='basket' width='20' height='20'/>
	Basket ($max)</a> <br/>";
}
else{
	?>
	<a href="shoppingBasket.php"><img src = "images/basket.jpg" alt="basket" width="22" height="22"/>
	 Basket</a> <br/>
	<?
}

/*If a user is logged in, greet the user with a display of the user's name*/
if (isset($_COOKIE["user"])){
	echo "<a href='#'>Hi, " . $_COOKIE["user"] . "!</a><br>";
}
elseif (isset($_SESSION["name"]))
	echo "<a href='#'>Hi, " . $_SESSION["name"] . "!</a><br>";
elseif(isset($_COOKIE["user"]))
	echo "<a href='#'>Hi, " . $_COOKIE["user"] . "!</a><br>";
?>

