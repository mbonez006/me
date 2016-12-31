<?php
/*The purpose of this page is to display all the walks in the database that the viewer can view. The page is a menu of walk options.
This page only shows limited information about each of the walks their title, distance and time they take (shortdesc optional) 
with a button to redirect to the walks specific information*/

//error_reporting(-1);

//attempt at fixing the session
include 'init.php';

// catches the id and changes the walkId to the post[id]
// the post id is gotten from the for loop index of the hidden input
if(isset($_POST['id'])){
	if($_POST['id']!=null){
		$tmp_id=$_POST['id'];
		//check to see what the id is for matching with the below echo
		echo $tmp_id;
		$_session["walkId"]=$tmp_id;
		//check that walkId has changed can only been seen if the redirect is commented out off the onsubmit method call.
		echo $_session["walkId"];
		//redirects user to the walk page
		header('location:./walk.php');
	}
}

//highlight_file('walklistcontent.php');

/* //not used here
function change2POIphp($value){
$_session["poiId"]=$value;
header('location:./poi.php');
}*/

?>
<?php
//sets up the session walkId if its not previously been set
if(!(isset($_session['walkId']))){
$_session['walkId']=0;
}

//sets up the session poiId if its not previously been set
if(!(isset($_session['poiId']))){
$_session['poiId']=0;
}

//sets up the session db if its not previously been set
if(!(isset($_session['db']))){
//dummy data start
$_session['db']=
array(
'walk'=> array(
array(
'title' => 'Aber walk',
'shortDesc'=> 'Aber walk is a small walk example for testing',
'hours' => '0.15hrs',
'distance' => '0.019km',
),
array(
'title' => 'Bangor walk',
'shortDesc' => 'Bangor walk is a small walk example for testing',
'hours' => '0:28hrs',
'distance' => '0.049km',
)
)
);
//dummy data end
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="style.css" />
		<title>View Walk List</title>
</head>

<body>
	<div id="container">
		<header>
			<img src = "images/banner.jpg" alt= "Banner" width="850px" height="250px"/>
			<br/>
		</header>

		<section id = "pageDescription">		

		
<?php
//find the size of the walk array $_db['walk']’s size
$dbSize = count($_session['db']['walk']);

//For loop going upto the size of the walk array ^ and have the $id variable as the index
//http://www.w3schools.com/php/php_looping_for.asp
for ($id=0; $id<$dbSize; $id++)
  {
?>

<form action='walklistcontent.php' method='post' onSubmit='change2Walk(<?php echo $id; ?>)'>
<?php
//php prints out each walk iteminfo with a button that links to walk.php using the id variable from the for loop
echo "<a>{$_session['db']['walk'][$id]['title']}</a>
<a style='margin-left:20px'>{$_session['db']['walk'][$id]['shortDesc']}</a> 
<a style='margin-left:20px'>{$_session['db']['walk'][$id]['hours']}</a>
<a style='margin-left:20px'>{$_session['db']['walk'][$id]['distance']}</a>";
?>
<!-- input goes to post[id] -->
<input type='hidden' name='id' value='<?php echo $id; ?>'/>
<button value='<?php echo $id; ?>' > View Walk </button>
</form>
<?php
}
//highlight_file('walkinglistcontent.php');
?>


		</section>
</body>
</html>