<?php 
include('config.php');

$id=$_POST['patient_id'];
$name=$_POST['name'];
$mob=$_POST['mob'];
$appdate=$_POST['appdate'];
//$hr=$_POST['hour'];
//$min=$_POST['min'];
//$time= $hr.":".$min;
$type=$_POST['type'];
$hosp=$_POST['hos'];
$new=$_POST['new'];
$rema=$_POST['rem'];
//$ch1=$_POST['ch1'];
$block_id=$_POST['block_id'];
$slot=$_POST['sl'];
$ch=$_POST['ch'];
if(isset($_POST['submit']))
{

$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

//till here
$sq=mysql_query("select max(app_id) from `appoint`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
$newsrno=$max12[0]."-".$newpatid;
$center=$_POST['center'];
$sql="insert into `appoint`(name,no,type,hospital,app_date,new_old,remarks,block_id,slot,app_real_id,app_id,center,confirmstat) values('$name','$id','$type','$hosp',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$new','$rema','$block_id','$slot','$newsrno','$newpatid','".$center."','c')";
$result=mysql_query($sql);
if($result)
{
if($hosp != 'courier' and $hosp != 'collection'){
 $mob=",91".$mob;
 $address = "919820845863".$mob;
 $result6=mysql_query("select * from slot where block_id='$block_id'");
$row6=mysql_fetch_row($result6);
$dur=mysql_query("select duration from apptype where type='".$row6[1]."'");
$durro=mysql_fetch_row($dur);
$stime=$row6[3];
$mins=($slot-1)* $durro[0];
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 

 $message = "DEAR ".$name." , Permit Us To REMIND YOU Of Your APPOINTMENT, ".$apptime." ,ON ".$appdate." ,At DR. RAIs HEALTHCARE CLINIC, ".$center." Branch.";
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
"http://sarmicrosystems.in/newclinic/updated/processapp.php", // its your url
$data
);
$today = date("Y-m-d H:i:s"); 
//echo $message;
//echo $content;
$myvar=mysql_query("insert into sms values('".$content."','".$today."','".$message."','".$address."',NULL)");
//if(!$myvar)
//echo mysql_error();
}	
header("location: view_patient1.php");

}
else
echo "error Inserting data"; 

}

else{

$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

//till here
$sq=mysql_query("select max(app_id) from `appoint`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
$newsrno=$max12[0]."-".$newpatid;

$sql="insert into `appoint`(name,no,type,hospital,app_date,new_old,remarks,block_id,slot,app_real_id,app_id,center,confirmstat) values('$name','$id','$type','$hosp',STR_TO_DATE('".$appdate."','%d/%m/%Y'),'$new','$rema','$block_id','$slot','$newsrno','$newpatid','".$center."','w')";
//echo $sql;
$result=mysql_query($sql);
if($result)
{
	
//header("location: view_patient1.php");

}
else
echo "error Inserting data";

}

?>