<?php
session_start();
include("access.php");
include("config.php");

/*$alert_id= $_POST['alert_id'];
$maxsize='5000';
$size=($_FILES["fsrfile"]["size"] / 1024);

//$target_dir = "manual_fsr/";    

$uploadPath = "manual_fsr/"; // File upload path

// If file upload is not empty
$statusMsg = '';
    if(!empty($_FILES["fsrfile"]["name"])) 
    { 
       
        $fileName = basename($_FILES["fsrfile"]["name"]); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        $allowTypes = array('jpg','png','jpeg','gif');  // Allow certain file formats 
        if(in_array($fileType, $allowTypes))
        { 
            $imageTemp = $_FILES["fsrfile"]["tmp_name"]; 
              
            $compressedImage = compressImageData($imageTemp, $imageUploadPath, 75); // Compress size and upload image
             
            if($compressedImage){ 
   $inst=mysqli_query($con1,"UPDATE alert set manual_fsr='".$imageUploadPath."' where alert_id='".$alert_id."'");	             
        
                $status = 'compress success'; 
                $statusMsg = "Image compressed & Uploaded successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
 
// Display status message 
?>
    <script type="text/javascript">
	alert('<?php echo $statusMsg; ?>');
	window.close();
	</script> 
  <?   
function compressImageData($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
                case 'image/jpeg': 
                     $image = imagecreatefromjpeg($source); 
                     imagejpeg($image, $destination, $quality);
                     break; 
                case 'image/png': 
                     $image = imagecreatefrompng($source); 
                     imagepng($image, $destination, $quality);
                     break; 
                case 'image/gif': 
                     $image = imagecreatefromgif($source); 
                     imagegif($image, $destination, $quality);
                     break; 
               default: 
                     $image = imagecreatefromjpeg($source); 
                     imagejpeg($image, $destination, $quality);
} 
    // Return compressed image 
    return $destination; 
} 
*/


//==========================================

$alert_id= $_POST['alert_id'];
$maxsize='5000';
$size=($_FILES["fsrfile"]["size"] / 1024);


if($size>$maxsize)
{ ?>
<script type="text/javascript">
	alert("File is too large. You can only upload ".$maxsize." KB . Please correct the file size");
	window.location='manual_fsr.php';
	</script> 
    
<?   }  else {
    
$target_dir = "manual_fsr/";    

    
 //==========
$file=$_FILES['fsrfile']['name'];

$extension1 = end((explode(".", $file)));

$target_file = $target_dir.$file;

if(move_uploaded_file($_FILES['fsrfile']['tmp_name'],$target_file)){		
		$source_image = $target_file;
		$image_destination = $target_dir.$file;
	//	$compress_images = compressImage($source_image, $image_destination);
$compress_images=$target_file;

$inst=mysqli_query($con1,"UPDATE alert set manual_fsr='".$compress_images."' where alert_id='".$alert_id."'");	
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

if($inst){
	?> 
	<script type="text/javascript">
	alert("Successfully Uploaded FSR");
	window.close();
	</script> 
	<?
	} echo "Failed"; 
	
	?>
	