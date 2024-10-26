<?php

include('config.php');

$ref=$_GET['ref'];
$docref=$_GET['docref'];
if($ref=="df"){

       
            $qry="SELECT `CITY`, `TELNO`, `MOBILE`, `EMAIL`,`SPECIAL` FROM `doctor` WHERE `doc_id`='$docref'";
 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		if($row[1]==""){
		$phon=$row[2];
		}else{ 
		$phon=$row[1];
		}
		$str=$row[0]."#".$phon."#".$row[3]."#".$row[4];

}else if($ref=="sw"){

 $qry="SELECT `CITY`,`MOBILE`, `EMAIL` FROM   `social`  WHERE `social_id`='$docref'";
 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		
		$str=$row[0]."#".$row[1]."#".$row[2];

}else if($ref=="ng"){

 $qry="SELECT `mobile`, `city`, `email`  FROM `ngo` WHERE `ngo_id`='$docref'";
 $res=mysql_query($qry);
		$row = mysql_fetch_row($res);
		
		$str=$row[0]."#".$row[1]."#".$row[2];
}
					
echo $str;
?>