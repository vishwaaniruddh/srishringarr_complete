<?php
include 'config.php';
$type=$_GET['type'];
$fd=$_GET['fd'];
if($type=="X-RAY"){

$sql="SELECT impression FROM  `xraymast` where type='$fd' order by type ASC";
 
}else if($type=="USG"){

$sql="SELECT impression FROM  `sonomast`  where type='$fd' order by type ASC";

}else if($type=="LAB")
{
$sql="SELECT impression FROM  `labmast`  where type='$fd' order by type ASC";
}
$result=mysqli_query($con,$sql);

$row=mysqli_fetch_row($result);


echo $row[0];
?>