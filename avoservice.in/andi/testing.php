<?php
                         
                                                         
		                                     //********************************************//                                             
		                                     //  LATITUDE AND LONGITUDE STORE IN DATABASE  //
		                                     //********************************************//
include('config.php');                                             

   $php_macAddress = $_REQUEST['macAddress'];
   $php_latitude   = $_REQUEST['latitude'];
   $php_longitude  = $_REQUEST['longitude'];
  // if(isset($_GET['address']))
  // $php_address  = $_GET['address'];
   $php_uptime     = date("Y-m-d H:i:s"); //$_POST['uptime'];	
   
     //Test data  
     $php_macAddress = 'cb1bbd47cd4ce4d8';
      $php_latitude   = "1234";
      $php_longitude  = "1234";
    //  $php_uptime     = "2016-1-10 18:55:11";
    $php_address="Address check";

$response["result"] = array();
$q="select pid from notification_tble where mac_id='".$php_macAddress."'";
    $result = mysqli_query($conn,$q);
    $row=mysqli_fetch_row($result);
    $engg_id=$row[0];

//$query  = ("INSERT INTO Location (`mac_address`, `latitude`, `longitude`, `dt`) values ('".$php_macAddress."' , '".$php_latitude."' , '".$php_longitude."' ,  '".$php_uptime."')");    
if(isset($_REQUEST['address'])){
    if($_SERVER['REQUEST_METHOD']==='GET')
    $php_address  = $_REQUEST['address'];
    else if($_SERVER['REQUEST_METHOD']==='POST')
    $php_address  = urldecode($_REQUEST['address']);
    
$query  = ("INSERT INTO Location (`mac_address`, `latitude`, `longitude`, `dt`,`address`,`engg_id`) values ('".$php_macAddress."' , '".$php_latitude."' , '".$php_longitude."' ,  '".$php_uptime."','".$php_address."','".$engg_id."')");    
}
else
$query  = ("INSERT INTO Location (`mac_address`, `latitude`, `longitude`, `dt`,`address`,`engg_id`) values ('".$php_macAddress."' , '".$php_latitude."' , '".$php_longitude."' ,  '".$php_uptime."','','".$engg_id."')");    

echo $query;

$query_result = mysqli_query($conn, $query);


$qry="update engg_current_location set latitude='".$php_latitude."', longitude='".$php_longitude."', last_updated='".$php_uptime."' where engg_id='".$engg_id."'";

mysqli_query($conn,$qry);

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