<?php
include('config.php');
$cname=$_POST['cname'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$add=$_POST['add'];
$model=$_POST['model'];
$dop=$_POST['dop'];
$sdate1=$_POST['sdate1'];
$sdate2=$_POST['sdate2'];
$sdate3=$_POST['sdate3'];
$sdate4=$_POST['sdate4'];
$amount=$_POST['amount'];
$pin=$_POST['pin'];

$sql="insert into phppos_service1(name,contact,email,address,item_id,amc_cust,pincode) values
('$cname','$cont','$email','$add','$model','domestic','$pin')";
$result=mysql_query($sql);

$sq=mysql_query("select max(id),item_id from phppos_service1");
$ro=mysql_fetch_row($sq);
//echo $ro[0]."/".$ro[1];
$sql1="insert into phppos_amc(person_id,item_id,amount,start_date,end_date,service_date1,service_date2,service_date3,atype,cust_type,cust_status) values ('$ro[0]','$ro[1]','$amount',STR_TO_DATE('".$dop."','%d/%m/%Y'),STR_TO_DATE('".$sdate4."','%d/%m/%Y'),STR_TO_DATE('".$sdate1."','%d/%m/%Y'),STR_TO_DATE('".$sdate2."','%d/%m/%Y'),STR_TO_DATE('".$sdate3."','%d/%m/%Y'),'services','domestic','New')";
$result1=mysql_query($sql1);


if($result1)
{
	header('Location: amcview.php');
}
else
echo "Error Inserting Data".mysql_error();
?>