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

 $contents.="Sr no \t Customer Vertical\t Branch\t Site/Sol/ATM Id \t End User Name\t City\t Address \t Invoice No\t Inv Date\t Product\t Model Name\t Qrder Qty\t Barcode Pending\t";
$i=1;

while($so_det= mysqli_fetch_array($table))
{ 

$so_id=$so_det[0];
$assetcount=$so_det[5];
$model_id=$so_det[4];
$product=$so_det[6];                
                $atmqry = mysqli_query($con1, "select * from demo_atm where so_id='".$so_id."' ");
                $atm = mysqli_fetch_row($atmqry);
 
                $cl = mysqli_query($con1, "select cust_id,cust_name from customer where cust_id='".$so_det[3]."' ");
                     $clro = mysqli_fetch_row($cl);
                    $cust_name = $clro[1];
                
                $brqry = mysqli_query($con1, "select id,name from avo_branch where id='".$so_det[2]."' ");
                    $brro = mysqli_fetch_row($brqry);
                    $br_name = $brro[1];

                $specqry= mysqli_query($con1, "Select name from assets_specification where ass_spc_id='".$model_id."'" );
                    $spcrow=mysqli_fetch_row($specqry);
       
$model_name=$spcrow[0];

$qry= mysqli_query($con1, "Select count(id) as `count` from so_order_barcode where `so_id`='".$so_id."' and model_id='".$model_id."'" );
        $row=mysqli_fetch_assoc($qry);
        $count=$row['count'];
    
$pendingcount=$assetcount - $count;

$contents.="\n".$i."\t";
$contents.= $cust_name."\t";
$contents.= $br_name."\t";
$contents.= $atm[1]."\t";
$contents.= $atm[6]."\t";
$contents.= $atm[9]."\t";
$contents.= $atm[11]."\t";
$contents.= $so_det[1]."\t";// Inv No
$contents.= $so_det[7]."\t";// Inv Date
$contents.= $so_det[6]."\t";
$contents.= $model_name."\t";
$contents.= $so_det[5]."\t";
$contents.= $pendingcount."\t";
    $i++; 

}



$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=pending_barcode.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>