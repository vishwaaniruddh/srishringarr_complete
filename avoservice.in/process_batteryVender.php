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
$Battery_Vendor=$_POST['Battery_Vendor'];
$Mobile_Number=$_POST['Mobile_Number'];
$email=$_POST['mail'];



if(isset($_POST['submit']))
{

                        for($i=0;$i<count($email);$i++)
                        { 
                         $qry1=mysqli_query($con1,"INSERT INTO `batteryVendor`(batteryVendorName,Mobile,email) VALUES('".$_POST['Battery_Vendor'][$i]."','".$_POST['Mobile_Number'][$i]."','".$_POST['mail'][$i]."')");
                         }
             
}
?>
<script>


swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});


window.open("batteryVender.php","_self");

</script> 

</body>
</html>