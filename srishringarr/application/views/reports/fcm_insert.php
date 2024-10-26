<?php 
include('config.php');
$fcm_token = $_POST["fcm_token"];

$result = mysql_query("SELECT * FROM fcm_info WHERE fcm_token='$fcm_token'");
       if(mysql_num_rows($result)> 0)
       {
        //echo "Token exist";
        $frws=mysql_fetch_array($result);
        
        $sql = "update fcm_info set fcm_token='".$fcm_token."' where fcm_token='".$frws["fcm_token"]."' ";
                 mysql_query($sql);
                 mysql_close($connection);
        
       }
         else
            {
                $sql = "insert into fcm_info values ('".$fcm_token."');";
                 mysql_query($sql);
                 mysql_close($connection);
            }
?>