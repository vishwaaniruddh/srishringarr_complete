<?php include('config.php'); 
$id = $_REQUEST['id'];











 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>
</head>
<body>

<div id="demo" class="carousel slide" data-ride="carousel" style="background:black;">

  <!-- The slideshow -->
  <div class="carousel-inner" style="background:black;">
    <? 
    $i=1 ; 
    $sql = mysqli_query($con,"select * from client_diary_details where clientid='".$id."'");
while($sql_result = mysqli_fetch_assoc($sql)){ 
$image_url = $sql_result['image_url'];
?>
<div class="carousel-item <? if($i==1){ echo 'active'; } ?>" style="background:black;">
      <img src="<? echo $image_url ; ?>" style="height:800px; width:100%;object-fit:contain;">
    </div>
    
    
<? $i++ ;  } ?>
    

  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

</body>
</html>



