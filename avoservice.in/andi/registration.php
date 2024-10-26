<?php
/**
 * Database config variables
 */
 $conn = mysqli_connect("localhost" , "avoservi_avo" , "Myaccounts123*" , "avoservi_service");
 date_default_timezone_set('Asia/Kolkata');
define("DB_HOST", "localhost");
define("DB_USER", "avoservi_avo");
define("DB_PASSWORD", "Myaccounts123*");
define("DB_DATABASE", "avoservi_service");
date_default_timezone_set('Asia/Kolkata');
$con = mysql_connect("localhost","avoservi_avo","Myaccounts123*");
mysql_select_db("avoservi_service",$con);

/*mysql_query("SET NAMES UTF8;");
define("GOOGLE_API_KEY", "AIzaSyAySemt7rQA6rcnIKf_101x1LddTU98Pg8");
error_reporting(0);*/

$uname=$_POST['name'];
$email=$_POST['email'];
$pwd=$_POST['password'];

$qry=mysqli_query($conn,"insert into registration(uname,email,password) values('".$uname."','".$email."','".$pwd."')");

$myObj = (object)array();
if($qry){
    $myObj->success = "1";

$myJSON = json_encode($myObj);
echo $myJSON;
}
else{
    $myObj->success = "0";

$myJSON = json_encode($myObj);
echo $myJSON;
}
?>