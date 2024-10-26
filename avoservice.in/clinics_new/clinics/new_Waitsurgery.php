<?php 
include 'config.php';

session_start();

$id=$_POST['patient_id'];
$wait=$_POST['wait'];


if($wait=="Yes"){
	$next_date=$_POST['next_date'];
	$days=$_POST['days'];
$appfor='';
$doc='';
$appdate='';
$time= '';
$type='';

}else {
$next_date='';
	$days='';
	
$appfor=$_POST['appfor'];
$doc=$_POST['doc'];
$appdate=$_POST['appdate'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$time= $hr.":".$min;
$type=$_POST['type'];
}




$sql="insert into surgery_wait(p_id,waiting,days,wdate,next_date) 
values('$id','$wait','$days',curdate(),STR_TO_DATE('".$next_date."','%d/%m/%Y'))";
$result=mysqli_query($con,$sql);

 $sq=mysqli_query($con,"select max(w_id) from surgery_wait");
$max=mysqli_fetch_row($sq);

$sql1="insert into appoint(no,reason,doctor,date,time,type,waiting_list) values('$id','$appfor','$doc',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$time','$type','$max[0]')";

$result1=mysqli_query($con,$sql1);


if($result && $result1)
{
?>
<script>
 
    close();
  

</script>

<?php
}
else
echo "error Inserting data";
?>