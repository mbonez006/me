<?php
$data = file_get_contents('php://input');

$json = json_decode($data,true);
$stringData=$json."\n";
logMethod4Connections();
echo $json;
 
// Whats missing the list

//image conversion
//general type conversion
//final calculation conversions
//double checking the file_get_contents('php://input')
//looping through all points of interest and places and images.


$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=csgp16_13_14 user=admcsgp16 password=4dm5cs16gp");

//walks
//pg_query($conn,"INSERT INTO walks (title, shortdesc, longdesc, hours, distance)
//VALUES('womblewalk', 'wombling around', 'a super wombly day yay recycling and walking in a cleaner enviroment', '06.37', '4.22')");

// this stops all the data sending if some of it fails so no unlinked pieces get added.
beginTransaction();

pg_query($conn,"INSERT INTO walks VALUES
bindParam( :title , $json['title'];)
bindParam( :shortDesc, $json['shortDesc'])
bindParam( :longDesc, json['longDesc'])
bindParam( :hours,json['hours'] )
bindParam( :distance, json['distance'] )");
//get the last id
$theid = getnewid('walks');
echo $theid;

$size=count(json['POIs']);
for($index=0;$index<$size;$index++){
pg_query($conn, "INSERT INTO locations VALUES //locations
//bindParam ( :walkid , $theid )
//bindParam ( :latitude , json['POIs']['latitude'] )
//bindParam ( :longitude , json['POIs']['latitude'] )
//bindParam ( :timestamp , json['POIs']['timestamp'] )");
}
//get the last id
$theid = getnewid('locations');
echo $theid;

//queryString = INSERT INTO place VALUES

//place
//bindParam ( :locationid , $theid)
//if(name!=null||description!=null){
//
//}
//bindParam ( :name ,json['POIs']['name'] )
//bindParam ( :description ,json['POIs']['description'] )
$theid = getnewid('place');
echo $theid;

//queryString = INSERT INTO photos VALUES

//photos
//bindParam ( :placeid , $theid)
//bindParam ( :photoname , json['POIs']['images']['photoname'] )
$theid = getnewid('images');
echo $theid;

//exceute()

/*JSONParser parser = new JSONParser();
  KeyFinder finder = new KeyFinder();
  finder.setMatchKey("hours");
  try{
    while(!finder.isEnd()){
      parser.parse($json, finder, true);
      if(finder.isFound()){
        finder.setFound(false);
        System.out.println("found id:");
        System.out.println(finder.getValue());
      }
    }           
  }
  catch(ParseException pe){
    pe.printStackTrace();
  }
*/
//location
//$locationId= INSERT INTO place  VALUES
    //( '$walkId', 110,'19.850210','Comedy'),
    //( '$walkId', 140, 4.000543, 'Comedy');

//place
//$placeid INSERT INTO films (id, locationId, did,) VALUES
    //('B6717', 'Tampopo', 110,),
//('HG120', 'The Dinner Game', 140,);

//images
/*
INSERT INTO table [ ( column [, ...] ) ]
{ DEFAULT VALUES | VALUES ( { expression | DEFAULT } [, ...] ) [, ...] | query }
[ RETURNING * | output_expression [ [ AS ] output_name ] [, ...] ]*/

$stringData=" \n New set of Testing:Conversion \n";
logMethod4Connections();

function logMethod4Connections(){

$myFile = "hCTests.txt";
$fh = fopen($myFile, 'a') or die("can't open file");

$stringData1 = date("d/m/Y g.i a")."\n";
fwrite($fh, $stringData1);
//$stringData = "\nEnd of Testing\n";

fwrite($fh, $stringData);
fclose($fh);
}


function convert2Int($string){
$int= (int) $string;
}

function convert2float($string){
$float= (float) $string;
}

function getnewid ($table){
return pg_result(pg_query("SELECT MAX('$table'.id) FROM '$table'"));
}

?>
