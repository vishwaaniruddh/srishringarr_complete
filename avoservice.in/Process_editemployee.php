<html>
    <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
 
<body>


<?php
include 'config.php';
$ids=$_POST['empid'];
$EmployeeName=$_POST['EmployeeName'];
$Surname=$_POST['Surname'];
$empcode=$_POST['empcode'];
$Grade=$_POST['Grade'];
$department=$_POST['department'];
$branch=$_POST['branch'];
$Contact=$_POST['Contact'];
$dob=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dob'])));
$Job_Specific=$_POST['Job_Specific'];

$sql="update employee set EmployeeName='".$EmployeeName."',empcode='".$empcode."',Grade='".$Grade."',department='".$department."',branch='".$branch."',Contact='".$Contact."',Date_of_Joining='".$dob."',Job_Specific='".$Job_Specific."' where id='".$ids."'";
$result=mysqli_query($con1,$sql);
//echo $sql;
?>


<script>

swal({
  title: "update Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

window.open("view_employee.php","_self");


</script> 

</body>
</html>