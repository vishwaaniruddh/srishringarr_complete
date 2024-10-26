<?php include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;

$sqlme = str_replace("LIMIT 0, 10","",$sqlme);
$table=mysqli_query($con1,$sqlme);

function get_cust_vertical_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from customer where cust_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_name = $sql_result['cust_name'];
    
    return $cust_name;
}


function get_buyername($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from buyer where buyer_ID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $buyer_name = $sql_result['buyer_name'];
    
    return $buyer_name;
    
    
}

function get_sales_team($parameter,$id){
    

    global $con2;

    $sql = mysqli_query($con2,"select $parameter from salesteam where exe_id ='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    $result = $sql_result[$parameter];
    
    return $result;
    
}

function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}




$contents='';
 $contents.="Sr no \t Customer Vertical \t PO Number  \tPO Date\t  Buyer Name \t Buyer Address \t GST \t Sales Executive \t PO Raised By \t TAT \t Branch \t Payment \t Remarks \t Date \t  SO raised Count\t";


$i=1;


while($sql_result = mysqli_fetch_assoc($table)){
    
                $cust_id = $sql_result['cust_id'];
                $po_id = $sql_result['id'];
                
                
                $sales_order_sql = mysqli_query($con1,"select count(po_trackid) as sales_count from new_sales_order where po_trackid='".$po_id."'");
                
                $sales_order_sql_result = mysqli_fetch_assoc($sales_order_sql);
                
                $sales_count = $sales_order_sql_result['sales_count'];
                
                
    
    
            $contents.="\n".$i."\t";
            $contents.= get_cust_vertical_name($cust_id)."\t";
            $contents.= $sql_result['po_no']."\t";
            $contents.= $sql_result['po_date']."\t";
            $contents.= get_buyername($sql_result['buyer_id'])."\t";
            $contents.= $sql_result['buyeraddress']."\t";
            $contents.= $sql_result['gst']."\t";
            $contents.= get_sales_team('exe_name',$sql_result['salesperson'])."\t";
            $contents.= $sql_result['po_raiseby']."\t";
            $contents.= $sql_result['po_tat']."\t";
            $contents.= get_branch_name($sql_result['branch_id'])."\t";
            $contents.= $sql_result['po_payment']."\t";
            $contents.= $sql_result['po_remarks']."\t";
            $contents.= $sql_result['po_time']."\t";
            $contents.= $sales_count."\t";
    
    $i++; 
}




$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>