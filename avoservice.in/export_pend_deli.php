<?php include('config.php');
include('access.php');


$sqlme="select * from so_order where status=1" ;

$sqlme1=$sqlme." LIMIT 0, 1500" ;

//echo $sqlme1;

$table=mysqli_query($con1,$sqlme1);



function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$contents='';
 $contents.="Sr no \t SO Date \t DO No. \t Invoice No \t Invoice Date  \t Invoice Value \t Invoice Upload Time \t Customer Vertical \t PO Number \t End User \t City\t Address \t Branch \t Site/Sol/ATM ID \t Credit Note \t Credit Note Amount\t Delivery type \t Installation Request \t Delivery Mode \t Courier \t Docket No.  \t Estimated Delivery Date \t  Dispatch Date \t Delivery Date \t ";


$i=1;


while($sql_result = mysqli_fetch_assoc($table)){
 

$id = $sql_result['po_id'];
//============new_sale_order data====

$newso= mysqli_query($con1,"select * from new_sales_order where so_trackid = '".$id."' ");
$newso = mysqli_fetch_assoc($newso);


$buyer_id = $newso['buyerid'];
$po_idno = $newso['po_trackid'];
$cust_id = $newso['po_custid'];
$branch_id = $newso['branch_id'];;


//=========PO No.======
$po_no = mysqli_query($con1,"select po_no from purchase_order where id='".$po_idno."'");
$po_no1 = mysqli_fetch_assoc($po_no);

//========Customer======
 $cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$cust_id."'");
  $cust_sql_result = mysqli_fetch_assoc($cust_sql);
  $cust_name= $cust_sql_result['cust_name'];

//==============Branch==========
$branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$branch_id."'");
$branch_sql_result = mysqli_fetch_assoc($branch_sql);
$branch=$branch_sql_result['name'];

//================demo ATM
$demoatm= mysqli_query($con1,"select * from demo_atm where so_id = '".$id."' ");
  $demo = mysqli_fetch_assoc($demoatm);
 
 //==========Buyer
// $buyerqry = mysqli_query($con1,"select buyer_name, buyer_address from buyer where buyer_ID='".$buyer_id."'");
    
//    $buyerdata = mysqli_fetch_assoc($buyerqry);



$alert_id = $sql_result['alert_id']; 


 $contents.="\n".$i."\t";
 $contents.= $demo['so_date']."\t";
 $contents.= $demo['DO_no']."\t";
 $contents.= $sql_result['inv_no']."\t";
 $contents.= $sql_result['inv_date']."\t";
 $contents.= $sql_result['inv_value']."\t";
 $contents.= $sql_result['inv_img_time']."\t";
 $contents.= $cust_name."\t";
 $contents.= clean($po_no1['po_no'])."\t";
 
 //$contents.= $buyerdata['buyer_name'].'<br>'.$buyerdata['buyer_address']."\t";
 $contents.= $demo['bank_name']."\t";
 $contents.= $demo['city']."\t";
 $contents.= clean($demo['address'])."\t";


 $contents.= $branch."\t";
 
$atmid1= $demo['atm_id'];

if(is_numeric($atmid1)){ $atmid ="'".''.$atmid1.'';}

else $atmid=$atmid1;


 $contents.= $atmid."\t";
 $contents.= $sql_result['crn_no']."\t";
  $contents.= $sql_result['crn_amount']."\t";
 $contents.= $newso['del_type']."\t";
 $contents.= $newso['inst_request']."\t";
 $contents.= $sql_result['del_mode']."\t";
 $contents.= $sql_result['courier']."\t";
 $contents.= $sql_result['docketno']   ."\t";
 $contents.= $sql_result['est_date']."\t";
 $contents.= $sql_result['dis_date']."\t";
 $contents.= $sql_result['del_date']."\t";
 $contents.= "Pending"."\t";
 
    $i++; 
}



$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=inv.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>