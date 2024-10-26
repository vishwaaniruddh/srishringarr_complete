<?php
                         
                                                         
		                                     //********************************************//                                             
		                                     //  LATITUDE AND LONGITUDE STORE IN DATABASE  //
		                                     //********************************************//
include('config.php');                                             

   $php_macAddress = $_POST['macAddress'];
   $php_latitude   = $_POST['latitude'];
   $php_longitude  = $_POST['longitude'];
   $php_uptime     = $_POST['uptime'];	
   
     //Test data  
     // $php_macAddress = "1";
     // $php_latitude   = "1234";
     // $php_longitude  = "1234";
     // $php_uptime     = "2016-1-10 18:55:11";

$response["result"] = array();


$query  = ("INSERT INTO Location (`mac_address`, `latitude`, `longitude`, `dt`) values ('".$php_macAddress."' , '".$php_latitude."' , '".$php_longitude."' ,  '".$php_uptime."')");    
//echo $query;
$query_result = mysqli_query($conn, $query);

if($query_result)
	{
	       
                $response["result"] = "success";	
		
		echo json_encode($response); 

	}       
else
        {
        	
                $response["result"] = "error";	
		
		echo json_encode($response); 
        }
           

mysqli_close($conn);       
      
?>