<?php include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;


$sqlme = str_replace("LIMIT 0, 10","",$sqlme);



$table=mysqli_query($con1,$sqlme);


function customer_vertical_id($name){
    
    global $con;
    
    $sql= mysqli_query($con1,"select * from customer where cust_name='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}


function get_cust_vertical_name($id){
    
    global $con;
    
    $sql=mysqli_query($con1,"select * from customer where cust_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_name = $sql_result['cust_name'];
    
    return $cust_name;
}


function get_branch_name($id){
    
    global $con;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch_name = $sql_result['name'];
    
    return $branch_name;
}

function get_state_name($id){
    
    global $con;
    
    $sql=mysqli_query($con1,"select * from state where state_id='".$id."'");
        $sql_result = mysqli_fetch_assoc($sql);
       $state_name = $sql_result['state'];
              return $state_name;
}


function get_salesexecutive_name($id){

    global $con2;
    
    $executive_qry = mysqlii_query($con2, "SELECT * FROM salesteam where exe_id = '".$id."'");
    $executive_qry_result = mysqlii_fetch_assoc($executive_qry);
    $name = $executive_qry_result['exe_name'];
       return $name;
}


$contents='';
 $contents.="Sr no \t Buyer Name \t Buyer Segment  \t Branch \t Executive \t City \t Address \t State \t GST \t Pincode \t Contact \t Designation \t Phone \t  Mail \t Phone2 \t Created_at \t";


$i=1;


while($sql_result = mysqli_fetch_assoc($table)){
    
    $id = $sql_result['buyer_vertical'];
    $cust_vertical_name = get_cust_vertical_name($id);
    
    $branch_id = $sql_result['avo_branch'];
    $branch_name = get_branch_name($branch_id);
    
    $buyer_state = $sql_result['buyer_state'];
    $state = get_state_name($buyer_state);
    
    
    $exe_id= $sql_result['buyer_executive'];
    $exe_name = get_salesexecutive_name($exe_id);

    
    
    $contents.="\n".$i."\t";
    $contents.= $sql_result['buyer_name']."\t";
    $contents.= $cust_vertical_name."\t";
    $contents.= $branch_name."\t";
    $contents.= $exe_name."\t";
    $contents.= $sql_result['buyer_city']."\t";
    $contents.= $sql_result['buyer_address']."\t";
    $contents.= $state."\t";
    $contents.= $sql_result['buyer_gst']."\t";
    $contents.= $sql_result['buyer_pin']."\t";
    $contents.= $sql_result['buyer_contact']."\t";
    $contents.= $sql_result['buyer_designation']."\t";
    $contents.= $sql_result['buyer_phone']."\t";
    $contents.= $sql_result['buyer_mail']."\t";
    $contents.= $sql_result['buyer_phone2']."\t";
    $contents.= $sql_result['created_date']."\t";             



    $i++; 
}




$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>