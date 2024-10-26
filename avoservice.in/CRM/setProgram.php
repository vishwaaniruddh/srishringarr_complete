<?php
include ('config.php');

$data=array();
$sql="select * from Program";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['Progam_name'=>$row['Progam_name'],'Program_ID'=>$row['Program_ID']];
}
echo json_encode($data);
?>