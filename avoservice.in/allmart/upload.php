<?php session_start(); 


if($_SESSION['login']==1){ 

include('menu.php');


    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
      
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }

}


?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<style>
    form{
    width: 50%;
    margin: auto;
}
</style>
<div class="container-fluid" >
    
    <form action="<? $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    
    <div class="container-fluid" style="margin: 5% auto;">
      Select image to upload:
<br>
<br>

      <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
      <br>
      <br>
      <input type="submit" class="btn btn-danger" value="Upload Image" name="submit">
      
      </div>
      
    </form>
    
</div>

<? } else{ ?>
    
    <script>
        window.location.href='index.php';
    </script>
<? } ?>
