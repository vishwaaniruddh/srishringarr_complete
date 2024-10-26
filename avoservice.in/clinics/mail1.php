<?php
include('config.php');
$msg=$_POST['msg'];

$a=explode("LIMIT",$msg);

$result = mysql_query($a[0]) or die(mysql_error());
$message='<table class="results" border="1" cellpadding="3" cellspacing="0">
 
       
          <tr>

<th width="70" style="color:#ac0404; font-size:12px; font-weight:bold;">Surgery Date</th>
<th width="68" style="color:#ac0404; font-size:12px; font-weight:bold;">Time</th>
<th width="68" style="color:#ac0404; font-size:12px; font-weight:bold;"> Name</th> 
<th width="46" style="color:#ac0404; font-size:12px; font-weight:bold;">N/F,Age</th>	
<th width="81" style="color:#ac0404; font-size:12px; font-weight:bold;"> Contact no.</th>
<th width="70" style="color:#ac0404; font-size:12px; font-weight:bold;"> Diagnosis</th>
<th width="70" style="color:#ac0404; font-size:12px; font-weight:bold;"> Suregery</th>
<th width="67" style="color:#ac0404; font-size:12px; font-weight:bold;"> OT Type</th>
<th width="67" style="color:#ac0404; font-size:12px; font-weight:bold;"> City</th>
<th width="114" style="color:#ac0404; font-size:12px; font-weight:bold;"> Hospital Name</th>
<th width="73" style="color:#ac0404; font-size:12px; font-weight:bold;"> Anesthetic	</th>
<th width="52" style="color:#ac0404; font-size:12px; font-weight:bold;"> Pts.HB	</th>
<th width="69" style="color:#ac0404; font-size:12px; font-weight:bold;"> Implant</th>
<th width="82" style="color:#ac0404; font-size:12px; font-weight:bold;"> Room Type</th>
<th width="90" style="color:#ac0404; font-size:12px; font-weight:bold;"> NBM</th>
<th width="91" style="color:#ac0404; font-size:12px; font-weight:bold;"> Admission</th>
<th width="75" style="color:#ac0404; font-size:12px; font-weight:bold;"> Cat</th>
          </tr>';


$intRows = 0;
// Insert a new row in the table for each person returned

while($row= mysql_fetch_row($result))
{
//$result1 = mysql_query("select * from patient where no='$row[9]'");
//$row1=mysql_fetch_row($result1);

//$result2 = mysql_query("select * from appoint where app_id='$row[10]'");
//$row2=mysql_fetch_row($result2);

$result2 = mysql_query("select diagnosis from opd where patient_id='$row[7]'");
$row2=mysql_fetch_row($result2);

$result3 = mysql_query("select doc_id,name from doctor where doc_id='$row[14]'");
$row3=mysql_fetch_row($result3);
$result6=mysql_query("select * from slot where block_id='$row[2]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[3]-1)* 10;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 	 
if(isset($row[0]) and $row[0]!='0000-00-00')  $surdt=date('d/m/Y',strtotime($row[0]));

if(isset($row[3]) and $row[3]!='0000-00-00') $ad_ddt=date('d/m/Y',strtotime($row[3]));

$message.='<tr>
	
	 <td>'.$surdt.'</td>
    <td>'.$row[6]."-".$row[7].'</td>
     <td>'.$row[18].'</td>
	<td>'.$row[5].",".$row[22].'</td>
    <td>'.$row[21].'</td>
    <td>'.$row[8] .'</td>
	 <td>'.$row[9].'</td>
	  <td>'.$row[10].'</td>
	   <td>'.$row[20].'</td>
	   <td>'.$row[11].'</td>
	    <td>'.$row3[1].'</td>
		 <td> '.$row[12].'</td>
		  <td>'.$row[13].'</td>
		   <td>'.$row[2].'</td>
		   <td>'.$row[15].'</td>
    <td>'.$ad_ddt.'<br/>'.$row[18].'</td>
   <td>'. $row[16].'</td>
    </tr>
    
    </tr>';
    
	 $intRows++; } 
	 
$message.='</table>'; 

$to = 'preeti.nishi@gmail.com,kvaljani@gmail.com';
/////$to = 'kvaljani@gmail.com,taralnagda.ipodindia@gmail.com,jaideep.dhamele@gmail.com,yagnik.ipodindia@gmail.com,nutanipodindia@gmail.com,poonamipodindia@gmail.com,suchitrabhosaleipodindia@gmail.com, vijendraipodindia@gmail.com,pankaj.ipodindia@gmail.com,drsachin_k@yahoo.com';
			
			$subject = 'Surgery APPOINMENTS';
			
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