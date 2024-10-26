<?php 
include('config.php');


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
$link=$_POST['link'];
$ncity=$_POST['ncity'];
$tp=$_POST['tp'];
if($city=='Other' && $ncity!=''){$city=$ncity;
if($city!='Other'){
$cy=mysql_query("insert into city(name) values ('$city')");
}
}

$sql="insert into doctor (name,address,city,telno,gender,special,category,email,mobile,remarks,country) values('$name','$add','$city','$contact','$gen','$spl','$cat','$email','$mobile','$remarks','$country')";

$result=mysql_query($sql);
if($result)
{
	 if ($link=="doc"){
	?>
	<script>
	window.close();
	</script>
	<?php
 }
else
 {
  header("location: view_doctor.php");
 
  }

}

else
echo "error Inserting data";
?>