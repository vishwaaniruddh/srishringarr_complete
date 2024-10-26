<?php 
include('config.php');

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

$date = date("Y-m-d");
//$date1 = str_replace('-', '/', $date);
$tomorrow = date('Y-m-d',strtotime($date . "+1 days"));
echo $tomorrow;

//till here
$sq=mysql_query("select * from `appoint` where app_date='".$tomorrow."' and cancstat=0 and (hospital <>'courier' AND hospital <>'collection')");
while($max=mysql_fetch_row($sq)){
echo $max[11]."--".$max[12]."--".$max[15]."<br>";
$sq1=mysql_query("select name,mobile from `patient` where srno='".$max[11]."'");
$max1=mysql_fetch_row($sq1);
 $name=$max1[0];
 $mob=",91".$max1[1];
 $address = "919820845863".$mob;
 $result6=mysql_query("select * from slot where block_id='$max[20]'");
$row6=mysql_fetch_row($result6);
$dur=mysql_query("select duration from apptype where type='".$row6[1]."'");
$durro=mysql_fetch_row($dur);
$stime=$row6[3];
$mins=($max[21]-1)* $durro[0];
$center=$max[24];
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 

 $message = "DEAR ".$name." , Permit Us To REMIND YOU Of Your APPOINTMENT, ".$apptime." ,ON ".$tomorrow." ,At DR. RAIs HEALTHCARE CLINIC, ".$center." Branch.";
 echo $message; 
 
 
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
echo $content;
mysql_query("insert into sms values('".$content."','".$today."','".$message."','".$address."',NULL)");
}	

?>