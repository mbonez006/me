<div style="background-color:rgb(255,255,255)" height=200px width=300px overflow=auto;>
<?php
$_session['db']=
array(
walkId=>'0',
poiId=>'0',
walk=> array(
array(
title => 'Aber walk',
shortDesc => 'Aber walk is a small walk example for testing',
longDesc => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse non dui est. In et risus sed lectus faucibus rhoncus eget at leo.
 Nullam vitae magna risus. Suspendisse vehicula nec erat at vulputate. Mauris sem leo, gravida non venenatis ut, pulvinar nec purus. Morbi eros enim,
 condimentum sollicitudin dui fringilla, laoreet sagittis orci. Morbi dictum nisi sodales, ultrices lectus a, hendrerit ligula.
 Pellentesque dictum neque sed malesuada rutrum. Maecenas tortor tortor, pulvinar in facilisis ac, bibendum sit amet augue.
 Ut non tristique mi, nec congue mi. Ut euismod augue nec sapien eleifend, id pharetra dui mattis. Morbi eget nisi porta, accumsan.',
hours => '0.15hrs',
distance => '0.019km'
poi => array(
array(
longitude=>'-4.00',
lattitude=>'52.2348572',
timeStamp=>'0.33',
description=> 'point of interest one of walk one in aber';
),
array(
longitude=>'-4.00',
lattitude=>'52.2344872',
timeStamp=>'0.41',
description=> 'point of interest two of walk one in aber';
)
);
),
array(
title => 'Bangor walk',
shortDesc => 'Bangor walk is a small walk example for testing',
longDesc => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse non dui est. In et risus sed lectus faucibus rhoncus eget at leo.
 Nullam vitae magna risus. Suspendisse vehicula nec erat at vulputate. Mauris sem leo, gravida non venenatis ut, pulvinar nec purus. Morbi eros enim,
 condimentum sollicitudin dui fringilla, laoreet sagittis orci. Morbi dictum nisi sodales, ultrices lectus a, hendrerit ligula.
 Pellentesque dictum neque sed malesuada rutrum. Maecenas tortor tortor, pulvinar in facilisis ac, bibendum sit amet augue.
 Ut non tristique mi, nec congue mi. Ut euismod augue nec sapien eleifend, id pharetra dui mattis. Morbi eget nisi porta, accumsan.',
hours => '0:28hrs',
distance => '0.049km'
poi =>array(
array(
longitude=>'-4.12',
lattitude=>'53.22739',
timeStamp=>'0.33',
description=> 'point of interest one of walk two in bangor';
),
array(
longitude=>'-4.12',
lattitude=>'53.227872',
timeStamp=>'0.41',
description=> 'point of interest two of walk two in bangor';
)
)
)
)
);

//find the size of the walk array $_db['walk']’s size
$dbSize = count($_session['db']['walk'][$_session['db']['walkId']]['poi']);

//For loop going upto the size of the walk array ^ and have the $id variable as the index
//http://www.w3schools.com/php/php_looping_for.asp

for ($id=0; $id<$dbSize; $id++){
echo "
<div class=’walkItem’ height=100% width=100%>
<a>{$_session['db']['walk'][$_session['db']['walkId']]['poi'][$id]['longitude']}</a>
<a>{$_session['db']['walk'][$_session['db']['walkId']]['poi'][$id]['lattitude']}</a>
<a>{$_session['db']['walk'][$_session['db']['walkId']]['poi'][$id]['timeStamp']}</a>
<a>{$_session['db']['walk'][$_session['db']['walkId']]['poi'][$id]['description']}</a>
<form onSubmit='change2Walk({$id})'>
<button type='submit' style='margin-left:35%;’ class='greenButton' value=’{$id}’> View Walk </button>
</form>
</div> ";
}
highlight_file('poilistcontent.php');
?>
</div>