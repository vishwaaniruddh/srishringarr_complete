<?php
include ('config.php');
//echo $materialid;
$state=$_POST['state'];
$data=array();
$sql="select * from cities where state_id='".$state."'";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['modelno'=>$row['city'],'ids'=>$row['city']];
}
echo json_encode($data);
?>