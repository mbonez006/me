<?php
$f = file_get_contents('php://input');

$arr = explode('},',$f);  // Prepare for json_decode BUT last } missing
$global_arr = array(); // Contains each decoded json (TABLE ROW)
$global_keys = array(); // Contains columns for SQL
if(!function_exists('json_decode')) die('Your host does not support json');
for($i=0; $i<count($arr); $i++)
{
    $decoded = json_decode($arr[$i].'}',true); // Reappend last } or it will return NULL
    $global_arr[] = $decoded;
    foreach($decoded as $key=> $value)
    {
    $global_keys[$key] = '';
    }
}

$conn = pg_connect("host=db.dcs.aber.ac.uk port=5432 dbname=csgp16_13_14 user=admcsgp16 password=4dm5cs16gp");
// iterate $global_arr
for($i=0; $i<count($global_arr); $i++) // this is faster than foreach
{
// NOW use what ardav suggested
    foreach($global_arr[$i] as $key => $value){
    $sql[] = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '" . pg_real_escape_string($value) . "'";
    }
    $sqlclause = implode(",",$sql);
    $rs = pg_query("INSERT INTO `walks` SET $sqlclause");
}
?>