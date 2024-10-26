<?php
session_start();
$name=$_POST['name'];
$id=$_POST['id'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$city=$_POST['city'];
$area=$_POST['area'];
$transferarea=$_POST['transferarea'];

$resume2=$_POST['resume2'];
$resume=$_FILES['resume']['name'];
include("config.php");

if($resume=='')
{

echo "Update area_engg set city='".$city."', engg_name='".$name."', area='".$area."',email_id='".$email."',phone_no1='".$cont."' where engg_id='".$id."' ";

/*$qry=mysqli_query($con1,"Update area_engg set city='".$city."', engg_name='".$name."', area='".$area."',email_id='".$email."',phone_no1='".$cont."' where engg_id='".$id."' ");*/

if($transferarea!="")
{
$logqry="INSERT INTO `area_engg_location_log`(`eng_id`, `default_loc`, `new_location`, `fromdt`, `todt`, `entryby`, `entrydt`) VALUES ('".$id."','".$area."','".$transferarea."','".date("Y-m-d",strtotime(str_replace("/","-",$_POST["fromdt"])))."','".date("Y-m-d",strtotime(str_replace("/","-",$_POST["todt"])))."','".$_SESSION['logid']."','".date("Y-m-d H:i:s")."')";
echo $logqry;
}

if($qry)
header("location:view_areaeng.php");
else
echo "failed".mysqli_error();
}
else
{
 define ("MAX_SIZE","100"); 
 
//$fichier=$_FILES['userfile']['name']; 

///echo $fichier;
 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
$errors=0;	

 $filename = stripslashes($_FILES['resume']['name']);

			//get the extension of the file in a lower case format
				 $extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().date("d_m_y").'.'.$extension;
	if(!is_dir("eng_resume"))
	mkdir("eng_resume");			
$newname="eng_resume/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['resume']['tmp_name'], $newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}


if($errors!=1)
{
echo "Update area_engg set city='".$city."', engg_name='".$name."', area='".$area."',email_id='".$email."',phone_no1='".$cont."',resume='".$newname."' where engg_id='".$id."' ";
/*$qry=mysqli_query($con1,"Update area_engg set city='".$city."', engg_name='".$name."', area='".$area."',email_id='".$email."',phone_no1='".$cont."',resume='".$newname."' where engg_id='".$id."' ");*/
if($qry)
{
	header('Location:view_areaeng.php');
}
//else
//echo "Error Creating Area Engineer".mysqli_error();

unlink($resume2);
}
}
?>