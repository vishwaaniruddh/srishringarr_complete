<?php
ini_set( "display_errors", 0);

$con = mysql_connect("localhost","satyavan_sunrise","sunrise123*");
mysql_select_db("satyavan_sunrise",$con);

	
		 $search=$_GET['letters'];
         if($search){ 
       
        	$qry="SELECT name,item_number FROM  `phppos_items` where name like ('".$search."%') order by name ASC ";
        

$res=mysql_query($qry);   
while($suggest = mysql_fetch_array($res, MYSQL_ASSOC))
 {
		//Return each page title seperated by a newline.
		//echo $suggest["letters"]."|";
		echo $suggest["item_number"]."###".$suggest['name'] . "|";
 }
                    }             
				 
?>
