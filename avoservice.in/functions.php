<?php include("config.php");

function get_buyer($parameter,$id){
    

    global $con1;


    $sql = mysqli_query($con1,"select $parameter from buyer where buyer_ID ='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    $result = $sql_result[$parameter];
    
    return $result;
    
}


function get_customer_data(){
    
    global $con1;
    $sql = mysqli_query($con1,"select * from customer where status = 'y' ");
    $result = mysqli_fetch_assoc($sql);
    return $result;
    
}


function get_cust_vertical_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from customer where cust_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_name = $sql_result['cust_name'];
    
    return $cust_name;
}


function get_end_user_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from user_segment where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}


function get_state_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from state where state_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $state = $sql_result['state'];
    
    return $state;
}


function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}


function get_sales_team($parameter,$id){
    

    global $con2;

    $sql = mysqli_query($con2,"select $parameter from salesteam where exe_id ='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    $result = $sql_result[$parameter];
    
    return $result;
    
}


?>
