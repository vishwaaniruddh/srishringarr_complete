<?php

$id=$_POST['id'];
$cont=$_POST['cont'];
$city=$_POST['city'];

$empcod=$_POST['empcode'];
$desgnn=$_POST['desgn'];
$dojj=date("Y-m-d",strtotime(str_replace("/","-",$_POST['doj'])));

$lat=$_POST['lat'];
$long=$_POST['long'];
$address=$_POST['address'];

include("../config.php");
$errors=0;


mysqli_query($con1,"BEGIN");


$mqr="Update area_engg set city='".$city."', emp_code='".$empcod."' , engg_desgn='".$desgnn."', date_join='".$dojj."' ,phone_no1='".$cont."', latitude='".$lat."', longitude='".$long."', address='".$address."' where engg_id='".$id."'  ";
$qry=mysqli_query($con1,$mqr);




if(!$qry)
{
$errors++;
}

if($errors==0)
{
mysqli_query($con1,"COMMIT");
header("location:view_areaeng.php");
}
else
{
mysqli_query($con1,"ROLLBACK");

echo "failed".mysqli_error();
}


?>