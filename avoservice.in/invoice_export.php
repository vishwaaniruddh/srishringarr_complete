<?php include('config.php');

$sqlme=$_POST['qr'];

//echo $sqlme."<br>";

//$sqlme = str_replace("LIMIT 0, 25","",$sqlme);

//$sqlme=$sqlme." LIMIT 0, 1000" ;

//echo $sqlme1;

$table=mysqli_query($con1,$sqlme);



function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$contents='';
 $contents.="Sr no \t SO Date \t DO No. \t Invoice No \t Invoice Date  \t Invoice Value \t Invoice Upload Time \t Customer Vertical \t PO Number \t Buyer Name & Address \t End User \t City\t Address \t Branch \t Site/Sol/ATM ID \t Credit Note \t Credit Note Amount\t Delivery type \t Installation Request \t Delivery Mode \t Courier \t Docket No.  \t Estimated Delivery Date \t  Dispatch Date \t Delivery Date \t Invoice Status \t Call Ticket No\t Call Status\t delegated to:\t Last Engg Update\t Engg update Time\t Invoice Last Update & time\t ";
 
 //$contents.="Sr no \t SO Date \t DO No. \t Invoice No \t Invoice Date  \t Invoice Value \t Invoice Upload Time \t Customer Vertical \t PO Number \t Buyer Name & Address \t End User \t City\t Address \t Branch \t Site/Sol/ATM ID \t Credit Note \t Credit Note Amount\t Delivery type \t Installation Request \t Delivery Mode \t Courier \t Docket No.  \t Estimated Delivery Date \t  Dispatch Date \t Delivery Date \t Invoice Status \t Call Ticket No\t Call Status\t Last Update \t ";


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
 $buyerqry = mysqli_query($con1,"select buyer_name, buyer_address from buyer where buyer_ID='".$buyer_id."'");
    
    $buyerdata = mysqli_fetch_assoc($buyerqry);

//====================
 If ($sql_result['status'] == '1'){
      $status1 = "Pending";
} elseif ($sql_result['status'] == '2'){
      $status1 = "Closed";
} elseif ($sql_result['status'] == 'h'){
      $status1 = "On Hold";
} else $status1 = "Cancelled";

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
 
 $contents.= $buyerdata['buyer_name'].'<br>'.$buyerdata['buyer_address']."\t";
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
 $contents.= $status1."\t";
 
//==============Alert Table==========


$alerttable= mysqli_query($con1,"select * from alert where alert_id = '".$alert_id."' ");
 $alertdata = mysqli_fetch_assoc($alerttable);

$contents.= $alertdata['createdby']."\t";



$status=$alertdata['call_status'];
$status1=$alertdata['status'];

if($status=="Done" or $status1=="Done"){
  $call_status="Closed" ;}  
else if($status=="1"){
    $call_status="Pending" ;} 
    
else if($status=="") {
 $call_status="Not Assigned" ;}
 else {$call_status=$status;}

$contents.= $call_status."\t";



//===============Engineer Name
 $enggqry= mysqli_query($con1,"select engineer from alert_delegation where alert_id = '".$alert_id."' and alert_id !=0 ");
    
    $enggdata = mysqli_fetch_assoc($enggqry);

$engineerid=$enggdata['engineer'];

$engrsql=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engineerid."'");
$engineer = mysqli_fetch_assoc($engrsql);
$contents.= $engineer['engg_name']."\t";

//===========Updates

$qry2=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$alert_id."' and alert_id !=0 order by id desc limit 1");
$qryr2=mysqli_fetch_row($qry2);

$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $qryr2[0]))."\t";

$contents.=$qryr2[1]."\t"; 

//=============================
// by anand show  Post Invoice

//echo "select * from SO_Update where so_id='".$id."' ORDER BY updt_id DESC LIMIT 1" ;

$qryupdate=mysqli_query($con1,"select * from SO_Update where so_id='".$id."' ORDER BY updt_id DESC LIMIT 1 ");	
$n=mysqli_num_rows($qryupdate);

if($n>0){

$rowUpdate=mysqli_fetch_array($qryupdate);

$contents .=$rowUpdate[3]." - Datetime: ".$rowUpdate[2]."\t";
//$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $rowUpdate[3]))." - Datetime: ".$rowUpdate[2]."\t";

}else{
$dataaa="";
$contents.=$dataaa."\t";
}

/*

$qryupdate2=mysqli_query($con1,"select * from SO_Update where so_id='".$id."' and remarks_type='2' ORDER BY updt_id DESC LIMIT 1");	
$n2=mysqli_num_rows($qryupdate2);

if($n2>0){

while($rowUpdate2=mysqli_fetch_array($qryupdate2)){
$contents.=str_replace("\n"," ",preg_replace('/\s+/', ' ', $rowUpdate[3]))."\t";
}

}else{
$dataaa2="";
$contents.=str_replace("\n"," ",preg_replace('/\s+/', ' ', $dataaa2))."\t";
}
*/



// ===========by anand Show Asset

/*$assetqry= mysqli_query($con1,"Select * from new_sales_order_asset where so_trackid= '".$id."'");


$ii=1;
while ($asset=mysqli_fetch_array($assetqry)) {
  $modelqry= mysqli_query($con1,"Select name from assets_specification where ass_spc_id= '".$asset[4]."'");  
  $model=mysqli_fetch_row($modelqry);  
    
    $ass=$asset[3].", ".$model[0]."-".$asset[5].", ".$asset[6].", Rate:".$asset[7];

$contents.= $ass."\t";  
$ii++;
} */

//++++++++++
    $i++; 
}



$contents = strip_tags($contents); 

   header("Content-Disposition: attachment; filename=inv.xls");
  //header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
   header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>