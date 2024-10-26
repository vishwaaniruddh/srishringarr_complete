<?php include('config.php');
$sqlme1=$_POST['qr'];


//$sqlme1 =$sqlme1." LIMIT 0, 2000";

//echo $sqlme1;


function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}


$table=mysqli_query($con1,$sqlme1);

$contents='';
 $contents.="Sr no \t Invoice No \t Invoice Date  \t Invoice Value \t Invoice Upload Time \t Customer Vertical \t End User \t City\t Address \t Branch \t Site/Sol/ATM ID \t Dispatch Date\t Delivery Date\t Dispatch type \t Courier Name\t Courier Doc.No\t";


$i=1;
while($sql_result = mysqli_fetch_assoc($table)){
$id = $sql_result['po_id'];

$demo= mysqli_query($con1,"select * from demo_atm where so_id = '".$id."' ");
    $atm = mysqli_fetch_assoc($demo);
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
 $contents.= $atm['bank_name']."\t";
 $contents.=clean($atm['city'])."\t";
 $contents.= clean($atm['address'])."\t";
 $contents.= $branch['name']  ."\t";
 $contents.= $atm['atm_id']."\t";
 
 $contents.= $sql_result['dis_date']."\t";
  $contents.= $sql_result['del_date']."\t";
 $contents.= $sql_result['del_mode']."\t";
 
 $contents.= $sql_result['courier']."\t";
 $contents.= $sql_result['docketno']."\t";
 
//++++++++++
    $i++; 

}



$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=disp_rep.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>