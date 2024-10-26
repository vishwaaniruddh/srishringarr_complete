<?
//session_start();
// config
include_once "config.php";

$sql=mysql_query("select name,mobile from `patient` where mobile<>'' and length(MOBILE)=10");


//$today = date("d\m\Y");         
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
/*
$sql = "select web_users_relid,web_users_username from web_users where web_users_type='C'";
$res = $db->get_results($sql);
$result="send-";
foreach($res as $ress){
        // echo $ress->web_users_relid."<br>";
        $sql1 = "select studentcontact_phone1 from studentcontact where studentcontact_studentid=$ress->web_users_relid";
        $res1 = $db->get_results($sql1);
       foreach($res1 as $ress1) {
        echo $ress->web_users_username."-".$ress1->studentcontact_phone1."<br>";
  */      
  while($max=mysql_fetch_row($sql)){
  if(is_numeric($max[1])){
echo $max[0]."--".$max[1]."<br>";
$address="91".$max[1];
//$address="918237123081";
//$message="Wishing you a Healthy New Year. A Lifetime of Healthcare can be your resolution this year with Dr. Rai's 'My Health Card'";
$message="Dr. Rai's Healthcare gifting you and your loved ones this Diwali with lifetime membership worth 1 lac @ 30000/-";
$data = array(
'user' => "satyendra_sar",
'password' => "637696",
'msisdn' => $address,
'sid' => "WEBSMS",
'msg' => $message,
'fl' =>"0",
//'gwid' => "2",
);
list($header, $content) = PostRequest(
"http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to
"http://sarmicrosystems.in/newclinic/updated/mass_sms_clinics.php", // its your url
$data
);
$today = date("Y-m-d H:i:s"); 
echo $message;
echo $content;
mysql_query("insert into sms values('".$content."','".$today."','".$message."','".$address."',NULL)");
} }
//echo $content;
//mysql_query("insert into sms values('".$content."','".$today."','".$message."')");
//$result=$result."<br>".$content; 
   // };
   // }; 
  // echo $result; 
//echo $address;
//echo $message;
//header("Location: http://smslane.com/vendorsms/pushsms.aspx?user=satyendra1111&password=207860&msisdn=".$address."&sid=WebSMS&msg=".$message."&fl=0");
/*
$mail->AddReplyTo($SMTP_REPLY_TO,$SMTP_FROM_NAME);
$mail->WordWrap = 70;     // set word wrap
$mail->Subject  =  $subject;
$mail->Body = $message;
if($mail->Send()){
	header("Location: admin_main_menu.php");
	exit();
};
echo $mail->ErrorInfo; */
?>