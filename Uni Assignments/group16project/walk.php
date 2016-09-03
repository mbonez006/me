<?php 
/*The purpose of this page is to display the specific walk information in the database and a menu of all the points of interest in that walk. 
The page is complete overview of a walk and displays links to its points of interest.
This page only shows detailed information about a specific walk its title, distance and time the walk takes to complete.
the page includes a map of the entire walk and A long and short description of the walk.
with a menu of points of interest within the specific walk*/

//error_reporting(-1);

//attempt at fixing the session
include 'init.php';

// catches the id and changes the poiId to the post[id]
// the post id is gotten from the for loop index of the hidden input
if(isset($_POST['id'])){
	if($_POST['id']!=null){
		$tmp_id=$_POST['id'];
		//check to see what the id is for matching with the below echo
		echo $tmp_id;
		$_session["id"]=$tmp_id;
		//check that walkId has changed can only been seen if the redirect is commented out off the onsubmit method call.
		echo $_session["id"];
		//redirects user to the poi page
		header('location:./poi.php');
	}
}?>
 
<?php
 //sets up the session walkId if its not previously been set
if(!(isset($_session['walkId']))){
$_session['walkId']=0;
}

//sets up the session poiId if its not previously been set
if(!(isset($_session['poiId']))){
$_session['poiId']=0;
}
?>
 
 <?php
//dummy data start
$_session['db']=
array(
'walk'=> array(
array(
'title' => 'Aber walk',
'shortDesc'=> 'Aber walk is a small walk example for testing',
'longDesc' => 'Aberystwyth (Mouth of the Ystwyth) ,is a historic market town,
 administrative centre and holiday resort within Ceredigion, West Wales.
 Often colloquially known as Aber, it is located near the 
 confluence of the rivers Ystwyth and Rheidol.',
'hours' => '0.15hrs',
'distance' => '0.019km',
'poiCount'=>4
),
array(
'title' => 'Bangor walk',
'shortDesc' => 'Bangor walk is a small walk example for testing',
'longDesc' => 'Bangor is a city in Gwynedd unitary authority, north west Wales,
 and one of the smallest cities in Britain. Historically in Caernarfonshire,
 it is a university city with a population of 13,725 at the 2001 census,
 not including around 10,000 students at Bangor University.
 It is one of only six places classed as a city in Wales, although it is only the 36th largest
 urban area by population.',
'hours' => '0:28hrs',
'distance' => '0.049km',
'poiCount'=>2
)
)
);
//dummy data end
?>
 
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/> 
</head>
<body>

<div id="container">
	<header>
		<img src = "images/banner.jpg" alt= "Banner" width="850px" height="250px"/>
		<br/>
	</header>
</div>

<!--Left hand container holds specific walk info-->
<div id="walkinfo">
<?php
echo"<h3> {$_session['db']['walk'][$_session['walkId']]['title']}</h3>"
?>
<div class="map">
<!--Temporary (Katies back up if jacks better map fails.) Requires updating with relevant points meaning this page needs access to the point of interest longitudes and latitudes-->
<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
src="https://maps.google.co.uk/maps?q=from:56.01,-4.02+to:55.413991,-4.058332+to:55.412891,-4.058332+to:52.41755,-4.065635&amp;saddr=56.01,-4.02&amp;daddr=55.413991,-4.058332+to:55.412891,-4.058332+to:52.41755,-4.065635&amp;ie=UTF8&amp;t=m&amp;geocode=FRClVgMd4KjC_w%3BFeeMTQMdJBPC_w%3BFZuITQMdJBPC_w%3BFQ7UHwMdnfbB_w&amp;z=7&amp;output=embed">
</iframe>
</div>
<br/>
<br/>
<br/>
<br/><br/>
<?php
//first para used for testing remove once session works.
echo"
<p>Testing: Walk Id " . $_session['walkId'] + 1 . "</p>

<a>{$_session['db']['walk'][$_session['walkId']]['hours']}</a>
<a style='margin-left:20px'>{$_session['db']['walk'][$_session['walkId']]['distance']}</a>
<p>{$_session['db']['walk'][$_session['walkId']]['shortDesc']}</p>
<p>{$_session['db']['walk'][$_session['walkId']]['longDesc']}</p>"; ?>
</div>
<!--Right hand container holds poi menu for this walk-->
<div id="poilist">
<?php
//find the size of the walk array $_db['walk']’s size
$dbSize = $_session['db']['walk'][$_session['walkId']]['poiCount'];

//For loop going upto the size of the poi count ^ and have the $id variable as the index
//http://www.w3schools.com/php/php_looping_for.asp

for ($id=0; $id<$dbSize; $id++){
//buttons to redirect the user to the poi page and change the session variable poiIndex
?>
<form class="poiform" action='walk.php' method='post' >
<input type='hidden' name='id' value='<?php echo $id;?>' />
<button value=’<?php echo $id;?>’> View Point <?php echo $id;?> </button>
</form>
<?php
}
?>
</div>

<!-- not used was for code testing and map testing -->
<?php
//echo "{$_session['db']['walkId']} timmy";

function getlongitude($walkvalue,$poivalue){
return $_session['db']['walk'][$walkvalue]['poi'][$poivalue]['Longitude'];
}

function getlattitude($walkvalue,$poivalue){
return $_SESSION['db']['walk'][$walkvalue]['poi'][$poivalue]['Lattitude'];
}

?>

</body>
</html>