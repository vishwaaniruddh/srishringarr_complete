<?php
include 'config.php';
include("access.php");


$cnt=$_POST['cnt'];
//echo $cnt;
$id=$_POST['id'];
$empName=$_POST['empName'];
$Surname=$_POST['Surname'];
$empcode=$_POST['empcode'];
$department=$_POST['department'];
$date=$_POST['datepicker'];
$dates=date("Y-m-d", strtotime($date) );
//echo $dates;
$day=$_POST['day'];
$branch=$_POST['branch'];
//date_default_timezone_set('Asia/Kolkata');
//$dates = date('Y-m-d');


for($i=0;$i< $cnt;$i++){

$check=$_POST['radio'.$i];
$a="";
foreach ($check as $answer) {
    $a=$answer;
}

$sql="insert into Attendance (emp_id,empName,surname,empcode,department,attendance,date,day,branch) values('".$id[$i]."','".$empName[$i]."','".$Surname[$i]."','".$empcode[$i]."','".$department[$i]."','".$a."','".$dates."','".$day."','".$branch[$i]."')";
$result=mysqli_query($con1,$sql);

//echo $sql;


//echo $id[$i]." ". $empName[$i]." ". $Surname[$i] ." ". $empcode[$i] ." ". $department[$i]  . " ". $a;

}

?>

<script>
window.open("ViewAttendance.php","_self");
</script>