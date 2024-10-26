<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Hotel=$_POST['Hotel'];
$Program=$_POST['Program'];
if(isset($_POST['update'])){
  $mainid=$_POST['mainid'];  
 $sqlupdate=mysqli_query($conn,"update  Program set Hotel_id='".$Hotel."',Progam_name='".$Program."' where Program_ID='".$mainid."'");
if($sqlupdate){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Updated Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("Program_view.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}   
}

if(isset($_POST['submit'])){

$programInsert=mysqli_query($conn,"insert into  Program(Progam_name,Hotel_id)values('".$Program."','".$Hotel."')");
if($programInsert){?>
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
    window.open("Program.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}
}
?>
</body>
</html>