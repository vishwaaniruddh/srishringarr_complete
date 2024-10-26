<html>
    <head>
        
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
  
<body>
<?php
include 'config.php';
$comment=$_POST['comments'];
$check=$_POST['check'];
$nums=$_POST['BRF_id'];

date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');
//echo "hello".$nums;
$battery=$_POST['num_battery'];
$completed_dt=$_POST['com_date'];



if(isset($_POST['comments']) && $_POST['comments']=='') {
    echo "You must enter the the Remarks";
    return; } 
if(isset($_POST['check']) && $_POST['com_date']=='') {
    echo "You must enter the Completion Date";
    return;    

} else if ($check==1 && $battery=='') { 
   echo "You must enter the Battery Qty Replaced";
    return;  
} else {   

if($check==1){
$ins="update BRF_form set BatteriesReplaced='".$battery."',CompletedDate='".$completed_dt."', statu='".$check."' where Brf_id='".$nums."'";
$runins=mysqli_query($con1,$ins);
} elseif($check==2) {
$ins="update BRF_form set BatteriesReplaced='0', CompletedDate='".$completed_dt."', statu='".$check."' where Brf_id='".$nums."'";
$runins=mysqli_query($con1,$ins);
}
if($check==''){$check="Pending";}

$sql="insert into UpdateStatus (comments,status,brf_id,currentdate)values('$comment','$check','$nums','$dates')";

$result=mysqli_query($con1,$sql);
}  
?>
<script>
<?php
if($result){
?>

swal({
  title: "Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.close();
//window.open("viewBRF_form.php","_self");
<?php
} 
else
{?>


  swal({
  title: "Invalid!",
  text: "oops!",
  icon: "error",
  button: "not done",
}); 
window.close();
//window.open("viewBRF_form.php","_self");
<?php }?>

</script> 

</body>
</html>
