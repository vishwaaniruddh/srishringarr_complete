<?php include('functions.php');



$array = ($_POST);

reset($array);
$first_key = key($array);

$id = str_replace("sub","",$first_key);


$is_collected = $_POST['is_buyback_collected'];
$date = $_POST[$first_key];
$remark = $_POST['remark'];


$sql = "update new_buyback set buyback_date=STR_TO_DATE('".$date."','%d/%m/%Y') ,is_collected='".$is_collected."', remark='".$remark."' where track_id='".$id."'";


if(mysqli_query($con1,$sql)){ ?>
 <script>
    setTimeout(function(){ 
        
        alert("Updated Successfully !");
        
        window.location.href="view_buyback.php";
        
    }, 500);

</script>   
<? }
else{ ?>
    
     <script>
    setTimeout(function(){ 
        
        alert("Error Occured !");
        
        window.location.href="view_buyback.php";
        
    }, 500);

</script>
    
<? } ?>




