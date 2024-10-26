<?php
include('config.php');
////update hospital data
$hos=mysql_query("select * from doctor");
while($hos1=mysql_fetch_row($hos)){
	
               
  mysql_query("update patient set ref='".$hos1[0]."' where ref='".$hos1[1]."'");              
                } ?>