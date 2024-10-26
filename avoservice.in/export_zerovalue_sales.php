<?php
// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';

//echo $sqlme;

$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}

function get_spec($spc_id){
    
    global $con1;
  // echo "select name from assets_specification where ass_spc_id='".$spc_id."'";
    $sql = mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$spc_id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['name'];
} 

//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Vertical-Client Name\t Invoice No\t Inv Date\t Branch\t Site/Sol/ATM ID\t End User\t City\t Address\t Call Ticket No\t Close Date\t Product details\t";

 $cnt=0;

//echo $contents;
 
while($row=mysqli_fetch_assoc($table))
{
$cnt++;

$so_id=$row['po_id'];
$cid= $row['customer_vertical'];
$br=  $row['avo_branch'];
$atmqry= mysqli_query($con1,"SELECT bank_name,city, address FROM demo_atm WHERE so_id='".$so_id."'");
$atm=mysqli_fetch_row($atmqry);

$custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cid."'");
$custname1=mysqli_fetch_row($custname);

$branch=mysqli_query($con1,"select name from avo_branch where id='".$br."'");
$branch1=mysqli_fetch_row($branch);

$contents.="\n".$cnt."\t";
 $contents.=$custname1[0]."\t";
  $contents.=$row['inv_no']."\t";
  $contents.=$row['inv_date']."\t";
  $contents.=$branch1[0]."\t";
  
 $contents.=$row['atm_id']."\t";
 $contents.=$atm[0]."\t";
 $contents.=$atm[1]."\t";
 $contents.=$atm[2]."\t";
 
 if($row['status'] == 2){
 $site_qry=mysqli_query($con1,"select alert_id from site_assets where so_id='".$so_id."'"); 
 if(mysqli_num_rows($site_qry) >0){
$alert_id=mysqli_fetch_row($site_qry) ;
//echo "select createdby, close_date from alert where alert_id='".$alert_id[0]."'";
$alert_qry=mysqli_query($con1,"select createdby, close_date from alert where alert_id='".$alert_id[0]."'"); 
$alertdet =mysqli_fetch_row($alert_qry);
$tkt= $alertdet[0];
$close = $alertdet[1];
} else {
    $tkt= "Not Found";
$close = "Not Found";
} }else {
    $tkt= "Pending";
$close = "Pending";
}
$contents.=$tkt."\t";
$contents.=$close."\t";

 $assetqry=mysqli_query($con1,"select * from new_sales_order_asset where so_trackid='".$so_id."'");
 while($detailme=mysqli_fetch_row($assetqry))
{ 
$det= $detailme[3].' Cap:' .get_spec($detailme[4]).' ||<br>Qty:'.$detailme[5].') || Warr:'.$detailme[6].' ||<br>Rate:'.$detailme[7]."</br>";
} 
 $contents.=$det."\t";

}


$contents = strip_tags($contents); 

  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>

<?php CloseCon($con1); ?>
