<?php include('config.php');
$sqlme=$_POST['qr'];


$sqlme1 =$sqlme." LIMIT 0, 2000";

//echo $sqlme1;


function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$table=mysqli_query($con1,$sqlme1);



$contents='';
 $contents.="Sr no \t Invoice No \t Invoice Date  \t Invoice Value \t Invoice Upload Time \t Customer Vertical \t PO Number \t Sales Exec\t Buyer Name\t Buyer Address \t End User \t City\t Address \t Branch \t Site/Sol/ATM ID \t Credit Note \t Credit Note Amount\t Delivery type \t Payment Terms\t PO Remarks\t Dispatch Type\t  Assets \t";


$i=1;


while($sql_result = mysqli_fetch_assoc($table)){
 

$id = $sql_result['po_id'];





//===========New Sales Order Table==========
 $sotable= mysqli_query($con1,"select * from new_sales_order where so_trackid = '".$id."' ");
     $sorder = mysqli_fetch_assoc($sotable);

//=========== Demo ATM Table==========
$demo= mysqli_query($con1,"select * from demo_atm where so_id = '".$id."' ");
    $atm = mysqli_fetch_assoc($demo);

//=======PO Table===
$po_no = mysqli_query($con1,"select po_no, salesperson, po_payment, po_remarks from purchase_order where id='".$sorder['po_trackid']."'");
$po_data = mysqli_fetch_assoc($po_no);

//======== Sales Exec==========
$executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where exe_id='".$po_data['salesperson']."'");
    $executive_name = mysqli_fetch_assoc($executive_qry);
    $name = $executive_name['exe_name'];


//============Buyer Data==========
 $bid = mysqli_query($con1,"select buyer_name, buyer_address from buyer where buyer_ID='".$sorder['buyerid']."'");
     $buyer = mysqli_fetch_assoc($bid);
     
//========== AVO Branch=====
$branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$sorder['branch_id']."'");
    $branch = mysqli_fetch_assoc($branch_sql);

//==============Customer===
$cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$sorder['po_custid']."'");
    
    $cust = mysqli_fetch_assoc($cust_sql);


 $contents.="\n".$i."\t";
 $contents.= $sql_result['inv_no']."\t";
 $contents.= $sql_result['inv_date']."\t";
 $contents.= $sql_result['inv_value']."\t";
 $contents.= $sql_result['inv_img_time']."\t";
 $contents.= $cust['cust_name'] ."\t";
 $contents.= clean($po_data['po_no'])."\t";
 $contents.= $name."\t";
 
 $contents.= $buyer['buyer_name']."\t";
 $contents.= clean($buyer['buyer_address'])."\t";
 $contents.= $atm['bank_name']."\t";
 //$contents.= $atm['city']."\t";
 
 $contents.=clean($atm['city'])."\t";
 $contents.= clean($atm['address'])."\t";
 $contents.= $branch['name']  ."\t";
 $contents.= $atm['atm_id']."\t";
 $contents.= $sql_result['crn_no']."\t";
  $contents.= $sql_result['crn_amount']."\t";
 $contents.= $sorder['del_type']."\t";
 
 $contents.= $po_data['po_payment']."\t";
 $contents.= $po_data['po_remarks']."\t";
 $contents.= $sql_result['del_mode']."\t";
 

// ===========Show Asset==============

$daata=array();
$tab=mysqli_query($con1,"SELECT * from new_sales_order_asset where so_trackid ='".$id."'");

while($rowtest1=mysqli_fetch_row($tab)){

$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$rowtest1[4]."'");	
$rowe=mysqli_fetch_row($qrytest);

$daata=$rowtest1[3].' - ('.$rowe[0].') - Qty: '.$rowtest1[5].' - Warranty: '.$rowtest1[6] .' - Rate: '.$rowtest1[7];

$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $daata))."\t";

}

//++++++++++
    $i++; 


}



$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=sales_rep.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>