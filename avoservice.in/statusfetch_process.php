<?php

include 'config.php';
$comment=$_POST['comments'];
$check=$_POST['check'];
$nums=$_POST['BRF_id'];


//date_default_timezone_set('Asia/Kolkata');
//$dates = date('Y-m-d H:i:s');
//echo "hello".$nums;
$result3=mysqli_query($con1,"select * from UpdateStatus where brf_id='$nums' order by currentdate desc ");
$Num_Rows=mysqli_num_rows($result3);
$array = array();
while($row6=mysqli_fetch_assoc($result3))
{
$array[] = $row6;

 /*$result[] = array(
                            "currentdate"=>$row6['currentdate'],
                            "comments"=>$row6['comments'],
                            "status"=>$row6['status']
                            );
*/


//echo $row6['currentdate']."@#".$row6['comments']."@#".$row6['status'];
}


//echo json_encode(array("result"=>$result));

//echo $row['currentdate']."@#".$row['comments']."@#".$row['currentdate'];
//print_r($array);


$myJSON = json_encode($array);

echo $myJSON;
/*

$myArr = array("John", "Mary", "Peter", "Sally");

$myJSON = json_encode($array);

echo $myJSON;
*/

?>