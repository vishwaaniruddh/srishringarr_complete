<?php
$name=$_POST['name'];
$id=$_POST['id'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$city=$_POST['city'];
$area=$_POST['area'];
$resume2=$_POST['resume2'];
$resume=$_FILES['resume']['name'];
include("config.php");
/*
require_once('class_files/update.php');
$update=new update();
$update->update_table('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','area_engg',array("engg_name","city","area","email_id","phone_no1"),array($name,$city,$area,$email,$cont),'engg_id',$id);

if($update)
{
	header('Location:view_areaeng.php');
}
else
echo "Error Updating Area Engineer";*/

if($resume=='')
{
$qry=mysqli_query($con1,"Update area_engg set city='".$city."', area='".$area."',email_id='".$email."',phone_no1='".$cont."' where engg_id='".$id."' ");
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
//echo "Update area_engg set city='".$city."', engg_name='".$name."',area='".$area."',email_id='".$email."',phone_no1='".$cont."',resume='".$newname."' where engg_id='".$id."' ";
$qry=mysqli_query($con1,"Update area_engg set city='".$city."', area='".$area."',email_id='".$email."',phone_no1='".$cont."',resume='".$newname."' where engg_id='".$id."' ");
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