<?php 
include('config.php');

$pid=$_POST['pid'];
$aid=$_POST['ad_id'];
$pd=$_POST['pd'];
$ef=$_POST['ef'];
$fd=$_POST['fd'];
$oper=$_POST['oper'];
$treat=$_POST['treat'];
$find_on=$_POST['find_on'];
$operation_notes=$_POST['operation_notes'];
$datedis=$_POST['datedis'];
$med=$_POST['med'];
$tak=$_POST['tak'];
$dos=$_POST['dos'];
$days=$_POST['days'];
$d=count($med);

$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

//till here
$sq=mysql_query("select max(dis_id) from `discharge_summary`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
$newsrno=$max12[0]."-".$newpatid;


///upload photo
$image=$_FILES['pre']['name']; 
$image1=$_FILES['intra']['name']; 
define ("MAX_SIZE","100"); 

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;
//checks if the form has been submitted
 	 $time = time();

 	if ($image) 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($image); //echo $filename;
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
$image_name=$time.'.'.$extension; //echo $image_name[$j];
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="photo/".$image_name;
//echo $newname;

//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['pre']['tmp_name'],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}
////////////////////////////////////////////////intra//////////////////////////////////////////////
if ($image1) 
 	{// echo $image;
 	//get the original name of the file from the clients machine
 		$filename1 = stripslashes($image1); //echo $filename;
 	//get the extension of the file in a lower case format
  		$extension1 = getExtension($filename1);
 		$extension1 = strtolower($extension1);
 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
	//otherwise we will do more tests
 if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif") && ($extension1 != "PDF")) 
 		{
		//print error message
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{

//we will give an unique name, for example the time in unix time format
$image_name1=$time.'.'.$extension1; //echo $image_name[$j];
$time=$time+2;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname1="photo/".$image_name1;
//echo $newname;

//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['intra']['tmp_name'],$newname1);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}
/////echo $newname."////////////////".$newname1;
	
///echo "insert into discharge_summary(`dis_id`, `dis_real_id`, `p_id` , `ad_id`, `provisional_diagnosis`, `examination_findings`, `final_diagnosis`, `operation`, `treatment_advised` , `finding_on_discharge`, `advice`, `date_of_discharge`, `discharge_status`,`pre_operation`,`intra_operation`)
///values('$newpatid','$newsrno','$pid','$aid','$pd','$ef','$fd','$oper','$treat','$find_on','$advice',STR_TO_DATE('".$datedis."','%d/%m/%Y'),'Yes','$newname','$newname1')";
 

$sql="insert into discharge_summary(`dis_id`, `dis_real_id`, `p_id` , `ad_id`, `provisional_diagnosis`, `examination_findings`, `final_diagnosis`, `operation`, `treatment_advised` , `finding_on_discharge`, `operation_notes`, `date_of_discharge`, `discharge_status`,`pre_operation`,`intra_operation`)
values('$newpatid','$newsrno','$pid','$aid','$pd','$ef','$fd','$oper','$treat','$find_on','$operation_notes',STR_TO_DATE('".$datedis."','%d/%m/%Y'),'Yes','$newname','$newname1')";
$result = mysql_query($sql);

for($i=0;$i<$d;$i++)
{ 
if($i!=0) {
	if($dos[$i]!=''){
		$strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		$strarray2=$strarray2.",".$tak[$i];
        $strarray3=$strarray3.",".$days[$i];
		
		
	}
	} else {
		$strarray=$dos[$i];
		$strarray1=$med[$i];
		$strarray2=$tak[$i];
        $strarray3=$days[$i];
  
	}
	if($med[$i]=="" or $med[$i]=="0"){}else{
	
$sql1="insert into discharge_prescription(dis_real_id,medicine,how_to_take,dosage,days) values('$newsrno','$med[$i]','$tak[$i]','$dos[$i]','$days[$i]')";
$result1=mysql_query($sql1);
	}
	}
 
if($result){
header('location:home.php');
}
else 
echo "Error Inserting Data".mysql_error();
?>