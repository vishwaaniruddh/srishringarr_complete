<?php
session_start();
//include("access.php");
include("config.php");


$alert_id= $_POST['alert_id'];
$maxsize='10000';
$size=($_FILES["userfile1"]["size"] / 1024);

$size1=($_FILES["userfile2"]["size"] / 1024);
$size2=($_FILES["userfile3"]["size"] / 1024);


if($size>$maxsize && $size1>$maxsize && $size2>$maxsize )
{

?>
<script type="text/javascript">
	alert("File is too large. You can only upload ".$maxsize." KB . Please correct the file size");
	window.location='attach_snaps.php';
	</script> 
    
<?   }  else {
    
$target_dir = "inst_snaps/";    
$target_dir1 = "inst_buyback/";    
    
 //==========
$file1=$_FILES['userfile1']['name'];
$file2=$_FILES['userfile2']['name'];
$file3=$_FILES['userfile3']['name'];

$extension1 = end((explode(".", $file1)));
$extension2 = end((explode(".", $file2)));
$extension3 = end((explode(".", $file3)));


$target_file = $target_dir.$file1;
$target_file1 = $target_dir1.$file2; 
$target_file2 = $target_dir1.$file3;     
    

if(move_uploaded_file($_FILES['userfile1']['tmp_name'],$target_file)){		
		$source_image = $target_file;
		$image_destination = $target_dir.$file1;
		$compress_images = compressImage($source_image, $image_destination);

$inst=mysqli_query($con1,"UPDATE alert set snap_file='".$compress_images."' where alert_id='".$alert_id."'");	
}
		
if(move_uploaded_file($_FILES['userfile2']['tmp_name'],$target_file1)){			  
		$source_image = $target_file1;
		$image_destination = $target_dir1.$file2;
		$compress_images = compressImage($source_image, $image_destination);

   $buyback=mysqli_query($con1,"UPDATE alert set buyback_snap='".$compress_images."' where alert_id='".$alert_id."'");}	

if(move_uploaded_file($_FILES['userfile3']['tmp_name'],$target_file2)){			  
		$source_image = $target_file2;
		$image_destination = $target_dir1.$file3;
		$compress_images = compressImage($source_image, $image_destination);
	
	$buyback=mysqli_query($con1,"UPDATE alert set fsr_file='".$compress_images."' where alert_id='".$alert_id."'");
}	
}		

function compressImage($source_image, $compress_image) {
		$image_info = getimagesize($source_image);	
		if ($image_info['mime'] == 'image/jpeg') { 
			$source_image = imagecreatefromjpeg($source_image);
			imagejpeg($source_image, $compress_image, 75);
		} elseif ($image_info['mime'] == 'image/gif') {
			$source_image = imagecreatefromgif($source_image);
			imagegif($source_image, $compress_image, 75);
		} elseif ($image_info['mime'] == 'image/png') {
			$source_image = imagecreatefrompng($source_image);
			imagepng($source_image, $compress_image, 6);
		}	    
		return $compress_image;
	}



if($inst || $buyback){
	?> 
	<script type="text/javascript">
	alert("Successfully Uploaded Snaps");
	window.close();
	</script> 
	<?
	} echo "Failed";
	
	?>
	