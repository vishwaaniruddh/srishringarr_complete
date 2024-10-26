<?php
include 'config.php';
////update hospital data
$hos=mysqli_query($con,"select * from doctor");
while($hos1=mysqli_fetch_row($hos)){
	
               
  mysqli_query($con,"update patient set ref='".$hos1[0]."' where ref='".$hos1[1]."'");              
                } ?>