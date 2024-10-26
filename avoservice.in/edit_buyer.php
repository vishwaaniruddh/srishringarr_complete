<?php 
include('config.php');
$id = $_GET['id'];
if(isset($_GET['action']) && $_GET['action']=='delete'){
    
   
    $sql = mysqli_query($con1,"update buyer set status = 2 where buyer_ID= ".$id);
    if($sql){
        echo '<script>alert("Deleted successfully!")</script>';
    }
} else {
    
    
}

if($sql){
    //header('Location : view_buyers.php');
    //header('Location:view_buyers.php');
    echo '<script>window.location.href="view_buyers.php"</script>';
}

?>