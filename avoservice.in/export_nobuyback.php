<?php include('config.php');
include('functions.php');
$sqlme=$_POST['qr'];

$sqlme1 =$sqlme." LIMIT 0, 1000"; 



//echo $sqlme1;

$table=mysqli_query($con1,$sqlme1);


function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}




$contents='';
 $contents.="Sr no \t Customer Vertical \t Invoice No  \t Invoice Date\t Branch\t Site ID \t Enduser Name \t City \t Address\t So Datetime\t Engr Name\t Engr Feedback\t Call close Date\t Engr-BB Availabe\t Engr-BB Collected\t SO Assets\t";


$i=1;


while($sql_result = mysqli_fetch_assoc($table)){
 
 $id=$sql_result['so_trackid'];
$branch_id = $sql_result['branch_id'];
$cust_id = $sql_result['po_custid'];
$alert_id =  $sql_result['alert_id'];

//==========demo ATM
$sqlatm= mysqli_query($con1,"select * from demo_atm where so_id = '".$id."' ");
$atm = mysqli_fetch_assoc($sqlatm);

//=====Branch    
$branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$branch_id."'");
$branch = mysqli_fetch_assoc($branch_sql);

//===================so order== invoice det 
$invqry= mysqli_query($con1,"SELECT * FROM so_order WHERE po_id='".$id."'");
$sorow=mysqli_fetch_assoc($invqry);

$alert_id=$sorow['alert_id'];

//===alert id to eng last update======
$call= mysqli_query($con1,"Select feedback, engineer from eng_feedback where alert_id= '".$alert_id."' order by id DESC LIMIT 1");
$update=mysqli_fetch_row($call);

//======engr name=========

$enggqry= mysqli_query($con1,"Select engg_name from area_engg where loginid= '".$update[1]."' ");
$engg=mysqli_fetch_row($enggqry);

//===alert id to alert - close date======
$alertqry= mysqli_query($con1,"Select close_date from alert where alert_id= '".$alert_id."'");
$close=mysqli_fetch_row($alertqry);

//=====Cust=======
$cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$cust_id."'");
    $cust = mysqli_fetch_assoc($cust_sql);
//============engr Buyback=======

$bbengqry = "SELECT * from buyback_engg where alert_id='".$alert_id."'";
$bbstat=mysqli_query($con1,$bbengqry);
$bbrow = mysqli_fetch_row($bbstat);



if ($bb['is_collected']==0) { $status= "No";}
   else if($bb['is_collected']==1) {$status= "Yes";}
   else if ($bb['is_collected']=='-1') {$status= "Not Available";} 

 $contents.="\n".$i."\t";
 $contents.= $cust['cust_name']."\t";
 $contents.= $sorow['inv_no']."\t";  // Invoice
  $contents.= $sorow['inv_date']."\t"; 
 $contents.= $branch['name']."\t";
 $contents.= $sql_result['atm_id']."\t";
 $contents.= clean($atm['bank_name'])."\t";
 $contents.= clean($atm['city'])."\t";
 $contents.= clean($atm['address'])."\t";
 $contents.= $sql_result['so_time']."\t";
 $contents.= $engg[0]."\t";
 $contents.= clean($update[0])."\t";
 $contents.= $close[0]."\t";

 $contents.= $bbrow[4]."\t";
  $contents.= $bbrow[8]."\t";

  //===============Sales Order Assets=======
$tab=mysqli_query($con1,"SELECT * from new_sales_order_asset where so_trackid ='".$id."'");


$ii=1;
while($asset=mysqli_fetch_array($tab)){

$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$asset[4]."'");	
$spc=mysqli_fetch_row($qrytest);

//$prod=$asset[3].', '.$spc[0].', '.$asset[5].', '.$asset[7];
$prod=$asset[3].', '.$spc[0].', '.$asset[5];

$contents.=$prod."\t";

$ii++;
}

    $i++; 

}



$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=inv.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>