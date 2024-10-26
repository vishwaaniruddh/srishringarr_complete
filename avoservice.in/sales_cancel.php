<? include('config.php');



$string= $_POST['data'];


$string = explode('&',$string);

$remark = $string[0];
$remark = str_replace("value=","",$remark);

$id= $string[1];
$id = str_replace("id=","",$id);

$so_trackid= $string[2];
$so_trackid = str_replace("so_trackid=","",$so_trackid);

$date=date('Y-m-d H:i:s');
$user=$_SESSION['user'];

if(!empty($remark)){
$sql = "insert into SO_Update(po_id,date,Remarks_update,remarks_type,so_status, so_id,update_by) values('".$id."','".$date."','".$remark."','1','Cancel', '".$so_trackid."','".$user."')";

if(mysqli_query($con1,$sql)){
    echo '1';
    

    $update_sales = mysqli_query($con1,"update new_sales_order set status='c' where so_trackid='".$so_trackid."'");
}
else{
    echo '0';
}
}

else{
    echo 2;
}

?>