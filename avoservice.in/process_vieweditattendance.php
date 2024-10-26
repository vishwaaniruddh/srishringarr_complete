<?php
include 'config.php';
include("access.php");

$id=$_POST['idd'];
$cnt=$_POST['cnt'];
//echo $cnt;


$att=$_POST['radio'];

//echo $att;

$sql="update Attendance set attendance='".$att."' where id='".$id."'";
$result=mysqli_query($con1,$sql);





/*for($i=0;$i< $cnt;$i++){

$check=$_POST['radio'.$i];
$a="";
foreach ($check as $answer) {
    $a=$answer;
}

$sql="update Attendance set attendance='".$a."' where id='".$id."'";

echo $sql;
//$result=mysqli_query($con1,$sql); */

if($result){?>
<script>
alert("Attendance Updated Successfuly!!");
window.open("editattendance.php","_self")
</script>
<?php }
//}
?>