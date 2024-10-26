<?php 
include('config.php');

$id=$_POST['id'];

$fname=$_POST['fname'];
$gender=$_POST['gender'];
$dob=$_POST['dob4'];
$age=$_POST['age'];
$address=$_POST['add'];
$contact=$_POST['cn'];
$crel=$_POST['crel'];
$rel=$_POST['rel'];
$mem=$_POST['mem'];
$house=$_POST['house'];
$kids=$_POST['kids'];
$relation=$_POST['relation'];
$amt=$_POST['amt'];
$sal=$_POST['sal'];
$work=$_POST['work'];
$post=$_POST['post'];
$bsal=$_POST['bsal'];
$ot=$_POST['ot'];

$sql="update staff_master set name='".$fname."',gender='".$gender."',dob=STR_TO_DATE('".$dob."','%d/%m/%Y'),age ='".$age."',address ='".$address."',contact ='".$contact."',close_relative ='".$crel."',relation ='".$rel."',no_of_mem ='".$mem."',house ='".$house."',kids_info ='".$kids."',name_mem='".$relation."',expense ='".$amt."',salaryexp ='".$sal."',daily_hrs ='".$work."',post ='".$post."',basic_sal ='".$bsal."',ot_rate ='".$ot."' where staff_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	
header("location: home.php");

}
else
echo "error Inserting data";
?>