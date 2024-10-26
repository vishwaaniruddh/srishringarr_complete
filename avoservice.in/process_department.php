<?php
include 'config.php';
?>
<html>
    <head>
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>-->
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
     
<body>

<?php
$department=$_POST['dep'];




if(isset($_POST['submit']))
{

                        
                         $qry1=mysqli_query($con1,"INSERT INTO `deparment`(dep_name) VALUES('".$department."')");
                         }
             

?>
<script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("create_department.php","_self");

</script> 

</body>
</html>