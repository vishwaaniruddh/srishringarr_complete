<?php

include 'config.php';

//$ref=$_GET['ref'];
$proc=$_GET['proc'];

   
            $qry="SELECT * FROM `procedures` WHERE `id`='$proc'";
 $res=mysqli_query($con,$qry);
		$row = mysqli_fetch_row($res);
		$total=$row[3];
		
		$str=$total."#".$row[0];


					
echo $str;
?>