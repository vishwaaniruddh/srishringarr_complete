<?php 
include('config.php');
//echo "hi";
if(isset($_POST['Submit']))
{
//echo "hello";
 $patid=$_POST['patient_id'];
//echo "<br>";
  $hospital=$_POST['hospital'];
  $date1=$_POST['date1'];
  $examtemp=$_POST['examtemp'];
  $opdtemp=$_POST['opdtemp'];
  $comp=$_POST['comp'];
  $findin=$_POST['findin'];
  $soi=$_POST['soi'];
  $hos=$_POST['hos'];
  $surgery=$_POST['surgery'];
  //$adv=$_POST['adv'];
  $adv='';
 // $diag=$_POST['diag'];
  $diag='';
  $key1=$_POST['key1'];
$impr=$_POST['impr'];
$invest=$_POST['invest'];
$physio=$_POST['physio'];
$actxt=$_POST['actxt'];
$comm=$_POST['comm'];
$cost=$_POST['cost'];
$instruc=$_POST['instruc'];
$nxtdate=$_POST['nxtdate'];
  $hos1=$_POST['hos1'];
$med=$_POST['med'];
$tak=$_POST['tak'];
$dos=$_POST['dos'];
$days=$_POST['days'];
$pot=$_POST['pot'];
$cmnt=$_POST['cmnt'];
$drugs=$_POST['drugs'];
$dosage=$_POST['dosage'];
$blis=$_POST['blis'];
$inst=$_POST['inst'];
$d=count($med);
$aid=$_POST['aid'];
$finding=trim($findin," ");
//$newhospital=$_POST['newhospital'];
$block_id=$_POST['block_id'];
 $slot=$_POST['sl'];
$tp='new';

 $nxttext=$_POST['nxttext'];
for($i=0;$i<$d;$i++)
{ 
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $med[$i]))
{
   $med[$i]=str_replace("'","\'",$med[$i]);
}
else
$med[$i]=$med[$i];
if($i!=0) {
	if($med[$i]!=''){
		$strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		//$strarray2=$strarray2.",".$tak[$i];
        $strarray3=$strarray3.",".($days[$i]);
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
        $strarray3=($days[$i]);
  $strarray4=$pot[$i];
		$strarray5=$cmnt[$i];
		$strarray6=$drugs[$i];
		$strarray7=$dosage[$i];
		$strarray8=$blis[$i];
		$strarray9=$inst[$i];
	}
	}
	
	$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

$sq11=mysql_query("select max(opd_id) from `opd`");
$max11=mysql_fetch_row($sq11);
//echo $max[0];
$newopd=$max11[0]+1;
 $newsrno=$max12[0]."-".$newopd;

$sql="INSERT INTO `opd`(`opd_id`,`patient_id`, `opddate`,`hospital`,`complaint`,`clinical`,`advise`,`diagnosis`, `medicines`,`howtotake`,`dosage`,`intervention`,`impression`,`invadvise`,`goals`,`comments`,`cost`,`days1`,`nextdate`,`nxttext`,`nexttime`,`nexthosp`,`surgery`, `hosp`,`action`,`keyword1`,`exam_temp`, `opd_temp`,`instruct`,`app_id`,`block_id`,`opd_real_id`,`potency`,`prescmnt`,`drugs`,`dos`,`blister`,`instruction`) values('$newopd','$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'), '$hospital','$comp','$finding','$adv','$diag','$strarray1','','$strarray','$soi','$impr','$invest','$physio','$comm','$cost','$strarray3', STR_TO_DATE('".$nxtdate."','%d/%m/%Y'), '$nxttext','$slot','$hos1','$surgery','$hos','$actxt','$key1','$examtemp','$opdtemp','$instruc','$aid','$block_id','$newsrno','$strarray4','$strarray5','$strarray6','$strarray7','$strarray8','$strarray9')";
//echo $sql;
$result=mysql_query($sql);
if(!$result)
echo "failed".mysql_error();
if($nxtdate!=''){


if($_POST['apptype']!='' && $slot!='')
{
$ini=substr($hos1,0,1);
$sqnx=mysql_query("select max(app_id) from `appoint` where center='".$hos1."'");
$maxnx=mysql_fetch_row($sqnx);
//echo $max[0];
$newpatidnx=$maxnx[0]+1;
 $newsrnonx=$ini."-".$newpatidnx;
//echo $_POST['apptype']." ".$slot;

//echo $patid." ".$_POST['apptype']." ".$nxtdate." ".$block_id." ".$slot." ".$newsrnonx." ".$newpatidnx." ".$hos1;
$app="insert into appoint(no,hospital,app_date,block_id,slot,app_real_id,app_id,new_old,center,confirmstat,date) values('".$patid."','".$_POST['apptype']."',STR_TO_DATE('".$nxtdate."','%d/%m/%Y'),'".$block_id."','".$slot."','".$newsrnonx."','".$newpatidnx."','O','".$hos1."','w','".date("Y-m-d")."')";
//echo $app;
$appresult=mysql_query($app);
}
 $image=$_FILES['image']['name']; 
 //print_r($image);
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

	  mysql_query("insert into patient_photo(patient_id,photo_date,photo,opd_id)values('$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'),'$newname','$newsrno')");
	}
 
///end of photo
//echo "update appoint set status='yes',presstat='1' where app_real_id='".$aid."'";
mysql_query("update patient set pattype='$comm' where srno='".$patid."'");
 mysql_query("update appoint set status='yes',presstat='3' where app_real_id='".$aid."'");
if($result)
{
//unset($_POST['Submit']);
//header("location: view_opd.php");
include("clinic2_print.php");
 }else
echo "error Inserting data".mysql_error();

}

}
//session_start();
/*if(isset($_POST['Submit']))
echo $patid=$_POST['patient_id'];
$hospital=$_POST['hospital'];
$date1=$_POST['date1'];
$examtemp=$_POST['examtemp'];
$opdtemp=$_POST['opdtemp'];
$comp=$_POST['comp'];
$findin=$_POST['findin'];
$soi=$_POST['soi'];
$hos=$_POST['hos'];
$surgery=$_POST['surgery'];
$adv=$_POST['adv'];
$diag=$_POST['diag'];
$key1=$_POST['key1'];
$impr=$_POST['impr'];
$invest=$_POST['invest'];
$physio=$_POST['physio'];
$actxt=$_POST['actxt'];
$comm=$_POST['comm'];
$cost=$_POST['cost'];
$instruc=$_POST['instruc'];
$nxtdate=$_POST['nxtdate'];
$nxttext=$_POST['nxttext'];
/*$hr=$_POST['hour'];
$min=$_POST['min'];
$dur=$_POST['dur'];
$time1=$hr.":".$min." ".$dur;*/
/*$hos1=$_POST['hos1'];
$med=$_POST['med'];
$tak=$_POST['tak'];
$dos=$_POST['dos'];
$days=$_POST['days'];
$pot=$_POST['pot'];
$cmnt=$_POST['cmnt'];
$d=count($med);
$aid=$_POST['aid'];
$finding=trim($findin," ");
//$newhospital=$_POST['newhospital'];
$block_id=$_POST['block_id'];
$slot=$_POST['sl'];
$tp='new';



for($i=0;$i<$d;$i++)
{ 
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $med[$i]))
{
   $med[$i]=str_replace("'","\'",$med[$i]);
}
else
$med[$i]=$med[$i];
if($i!=0) {
	if($dos[$i]!=''){
		$strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		//$strarray2=$strarray2.",".$tak[$i];
        $strarray3=$strarray3.",".($days[$i]);
		$strarray4=$strarray4.",".$pot[$i];
		$strarray5=$strarray5.",".$cmnt[$i];
		
	}
	} else {
	
		$strarray=$dos[$i];
		$strarray1=$med[$i];
		//$strarray2=$tak[$i];
        $strarray3=($days[$i]);
  $strarray4=$pot[$i];
		$strarray5=$cmnt[$i];
	}
	}
	///echo $nxtdate."/".$nxttext;
/*
$sql="
INSERT INTO `satyavan_clinicmgt`.`opd` 
(`opd_id`, `patient_id`, `srno`, `tempno`, `name`, `ref`, `time`, `newold`, `hospital`, `company`, `billno`, 
`billdate`, `appoint`, `acti`, `rs`, `activity`, `done`, `pres1`, `pres2`, `pres3`, `dosage1`, `dosage2`,
 `dosage3`, `days1`, `days2`, `days3`, `how1`, `how2`, `how3`, `complaint`, `diagnosis`, `keyword`, `diagno`, 
 `history`, `intervention`, `action`, `advise`, `treat`, `nextdate`, `nexttime`, `instruct`, `investi1`, 
 `instruct1`, `note`, `bill`, `opd`, `xray1`, `ref_doctor`, `path`, `remarks`, `ortho`, `paed`, `physio1`, 
 `telno`, `mobile`, `city`, `otwaiting`, `otschedule`, `keyword1`, `select`, `nexthosp`, `visit`, `comments`,
  `medical`, `invadvise`, `invletter`, `physio`, `admit`, `refer`, `thank`, `admit1`, `otcost`, `goals`,
   `clinical`, `medidate`, `centre`, `opddate`, `findings`, `medicines`, `howtotake`, `dosage`, `impression`,
    `cost`, `nxttext`, `calendar`, `surgery`, `hosp`, `exam_temp`, `opd_temp`) ";

*/

//echo $nxtdate;
/*$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

$sq11=mysql_query("select max(opd_id) from `opd`");
$max11=mysql_fetch_row($sq11);
//echo $max[0];
$newopd=$max11[0]+1;
 $newsrno=$max12[0]."-".$newopd;
echo "INSERT INTO `opd`(`opd_id`,`patient_id`, `opddate`,`hospital`,`complaint`,`clinical`,`advise`,`diagnosis`, `medicines`,`howtotake`,`dosage`,`intervention`,`impression`,`invadvise`,`goals`,`comments`,`cost`,`days1`,`nextdate`,`nxttext`,`nexttime`,`nexthosp`,`surgery`, `hosp`,`action`,`keyword1`,`exam_temp`, `opd_temp`,`instruct`,`app_id`,`block_id`,`opd_real_id`,`potency`,`prescmnt`) 
values('$newopd','$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'), '$hospital','$comp','$finding','$adv','$diag','$strarray1','','$strarray','$soi','$impr','$invest','$physio','$comm','$cost','$strarray3', STR_TO_DATE('".$nxtdate."','%d/%m/%Y'), '$nxttext','$slot','$hos1','$surgery','$hos','$actxt','$key1','$examtemp','$opdtemp','$instruc','$aid','$block_id','$newsrno','$strarray4','$strarray5')";;

$sql="INSERT INTO `opd`(`opd_id`,`patient_id`, `opddate`,`hospital`,`complaint`,`clinical`,`advise`,`diagnosis`, `medicines`,`howtotake`,`dosage`,`intervention`,`impression`,`invadvise`,`goals`,`comments`,`cost`,`days1`,`nextdate`,`nxttext`,`nexttime`,`nexthosp`,`surgery`, `hosp`,`action`,`keyword1`,`exam_temp`, `opd_temp`,`instruct`,`app_id`,`block_id`,`opd_real_id`,`potency`,`prescmnt`) 
values('$newopd','$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'), '$hospital','$comp','$finding','$adv','$diag','$strarray1','','$strarray','$soi','$impr','$invest','$physio','$comm','$cost','$strarray3', STR_TO_DATE('".$nxtdate."','%d/%m/%Y'), '$nxttext','$slot','$hos1','$surgery','$hos','$actxt','$key1','$examtemp','$opdtemp','$instruc','$aid','$block_id','$newsrno','$strarray4','$strarray5')";
//echo $sql;
$result=mysql_query($sql);
if(!$result)
echo "failed".mysql_error();
if($nxtdate!=''){

$sqnx=mysql_query("select max(app_id) from `appoint`");
$maxnx=mysql_fetch_row($sqnx);
//echo $max[0];
$newpatidnx=$maxnx[0]+1;
$newsrnonx=$max12[0]."-".$newpatidnx;
if($_POST['apptype']!='' && $_POST['sl']!='')
$app="insert into `appoint`(no,hospital,app_date,block_id,slot,app_real_id,app_id,new_old,center) values('$patid','$_POST['apptype']',STR_TO_DATE('".$nxtdate."','%d/%m/%Y'),'$block_id','$slot','$newsrnonx','$newpatidnx','O','$hos1')";
$appresult=mysql_query($app);
}

$sq=mysql_query("select max(opd_real_id) from opd");
$max=mysql_fetch_row($sq);
/*
$sql1="insert into opdmedicine(opd_id,patient_id,medicine,how,dosage) values('$max[0]','$patid','$strarray1','$strarray2','$strarray')";
$result1=mysql_query($sql1);
*/

///upload photo
/*$image=$_FILES['image']['name']; 
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

	  mysql_query("insert into patient_photo(patient_id,photo_date,photo,opd_id)values('$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'),'$newname','$newsrno')");
	}
 
///end of photo
//echo "update appoint set status='yes',presstat='1' where app_real_id='".$aid."'";
mysql_query("update patient set pattype='$comm' where srno='".$patid."'");
 mysql_query("update appoint set status='yes',presstat='3' where app_real_id='".$aid."'");
if($result)
{
//unset($_POST['Submit']);
//header("location: view_opd.php");
include("clinic2_print.php");
 }else
echo "error Inserting data".mysql_error();
}
else
include("clinic2_print.php"); 
*/

?>