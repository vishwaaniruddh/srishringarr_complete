<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");


if (isset($_POST['Update'])){
    
$TitleName=$_POST['TitleName'];
$MainID=$_POST['MainID'];

$brandinsert=mysqli_query($conn,"update Title set titleName='".$TitleName."' where title_id='".$MainID."' ");
if($brandinsert){?>
<script> 
 swal({
  title: "Success!",
  text: "Thank you, Update Successfully.!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("title_view.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}
    
}


if (isset($_POST['Submit'])){

$TitleName=$_POST['TitleName'];

$brandinsert=mysqli_query($conn,"insert into Title (titleName)values('".$TitleName."')");
if($brandinsert){?>
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
    window.open("title.php","_self");
    
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