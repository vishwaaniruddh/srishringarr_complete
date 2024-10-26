<?php

$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<table border='1' width='700px'>
<tr>
	<th>COMPLAINT ID</th>
	<th>ATM ID</th>
	<th>BANK</th>
	<th>State</th>
	<th>City</th>
</tr>";
$tbl.="<tr>
		<td>1</td>
		<td>test1</td>
		<td>testbank</td>
		<td>cg</td>
		<td>bhilai</td>
	</tr>";	

	$to = 'work.rajeshb@gmail.com';
// 	$ccm=implode(",",extract_email_address($alertr[32]));
// 	$ccm=str_replace("<","",$ccm);
//     $cc=str_replace(">","",$ccm);
	
	$subject = $alertr[29];
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>Delegated By:</font> <font color='red'>".$_SESSION['user']."</font> </body></html>";
	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
// 	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;
	$mailqry=mail($to, $subject, $message, $headers);
	
	if($mailqry){
	    echo '<script>
	        alert("mail sent");
	    </script>';
	    
	}else {
	    echo 0;
	}


?>