<?php
include('config.php');
$cname=$_POST['cname'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$add=$_POST['add'];
$model=$_POST['model'];
$dop=$_POST['dop1'];
$dp=$_POST['dop1'];
$amount=$_POST['amount'];
$service=$_POST['service'];
$pin=$_POST['pin1'];
$dt=0;

if ($service==6)
{

$sql="insert into phppos_service1(name,contact,email,address,item_id,amc_cust,pincode) values
('$cname','$cont','$email','$add','$model','commercial','$pin')";
$result=mysql_query($sql);

$sq=mysql_query("select max(id),item_id from phppos_service1");
$ro=mysql_fetch_row($sq);
//echo $ro[0];


//echo $dop."<br/>";
$date = str_replace('/', '-', $dop);
$array=date('Y-m-d', strtotime($date));

for($i=0;$i<6;$i++){

//$array=date('Y-d-m', strtotime($dop. ' + 2 days'));
$dt=$array;

$sql1="insert into phppos_servicestatus1 (id,service_date,status) values('$ro[0]','$array',0)";
$result1=mysql_query($sql1);
 $dop=$array;
 $array=date('Y-m-d', strtotime($dop. ' + 2 months'));
 
}
$e=date('Y-d-m', strtotime($dp. ' + 1 year'));
//echo $dt;
$sql1="insert into phppos_amc(person_id,item_id,amount,start_date,end_date,atype,cust_type,cust_status) values ('$ro[0]','$ro[1]','$amount',STR_TO_DATE('".$dp."','%d/%m/%Y'),'$e','services','commercial','New')";
$result1=mysql_query($sql1);
}


else
{

$sql="insert into phppos_service1(name,contact,email,address,item_id,amc_cust,pincode) values
('$cname','$cont','$email','$add','$model','commercial','$pin')";
$result=mysql_query($sql);

$sq=mysql_query("select max(id),item_id from phppos_service1");
$ro=mysql_fetch_row($sq);
//echo $ro[0];

$date = str_replace('/', '-', $dop);
$array=date('Y-m-d', strtotime($date));

for($i=0;$i<12;$i++){
$dt=$array;
//$array=date('Y-d-m', strtotime($dop. ' + 2 days'));
$sql1="insert into phppos_servicestatus1 (id,service_date,status) values('$ro[0]','$array',0)";
$result1=mysql_query($sql1);
 $dop=$array;
 
 $array=date('Y-m-d', strtotime($dop. ' + 1 month'));
 
}
//echo $dt;
$sql1="insert into phppos_amc(person_id,item_id,amount,start_date,end_date,atype,cust_type,cust_status) values ('$ro[0]','$ro[1]','$amount',STR_TO_DATE('".$dp."','%d/%m/%Y'),'$dt','services','commercial','New')";
$result1=mysql_query($sql1);



}


if($result && $result1)
{
		header('Location: amcview.php');
}
else
echo "Error Inserting Data";
?>