<?php
session_start() ;
include("../config.php");

//$username='Kerala1894';
//$password='Kerala1894123';

error_reporting(E_ALL);

function storeUser($username,$password,$con1) 	{
 
    $qry = mysqli_query($con1, "select * from login where username='".$username."' and password='".$password."' and status=1 ");

if(mysqli_num_rows($qry)==1) {
	$row=mysqli_fetch_row($qry);
	
if($row[4]==7 && $row[3] !='' or $row[3] !=0) {
	  
     return true;
              }
         else {
                 return false;
              }                
} else 
 return false;
} 


if (isset($_POST["username"]) && isset($_POST["password"])) {

    $username= trim($_POST["username"]); // GCM Registration ID
    $password= trim($_POST["password"]);
    
    $res = storeUser($username,$password, $con1);
     
    echo json_encode($res);
    
    
} else {
     echo "false";
}

?>