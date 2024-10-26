<?php
session_start();
include('config.php');
$value=$_POST['material'];
//echo $value;
if($value=="ups"){
$data=array();
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='1'");
while($row=mysqli_fetch_row($qry1)){

$data[]=['modelno'=>$row[2],'ids'=>$row[0]];
}
echo json_encode($data);
}

if($value=="Battery"){
$data=array();
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='2'");
while($row=mysqli_fetch_row($qry1)){
$data[]=['modelno'=>$row[2],'ids'=>$row[0]];
}
echo json_encode($data);
}

if($value=="Isolation"){
$data=array();
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='8'");
while($row=mysqli_fetch_row($qry1)){
$data[]=['modelno'=>$row[2],'ids'=>$row[0]];
}
echo json_encode($data);
}

if($value=="Stabilizer"){
$data=array();
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='7'");
while($row=mysqli_fetch_row($qry1)){
$data[]=['modelno'=>$row[2],'ids'=>$row[0]];
}
echo json_encode($data);
}

if($value=="AVR"){
$data=array();
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='10'");
while($row=mysqli_fetch_row($qry1)){
$data[]=['modelno'=>$row[2],'ids'=>$row[0]];
}
echo json_encode($data);
}
?>