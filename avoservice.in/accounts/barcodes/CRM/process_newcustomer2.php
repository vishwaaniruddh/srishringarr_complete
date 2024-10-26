<?php
include('config.php');
$cname=$_POST['cname'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$add=$_POST['add'];
$model=$_POST['model'];
$pin=$_POST['pin'];


$sql="insert into phppos_service1 (name,contact,email,address,item_id,pincode) values
 ('$cname','$cont','$email','$add','$model','$pin')";
$result=mysql_query($sql);

if($result)
{
$result1=mysql_query("select max(id) from phppos_service1");
$row=mysql_fetch_row($result1);
echo "<br><center>New Customer created with id T-".$row[0]."<br><a href='cust_request.php' >Go Back</a></center>";
$crid="T-".$row[0];
$result2=mysql_query("update phppos_service1 set cr_id='".$crid."' where id=".$row[0]);

	//header('Location: cust_request.php');
}
else
echo "Error Inserting Data";
?>