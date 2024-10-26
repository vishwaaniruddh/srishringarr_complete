<?php
include('config.php');
 $msg=$_POST['msg'];
 $to=nl2br(stripslashes($_POST['email']));
$result = mysql_query($msg) or die(mysql_error());
$message='<table class="results" border="1" cellpadding="3" cellspacing="1">
 
       
          <tr>
          <td width="71" style="color:#ac0404; font-size:12px; font-weight:bold;">App_Date</td>
          <td width="105" style="color:#ac0404; font-size:12px; font-weight:bold;">Time</td>
          <td width="108" style="color:#ac0404; font-size:12px; font-weight:bold;">Patient_Name</td>
          <td width="64" style="color:#ac0404; font-size:12px; font-weight:bold;">Contact</td>
          <td width="69" style="color:#ac0404; font-size:12px;font-weight:bold;">New/Old</td>
          <td width="126" style="color:#ac0404; font-size:12px;font-weight:bold;">Ref.Doctor</td>
          <td width="124" style="color:#ac0404; font-size:12px; font-weight:bold;">Hospital</td>
          <td width="48" style="color:#ac0404; font-size:12px; font-weight:bold;">Type</td>
          </tr>';


$intRows = 0;
// Insert a new row in the table for each person returned

while($row= mysql_fetch_row($result))
{
$result1 = mysql_query("select * from patient where srno='$row[1]'");
$row1=mysql_fetch_row($result1);
$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
$row2=mysql_fetch_row($result2);
$result5=mysql_query("select * from appoint");
$row5=mysql_fetch_row($result5);

$result6=mysql_query("select * from slot where block_id='$row[3]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[4]-1)* 10;
//echo $mins;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);

$message.='<tr>
   
    <td>';
	if(isset($row[2]) and $row[2]!='0000-00-00')
 $message.=date('d/m/Y',strtotime($row[2])).' </td>
    <td>'.$apptime.'</td>
    <td>'.$row1[6].'</td>
    <td>';
	if($row1[23]=="") $message.= $row1[22];
	 else $message.= $row1[23].'
	</td>
    <td>';
	if($row[5]=="N") $message.="New";
	else $message.="Old".'</td>';
    $message.='<td>';
	 if (is_numeric($row1[9]))  $message.=$row2[1];
	 else $message.=$row1[9].' </td>';
	  $message.='<td>'.$row[7].'</td>
	 <td>'.$row[6].'</td>
	 </tr>';
    
	 $intRows++; } 
	 
$message.='</table>'; 
//echo $message;
//$to = 'kvaljani@gmail.com';
			
			$subject = 'MISSED APPOINMENTS';
			
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
              echo 'Your message has been Mailed. <a href="View_app.php"> Go Back </a>';
              
            } else {
              echo 'There was a problem sending the email.';
            }
?>