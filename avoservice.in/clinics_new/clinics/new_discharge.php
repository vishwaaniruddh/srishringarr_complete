<?php 
include 'config.php';

$pid=$_POST['pid'];
$aid=$_POST['ad_id'];
$pd=$_POST['pd'];
$inv=$_POST['inv'];
$fd=$_POST['fd'];
$jj=$_POST['jj'];
$uc=$_POST['uc'];			
$jjdate=$_POST['jjdate'];
$ucdate=$_POST['ucdate'];
$op=$_POST['op'];
$proc=$_POST['proc'];
$po=$_POST['po'];
$add_proc=$_POST['add_proc'];
$treat=$_POST['treat'];
$advice=$_POST['advice'];
$visit=$_POST['visit'];


$sql="insert into discharge_summary(patient_id,ad_id,provisional_diagnosis,investigations,final_diagnosis,operation,proc,jj_stent,uretric_cath,removal_date,uc_date,post_operative,additional_procedure,treatment_on_discharge,advice,visit_opd) 
values('$pid','$aid','$pd','$inv','$fd','$op','".mysqli_real_escape_string($con,$proc)."','$jj','$uc',STR_TO_DATE('".$jjdate."','%d/%m/%Y'),STR_TO_DATE('".$ucdate."','%d/%m/%Y'),'$po','".mysqli_real_escape_string($con,$add_proc)."','$treat','$advice','$visit')";
$result = mysqli_query($con,$sql);

if($result){
	header('location:home.php');
}
else 
echo "Error Inserting Data";	
?>