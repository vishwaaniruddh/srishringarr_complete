<?php 
include('config.php');



$fn=$_POST['fn'];
$ln=$_POST['ln'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$add1=$_POST['add1'];
$add2=$_POST['add2'];
$city= $_POST['city'];
$state=$_POST['state'];
$zip=$_POST['zip'];
$coun=$_POST['coun'];
$comm=$_POST['comm'];
$acc=$_POST['acc'];
$tax=$_POST['tax'];
$dob=$_POST['dob'];
$mode=$_POST['mode'];
//echo "hi".$mode;
$sql="insert into phppos_people(first_name,last_name,phone_number,email,address_1,address_2,city,state,zip,country,comments,dob) values('$fn','$ln','$phone','$email','$add1','$add2','$city','$state','$zip','$coun','$comm','$dob')";

$result=mysql_query($sql);

$sql1="select max(person_id) from phppos_people";
$result1=mysql_query($sql1);
$row=mysql_fetch_row($result1);
//echo $row[0];
$sql2="insert into phppos_customers(person_id,taxable) values('$row[0]','1')";
$result2=mysql_query($sql2);


if($result && $result2)
{

if($mode=='rent1')	
header("location: rent1.php");
else if($mode=='rent')	
header("location: rent.php");
else if($mode=='app')	
header("location: approval.php");
}
else
echo "error Inserting data";

?>