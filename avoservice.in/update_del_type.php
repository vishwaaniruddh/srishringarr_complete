<?php 
include('config.php');


$so_id=$_GET['soid'];

   $del_type	= $_POST['del_type'];
   $inst = $_POST['inst_req'];
    
    $sql = mysqli_query($con1,"update new_sales_order set del_type='".$del_type."', inst_request='".$inst."' where so_trackid= '".$so_id."' ");
 
 
 if($sql){
        echo '<script>alert("Updated successfully!")</script>';
      //  header('Location: ' . $_SERVER['HTTP_REFERER']);
        echo '<script>window.location.href="new_invoices.php"</script>';
        
 } else {
   echo '<script>alert("Error.. in Update!!!")</script>';
        echo '<script>window.location.href="new_invoices.php"</script>';
}
 
?>