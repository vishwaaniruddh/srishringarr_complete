<?php

include 'config.php';
$str="";
       
	   if(isset($_GET['searchby']) && isset($_GET['letters'])){
	             $contact=$_GET['searchby'];
                 $ar = $_GET['letters'];
				 
				 if($contact=='contact'){
                 $qry="select * from new_patient where contact like('" . $ar . "%')";
				 $res=mysqli_query($con,$qry);
				 while($suggest = mysqli_fetch_array($res, MYSQL_ASSOC)) {
		//Return each page title seperated by a newline.
		
		$str=$str.$suggest["contact"]."###".$suggest["contact"]."|";			
	}
	echo $str;
	}
				 else
				 {
				 $qry="select * from new_patient where fname like('" . $ar . "%')";
                 $res=mysqli_query($con,$qry);    
				 while($suggest = mysqli_fetch_array($res, MYSQL_ASSOC)) {
		//Return each page title seperated by a newline.		
		$str=$str.$suggest["fname"]."###".$suggest["fname"]."|";

				 }
				 echo $str;
	}            
             

	
     }

?>