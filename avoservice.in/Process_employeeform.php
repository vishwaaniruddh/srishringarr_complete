<?php
include 'config.php';
include("access.php");

$EmployeeName=$_POST['EmployeeName'];
$Surname=$_POST['Surname'];
$empcode=$_POST['empcode'];
$Grade=$_POST['Grade'];
$department=$_POST['department'];
$branch=$_POST['branch'];
$Contact=$_POST['Contact'];
$dob=$_POST['dob'];
$Job_Specific=$_POST['Job_Specific'];

$sql="insert into employee(EmployeeName,empcode,Grade,department,branch,Contact,Date_of_Joining,status,Job_Specific,service_login) values('".$EmployeeName." ' '".$Surname."','".$empcode."','".$Grade."','".$department."','".$branch."','".$Contact."','".$dob."','0','".$Job_Specific."','0')";
$result=mysqli_query($con1,$sql);
//echo $sql;
?>

<html>
    <head>
        
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>
<script>


swal({
  title: "Insert Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("create_employee.php","_self");

</script> 

</body>
</html>