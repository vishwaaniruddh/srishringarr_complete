<?php
include("access.php");
include('config.php');
//$city=$_POST['city'];
 $area=$_POST['area'];
 $name=$_POST['name'];
 $cont=$_POST['cont'];
 $email=$_POST['email'];
// $fichier=$_FILES['resume']['name'];
 $logintype=$_POST['logintype'];
 $custx=$_POST['custx'];
 $logid='';

$uname=explode(" ",$name);
$qr=mysqli_query($con1,"select max(srno) from login");
$row=mysqli_fetch_row($qr);
//echo "<br>max id ".$row[0]." ".$uname[0];
$uid=$uname[0].($row[0]+1)."";


$q=mysqli_query($con1,"INSERT INTO `login` (`srno`, `username`, `password`, `branch`, `designation`, `status`) VALUES (NULL, '".$uid."', '".$uid."123', '".$area."', '$logintype', '1')");
$logid=mysqli_insert_id($con1);

$qry=mysqli_query($con1,"Insert into branch_head(`head_name`,`email_id`,`phone_no1`,`loginid`)Values('".$name."','".$email."','".$cont."','".$logid."')");

for($i=0;$i<count($custx);$i++)
{
	
if(isset($custx[$i]))
{
//echo "Insert into clienthandle(`id`,`logid`,`client`,`status`)Values(NULL,'".$logid."',$custx[$i],0)";
$qry1=mysqli_query($con1,"Insert into clienthandle(`id`,`logid`,`client`,`status`)Values(NULL,'".$logid."','".$custx[$i]."',0)");
}

}

if($qry && $q)
{
$subject = 'Your Login Details for AVOUPS';
			
			$headers = "From: " .Avoups. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	
	$message="UserID: ".$uid." Password: ".$uid."123";
$to=$email;
mail($to, $subject, $message, $headers);
	header('Location:view_cityhead.php');
}
else
echo "Error Creating";
//}















?>