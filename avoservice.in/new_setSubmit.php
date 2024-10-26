<?php include('config.php');

$id=$_POST['id'];
$sub=$_POST['sub'];


$qry="update so_order set del_date=STR_TO_DATE('".$sub."','%d/%m/%Y') where id='".$id."'";


if(mysqli_query($con1,$qry)){
    
    echo '1';
}
else{
    echo '0';
}



?>