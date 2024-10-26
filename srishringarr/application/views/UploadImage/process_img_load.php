<?php

include('config.php');

try{

		//$cname=$_POST['cname'];
		  $size="";
                  $newname="";
		  $desc=$_POST['desc'];
		  $cat=$_POST['lodimg'];

//if($cat=='1')
//$path="";
//elseif($cat=='2')
//$path="";
  //image
 define ("MAX_SIZE","100"); 
//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.

 function getExtension($str) {

         $i = strrpos($str,".");

         if (!$i) { return ""; }

         $l = strlen($str) - $i;

         $ext = substr($str,$i+1,$l);

         return $ext;

 }
 
 
 function resize($filename_original, $filename_resized, $new_w, $new_h){
	//echo $filename_original." ".$filename_resized."<br>";
    $extension = pathinfo($filename_original, PATHINFO_EXTENSION);
    //echo $extension;
    if ( preg_match("/jpg|jpeg/", $extension) ){ $src_img=@imagecreatefromjpeg($filename_original); }
 
    if ( preg_match("/png/", $extension) ) $src_img=@imagecreatefrompng($filename_original);
 
   // echo "<br><br>---".$src_img."---";
    if(!$src_img) return false;
 
    $old_w = imageSX($src_img);
    $old_h = imageSY($src_img);
 
    $x_ratio = $new_w / $old_w;
    $y_ratio = $new_h / $old_h;
 
    if ( ($old_w <= $new_w) && ($old_h <= $new_h) ) {
        $thumb_w = $old_w;
        $thumb_h = $old_h;
    }
    elseif ( $y_ratio <= $x_ratio ) {
        $thumb_w = round($old_w * $y_ratio);
        $thumb_h = round($old_h * $y_ratio);
    }
    else {
        $thumb_w = round($old_w * $x_ratio);
        $thumb_h = round($old_h * $x_ratio);
    }        
 
    $dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
    imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_w,$old_h); 
 
    if (preg_match("/png/",$extension)) imagepng($dst_img,$filename_resized); 
    else imagejpeg($dst_img,$filename_resized,100); 
 
    imagedestroy($dst_img); 
    imagedestroy($src_img);
 
    return true;
} 
 

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  

//and it will be changed to 1 if an errro occures.  

//If the error occures the file will not be uploaded.

 $errors=0;

//checks if the form has been submitted

 if(isset($_POST['Submit'])) 

 {

 	//reads the name of the file the user submitted for uploading

 	$image=$_FILES['image']['name'];

 	//if it is not empty

 	if ($image) 

 	{// echo $image;

 	//get the original name of the file from the clients machine

 		$filename = stripslashes($_FILES['image']['name']);

 	//get the extension of the file in a lower case format

  		$extension = getExtension($filename);

 		$extension = strtolower($extension);

 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  

	//otherwise we will do more tests

 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 

 		{
		//print error message
 		//echo '<h1>Unknown extension!</h1>';
 		header('Location:load-Img.php?extension=Unknown extension!'); 
		$errors=1;
 		}
 		else
 		{

//get the size of the image in bytes

 //$_FILES['image']['tmp_name'] is the temporary filename of the file

 //in which the uploaded file was stored on the server

if(isset($POST['Images']))
 $size=filesize($_FILES['Images']['tmp_name']);

//compare the size with the maxim size we defined and print error if bigger
if ($size > MAX_SIZE*1024)
    {
	echo '<h1>You have exceeded the size limit!</h1>';
	$errors=1;
    }

//we will give an unique name, for example the time in unix time format

$image_name=time().'.'.$extension;

//echo "TIME IS  :".time();

//the new name will be containing the full path where will be stored (images folder)
 $newname=$_POST['lodimg']."/".$image_name;

//we verify if the image has been uploaded, and print error instead

$copied = copy($_FILES['image']['tmp_name'], $newname);

if (!$copied) 
    {
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
    }
	
}}}

    //resize($newname,$_POST['lodimg']."/"."thumbs/".$image_name, 200, 200);
	//resize($newname,"midsize/".$image_name, 300, 300);

	   if(isset($_POST['Submit']) && !$errors) 
       {
       $sql="insert into `doc_image` (`doc_img`,`description`) values('".$newname."','$desc')";
	   $result = mysql_query($sql);

		//echo $result;

		if($result)

		{

	    header('Location:load-Img.php?success=Copy Successfully'); 
		}

		else

		echo "error updating data";

		}}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>