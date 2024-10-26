<? include('config.php');  
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)

$ip = $_SERVER['REMOTE_ADDR'];
$datetime = date('Y-m-d'); 





if($ip){
    
    
    $check_sql = mysqli_query($con,"select ip from logintrack where ip='".$ip."' and created_at = CURDATE()");
    if($check_sql_result = mysqli_fetch_assoc($check_sql)){
        
    }else{
        $sql = "insert into logintrack(ip,created_at) values('".$ip."','".$datetime."')";
        if(mysqli_query($con,$sql)){
            echo 1;
        } else{
            echo 0;
        }        
    }

}else{
    echo 2;
}
?>
