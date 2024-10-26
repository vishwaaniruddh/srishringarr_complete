<?php 
include('config.php');

session_start();
$d=date('Y-m-d');
$fname=$_POST['fname'];
$year=$_POST['year'];
$month=$_POST['month'];
$day=$_POST['day'];
$dob=$year."-".$month."-".$day;
$gender=$_POST['gen'];
$con12=$_POST['cn12'];
$con22=$_POST['cn22'];
$mob2=$_POST['mob2'];
$city=$_POST['city'];
$address=$_POST['add'];
$email1=$_POST['email1'];
$email2=$_POST['email2'];
$newname='';
//$oi=$_POST['oi'];
$ref=$_POST['ref'];
$center=$_POST['center'];
/*$docref=$_POST['docref1'];
$doc=$_POST['doc'];
$follow=$_POST['follow'];

$email3=$_POST['email3'];
$cn=$_POST['cn1'];
$city1=$_POST['city1'];
$spl=$_POST['spl'];

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

$tos=$_POST['tosref1']; $toscity=$_POST['toscity']; $tostel=$_POST['tostel']; $tosemail=$_POST['tosemail'];
$paed=$_POST['paedref1']; $paedcity=$_POST['paedcity']; $paedtel=$_POST['paedtel']; $paedemail=$_POST['paedemail'];
$phys=$_POST['physref1']; $physcity=$_POST['physcity']; $phystel=$_POST['phystel']; $physemail=$_POST['physemail'];
$neu=$_POST['neuref1']; $neucity=$_POST['neucity']; $neutel=$_POST['neutel']; $neuemail=$_POST['neuemail'];
$sw=$_POST['swref1']; $swcity=$_POST['swcity']; $swtel=$_POST['swtel']; $swemail=$_POST['swemail'];
$ng=$_POST['ngref1']; $ngcity=$_POST['ngcity']; $ngtel=$_POST['ngtel']; $ngemail=$_POST['ngemail'];


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
//from here


$photo=$_FILES['photo']['name']; 
//$old=$_POST['old'];
define ("MAX_SIZE","3000");
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
 	

 	//if it is not empty
	//echo count($image1);
 	if (!$photo=="") 
 	{
 	//get the original name of the file from the clients machine
 		$filename = stripslashes($photo); //echo $filename;
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

//we will give an unique name, for example the time in unix time format
$photo_name1=$time.'.'.$extension; //echo $image_name[$j];
$time=$time+1;
//echo "TIME IS  :".time();
//the new name will be containing the full path where will be stored (images folder)
$newname="patients_photo/".$photo_name1;
//echo $newname;
//we verify if the image has been uploaded, and print error instead
$copied = copy($_FILES['photo']['tmp_name'],$newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
	$errors=1;
}}
//echo $newname;


}

//$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
//$max12=mysql_fetch_row($sq12);
$ini=substr($center,0,1);
//till here
//echo "select max(no) from `patient` where area='$center'";
$sq=mysql_query("select max(no) from `patient` where area='$center'");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;

$newsrno=$ini."-".$newpatid;

//echo "INSERT INTO `patient`(`no`,`srno`,`name`,`birth`,`sex`,`telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`,`remarks`,`occupation`,`maritalstatus`) values('".$newpatid."','".$newsrno."','".$fname."','".$dob."','".$gender."','".$con12."','".$con22."','".$city."','".$address."','".$ref."','".$d."','".$email1."','".$email2."','".$mob2."','".$newname."','".$_POST['pattype']."','".$center."','".$_POST['rem']."','".$_POST['occu']"','".$_POST['marit']."')";
$result=mysql_query("INSERT INTO `patient`(`no`,`srno`,`name`,`birth`,`sex`,`telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`,`remarks`,`occupation`,`maritalstatus`,`REFERENCE`) values('".$newpatid."','".$newsrno."','".$fname."','".$dob."','".$gender."','".$con12."','".$con22."','".$city."','".$address."','".$ref."','".$d."','".$email1."','".$email2."','".$mob2."','".$newname."','".$_POST['pattype']."','".$center."','".$_POST['rem']."','".$_POST['occu']."','".$_POST['marit']."','".$_POST['patref']."')");
//echo $sql;
//$result=mysql_query($sql);
if(!$result)
echo "failed ".mysql_error();
if($_POST['pattype']=='r')
{
$stdt=str_replace("/","-",$_POST['stdt']);
$stdt2=date('Y-m-d', strtotime($stdt));
$pack=mysql_query("select * from package where packid='".$_POST['pack']."'");
$packro=mysql_fetch_row($pack);
$expdt=date('Y-m-d', strtotime($stdt .' +'.$packro[1].'-'.'1 day'));
$dis=$packro[2]-$_POST['packamt'];
//echo "Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`) Values('".$newsrno."','".$_POST['pack']."','".$stdt2."','".$expdt."')";
$package=mysql_query("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`,`center`) Values('".$newsrno."','".$packro[1]."','".$stdt2."','".$expdt."','".$_POST['netamt']."','".$_POST['disamt']."','".$center."')");
if(!$package)
echo "failed".mysql_error();

}
if($result)
{
	$sqapp=mysql_query("select max(app_id) from `appoint`");
$maxapp=mysql_fetch_row($sqapp);
//echo $max[0];
$newappid=$maxapp[0]+1;
$newapp=$ini."-".$newappid;
//$newapp."-".$newappid;
$app=mysql_query("insert into `appoint`(name,no,type,hospital,app_date,new_old,remarks,block_id,slot,app_real_id,app_id,center,confirmstat) values('".$fname."','".$newsrno."','0','NP Slot','".$d."','N','".$_POST['rem']."','0','0','$newsrno','$newapp','".$center."','c')");	
/*if($app)
{
 $address = "919323654529";
 $result6=mysql_query("select * from slot where block_id='$row[3]'");
$row6=mysql_fetch_row($result6);
$dur=mysql_query("select duration from apptype where type='".$row6[1]."'");
$durro=mysql_fetch_row($dur);
$stime=$row6[3];
$mins=($row[4]-1)* $durro[0];
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 

 $message = "DEAR ".$fname." , Permit Us To REMIND YOU Of Your APPOINTMENT, ".##Field## ,ON ##Field## ,At DR. RAI’s HEALTHCARE CLINIC, ##Field## Branch.";
 function PostRequest($url, $referer, $_data) {
// convert variables array to string:
$data = array();
while(list($n,$v) = each($_data)){
$data[] = "$n=$v";
}
$data = implode('&', $data);
// format --> test1=a&test2=b etc.
// parse the given URL
$url = parse_url($url);
if ($url['scheme'] != 'http') {
die('Only HTTP request are supported !');
}
// extract host and path:
$host = $url['host'];
$path = $url['path'];
// open a socket connection on port 80
$fp = fsockopen($host, 80);
// send the request headers:
fputs($fp, "POST $path HTTP/1.1\r\n");
fputs($fp, "Host: $host\r\n");
fputs($fp, "Referer: $referer\r\n");
fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
fputs($fp, "Content-length: ". strlen($data) ."\r\n");
fputs($fp, "Connection: close\r\n\r\n");
fputs($fp, $data);
$result = '';
while(!feof($fp)) {
// receive the results of the request
$result .= fgets($fp, 128);
}
// close the socket connection:
fclose($fp);
// split the result header from the content
$result = explode("\r\n\r\n", $result, 2);
$header = isset($result[0]) ? $result[0] : '';
$content = isset($result[1]) ? $result[1] : '';
// return as array:
return array($header, $content);
}
$data = array(
'user' => "satyendra_sar",
'password' => "637696",
'msisdn' => $address,
'sid' => "DRRAIS",
'msg' => $message,
'fl' =>"0",
'gwid' => "2",
);
list($header, $content) = PostRequest(
"http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to
"http://sarmicrosystems.in/newclinic/updated/new_patient.php", // its your url
$data
);
//echo $content;
//mysql_query("insert into sms values('".$content."','".$today."','".$message."')");
}	*/
if(isset($_POST['Submit'])){
header("location: patient_detail.php?id=".$newsrno);
}
else {header("location: view_patient1.php");}
}
else
echo "error Inserting data".mysql_error();


?>