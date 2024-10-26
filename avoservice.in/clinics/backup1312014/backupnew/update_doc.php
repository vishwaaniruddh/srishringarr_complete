<?php 
include('config.php');

$id=$_POST['id'];

$name=$_POST['name'];
$add=$_POST['add'];
$city=$_POST['city'];
$contact=$_POST['cn'];
$gen=$_POST['gen'];
$spl=$_POST['spl'];
$mobile=$_POST['mobile'];
$cat=$_POST['cat'];
$email=$_POST['email'];
$remarks=$_POST['rem'];
$country=$_POST['country'];
$tp=$_POST['tp'];
$sql="update doctor set name='".$name."',address='".$add."',telno='".$contact."',city='".$city."',gender='".$gen."',special='".$spl."' ,category='".$cat."',email='".$email."',mobile='".$mobile."',remarks='".$remarks."',country ='".$country."' where doc_id='".$id."'";

$result=mysql_query($sql);
if($result)
{
	if($tp!='')
	{
	?>
    <script type="text/javascript">
	alert("Updated Successfully");
	window.close();
	</script>
    <?php
	}
	else
header("location: view_doctor.php");

}
else
echo "error Inserting data";
?>