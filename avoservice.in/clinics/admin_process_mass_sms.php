<?
session_start();
//Inizialize database functions
include_once "ez_sql.php";

//Include global functions
include_once "common.php";

// config
include_once "configuration.php";

$smsto=get_param("smsto");
$message=stripslashes(get_param("message"));
$jsect=get_param("js");
$ssect=get_param("ss");
$slist=get_param("slist");
//echo $slist;
//$subject=get_param("subject");

if ($smsto!="both"){
        if($smsto=="1")
       { 
        if($jsect=="0")
	$sSQL="SELECT studentcontact_phone1 AS phone FROM studentcontact where studentcontact_id in(select studentbio_id from studentbio where studentbio_school=1)";
        else	
	$sSQL="SELECT studentcontact_phone1 AS phone FROM studentcontact where studentcontact_id in(select studentbio_id from studentbio where studentbio_school=1 and studentbio_homeroom=$jsect)";        
       }
      if($smsto=="3")
       { 
        if($ssect=="0") 
	$sSQL="SELECT studentcontact_phone1 AS phone FROM studentcontact where studentcontact_id in(select studentbio_id from studentbio where studentbio_school=3)";
        else
        $sSQL="SELECT studentcontact_phone1 AS phone FROM studentcontact where studentcontact_id in(select studentbio_id from studentbio where studentbio_school=3 and studentbio_homeroom=$ssect)"; 	
       } 
	$emails = $db->get_results($sSQL);
      if($smsto=="list")
       {
        $emails = explode(",", $slist); 
       } 
}else{
	$sSQL1="SELECT studentcontact_phone1 AS phone FROM studentcontact where studentcontact_id in(select studentbio_id from studentbio where studentbio_school=1)";
	$sSQL2="SELECT studentcontact_phone1 AS phone FROM studentcontact where studentcontact_id in(select studentbio_id from studentbio where studentbio_school=3)";
	$emails_teach=$db->get_results($sSQL1);
	$emails_conta=$db->get_results($sSQL2);
};

/*
require_once "class.phpmailer.php";
$mail = new PHPMailer();

$mail->IsSMTP();  // send via SMTP
$mail->Host     = $SMTP_SERVER; // SMTP servers
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Username = $SMTP_USER;  // SMTP username
$mail->Password = $SMTP_PASSWORD; // SMTP password
$mail->From     = $SMTP_FROM_EMAIL;
$mail->FromName = $SMTP_FROM_NAME;
$mail->AddAddress($SMTP_FROM_EMAIL,_ADMIN_PROCESS_MASS_MAIL_GENERAL);
*/
$address = "919776051706";

if ($smsto!="both"){
    if($smsto!="list"){
   foreach ($emails as $email){
   // echo "hg"; 
     if (($email->phone != "") && ($email->phone != " ") && (trim($email->phone) != "Na") && (trim($email->phone) != "NA")) { $address = $address.",91".trim($email->phone) ; }
   // echo $email->phone ; 
   };
   }else{
    foreach ($emails as $email){ $address=$address.",91".$email ; };
        } 
}else{
   foreach ($emails_teach as $emails){
     if (($emails->phone != "") && ($email->phone != " ") && (trim($emails->phone) != "Na")) { $address = $address.",91".trim($emails->phone) ; }
   };
   foreach ($emails_conta as $emails){
     if (($emails->phone != "") && ($email->phone != " ") && (trim($emails->phone) != "Na")) { $address = $address.",91".trim($emails->phone) ; }
   };
};
//echo $address;

$today = date("d\m\Y");         
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
$data = array(
'user' => "LHTA",
'password' => "618814",
'msisdn' => $address,
'sid' => "LHTA",
'msg' => $message,
'fl' =>"0",
);
list($header, $content) = PostRequest(
"http://www.smslane.com//vendorsms/pushsms.aspx", // the url to post to
"http://www.littlehearts.ind.in/admin_process_mass_sms.php", // its your url
$data
);
echo $content;
mysql_query("insert into sms values('".$content."','".$today."','".$message."')");
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