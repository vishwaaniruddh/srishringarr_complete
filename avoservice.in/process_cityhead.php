<?php
include("config.php");
$subject = 'Your Login Details for AVOUPS';
			
			$headers = "From: " .Avoups. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$name=array();
$cont=array();
$email=array();
 $city=$_POST['brcity'];
 $state=$_POST['state'];
 $branch_id=$_POST['state'];
 
 $badd=$_POST['bradd'];
 $bpin=$_POST['brpin'];
$id2=0;
$cnt=0;
$qry=mysqli_query($con1,"INSERT INTO `branch_details` (`branchid`, `state`, `badd`, `city`, `pin`) VALUES (NULL, '".$state."', '".$badd."', '".$city."', '".$bpin."');");
$id=mysqli_insert_id($con1);
for($i=0;$i<count($_POST['hname']);$i++)
{
if($_POST['hname'][$i]!='')
{

$name[]=$_POST['hname'][$cnt];
$cont[]=$_POST['cont'][$cnt];
$email[]=$_POST['email'][$cnt];
$cnt=$cnt+1;
}
}

if($cnt>0)
{
for($j=0;$j<$cnt;$j++)
{
//echo "hi";
if(!preg_match('/^[0-9]{11}$/',$cont[$j]))
    {
     echo $cont[$j].' is Invalid Number! Please Insert Correct number';
    }
    else
    {
if (!filter_var($email[$j], FILTER_VALIDATE_EMAIL)) {
  echo "It Seems you Entered Invalid Email  Address ".$email[$j]." is invalid";
} else {
  $id2=0;
  unset($uname);
  $logid='';

$uname=explode(" ",$name[$j]);

$qr=mysqli_query($con1,"select max(srno) from login");
$row=mysqli_fetch_row($qr);
//echo "<br>max id ".$row[0]." ".$uname[0];
$uid=$uname[0].($row[0]+1)."";
$login=mysqli_query($con1,"INSERT INTO `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`) VALUES (NULL, '".$uid."', '".$uid."123', '".$branch_id."', '3', '1')");

$message="UserID: ".$uid." Password: ".$uid."123";
$to=$email[$j];
mail($to, $subject, $message, $headers);
$logid=mysqli_insert_id($con1);

if(!$login)
echo "".mysqli_error();
$in_obj=mysqli_query($con1,"INSERT INTO `branch_head` (`head_id`, `branchid`, `head_name`, `email_id`, `phone_no1`, `phone_no2`,`loginid`,`status`) VALUES (NULL, '".$id."', '".$name[$j]."', '".$email[$j]."', '".$cont[$j]."', NULL,'".$logid."','1')");

if($in_obj)
{
	//header('Location:newcty_head.php');
}
else
echo "Error Creating Branch Head".mysqli_error();
}
}
}
header('Location:view_cityhead.php');
}
else
echo "Please go back and Enter Branch head Details";
?>