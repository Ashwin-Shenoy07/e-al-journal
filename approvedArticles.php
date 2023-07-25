<?php

//echo "inside php";

$mysqli=new mysqli("localhost","root","","e_al");
if($mysqli===false)
{
    echo "ERROR: Could Not Connect.".mysqli_connect_error();
}
/*$str_json = file_get_contents('php://input'); //($_POST doesn't work here)
echo $str_json;
$response = json_decode($str_json, true); // decoding received JSON to array

echo $response[0];*/
//print_r(json_decode(file_get_contents('php://input'), true));
$a =json_decode(file_get_contents('php://input'), true);
$sql = $a['myJsonString'];
//$stringarray = explode(';',$sql);
//print_r( $stringarray);
//for($i =0;$i<sizeof($stringarray)-1;$i++){
  //  $stringarray[$i].';';
    $result = $mysqli->query($sql);
//}
if($result===true){
    echo 'Success';
}
else{
    echo $mysqli->error;
}
?>