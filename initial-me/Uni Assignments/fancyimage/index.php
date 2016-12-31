<?php
session_start();
$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=csgp16_13_14 user=admcsgp16 password=4dm5cs16gp");
$poi=1;
					$res = pg_query("SELECT * FROM place WHERE place.id='$poi'");
					  while ($a =pg_fetch_array($res)){
							  $name=$a['name'];
							  $desc=$a['description'];
						}
							 
					$res = pg_query("SELECT photoname FROM photos WHERE placeid='$poi'");
					
					$pname = array();
					$i = 0;
					
					while ($a = pg_fetch_array($res)){
						$pname[$i]= $a['photoname'];
						$i++;
					}
					
			pg_close($conn);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
        <link rel="icon" 
      type="image/png" 
      href="http://users.aber.ac.uk/dtg1/group/plogo.gif"> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="style.css">
		<title>Walking Tour Displayer </title>
		
		<script language="JavaScript1.2">
	
var howOften = 5; //number often in seconds to rotate
var current = 0; //start the counter at 0
var ns6 = document.getElementById&&!document.all; //detect netscape 6

// place your images, text, etc in the array elements here
var items = new Array();
	
for(i=0; i <= <?echo $i?>; i++){
	j = i+1;
	items[i]="<a href='#'><img alt='pic"+j+".jpg' src='https://dl.dropboxusercontent.com/u/16566918/images/pic"+j+".jpg' height='300' width='300' border='0' /></a>"; //a linked image
}
	
function rotater() {
    document.getElementById("placeholder").innerHTML = items[current];
    current = (current==items.length-1) ? 0 : current + 1;
    setTimeout("rotater()",howOften*1000);
}

function rotater() {
    if(document.layers) {
        document.placeholderlayer.document.write(items[current]);
        document.placeholderlayer.document.close();
    }
    if(ns6)document.getElementById("placeholderdiv").innerHTML=items[current]
        if(document.all)
            placeholderdiv.innerHTML=items[current];

    current = (current==items.length-1) ? 0 : current + 1; //increment or reset
    setTimeout("rotater()",howOften*1000);
}

window.onload=rotater;
</script>		
</head>

<body>


		
		
			<div id="pi" class="allcurlyshadow">
			<layer id="placeholderlayer"></layer><div id="placeholderdiv"></div>
			</div>
			</div><!--end content -->
	




		
		<!--end contentwrap -->
	
		<footer>
		</footer>
















</div><!--end wrap -->
</body>

</html> 





