<?php
include("../config.php");
include_once 'GCM.php';
 
$response["result"] = array();

$query  = "select * from problemtype";
$result = mysql_query($query);
$numres = mysql_num_rows($result);

if($numres>0)
         {

	    while ($row = mysql_fetch_array($result))

	      {
	        $tmp = array(); 
 
	        $tmp["json_probid"]  = $row[0]; 	 
 		$tmp["json_problem"] = $row[1]; 	 
		$tmp["json_type"]    = $row[2]; 	 
		
		array_push($response["result"], $tmp);

              }
                echo json_encode($response); 

         }     

else
	{
	        $response["result"] = "error";	
	        echo json_encode($response); 
        }   
        
 
?>