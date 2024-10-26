<?php
include('config.php');
$cname=$_POST['cname'];
$item_id=$_POST['item'];
$sdate=$_POST['sdate'];
$sdate1=$_POST['sdate1'];
$sdate2=$_POST['sdate2'];
$sdate3=$_POST['sdate3'];
$sdate4=$_POST['sdate4'];
///$edate=$_POST['edate'];
$amount=$_POST['amount'];
$type=$_POST['cst_type'];

//echo $type."///////";
if($type=="sales"){
$sql11=mysql_query("select * from phppos_service where id='$cname'");
$row11 = mysql_fetch_row($sql11);

//////////////////////////////////////type of customer type that are sales or service;

if($row11[16]=="domestic"){
$xdate = str_replace('/', '-', $sdate);
//$x=explode('/',$sdate);
//$xdate=$x[1]."/".$x[0]."/".$x[2];
//echo $xdate;
$a=date('Y-m-d', strtotime($xdate.'+ 3 months'));
$b=date('Y-m-d', strtotime($xdate. ' + 6 months'));
$c=date('Y-m-d', strtotime($xdate. ' + 9 months'));
$d=date('Y-m-d', strtotime($xdate. ' + 12 months'));

//echo $sdate."  ".$a."  ".$b."  ".$c."  ".$d;
	 
$sql="insert into phppos_amc (person_id,item_id,amount,start_date,end_date,service_date1,service_date2,service_date3,atype,cust_type,cust_status) values ('$cname','$item_id','$amount',STR_TO_DATE('".$sdate."','%d/%m/%Y'),'$d','$a','$b','$c','sales','$row11[16]','Old')";
$result=mysql_query($sql);

//////////////////////starting of commercial
}
else{

	$sq=mysql_query("select * from phppos_servicestatus where id='$cname'");
    $ro=mysql_num_rows($sq);
//echo $ro;
// for 6 times amc	

if ($ro==6)
{
$dt=0;


$date = str_replace('/', '-', $sdate);
$array=date('Y-m-d', strtotime($date));
for($i=0;$i<6;$i++){

//$array=date('Y-d-m', strtotime($dop. ' + 2 days'));
$dt=$array;
/////echo $array."<br/>";


$sql1="insert into phppos_amcservicestatus(service_date,status) values('$array',0)";
$result1=mysql_query($sql1);
 $dop=$array;
 $array=date('Y-m-d', strtotime($dop. ' + 2 months'));
 
}
//echo $dt;
$sql1="insert into phppos_amc(person_id,item_id,amount,end_date,atype,cust_type,cust_status) values ('$cname','$item_id','$amount','$dt','sales','$row11[16]','Old')";
$result1=mysql_query($sql1);
$sqx=mysql_query("select max(id) from phppos_amc");
$rox=mysql_fetch_row($sqx);
///echo $rox[0];
mysql_query("update  phppos_amcservicestatus set id='$rox[0]' where id=''");
}
///////////////////end of if case

else
{

// for 12 times amc
//echo $ro[0];
$dt=0;
$date = str_replace('/', '-', $sdate);
$array=date('Y-m-d', strtotime($date));

for($i=0;$i<12;$i++){
$dt=$array;
//$array=date('Y-d-m', strtotime($dop. ' + 2 days'));

$sql1="insert into phppos_amcservicestatus (service_date,status) values('$array',0)";
$result1=mysql_query($sql1);
 $dop=$array;

////echo $array."<br/>";

 $array=date('Y-m-d', strtotime($dop. ' + 1 month'));
 
}
//echo $dt;
$sql1="insert into phppos_amc(person_id,item_id,amount,end_date,atype,cust_type,cust_status) values ('$cname','$item_id','$amount','$dt','sales','$row11[16]','Old')";
$result1=mysql_query($sql1);

$sqx=mysql_query("select max(id) from phppos_amc");
$rox=mysql_fetch_row($sqx);
///echo $rox[0];
mysql_query("update  phppos_amcservicestatus set id='$rox[0]' where id=''");
}
}
//mysql_query("update  phppos_service set amctaken='1' where id='$cname'");


}else{
////////////////////////////////////////////service///////////////////////////


$sql11=mysql_query("select * from phppos_service1 where id='$cname' ");
$row11 = mysql_fetch_row($sql11);


//////////////////////////////////////type of customer type that are sales or service;

if($row11[7]=="domestic"){
/*$a=date('Y-m-d', strtotime($sdate. ' + 3 months'));
$b=date('Y-m-d', strtotime($sdate. ' + 6 months'));
$c=date('Y-m-d', strtotime($sdate. ' + 9 months'));
$d=date('Y-m-d', strtotime($sdate. ' + 12 months'));*/


	 
$sql="insert into phppos_amc (person_id,item_id,amount,start_date,end_date,service_date1,service_date2,service_date3,atype,cust_type,cust_status) values ('$cname','$item_id','$amount',STR_TO_DATE('".$sdate."','%d/%m/%Y'),STR_TO_DATE('".$sdate4."','%d/%m/%Y'),STR_TO_DATE('".$sdate1."','%d/%m/%Y'),STR_TO_DATE('".$sdate2."','%d/%m/%Y'),STR_TO_DATE('".$sdate3."','%d/%m/%Y'),'service','$row11[7]','Old')";
$result=mysql_query($sql);

//////////////////////starting of commercial
}else{

	
	$sq=mysql_query("select * from phppos_servicestatus1 where id='$cname'");
    $ro=mysql_num_rows($sq);
//echo $ro;

if ($ro==6)
{
$dt=0;

$date = str_replace('/', '-', $sdate);
$array=date('Y-m-d', strtotime($date));
for($i=0;$i<6;$i++){

//$array=date('Y-d-m', strtotime($dop. ' + 2 days'));
$dt=$array;
/////echo $array."<br/>";

$sql1="insert into phppos_amcservicestatus(service_date,status) values('$array',0)";
$result1=mysql_query($sql1);
 $dop=$array;
 $array=date('Y-m-d', strtotime($dop. ' + 2 months'));
 
}
//echo $dt;
$sql1="insert into phppos_amc(person_id,item_id,amount,end_date,atype,cust_type,cust_status) values ('$cname','$item_id','$amount','$dt','service','$row11[7]','Old')";
$result1=mysql_query($sql1);


$sqx=mysql_query("select max(id) from phppos_amc");
$rox=mysql_fetch_row($sqx);
///echo $rox[0];
mysql_query("update  phppos_amcservicestatus set id='$rox[0]' where id=''");

}
///////////////////end of if case

else
{



//echo $ro[0];
$dt=0;
$date = str_replace('/', '-', $sdate);
$array=date('Y-m-d', strtotime($date));

for($i=0;$i<12;$i++){
$dt=$array;
//$array=date('Y-d-m', strtotime($dop. ' + 2 days'));

$sql1="insert into phppos_amcservicestatus (service_date,status) values('$array',0)";
$result1=mysql_query($sql1);
 $dop=$array;

////echo $array."<br/>";

 $array=date('Y-m-d', strtotime($dop. ' + 1 month'));
 
}
//echo $dt;
$sql1="insert into phppos_amc(person_id,item_id,amount,end_date,atype,cust_type,cust_status) values ('$cname','$item_id','$amount','$dt','service','$row11[7]','Old')";
$result1=mysql_query($sql1);

$sqx=mysql_query("select max(id) from phppos_amc");
$rox=mysql_fetch_row($sqx);
///echo $rox[0];
mysql_query("update  phppos_amcservicestatus set id='$rox[0]' where id=''");
}


}



}
if($result1 || $result)
{
	header('Location: amc.php');
}
else
echo "Error Inserting Data".mysql_error();
?>