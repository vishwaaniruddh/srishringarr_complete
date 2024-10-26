<? include('config.php');
session_start();

$user=$_SESSION['user'];
$string= $_POST['data'];




$string = explode('&',$string);

$remark = $string[0];
$remark = str_replace("value=","",$remark);

$id= $string[1];
$id = str_replace("id=","",$id);

$so_trackid= $string[2];
$so_trackid = str_replace("so_trackid=","",$so_trackid);
$date= date('Y-m-d H:i:s');


if(!empty($remark)){
$sql = "insert into SO_Update(po_id,date,Remarks_update,remarks_type,so_status, so_id,update_by) values('".$id."','".$date."','".$remark."','2','h','".$id."','".$user."' )";

if(mysqli_query($con1,$sql)){
    echo '1';
    

    $update_sales = mysqli_query($con1,"update so_order set status='h' where po_id='".$so_trackid."'");
}
else{
    echo '0';
}
}

else{
    echo 2;
}

?>