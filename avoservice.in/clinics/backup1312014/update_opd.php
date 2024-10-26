<?php 
include('config.php');

 $id=$_POST['id'];

$actxt=$_POST['actxt'];
$date1=$_POST['date1'];
$comp=$_POST['comp'];
$find=$_POST['findin'];
$adv=$_POST['adv'];
$diag=$_POST['diag'];
$act=$_POST['actxt'];
$hospital=$_POST['hospital'];
//$hos1=$_POST['hos1'];
$soi=$_POST['soi'];
$impr=$_POST['impr'];
$invest=$_POST['invest'];
$physio=$_POST['physio'];
$comm=$_POST['comm'];
$cost=$_POST['cost'];
//$nxtdate=$_POST['nxtdate'];
//$nxttext=$_POST['nxttext'];
$hr=$_POST['hour'];
$min=$_POST['min'];
$dur=$_POST['dur'];
$time=$hr.":".$min." ".$dur;
$hos=$_POST['hos'];
$surgery=$_POST['surgery'];
$key=$_POST['key1'];
$examtemp=$_POST['examtemp'];
$opdtemp=$_POST['opdtemp'];
$instruc=$_POST['instruc'];
$newhospital=$_POST['newhospital'];
$newsrno=$id;
$med=$_POST['med'];
$tak=$_POST['tak'];
$dos=$_POST['dos'];
$days=$_POST['days'];
$qrr=mysql_query("select * from opd where opd_real_id='".$id."'");
$qrro=mysql_fetch_row($qrr);
$pot=$_POST['pot'];
$cmnt=$_POST['cmnt'];
$drugs=$_POST['drugs'];
$dosage=$_POST['dosage'];
$blis=$_POST['blis'];
$inst=$_POST['inst'];
$patid=$qrro[1];
 $d=count($med);
$tp='edit';
for($i=0;$i<$d;$i++)
{ 
if($i!=0) {
	if($med[$i]!=''){
	 $strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		//$strarray2=$strarray2.",".$tak[$i];
		$strarray3=$strarray3.",".$days[$i];
		$strarray4=$strarray4.",".$pot[$i];
 	$strarray5=$strarray5.",".$cmnt[$i];
	$strarray6=$strarray6.",".$drugs[$i];
		$strarray7=$strarray7.",".$dosage[$i];
		$strarray8=$strarray8.",".$blis[$i];
		$strarray9=$strarray9.",".$inst[$i];
		
	}
	} else {
		 $strarray=$dos[$i];
		$strarray1=$med[$i];
		//$strarray2=$tak[$i];
		$strarray3=$days[$i];
		$strarray4=$pot[$i];
		$strarray5=$cmnt[$i];
		$strarray6=$drugs[$i];
		$strarray7=$dosage[$i];
		$strarray8=$blis[$i];
		$strarray9=$inst[$i];
	}
}
//echo $strarray4." ".$strarray5;
/*if($hospital=='Other' && $newhospital!=''){$hospital=$newhospital;
if($hospital!='Other'){
$hs=mysql_query("insert into hospital(name) values ('$hospital')");
}
}*/

$sql="update opd set opddate=STR_TO_DATE('".$date1."','%d/%m/%Y'),
complaint='".$comp."',
clinical='".$find."',
advise='".$adv."',
diagnosis='".$diag."',
medicines='".$strarray1."',
days1='".$strarray3."',
dosage='".$strarray."',
action='".$actxt."',
hospital='".$hospital."',
intervention='".$soi."',
impression='".$impr."',
invadvise='".$invest."',
goals='".$physio."',
comments='".$comm."',
cost='".$cost."',
nexttime='".$time."',
keyword1='".$key1."',
exam_temp='".$examtemp."',
opd_temp='".$opdtemp."',instruct='".$instruc."',`potency`='".$strarray4."',`prescmnt`='".$strarray5."',`drugs`='".$strarray6."',`dos`='".$strarray7."',`blister`='".$strarray8."',`instruction`='".$strarray9."' where opd_real_id='".$id."'";

//echo $sql;
$result=mysql_query($sql);
/*$sql1="update opdmedicine set medicine='".$strarray1."',how='".$strarray2."',dosage='".$strarray."' where opd_id='".$id."'";  

$result1=mysql_query($sql1);*////udate photo

$image1=$_FILES['image1']['name']; 
 $old=$_POST['old'];
define ("MAX_SIZE","3000"); 

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
 	
	for($j=0;$j<count($image1);$j++){
 	//if it is not empty
	//echo count($image1);
 	if (!$image1[$j]=="") 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($image1[$j]); //echo $filename;
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
$image_name1[$j]=$time.'.'.$extension; //echo $image_name[$j];
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="photo/".$image_name1[$j];
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image1']['tmp_name'][$j],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}


}else{ $newname=$old[$j];
}

////echo "update patient_photo set photo='".$newname."' where opd_id='".$id."' and photo='".$old[$j]."'";
mysql_query("update patient_photo set photo='".$newname."' where opd_id='".$id."' and photo='".$old[$j]."'");
///echo $newname."<br/>";
//echo $newname."hi".$old[$j];

 

}

////end of new image


///upload photo
$image=$_FILES['image']['name']; 


//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)  
//and it will be changed to 1 if an errro occures.  
//If the error occures the file will not be uploaded.
 $errors=0;
//checks if the form has been submitted
 	 $time = time();
 	//reads the name of the file the user submitted for uploading
 	
	for($k=0;$k<count($image);$k++){
 	//if it is not empty
	//echo count($image);
 	if ($image[$k]) 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($image[$k]); //echo $filename;
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
$image_name[$k]=$time.'.'.$extension; //echo $image_name[$j];
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="photo/".$image_name[$k];
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'][$k],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}
//echo $newname;
$sq=mysql_query("select * from opd where opd_real_id='$id'");
$max=mysql_fetch_row($sq);
	  mysql_query("insert into patient_photo(patient_id,photo_date,photo,opd_id)values('$max[1]',STR_TO_DATE('".$date."','%d/%m/%Y'),'$newname','$id')");
	}


/////////////inser new imag	  
	
 
///end of photo

if($result)
{
//header("location: view_opd.php");
include("clinic2_print.php");
 }else
echo "error Updating data".mysql_error();
 


?>



