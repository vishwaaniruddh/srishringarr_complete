<?php
session_start();
include("access.php");
include("config.php");

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


$alert_id= $_POST['alert_id'];
$cnt= $_POST['cnt'];

$maxsize='10000';
$size=($_FILES["userfile"]["size"] / 1024);
$name=($_FILES["userfile"]["name"]);
//echo "size - ".$size;


//echo "<br>Name: ".$name;
//die;
//var_dump($this->upload->data());

if($size>$maxsize)
{ ?>
<script type="text/javascript">
	alert("File is too large. You can only upload ".$maxsize." KB . Please correct the file size");
	window.location='snaps_new.php';
	</script> 
    
<?   }  else {
    
//$target_dir = "inst_snaps/";    
$target_dir = "inst_snaps_new/";   

$file=$_FILES['userfile']['name'];

$extension1 = end((explode(".", $file)));

$target_file = $target_dir.$file;
$date=date('Y-m-d H:i:s');
$uploadOk = 1;

if(move_uploaded_file($_FILES['userfile']['tmp_name'],$target_file)){		
		$source_image = $target_file;
		$image_destination = $target_dir.$file;
	//	$compress_images = compressImage($source_image, $image_destination);

$compress_images=$target_file;

//echo "select * from snap_inst where alert_id='".$alert_id."'";
//die;

$snapqry=mysqli_query($con1,"select * from snap_inst where alert_id='".$alert_id."'");
if(mysqli_num_rows($snapqry)>0){ } else {
if($cnt==1){
 // echo "Insert into snap_inst set alert_id='".$alert_id."', full_product='".$compress_images."',created_at='".$date."' ";
 // die;
$inst=mysqli_query($con1,"Insert into snap_inst set alert_id='".$alert_id."', full_product='".$compress_images."',created_at='".$date."' ");

if ($inst){
$alrt=mysqli_query($con1,"UPDATE alert set snap_file='Done' where alert_id='".$alert_id."'");	    
} 

} } 

if($cnt==2){ 
$inst=mysqli_query($con1,"UPDATE snap_inst set front_panel='".$compress_images."' where alert_id='".$alert_id."'");	

}
else if($cnt==3){ 
$inst=mysqli_query($con1,"UPDATE snap_inst set buyback='".$compress_images."' where alert_id='".$alert_id."'");	
}
else if($cnt==4){ 
$inst=mysqli_query($con1,"UPDATE snap_inst set input_volt='".$compress_images."' where alert_id='".$alert_id."'");	
}
else if($cnt==5){ 
$inst=mysqli_query($con1,"UPDATE snap_inst set output_volt='".$compress_images."' where alert_id='".$alert_id."'");	
}
else if($cnt==6){ 
$inst=mysqli_query($con1,"UPDATE snap_inst set earth_volt='".$compress_images."' where alert_id='".$alert_id."'");	
}

}

}

if($inst){
    $cnt=$cnt+1;
    if($cnt <=6){
	?> 
	<script type="text/javascript">
	alert("Successfully Uploaded Snaps, Please continue !!");
	window.location='add_snaps.php?id=<? echo $alert_id;?>&cnt=<? echo $cnt;?>';
	</script> 
	<?
	} else {
	?> 
	<script type="text/javascript">
	alert("You Completed All the uploads");
	window.close();
	</script>
	<?
	} } else {

//echo "Insert into snap_inst set alert_id='".$alert_id."', full_product='".$compress_images."',created_at='".$date."' ";
//die;

	?>
<script type="text/javascript">
	alert("Some Error. Try Again !!");
		window.close();
	</script>

<? }	?>
	