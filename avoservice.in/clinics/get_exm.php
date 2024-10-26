<?php

include('config.php');
$exm=$_GET['exm'];

       
            $qry="SELECT * FROM `templa` where name='$exm'";
		 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		$s="";
		$v="";
		$str=$row[1]."#".$row[2]."#".$s."#".$v;			
echo $str;
?>