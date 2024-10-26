<?php include('config.php');

$sqlme=$_POST['qr'];
$sqlme="select * from so_order where avo_branch = '4'  order by id desc";
//echo $sqlme;

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
// $contents.="Sr no \t SO Date \t DO No. \t Invoice No \t Invoice Date  \t Invoice Value \t Invoice Upload Time \t Customer Vertical \t PO Number \t Buyer Name & Address \t End User \t City\t Address \t Branch \t Site/Sol/ATM ID \t Credit Note \t Credit Note Amount\t Delivery type \t Installation Request \t Delivery Mode \t Courier \t Docket No.  \t Estimated Delivery Date \t  Dispatch Date \t Delivery Date \t Invoice Status \t Call Ticket No\t Call Status\t delegated to:\t Last update\t Update time\t Pre-Invoice Updates \t Post Invoice Updates \t Assets \t";
 
 $contents.="Sr no \t SO Date \t DO No. \t ";


$i=1;


while($sql_result = mysqli_fetch_assoc($table)){
 

$id = $sql_result['po_id'];
//============new_sale_order data====

//================demo ATM
//$demoatm= mysqli_query($con1,"select * from demo_atm where so_id = '".$id."' ");
 // $demo = mysqli_fetch_assoc($demoatm);
 

 $contents.="\n".$i."\t";
 $contents.= ""."\t";
 $contents.= ""."\t";
 
    $i++; 
}



$contents = strip_tags($contents); 

   header("Content-Disposition: attachment; filename=inv.xls");
  //header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
   header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>