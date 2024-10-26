<?php include('config.php');
//include('functions.php');
$sqlme=$_POST['qr'];

$sqlme1 =$sqlme." LIMIT 0, 1000"; 

$table=mysqli_query($con1,$sqlme1);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}

$contents='';
 $contents.="Sr no \t Customer Vertical \t Invoice No  \t Invoice Date\t Branch\t Site ID \t Call Tkt No\t Enduser Name \t City \t Address\t So Datetime\t BB Product\t Capacity\t Qty\t BB Value\t Onward Transporter\t Transporter Doc No\t Site Contact Name\t Contact Number\t Engr Name\t Engr Feedback\t Call close Date\t Engr-BB Availabe\t Engr-BB Collected\t Is Collected?\t BB Collected Date\t Collected UPS\t Coll UPS Qty\t Coll Batt Details\t Coll Batt Qty\t Collected Others \t Collected Qty\t Sales Order Assets\t";
 
//  $contents.="Sr no \t Customer Vertical \t Invoice No  \t Invoice Date\t Branch\t Site ID \t Enduser Name \t City \t Address\t So Datetime\t BB Product\t Capacity\t Qty\t BB Value\t Onward Transporter\t Transporter Doc No\t Site Contact Name\t Contact Number\t Is Collected?\t BB Collected Date\t Collected UPS\t Coll UPS Qty\t Coll Batt Details\t Coll Batt Qty\t Collected Others \t Collected Qty\t Sales Order Assets\t";

$i=1;
while($sql_result = mysqli_fetch_assoc($table)){
 
$so_id=$sql_result['so_trackid'];
$branch_id = $sql_result['branch_id'];
$cust_id = $sql_result['po_custid'];

//==========demo ATM

$atmqry= mysqli_query($con1,"SELECT bank_name,city, address FROM demo_atm WHERE so_id='".$so_id."'");
$atm=mysqli_fetch_row($atmqry);

//==========So_order

$so_ordqry= mysqli_query($con1,"SELECT inv_no, inv_date, courier,docketno, alert_id FROM so_order WHERE po_id='".$so_id."'");
$so_order=mysqli_fetch_row($so_ordqry);
$alert_id= $so_order[4];  

//=====Branch 

$branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$branch_id."'");
$branch = mysqli_fetch_assoc($branch_sql);
//=====Cust=======
$cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$cust_id."'");
    $cust = mysqli_fetch_assoc($cust_sql);

//===================so order== invoice det 
$inv= mysqli_query($con1,"SELECT * FROM new_buyback WHERE so_trackid='".$so_id."'");
$bb=mysqli_fetch_assoc($inv);

//===alert id to eng last update======

 $call= mysqli_query($con1,"Select feedback, engineer from eng_feedback where alert_id= '".$alert_id."' order by id DESC LIMIT 1");
$update=mysqli_fetch_row($call);

//======engr name=========
$enggqry= mysqli_query($con1,"Select engg_name from area_engg where loginid= '".$update[1]."' ");
$engg=mysqli_fetch_row($enggqry);

//===alert id to alert - close date======
$alertqry= mysqli_query($con1,"Select close_date,createdby from alert where alert_id= '".$alert_id."'");

$close=mysqli_fetch_row($alertqry); 


//============engr Buyback=======
$bbengqry = "SELECT * from buyback_engg where alert_id='".$alert_id."'";
$bbstat=mysqli_query($con1,$bbengqry);
$bbrow = mysqli_fetch_row($bbstat); 

if ($bb['is_collected']==0) { $status= "No";}
   else if($bb['is_collected']==1) {$status= "Yes";}
   else if ($bb['is_collected']=='-1') {$status= "Not Available";} 

 $contents.="\n".$i."\t";
 $contents.= $cust['cust_name']."\t";
 $contents.= $so_order[0]."\t";  // Invoice
 $contents.= $so_order[1]."\t"; 
 $contents.= $branch['name']."\t";
 $contents.= $sql_result['atm_id']."\t";
 $contents.= $close[1]."\t"; // ticket no
 $contents.= $atm[0]."\t"; // end user
 $contents.= $atm[1]."\t"; // city
 $contents.= clean($atm[2])."\t";// Address
 $contents.= $sql_result['so_time']."\t";
 $contents.= clean($bb['bb_Product'])."\t";
 $contents.= $bb['bb_cap']."\t";
 $contents.= $bb['bb_qty']."\t";
 $contents.= $bb['bb_value']."\t";
 $contents.= $so_order[2]."\t";
 $contents.= $so_order[3]."\t";
 
 $contents.= $sql_result['user_cont_name']."\t";
 $contents.= $sql_result['user_cont_phone']."\t";
 
 $contents.= $engg[0]."\t";
 $contents.= clean($update[0])."\t";
 $contents.= $close[0]."\t";
 $contents.= $bbrow[4]."\t";
  $contents.= $bbrow[8]."\t";


 $contents.= $status."\t";
 $contents.= $bb['buyback_date']."\t";
 
  $contents.= $bb['ups_spec']."\t";
  $contents.= $bb['ups_qty']."\t";
  $contents.= $bb['batt_spec']."\t";
  $contents.= $bb['batt_qty']."\t";
   $contents.= $bb['remark']."\t";
   $contents.= $bb['other_qty']."\t";
 
 //===============Sales Order Assets=======
 

/*$tab=mysqli_query($con1,"SELECT * from new_sales_order_asset where so_trackid ='".$so_id."'");
$ii=1;
while($asset=mysqli_fetch_row($tab)){

$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$asset[4]."'");	
$spc=mysqli_fetch_row($qrytest);

//$prod=$asset[3].', '.$spc[0].', '.$asset[5].', '.$asset[7];
$prod=$asset[3].', '.$spc[0].', '.$asset[5];

$contents.=$prod."\t";

$ii++;
}
*/
    $i++; 

}
$contents = strip_tags($contents); 
   header("Content-Disposition: attachment; filename=inv.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>