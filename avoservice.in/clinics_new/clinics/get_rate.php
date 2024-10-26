<?php

include 'config.php';

//$ref=$_GET['ref'];
$other_proc=$_GET['other_proc'];
//if($ref=="df"){

       
            $qry="SELECT `rate` FROM `other_charges` WHERE `id`='$other_proc'";
 $res=mysqli_query($con,$qry);
		$row = mysqli_fetch_row($res);
		
		$str=$row[0]."#";


					
echo $str;
?>