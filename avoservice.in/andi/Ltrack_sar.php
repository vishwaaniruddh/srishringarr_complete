<?php
                         
                                                         
		                                     //********************************************//                                             
		                                     //  LATITUDE AND LONGITUDE STORE IN DATABASE  //
		                                     //********************************************//
include('config.php');                                             

   $php_macAddress = $_GET['macAddress'];
   $php_latitude   = $_GET['latitude'];
   $php_longitude  = $_GET['longitude'];
   $address=$_GET['address'];
   $php_uptime     = date("Y-m-d H:i:s"); //$_POST['uptime'];	
   
     //Test data  
     // $php_macAddress = "1";
     // $php_latitude   = "1234";
     // $php_longitude  = "1234";
     // $php_uptime     = "2016-1-10 18:55:11";

$response["result"] = array();


//$query  = ("INSERT INTO Location (`mac_address`, `latitude`, `longitude`, `dt`) values ('".$php_macAddress."' , '".$php_latitude."' , '".$php_longitude."' ,  '".$php_uptime."')");    
$query  = ("INSERT INTO Location_sar (`mac_address`, `latitude`, `longitude`, `dt`,address) values ('".$php_macAddress."' , '".$php_latitude."' , '".$php_longitude."' ,  '".$php_uptime."','".$address."')");    
//echo $query;
$query_result = mysqli_query($conn, $query);

if($query_result)
	{
	       
                $response["result"] = "success";	
		
		echo "success";//json_encode($response); 

	}       
else
        {
        	
                $response["result"] = "error";	
		
		echo "error";//json_encode($response); 
        }
           

mysqli_close($conn);       
      
?>