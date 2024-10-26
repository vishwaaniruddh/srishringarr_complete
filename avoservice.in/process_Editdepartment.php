<?php
include 'config.php';
include("access.php");

$dep=$_POST['dep'];
$ids=$_POST['ids'];

$sql="update deparment set dep_name='".$dep."' where id='".$ids."'";
$result=mysqli_query($con1,$sql);

?>

<html>
    <head>
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>-->
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>
<script>


swal({
  title: "update Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("departmentview.php","_self");

</script> 

</body>
</html>