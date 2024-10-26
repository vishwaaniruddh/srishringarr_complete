<?php 
include 'config.php';

$id=$_POST['id'];

$date=$_POST['date'];
$comp=$_POST['comp'];
$find=$_POST['findin'];
$adv=$_POST['adv'];
$diag=$_POST['diag'];
$med=$_POST['med'];
$tak=$_POST['tak'];
$dos=$_POST['dos'];
$d=count($med);
for($i=0;$i<$d;$i++)
{ 
if($i!=0) {
	if($dos[$i]!=''){
		$strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		$strarray2=$strarray2.",".$tak[$i];
		
		
	}
	} else {
		$strarray=$dos[$i];
		$strarray1=$med[$i];
		$strarray2=$tak[$i];
	}
}
$sql="update opd set opddate=STR_TO_DATE('".$date."','%d/%m/%Y'),complaint='".$comp."',findings='".$find."',advise='".$adv."',diagnosis='".$diag."',medicines='".$strarray1."',howtotake='".$strarray2."',dosage='".$strarray."' where opd_id='".$id."'";

$result=mysqli_query($con,$sql);
/*$sql1="update opdmedicine set medicine='".$strarray1."',how='".$strarray2."',dosage='".$strarray."' where opd_id='".$id."'";  

$result1=mysqli_query($con,$sql1);*////upload photo
if(isset($image)){
$image=$_FILES['image']['name']; 
 $old=$_POST['old'];
define ("MAX_SIZE","100"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 $time = time();
 	//reads the name of the file the user submitted for uploading
 	
	for($j=0;$j<count($image);$j++){
 	//if it is not empty
	//echo count($image);
 	if (!$image[$j]=="") 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($image[$j]); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif") && ($extension != "PDF")) 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{

//we will give an unique name, for example the time in unix time format
$image_name[$j]=$time.'.'.$extension; //echo $image_name[$j];
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="photo/".$image_name[$j];
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'][$j],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}
/*$sq=mysqli_query($con,"select * from opd where opd_id='$id'");
$max=mysqli_fetch_row($sq);
//echo $newname;
 mysqli_query($con,"insert into patient_photo(patient_id,photo_date,photo,opd_id)values('$max[1]',STR_TO_DATE('".$date."','%d/%m/%Y'),'$newname','$id')");
 */
}else{ $newname=$old[$j];}
//echo $newname."hi".$old[$j];
mysqli_query($con,"update patient_photo set photo='".$newname."' where opd_id='".$id."'");
 

}
	  
}	
 
///end of photo

if($result)
{
header("location: view_opd.php");
 }else
echo "error Inserting data";
 


?>