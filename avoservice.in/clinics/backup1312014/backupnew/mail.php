<?php
include('config.php');
$msg=$_POST['msg'];
///echo $msg;

$a=explode("LIMIT",$msg);

$result = mysql_query($a[0]) or die(mysql_error());

$message='<table class="results" border="1" cellpadding="3" cellspacing="1">
 
       
          <tr>
          <td width="55" style="color:#ac0404; font-size:12px; font-weight:bold;">Time</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Name</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Hospital </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">City </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Contact</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">N/F,Age</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Email</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Ref</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Diagnosis</td>
          </tr>';


$intRows = 0;
// Insert a new row in the table for each person returned
////echo mysql_num_rows($result);
while($row= mysql_fetch_row($result))
{
//$result1 = mysql_query("select * from patient where no='$row[9]'");
//$row1=mysql_fetch_row($result1);

//$result2 = mysql_query("select * from appoint where app_id='$row[10]'");
//$row2=mysql_fetch_row($result2);

$result2 = mysql_query("select diagnosis from opd where patient_id='$row[7]'");
$row2=mysql_fetch_row($result2);

$result3 = mysql_query("select doc_id,name from doctor where doc_id='$row[12]'");
$row3=mysql_fetch_row($result3);

$result6=mysql_query("select * from slot where block_id='$row[2]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[3]-1)* 10;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 	 

$message.='<tr>
    <td>'.$apptime.'</td>
    <td>'.$row[6].'</td>
    <td>'.$row[4].'</td>
    <td>'.$row[8].'</td>
    <td>';
	if(isset($row[1]) and $row[1]!='0000-00-00')
 $message.=date('d/m/Y',strtotime($row[1])).' </td>
    <td>'.$row[9].'</td>
    <td>'.$row[5].",".$row[10].'</td>
    <td style="text-transform:lowercase">'.$row[11].'</td>
    <td>'.$row3[1].'</td>
    <td style="word-break:break-all;">'.$row2[0].'</td>
    </tr>';
    
	 $intRows++; } 
	 
$message.='</table>'; 

/////$to = 'kvaljani@gmail.com,taralnagda.ipodindia@gmail.com,jaideep.dhamele@gmail.com,yagnik.ipodindia@gmail.com,nutanipodindia@gmail.com,poonamipodindia@gmail.com,suchitrabhosaleipodindia@gmail.com, vijendraipodindia@gmail.com,pankaj.ipodindia@gmail.com,drsachin_k@yahoo.com';
	$to='kvaljani@gmail.com,preeti.nishi@gmail.com';		
			$subject = 'OPD APPOINMENTS';
			
			$headers = "From: " .Clinic. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            
// message
/*$message = '
<html>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</html>
';*/

// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0;';
//$headers .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it

if (mail($to, $subject, $message, $headers)) {
              echo 'Your message has been Mailed.<a href="opd_reports.php"> Go Back </a>';
            } else {
              echo 'There was a problem sending the email.';
            }
            
?>