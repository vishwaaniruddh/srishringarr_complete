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

 $contents.="Sr no \t Customer Vertical\t Branch\t Site/Sol/ATM Id \t End User Name\t City\t Address \t Invoice No\t Inv Date\t Serial Numbers\t";
$i=1;

while($so_det= mysqli_fetch_array($table))
{ 

$so_id=$so_det[1];
         
$atmqry = mysqli_query($con1, "select * from demo_atm where so_id='".$so_id."'");
                $atm = mysqli_fetch_row($atmqry);
 
    $cl = mysqli_query($con1, "select cust_id,cust_name from customer where cust_id='".$so_det[14]."' ");
                     $clro = mysqli_fetch_row($cl);
                    $cust_name = $clro[1];
                
    $brqry = mysqli_query($con1, "select id,name from avo_branch where id='".$so_det[13]."' ");
                    $brro = mysqli_fetch_row($brqry);
                    $br_name = $brro[1];


$qry= mysqli_query($con1, "Select * from so_order_barcode where `so_id`='".$so_id."' " );
       $count=mysqli_num_rows($qry);
 
$pendingcount=$assetcount - $count;

$contents.="\n".$i."\t";
$contents.= $cust_name."\t";
$contents.= $br_name."\t";
$contents.= $atm[1]."\t";
$contents.= $atm[6]."\t";
$contents.= $atm[9]."\t";
$contents.= $atm[11]."\t";
$contents.= $so_det[3]."\t";// Inv No
$contents.= $so_det[4]."\t";// Inv Date


while($row=mysqli_fetch_row($qry)) {

 $specqry= mysqli_query($con1, "Select name from assets_specification where ass_spc_id='".$row[2]."'" );
$spcrow=mysqli_fetch_row($specqry);
       
$model_name=$spcrow[0];    

  $contents.= $model_name." - ".$row[3]."\t";  
    
}

    $i++; 

}



$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=barcode.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>