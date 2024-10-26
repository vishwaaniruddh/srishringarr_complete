<?php 
include('config.php');

session_start();
$id=$_POST['patient_id'];

$date=$_POST['date'];
$comp=$_POST['comp'];
$find=$_POST['findin'];
$adv=$_POST['adv'];
$diag=$_POST['diag'];
$ref=$_POST['ref'];

/*$con=$_POST['cons'];
$foll=$_POST['foll'];
$xray=$_POST['xray'];
$dres=$_POST['dres'];
$strtxt=$_POST['strtxt'];
$ecgtxt=$_POST['ecgtxt'];
$pa=$_POST['pa'];
$pr=$_POST['pr'];
$red=$_POST['red'];
$op=$_POST['op'];
$sut=$_POST['sut'];
$cer=$_POST['cer'];
$oth=$_POST['oth'];
$inj=$_POST['inj'];
$tot=$_POST['tot'];

*/


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

$sql="insert into opd(patient_id,opddate,complaint,findings,advise,diagnosis,medicines,howtotake,dosage,ref_doctor) values('$id',STR_TO_DATE('".$date."','%d/%m/%Y'),'$comp','$find','$adv','$diag','$strarray1','$strarray2','$strarray','$ref')";
$result=mysql_query($sql);

$sq=mysql_query("select max(opd_id) from opd");
$max=mysql_fetch_row($sq);
/*
$sql1="insert into opdmedicine(opd_id,patient_id,medicine,how,dosage) values('$max[0]','$id','$strarray1','$strarray2','$strarray')";
$result1=mysql_query($sql1);
*/

///upload photo
$image=$_FILES['image']['name']; 
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
 	if ($image[$j]) 
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
}}}
//echo $newname;

	  mysql_query("insert into patient_photo(patient_id,photo_date,photo,opd_id)values('$id',STR_TO_DATE('".$date."','%d/%m/%Y'),'$newname','$max[0]')");
	}
 
///end of photo

if($result)
{
header("location: home.php");
 }else
echo "error Inserting data";
 


?>