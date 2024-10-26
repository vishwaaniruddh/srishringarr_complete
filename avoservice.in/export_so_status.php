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
$contents.="Sr no \t Customer Vertical \t Site/Sol/ATM ID \t PO No.\t DO No.\t End User \t Address\t Branch \t Current Status\t Last Update \t SO upload Date\t Invoice Upload Time \t Invoice No \t Invoice Date  \t Invoice Value\t Dispatch Date\t ETA\t Delivery Date\t Call log date\t Call Ticket No.\t Installed Date\t ";


$i=1;



while($row= mysqli_fetch_row($table)) 

{

$atmqry= mysqli_query($con1,"Select bank_name, address, so_date from demo_atm where so_id='".$row[0]."'");
$atm= mysqli_fetch_row($atmqry);

//=========SO Order ======
$soqry=mysqli_query($con1,"Select * from so_order where po_id='".$row[0]."'");
$so= mysqli_fetch_row($soqry);

//=====Call Log & status==== 

$alertqry=mysqli_query($con1,"Select entry_date, createdby, close_date from alert where alert_id='".$so[24]."'");

$alert= mysqli_fetch_row($alertqry);

//========== AVO Branch=====
$branch_sql = mysqli_query($con1,"select name from avo_branch where id = '".$row[4]."'");
    $branch = mysqli_fetch_assoc($branch_sql);

//==============Customer===
$cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id = '".$row[3]."'");
    
    $cust = mysqli_fetch_assoc($cust_sql);



   if ($row[14]==1) $status= "SO Pending"; 
   if ($row[14]=='c') $status="SO Cancelled";
   if ($row[14]=='h') $status= "SO on Hold";
   
   
   if ($row[14]=='2' && $so[19]=='c' ) $status= "Invoice Cancelled";
   if ($row[14]=='2' && $so[19]=='h' ) $status= "Invoice on Hold";
   if ($row[14]=='2' && $so[19]=='' ) $status= "Invoice on Hold";
   if ($so[19]=='1' && $so[9]=='0000-00-00' && $so[8]=='0000-00-00') $status= "Invoice Raised";
   if ($so[19]=='1' && $so[9]=='0000-00-00' && $so[8] !='0000-00-00') $status= "Dispatched";
   if ($so[19]=='1' && $so[9]!='0000-00-00' && $so[8] !='0000-00-00') $status= "Delivered";
//=== Check Inst request If no Fulfill=======   
   if ($so[19]=='2' && $row[8]=='0') $status= "Supply Fulfilled";
  
 if ($so[19]=='2' &&  $row[8]=='1' && $alert[2]=='0000-00-00 00:00:00') $status= "Installion U/Process";
   if ($so[19]=='2' &&  $row[8]=='1' && $alert[2] !='0000-00-00 00:00:00') $status= "Installion Complete";



//===========Last feedback
if ($row[14]!='2'  || $so[19]!='2' ){
$soupdate= mysqli_query($con1,"Select Remarks_Update from SO_Update where so_id= '".$row[0]."' Order by updt_id DESC LIMIT 1");

//echo "Select Remarks_update from SO_Update where so_id= '".$row[0]."' Order by updt_id DESC LIMIT 1";

$update=mysqli_fetch_row($soupdate);

$updt= $update[0];  }

else if ($so[19]=='2'){
$call= mysqli_query($con1,"Select feedback from eng_feedback where alert_id= '".$so[24]."' order by id DESC LIMIT 1");
$update1=mysqli_fetch_row($call);
$updt= $update1[0];  }

else $updt= "No Updates found";



 $contents.="\n".$i."\t";
 $contents.= $cust['cust_name'] ."\t";
 
 $contents.= $row[7]."\t";   // ATM ID
//==========PO================= 
$poname=mysqli_query($con1,"select `po_no` from `purchase_order` where `id`='".$row[1]."'");
$po_no=mysqli_fetch_row($poname);
 $contents.= clean($po_no[0])."\t";
 
 $contents.= clean($row[2])."\t";
 
 
 $contents.= $atm[0]."\t";
 $contents.= clean($atm[1])."\t";
 $contents.= $branch['name']  ."\t";
 
 $contents.= $status."\t";
 $contents.= clean($updt)."\t";
 
 
 $contents.= $atm[2]."\t"; // SO time
 $contents.= $so[21]."\t"; // Inv upload time
 
 $contents.= $so[2]."\t";  // Inv No
 $contents.= $so[3]."\t";
 $contents.= "Rs.".$so[4]."\t";
 $contents.= $so[8]."\t"; // Disp date 
 $contents.= $so[7]."\t";  // ETA Del Date
 $contents.= $so[9]."\t";  // Del Date
 
 $contents.= $alert[0]."\t";
 $contents.= $alert[1]."\t";
 $contents.= $alert[2]."\t";
 
// ===========by anand Show Asset

/* $assetqry= mysqli_query($con1,"Select * from new_sales_order_asset where so_trackid= '".$row[0]."'");
//echo "Select * from new_sales_order_asset where so_trackid='".$row[0]."'";
$ii=1;
while ($asset=mysqli_fetch_row($assetqry)) {
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


   header("Content-Disposition: attachment; filename=so-status.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>