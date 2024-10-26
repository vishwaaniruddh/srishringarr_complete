<html>
    <head>
        
        
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
  
<body>

<?php
include 'config.php';
$ticketno=$_POST['ticket'];
//echo "ram".$brf_id;
$VendorTicketNo=$_POST['VendorTicketNo'];
$VendorTktDate1=$_POST['VendorTktDate'];
$VendorTktDate=date("Y-m-d",strtotime($VendorTktDate1));

$sql="update BRF_form set VendorTicketNo='".$VendorTicketNo."',VendorTktDate='".$VendorTktDate."' where Call_Ticket='".$ticketno."'";

$result=mysqli_query($con1,$sql);

?>
<script>
<?php
if($result){
?>

swal({
  title: "Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});

window.open("viewBRF_form.php","_self");
<?php
}
else
{?>


  swal({
  title: "Invalid!",
  text: "oops!",
  icon: "error",
  button: "not done",
});  
window.open("Edit_brfform.php","_self");
<?php
}
?>

</script> 

</body>
</html>
