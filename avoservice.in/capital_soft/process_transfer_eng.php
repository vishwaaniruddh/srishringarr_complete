<?php
session_start();
include("../config.php");
$id=$_POST['id'];
$area=$_POST['area'];
$transferarea=$_POST['transferarea'];
$city=$_POST['city'];
$state_id=$_POST['state'];

$date= $_POST["fromdt"];
$lat=$_POST['lat'];
$long=$_POST['long'];
$add=$_POST['add'];
$errors=0;
mysqli_query($con1,"BEGIN");

if($transferarea!="")
{

$mqr2="Update area_engg set area='".$transferarea."', current_area='".$transferarea."', branch_id='".$transferarea."', state_id='".$state_id."', city='".$city."' , latitude='".$lat."', longitude='".$long."', address='".$add."' where engg_id='".$id."'";

$qry2=mysqli_query($con1,$mqr2);

$br=mysqli_query($con1,"select loginid from area_engg where engg_id= '".$id."'");
$log=mysqli_fetch_row($br);

$login=mysqli_query($con1,"update login set branch= '".$transferarea."' where srno='".$log[0]."'");

if(!$qry2)
{
$errors++ ;
echo "DB";
    
}

$logqry="INSERT INTO `area_engg_location_log`(`eng_id`, `default_loc`, `new_location`, `fromdt`, `entryby`, `entrydt`) VALUES ('".$id."','".$area."','".$transferarea."','".date("Y-m-d",strtotime(str_replace("/","-",$_POST["fromdt"])))."','".$_SESSION['logid']."','".date("Y-m-d H:i:s")."')";
$inslog=mysqli_query($con1,$logqry);
if(!$inslog)
{
$errors++;
//echo "DEE" ;
echo $logqry;
}
}

//=============mailing============

if($errors==0) {		

//echo "select `engg_name`,`engg_desgn` from `area_engg` where `engg_id`='".$id."'";

$eng_name=mysqli_query($con1,"select `engg_name`,`engg_desgn` from `area_engg` where `engg_id`='".$id."'");
$eng_name1=mysqli_fetch_row($eng_name);

//echo "select `name` from `avo_branch` where `id`='".$area."'";
$branch=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$area."'");
$curr=mysqli_fetch_row($branch);
$branch1=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$transferarea."'");
$trbr=mysqli_fetch_row($branch1);

//echo "select `city` from `cities` where `city_id`='".$city."'";
$cityqry=mysqli_query($con1,"select `city` from `cities` where `city_id`='".$city."'");
$city=mysqli_fetch_row($cityqry);


$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<table border='1' width='700px'>
<tr>
	<th>Engineer Name</th>
	<th>Designation</th>
	<th>Transfer from</th>
	<th>Transfer to Branch</th>
	<th>transfer City</th>
	<th>transfer date</th>
	<th>Entry BY</th>

</tr>";
$tbl.="<tr>
		<td>".$eng_name1[0]."</td>
		<td>".$eng_name1[1]."</td>
		<td>".$curr[0]."</td>
		<td>".$trbr[0]."</td>
		<td>".$city[0]."</td>
		<td>".$date."</td>
		<td>".$_SESSION['user']."</td>
		
		
	</tr>";	

//echo "select branch_email from `avo_branchmgr_email` where branch_id in ('".$transferarea."' , '".$area."')";
	
	$mails=mysqli_query($con1,"select branch_email from `avo_branchmgr_email` where branch_id in ('".$transferarea."' , '".$area."')");
	while ($ccro=mysqli_fetch_array($mails)) {
	    
	   $cc= $ccro[0];
    // $cc=implode(",",$ccro[0]);
	
//	echo $cc;
	}
	
	$to = 'boopathy@avoups.com, hr.avo@avoups.com, admin.avo@avoups.com, hr.assist@avoups.com';
	
      
	
	$subject = 'Engineer Transfer Details';
	
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			</body></html>";
	$headers = "From:<hr_engineer-admin@avoservice.in>\r\n";
	//$headers .= "Reply-To: ".dfdf . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	$mailqry=mail($to, $subject, $message, $headers);				
}

//=================mail end============


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