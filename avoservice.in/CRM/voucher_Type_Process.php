<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Program=$_POST['Program'];
$Level=$_POST['Level'];
$serialNo=$_POST['serialNo'];
$ServiceName=$_POST['ServiceName'];


$err=0;
   if (is_array($serialNo))
                    {
                        for($i=0;$i<count($serialNo);$i++)
                        {  $hotelinsert=mysqli_query($conn,"INSERT INTO `voucher_Type`(`Program_ID`,`level_id`, `serialNumber`,`serviceName`) VALUES('".$Program."','".$Level."','".$serialNo[$i]."','".$ServiceName[$i]."')");
                        }
                   $err++;
                     }
                     
        
if($err>0){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Add Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("voucher_Type.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

   
?>
</body>
</html>