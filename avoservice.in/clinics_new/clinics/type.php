<?php
include 'config.php';
$type=$_GET['type'];
if($type=="X-RAY"){

$sql="SELECT type FROM  `xraymast` order by type ASC";
 
}else if($type=="USG"){

$sql="SELECT type FROM  `sonomast` order by type ASC";

}else if($type=="LAB")
{
$sql="SELECT type FROM  `labmast`order by type ASC";
}
$result=mysqli_query($con,$sql);
$out="";
$out=$out."<select name='report' id='report'  style='width:350px;' onchange='finding1();'>";
while($row=mysqli_fetch_row($result)){

$out=$out."<option value='$row[0]'>$row[0]</option>";

}
$out=$out."</select>";

echo $out;
?>