<?php
include('config.php');

$branch= $_POST['branch_id'];

$mis_date=$_POST['mis_date'];
$edate1=date('Y-m-d',strtotime(str_replace("/","-",$mis_date)));


$engid=$_POST['engid'];
//print_r($engid);

$typact=$_POST['typact'];
$nameact=$_POST['nameact'];
//print_r($nameact);
$cust=$_POST['cust'];
$location=$_POST['location'];

$frtime=$_POST['frtime']; //==Hour
$frmin=$_POST['frmin']; //==Min


for($t=0;$t<count($frtime);$t++){

$frtime=$_POST['frtime']; //==Hour
$frmin=$_POST['frmin']; //==Min
$frmeri=$_POST['frmeri'];
//if($_POST['frmeri']=='pm') //==Meridian
//$frtime=(12+$frtime);
$allfrotime=$frtime[$t].":".$frmin[$t]." ".$frmeri[$t];

}

for($b=0;$b<count($frtime);$b++){
$totime=$_POST['totime']; //==Hour
$tomin=$_POST['tomin']; //==Min
$tomeri=$_POST['tomeri'];
//if($_POST['tomeri']=='pm') //==Meridian
//$totime=(12+$_POST['totime']);
$alltotime=$totime[$b].":".$tomin[$b]." ".$tomeri[$b]; 

} 


$remark=$_POST['remark'];


for($i=0;$i<count($engid);$i++){

echo "INSERT INTO `eng_mis`(`mis_date`, `eng_id`, `type`, `name`, `cust_name`, `location`, `from_time`, `to_time`, `remarks`) VALUES  ( '".$edate1."','".$engid[$i]."','".$typact[$i]."','".$nameact[$i]."','".$cust[$i]."','".$location[$i]."','".$allfrotime."','".$alltotime."','".$remark[$i]."')<br>";
	
$sql=mysqli_query($con1,"INSERT INTO `eng_mis`(`mis_date`, `eng_id`, `type`, `name`, `cust_name`, `location`, `from_time`, `to_time`, `remarks`,`branch_id`) VALUES  ( '".$edate1."','".$engid[$i]."','".$typact[$i]."','".$nameact[$i]."','".$cust[$i]."','".$location[$i]."','".$allfrotime."','".$alltotime."','".$remark[$i]."','".$branch."')");
	

}
if(!$sql) {
echo mysqli_error($con1);

}else
{
	header('Location:eng_mis.php?success= Inserted Successfully');
	}
?>
