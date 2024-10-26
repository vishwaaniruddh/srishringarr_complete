<?
session_start();
include('access.php');
$siteid=$_POST['site_id'];
$link=$_POST['link'];
$email=$_POST['add'];

if($email==''){ echo "No email id provided"; die;}

//var_dump($_POST);
//die;

	function extract_email_address($string) {
    foreach(preg_split('/\s/', $string) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $emails[] = $email;
        }
    }
    return $emails;
}


$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>Installed snaps for the site: <font color='blue'>".$siteid."</font></p>
<table border='1' width='700px'>
<tr><th>Snap Link</th></tr>";
$tbl.="<tr>
       
		<td>".$link."</td>
	</tr>";

  //  $cc=$ccm=implode(",",extract_email_address($alertr[32]));
	$to = $email;
	$subject = "Snaps for the site ".$siteid;
	
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>Sent By:</font> <font color='red'>".$_SESSION['user']."</font> </body></html>";
	$headers = "From:<Operations AVO@avoservice.in>\r\n";
	//$headers .= "Reply-To: ".dfdf . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	//$message="Update Time : ".$cdate."<br><br>Update for complaint no ".$resal[2].": ".$st;
//	echo $message;

	$mailqry=mail($to, $subject, $message, $headers);
	
if($mailqry){ ?>
<script type="text/javascript">
    alert("Successfully sent the sanps");
   window.close();
    
</script>
<?  } ?>	