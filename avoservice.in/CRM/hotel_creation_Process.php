<html>
 <head>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 </head>
<body>
<?php 
include("config.php");

$Brand=$_POST['Brand'];
$Logo=$_POST['Logo'];
$HotelName=$_POST['HotelName'];


$target_dir = "assets/img/logos/";
$target_file = $target_dir . basename($_FILES["Logo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["Logo"]["tmp_name"]);
    if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
      //  echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
//if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
  //  $uploadOk = 0;
//}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {?>
    <script> 
    swal("Sorry, your file is too large.");
    </script> 
    
  <?  $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    ?>
     <script> 
    swal("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    </script> 
    
 <?   $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {?>
    
    <script> 
    swal("Sorry, your file was not uploaded.");
    </script> 
<?php // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["Logo"]["tmp_name"], $target_file)) {
       // echo "The file ". basename( $_FILES["Logo"]["name"]). " has been uploaded.";
       // echo $target_file;
        
        
$hotelinsert=mysqli_query($conn,"insert into Hotel_Creation (Brand,logo,Hotel_Name)values('".$Brand."','".$target_file."','".$HotelName."')");
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
    window.open("hotel_creation.php","_self");
    
  } 
});
     
</script>
   
<? }else{
    echo "error";
}

        
        
        
        
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}













?>
</body>
</html>