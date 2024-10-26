<?php 
include('config.php');

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}

$po_id=$_GET['poid'];

   $atm_id	= $_POST['atm_id'];
    $enduser = clean($_POST['editenduser']);
    $area = clean($_POST['editarea']);
    $city = clean($_POST['editcity']);
    $address = clean($_POST['editaddress']);
    $pin = $_POST['editpin'];
    $branch = $_POST['addbranch'];
    $state = $_POST['addstate'];
    
    $sql = mysqli_query($con1,"update atm set bank_name='".$enduser."', city='".$city."', area='".$area."', address='".$address."', pincode='".$pin."', branch_id='".$branch."', state1='".$state."' where atm_id= '".$atm_id."' ");
   
    if($sql){
        echo '<script>alert("Updated successfully!")</script>';
        echo '<script>window.location.href="add_sales_order.php?id='.$po_id.'"</script>';
} else {
   echo '<script>alert("Error.. Go to Warranty Data View Sites and Update!!!")</script>';
        echo '<script>window.location.href="view_site.php"</script>';
}
?>