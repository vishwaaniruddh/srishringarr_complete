<?php
include ('config.php');
//echo $materialid;
$value=$_POST['value'];


$data=array();
$sql="select * from P where $Column='".$value."'";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['ids'=>$row[$id],'name'=>$row[$name]];
}
echo json_encode($data);
?>