<?php

include('config.php');
$exm=$_GET['exm1'];

       
            $qry="select * from templa1 where heading='$exm'";
		 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		
	
		$str=$row[1]."#".$row[2]."#".$row[4]."#".$row[7];			
echo $str;
?>