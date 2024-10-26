<?php
include('config.php');
$type=$_GET['type'];
$fd=$_GET['fd'];
if($type=="X-RAY"){

$sql="SELECT UPPER(impression) FROM  `xraymast` where type='$fd' order by type ASC";
 
}else if($type=="USG"){

$sql="SELECT UPPER(impression) FROM  `sonomast`  where type='$fd' order by type ASC";

}else if($type=="LAB")
{
$sql="SELECT UPPER(impression) FROM  `labmast`  where type='$fd' order by type ASC";
}
$result=mysql_query($sql);

$row=mysql_fetch_row($result);


echo $row[0];
?>