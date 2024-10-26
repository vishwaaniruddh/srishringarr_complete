<?php 
include('config.php');
try{
$id=$_POST['id'];
$fname=$_POST['fname'];
$year=$_POST['year'];
$month=$_POST['month'];
$day=$_POST['day'];
$dob=$year."-".$month."-".$day;
$age=$_POST['age'];
$gender=$_POST['gen'];
$con12=$_POST['cn12'];
$con22=$_POST['cn22'];
$city=$_POST['city'];
$address=$_POST['add'];
//$oi=$_POST['oi'];
$ref=$_POST['ref'];
$docref=$_POST['ref1'];
$doc=$_POST['doc'];
$follow=$_POST['follow'];
$email1=$_POST['email1'];
$email2=$_POST['email2'];
$email3=$_POST['email3'];
$cn=$_POST['cn1'];
$city1=$_POST['city1'];
$spl=$_POST['spl'];
$d=date('Y-m-d');
$center=$_POST['center'];
$rem=$_POST['rem'];
$ncity=$_POST['ncity'];
$ncen=$_POST['ncen'];
$ntos=$_POST['ntos'];
$npad=$_POST['npad'];
$nphy=$_POST['nphy'];
$nneu=$_POST['nneu'];
$nsw=$_POST['nsw'];
$nng=$_POST['nng'];
$nref=$_POST['nref'];
$oldimg = $_POST['oldimg'];
/*
if($city=='Other' && $ncity!=''){$city=$ncity;
if($city!='Other'){
$cy=mysql_query("insert into city(name) values ('$city')");
}
}

if($center=='Other' && $ncen!=''){$center=$ncen;
if($center!='Other'){
$cen=mysql_query("insert into area(name) values ('$center')");
}
}

if($docref=='Other' && $nref!=''){$docref=$nref;
if($docref!='Other'){
$d=mysql_query("insert into doctor(name) values ('$docref')");
}
}


$tos=$_POST['tos']; $toscity=$_POST['toscity']; $tostel=$_POST['tostel']; $tosemail=$_POST['tosemail'];
$paed=$_POST['paed']; $paedcity=$_POST['paedcity']; $paedtel=$_POST['paedtel']; $paedemail=$_POST['paedemail'];
$phys=$_POST['phys']; $physcity=$_POST['physcity']; $phystel=$_POST['phystel']; $physemail=$_POST['physemail'];
$neu=$_POST['neu']; $neucity=$_POST['neucity']; $neutel=$_POST['neutel']; $neuemail=$_POST['neuemail'];
$sw=$_POST['sw']; $swcity=$_POST['swcity']; $swtel=$_POST['swtel']; $swemail=$_POST['swemail'];
$ng=$_POST['ng']; $ngcity=$_POST['ngcity']; $ngtel=$_POST['ngtel']; $ngemail=$_POST['ngemail'];

if($tos=='Other' && $ntos!=''){$tos=$ntos;
if($tos!='Other'){
$q=mysql_query("insert into doctor(name,category,special) values ('$tos','Orthopaedic Surgeon','Orthopaedic Surgeon')");
}
}

if($paed=='Other' && $npad!=''){$paed=$npad;
if($paed!='Other'){
$q1=mysql_query("insert into doctor(name,category,special) values ('$paed','Paediatrician','Paediatrician')");
}
}

if($phys=='Other' && $nphy!=''){$phys=$nphy;
if($phys!='Other'){
$q2=mysql_query("insert into doctor(name,category,special) values ('$phys','physiotherapist','physiotherapist')");
}
}

if($neu=='Other' && $nneu!=''){$neu=$nneu;
if($neu!='Other'){
$q3=mysql_query("insert into doctor(name,category,special) values ('$neu','Neuro Surgeon','Neuro Surgeon')");
}
}

if($sw=='Other' && $nsw!=''){$sw=$nsw;
if($sw!='Other'){
$q4=mysql_query("insert into social(name) values ('$sw')");
}
}

if($ng=='Other' && $nng!=''){$ng=$nng;
if($ng!='Other'){
$q5=mysql_query("insert into ngo(name) values ('$ng')");
}
}
*/
//////image

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
 if(isset($_POST['submit'])) 
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
 			echo '<h1>Unknown extension!</h1>';
 			$errors=1;
 		}
 		else
 		{
//get the size of the image in bytes
 //$_FILES['image']['tmp_name'] is the temporary filename of the file
 //in which the uploaded file was stored on the server
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
$newname="patients_photo/".$image_name;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['image']['tmp_name'], $newname);
if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}}else { $newname=$oldimg;} }

	   if(isset($_POST['submit']) && !$errors) 
 {
 //"INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`, `telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','$newsrno','$fname','$dob','$gender','$con12','$con22','$city','$address','$ref','$d','$email1','$email2','$mob2','$newname','".$_POST['pattype']."','$center')";
 if($_POST['pattype']=='r')
{
$stdt=str_replace("/","-",$_POST['stdt']);
$stdt2=date('Y-m-d', strtotime($stdt));
//echo "select * from package where `desc`='".$_POST['pack']."'";
$pack=mysql_query("select * from package where `desc`='".$_POST['pack']."'");
$packro=mysql_fetch_row($pack);
//echo $packro[1]." <br>";
$expdt=date('Y-m-d', strtotime($stdt .' + '.$_POST['pack']));
echo $_POST['packamt']." ".$packro[2];
$dis=$packro[2]-$_POST['packamt'];
$get=mysql_query("select * from patient_package where patientid='".$id."' and status=0");
if(mysql_num_rows($get)>0)
{
//echo "Update patient_package set packid='".$_POST['pack']."',startdt='".$stdt2."',expdt='".$expdt."',amt='".$_POST['packamt']."',discount='".$dis."' where patientid='".$id."' and status=0";
$package=mysql_query("Update patient_package set packid='".$_POST['pack']."',startdt='".$stdt2."',expdt='".$expdt."',amt='".$_POST['packamt']."',discount='".$dis."' where patientid='".$id."' and status=0");
}
else
{
//echo "Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`) Values('".$id."','".$_POST['pack']."','".$stdt2."','".$expdt."','".$_POST['packamt']."','".$dis."')";
$package=mysql_query("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`) Values('".$id."','".$_POST['pack']."','".$stdt2."','".$expdt."','".$_POST['packamt']."','".$dis."')");
}
}
 
 //echo "update patient set name='".$fname."',birth='".$dob."',age='".$age."',sex='".$gender."',telno='".$con12."',mobile='".$con22."',city='".$city."',address='".$address."',ref='".$ref."',email='".$email1."', email2='".$email2."',photo='".$newname."',area='".$center."',type='".$_POST['pattype']."' where srno='".$id."'";
$sql="update patient set name='".$fname."',birth='".$dob."',age='".$age."',sex='".$gender."',telno='".$con12."',mobile='".$con22."',city='".$city."',address='".$address."',ref='".$ref."',email='".$email1."', email2='".$email2."',photo='".$newname."',area='".$center."',type='".$_POST['pattype']."',mobile2='".$_POST['mob2']."' where srno='".$id."'";
$result=mysql_query($sql);


if($result)
{
	
header("location: view_patient1.php");

}
else
echo "Error Updating data"; 
}}
catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>