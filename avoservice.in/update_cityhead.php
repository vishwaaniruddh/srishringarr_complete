<?php

 $name=$_POST['name'];

 $id=$_POST['id'];

 $cont=$_POST['cont'];

 $email=$_POST['email'];
include("config.php");
$qry=mysqli_query($con1,"update branch_head set head_name='".$name."', email_id='".$email."', phone_no1='".$cont."' where head_id='".$id."'");

if($qry)
{
$lid=$_POST['lid'];
//echo print_r($_POST['custx']);
$up2=mysqli_query($con1,"update clienthandle set status='1' where logid='".$lid."'");
for($i=0;$i<count($_POST['custx']);$i++)
{
if(isset($_POST['custx'][$i])){
$res=mysqli_query($con1,"select * from clienthandle where logid='".$lid."' and client='".$_POST['custx'][$i]."'");
if(mysqli_num_rows($res)>0)
{
//$resro=mysqli_fetch_row($res);
//echo "<br>update clienthandle set status='0' where logid='".$lid."' and client='".$_POST['custx'][$i]."' <br>";
$up=mysqli_query($con1,"update clienthandle set status='0' where logid='".$lid."' and client='".$_POST['custx'][$i]."' ");

}
else
{
//echo "Insert into clienthandle(`id`,`logid`,`client`,`status`)Values(NULL,'".$lid."','".$_POST['custx'][$i]."',0)<br>";
$ins=mysqli_query($con1,"Insert into clienthandle(`id`,`logid`,`client`,`status`)Values(NULL,'".$lid."','".$_POST['custx'][$i]."',0)");
}
}
}
	header('Location:view_cityhead.php');
}
else
echo "Error Updating Branch Head";
?>