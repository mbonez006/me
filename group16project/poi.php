<?php 
error_reporting(-1);
	if(isset($_POST['id'])){
		if($_POST['id']!=null){
			$tmp_id=$_POST['id'];
			echo $tmp_id;
			$_session["id"]=$tmp_id;
			echo $_session["id"];
			header('location:./poi.php');
		}
	}
?>
 
<script type="text/javascript">

 function next_image() { 
  if (slideshow.checked==false)
  {
    if (num<image.length)
    {
       num++
       //if last image is reached,display the first image
       if (num==image.length) 
       num=0
       image_effects()
        //set the SRC attribute to let the browser load the preloaded images 
       document.images.slideShow.src=image[num]   
    }
  } 
}

function previous_image()
{  
  //code to execute only when the automatic slideshow is disabled 
   if (slideshow.checked==false)
   {
    if (num>0)
    {
       num--
       image_effects()
       //set the SRC attribute to let the browser load the preloaded images 
       document.images.slideShow.src=image[num] 
     }
    if (num==0)
    {  //if first image is displayed
       num=image.length
       num--
       image_effects()
       document.images.slideShow.src=image[num] 
    } 
  }  
}


</script>

 
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"/> 
</head>
<body>

<div class="poilist" Style="float:right height:90% width:25% background-color:#000">

</div>
<?php $_session['poi']=
array(
'longitude' => '-4.78354',
'latitude' => '52.368549',
'Description' => 'Aberystwyth (Mouth of the Ystwyth) ,is a historic market town,
 administrative centre and holiday resort within Ceredigion, West Wales.
 Often colloquially known as Aber, it is located near the 
 confluence of the rivers Ystwyth and Rheidol.',
 'imageid' => 1
);
?>
<div id="container">
	<header>
		<img src = "images/banner.jpg" alt= "Banner" width="850px" height="250px"/>
		<br/>
	</header>
</div>

<div id='walklist'>
<form action="">	
<input type="button" name="previous" value="Previous Image" onclick="previous_image()" />


<img src="images/aber_falls_walk_falls_2.jpg" width="400" height="300" />


<input type="button" name="next" value="Next Image" onclick="next_image()" />
</form>
<br/>

<?php
echo "
<a> {$_session['poi']['latitude']} </a>;
<a> {$_session['poi']['longitude']} </a>
<p> {$_session['poi']['Description']} </p>";

?>
</div>
</body>
</html>