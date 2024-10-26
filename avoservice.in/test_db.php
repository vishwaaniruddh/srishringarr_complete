<?php
include("access.php");
include('config.php');


$st=date("Y-m-d");

$qry=mysqli_query($con1,"select site_ass_id, valid,start_date from site_assets where alert_id=1058413 ");

//echo "select site_ass_id, valid,start_date from site_assets where alert_id=1112103 ";

if(mysqli_num_rows($qry) > 0) {

while ($fetch=mysqli_fetch_array($qry)){

$deldate = $fetch[2];

//echo $deldate;
$final = date("Y-m-d", strtotime("+3 months $deldate"));


echo $deldate."<br>";
echo $final."<br>";

if($st > $final){ $st= $final; }

$d11=split(',',$fetch[1]);
  $expdt1=date('Y-m-d', strtotime("+$d11[0] months $st"));

$updt="update site_assets set start_date='".$st."', exp_date='".$expdt1."' where site_ass_id='".$fetch[0]."'";
echo $updt."<br>";

}
} else echo "Hi.............";



mysqli_close($con);
mysqli_close($con1);   

?>