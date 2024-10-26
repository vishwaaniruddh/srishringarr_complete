<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Program=$_POST['Program'];
$P_Level=$_POST['P_Level'];
$NewMembership=$_POST['NewMembership'];
$RenewalMembership=$_POST['RenewalMembership'];
$gst=$_POST['gst'];



 $hotelinsert=mysqli_query($conn,"INSERT INTO `PrimaryMembershipFee`(`Program_id`, `P_Level_id`, `NewMembership`, `RenewalMembership`, `GST`) VALUES('".$Program."','".$P_Level."','".$NewMembership."','".$RenewalMembership."','".$gst."')");
                     
        
if($hotelinsert){?>
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
    window.open("PrimaryMembershipFee.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

   
?>
</body>
</html>