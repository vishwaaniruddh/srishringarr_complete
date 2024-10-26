<? session_start(); 


if($_SESSION['login']==1){ 

include('menu.php');





?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<style>
    .gallery{
        width: 100%;
    height: 50%;
    object-fit: contain;
    }
</style>
<?

if(isset($_POST['delete'])){
    $name = $_POST['delete'];
    unlink($name);
}


$directory = 'uploads/';
$opendir = opendir($directory); ?>
<div class="container-fluid">
    

<div class="row">
 <? while($file = readdir($opendir)){ 
			if($file != '.' && $file != '..'){ ?>
			
            <div class="col-md-4">
                <?
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                if($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif'){ ?>
                <img class="gallery" data-u="image" src="<?php echo $directory.$file;?>" />                    
                <? }
                else if($ext == '3gp' || $ext == 'mp4' || $ext == 'avi'){ ?>
                   
                   <video style="width:100%; height:300px;" controls="">
                  <source src="<? echo $directory.$file;?>">
              </video>
              
                <? }
                else if($ext == 'pdf'){ ?>
                    <a href="<?php echo $directory.$file;?>">
                        <img class="gallery" data-u="image" src="pdf.png" />
                    </a>
                <? }
                ?>

                <br><br>
                <p style="text-align:center;"> 
                    <? echo 'http://avoservice.in/allmart/'.$directory.$file;?>
                </p>
                <form style="display:flex;justify-content:center;" action="<? $_SERVER['PHP_SELF'];?>" method="POST">
                    <button class="btn btn-danger" name="delete" type="submit" value="<? echo $directory.$file; ?>" onclick="confirm("Delete This Image ?!");">
                        Delete
                    </button>
                </form>
                <br>

            </div>
   
   <? } } ?>
    </div>

</div>






<? } else{ ?>
    
    <script>
        window.location.href='index.php';
    </script>
<? } ?>


