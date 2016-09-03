<?
			
	/*Function to get the manufacturer of a phone from a database*/		
	function get_phone_manuf($product_ref){
		$res = pg_query("SELECT manufacturer FROM phones WHERE ref = $product_ref");
		$row = pg_fetch_array($res);
		return $row['manufacturer'];
	}
	
	/*Function to get the model of a phone from a database*/	
	function get_phone_model($product_ref){
		$res = pg_query("SELECT model FROM phones WHERE ref = $product_ref");
		$row = pg_fetch_array($res);
		return $row['model'];
	}
	
	/*Function to get the price of a phone from a database*/	
	function get_phone_price($product_ref){
		$res = pg_query("SELECT price FROM phones WHERE ref = $product_ref");
		$row = pg_fetch_array($res);
		return $row['price'];
	}
	
	/*Function to remove a given product from the shopping cart*/	
	function remove_product($product_ref){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($product_ref == $_SESSION['cart'][$i]){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}
	
	/*Function to calculate the total amout of all the product in the cart*/
	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0; $i<$max; $i++){
			$product_ref = $_SESSION['cart'][$i];
			$price = get_phone_price($product_ref);
			$sum += $price;
		}
		return $sum;
	}
	
	/*Function to add to cart*/
	function addtocart($product_ref){		
		if(is_array($_SESSION['cart'])){
		//	if(product_exists($product_ref)) return;
			
			$max=count($_SESSION['cart']);
			$_SESSION['cart'][$max] = $product_ref;
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0] = $product_ref;
		}
	}
	
	/*Function to check if a product exists, that is, if it has been recorded or stored previously*/	
	function product_exists($product_ref){
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0; $i < $max; $i++){
			if($product_ref == $_SESSION['cart'][$i]){
				$flag = 1;
				break;
			}
		}
		return $flag;
	}

	$viewmonth=date("n");
	if (($viewmonth==12)||($viewmonth<7))
	{
	if (isset($_POST["viewsource"])) {echo"<hr />";highlight_file(__FILE__);}
	else echo('<form action="' . $_SERVER["PHP_SELF"] . '" method="post">
	<p><input type="submit" name="viewsource" value="View source"/></p></form>');
	}
?>
