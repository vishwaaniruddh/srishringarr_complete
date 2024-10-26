<?php
session_start();
include 'config.php';
include("access.php");

$ids=$_GET['ids'];
$sql="update employee set status='1' where id='".$ids."'";
$result=mysqli_query($con1,$sql);
//echo $sql;

?>

<html>
    <head>
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>-->
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>

<script>


swal({
  title: "Deactivate Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("view_employee.php","_self");

</script> 

</body>
</html>